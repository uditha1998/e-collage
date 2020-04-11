        <?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of lecture
 *
 * @author User
 */
class Lecture {

    public $id;
    public $full_name;
    public $email;
    public $nic_number;
    public $phone_number;
    public $address;
    public $city;
    public $district;
    public $authToken;
    public $lastLogin;
    public $status;
    public $subject;
    public $image_name;
    public $resetcode;
    public $queue;

    public function __construct($id) {

        if ($id) {

            $query = "SELECT * FROM `lecture` WHERE `id`=" . $id;

            $db = new Database();

            $result = mysql_fetch_array($db->readQuery($query));

            $this->id = $result['id'];
            $this->full_name = $result['full_name'];
            $this->email = $result['email'];
            $this->nic_number = $result['nic_number'];
            $this->phone_number = $result['phone_number'];
            $this->address = $result['address'];
            $this->password = $result['password'];
            $this->authToken = $result['authToken'];
            $this->lastLogin = $result['lastLogin'];
            $this->subject = $result['subject'];
            $this->city = $result['city'];
            $this->district = $result['district'];
            $this->image_name = $result['image_name'];
            $this->resetcode = $result['resetcode'];
            $this->queue = $result['queue'];

            return $result;
        }
    }

    public function create() {

        $query = "INSERT INTO `lecture` (`full_name`,`email`,`nic_number`,`phone_number`,`address`,`district`,`city`,`subject`,`password`) VALUES  ('"
                . $this->full_name . "','"
                . $this->email . "', '"
                . $this->nic_number . "', '"
                . $this->phone_number . "', '"
                . $this->address . "', '"
                . $this->district . "', '"
                . $this->city . "', '"
                . $this->subject . "', '"
                . $this->password . "')";

        $db = new Database();

        $result = $db->readQuery($query);

        if ($result) {
            $last_id = mysql_insert_id();

            return $this->__construct($last_id);
        } else {
            return FALSE;
        }
    }

    public function all() {

        $query = "SELECT * FROM `lecture`  ORDER BY queue ASC";

        $db = new Database();

        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }

        return $array_res;
    }

    public function getActiveStudent() {

        $query = "SELECT * FROM `lecture` WHERE `status` = 1 ORDER BY queue ASC";
        $db = new Database();

        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }

        return $array_res;
    }

    public function getInActiveStudent() {

        $query = "SELECT * FROM `lecture` WHERE `status` = 0 ORDER BY queue ASC";
        $db = new Database();

        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }

        return $array_res;
    }

    public function getAllMembersWithoutThis($lecture) {

        $query = "SELECT * FROM `lecture` WHERE `id` <> '" . $member . "' AND `status` = 1 AND `is_suspend` = 0";
        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }

        return $array_res;
    }

    public function login($email, $password) {

        $enPass = md5($password);

        $query = "SELECT `id`,`full_name`, `email`, `nic_number`  FROM `lecture` WHERE `email`= '" . $email . "' AND `password`= '" . $enPass . "'";

        $db = new Database();

        $result = mysql_fetch_array($db->readQuery($query));

        if (!$result) {

            return FALSE;
        } else {

            $this->id = $result['id'];
            $this->setAuthToken($result['id']);
            $this->setLastLogin($this->id);
            $lecture = $this->__construct($this->id);
            $this->setUserSession($lecture);

            return $lecture;
        }
    }

    public function checkOldPass($id, $password) {

        $enPass = md5($password);

        $query = "SELECT `id` FROM `lecture` WHERE `id`= '" . $id . "' AND `password`= '" . $enPass . "'";

        $db = new Database();

        $result = mysql_fetch_array($db->readQuery($query));

        if (!$result) {
            return FALSE;
        } else {
            return TRUE;
        }
    }

    public function changePassword($id, $password) {

        $enPass = md5($password);

        $query = "UPDATE  `lecture` SET "
                . "`password` ='" . $enPass . "' "
                . "WHERE `id` = '" . $id . "'";

        $db = new Database();

        $result = $db->readQuery($query);

        if ($result) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function ChangeProPic($lecture, $file) {

        $query = "UPDATE  `lecture` SET "
                . "`image_name` ='" . $file . "' "
                . "WHERE `id` = '" . $lecture . "'";

        $db = new Database();

        $result = $db->readQuery($query);

        if ($result) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function updateNicImagesBack($lecture, $nic_back) {

        $query = "UPDATE  `lecture` SET "
                . "`nic_back` ='" . $nic_back . "' "
                . "WHERE `id` = '" . $lecture . "'";


        $db = new Database();

        $result = $db->readQuery($query);

        if ($result) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function updateNicImagesFront($lecture, $nic_front) {

        $query = "UPDATE  `lecture` SET "
                . "`nic_front` ='" . $nic_front . "' "
                . "WHERE `id` = '" . $lecture . "'";


        $db = new Database();

        $result = $db->readQuery($query);

        if ($result) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function authenticate() {

        if (!isset($_SESSION)) {

            session_start();
        }

        $id = NULL;
        $authToken = NULL;

        if (isset($_SESSION["id"])) {

            $id = $_SESSION["id"];
        }

        if (isset($_SESSION["authToken"])) {

            $authToken = $_SESSION["authToken"];
        }

        $query = "SELECT `id` FROM `lecture` WHERE `id`= '" . $id . "' AND `authToken`= '" . $authToken . "'";

        $db = new Database();

        $result = mysql_fetch_array($db->readQuery($query));

        if (!$result) {
            return FALSE;
        } else {
            return TRUE;
        }
    }

    public function logOut() {

        if (!isset($_SESSION)) {

            session_start();
        }

        unset($_SESSION["id"]);
        unset($_SESSION["full_name"]);
        unset($_SESSION["email"]); 
        unset($_SESSION["nic_number"]);
        unset($_SESSION["authToken"]);
        unset($_SESSION["subject"]);
        unset($_SESSION["image_name"]);

        return TRUE;
    }

    public function checkLogin($id) {

        $query = "SELECT * FROM `lecture` WHERE `id` ='" . $id . "'  AND `status` = 0 ";

        $db = new Database();
        $result = mysql_fetch_array($db->readQuery($query));
        return $result['id'];
    }

    private function setUserSession($lecture) {

        if (!isset($_SESSION)) {

            session_start();
        }
        $_SESSION["id"] = $lecture['id'];
        $_SESSION["email"] = $lecture['email'];
        $_SESSION["nic_number"] = $lecture['nic_number'];
        $_SESSION["full_name"] = $lecture['full_name'];
        $_SESSION["authToken"] = $lecture['authToken'];
        $_SESSION["lastLogin"] = $lecture['lastLogin'];
        $_SESSION['login_time'] = time();
        $_SESSION['image_name'] = $lecture['image_name'];
    }

    private function setAuthToken($id) {

        $authToken = md5(uniqid(rand(), true));

        $query = "UPDATE `lecture` SET `authToken` ='" . $authToken . "' WHERE `id`='" . $id . "'";

        $db = new Database();

        if ($db->readQuery($query)) {

            return $authToken;
        } else {
            return FALSE;
        }
    }

    private function setLastLogin($id) {

        date_default_timezone_set('Asia/Colombo');

        $now = date('Y-m-d H:i:s');

        $query = "UPDATE `lecture` SET `lastLogin` ='" . $now . "' WHERE `id`='" . $id . "'";

        $db = new Database();

        if ($db->readQuery($query)) {

            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function checkEmail($email) {

        $query = "SELECT `email`,`full_name` FROM `lecture` WHERE `email`= '" . $email . "'";

        $db = new Database();

        $result = mysql_fetch_array($db->readQuery($query));

        if (!$result) {

            return FALSE;
        } else {

            return $result;
        }
    }

    public function getLastStudentId() {
        $query = " SELECT `id` FROM `lecture` ORDER BY `id` DESC LIMIT 1";
        $db = new Database();
        $result = mysql_fetch_assoc($db->readQuery($query));

        return $result['id'];
    }

    public function GenarateCode($email) {

        $rand = rand(10000, 99999);

        $query = "UPDATE  `lecture` SET "
                . "`resetcode` ='" . $rand . "' "
                . "WHERE `email` = '" . $email . "'";

        $db = new Database();

        $result = $db->readQuery($query);

        if ($result) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function SelectForgetUser($email) {

        if ($email) {

            $query = "SELECT `email`,`full_name`,`resetcode` FROM `lecture` WHERE `email`= '" . $email . "'";

            $db = new Database();

            $result = mysql_fetch_array($db->readQuery($query));

            $this->full_name = $result['full_name'];
            $this->email = $result['email'];
            $this->restCode = $result['resetcode'];
            return $result;
        }
    }

    public function SelectResetCode($code) {

        $query = "SELECT `id` FROM `lecture` WHERE `resetcode`= '" . $code . "'";

        $db = new Database();

        $result = mysql_fetch_array($db->readQuery($query));

        if (!$result) {
            return FALSE;
        } else {
            return TRUE;
        }
    }

    public function updatePassword($password, $code) {

        $enPass = md5($password);

        $query = "UPDATE  `lecture` SET "
                . "`password` ='" . $enPass . "' "
                . "WHERE `resetcode` = '" . $code . "'";

        $db = new Database();

        $result = $db->readQuery($query);

        if ($result) {

            return TRUE;
        } else {

            return FALSE;
        }
    }

    public function update() {

        $query = "UPDATE  `lecture` SET "
                . "`full_name` ='" . $this->full_name . "', "
                . "`nic_number` ='" . $this->nic_number . "', " 
                . "`phone_number` ='" . $this->phone_number . "', "
                . "`address` ='" . $this->address . "', "
                . "`district` ='" . $this->district . "', "
                . "`city` ='" . $this->city . "', "
                . "`subject` ='" . $this->subject . "', "
                . "`email` ='" . $this->email . "' "
                . "WHERE `id` = '" . $this->id . "'";


        $db = new Database();

        $result = $db->readQuery($query);

        if ($result) {

            return $this->__construct($this->id);
        } else {

            return FALSE;
        }
    }

    public function updateActiveStudent() {

        $query = "UPDATE  `lecture` SET "
                . "`full_name` ='" . $this->full_name . "', "
                . "`nic_number` ='" . $this->nic_number . "', "
                . "`gender` ='" . $this->gender . "', "
                . "`age` ='" . $this->age . "', "
                . "`phone_number` ='" . $this->phone_number . "', "
                . "`address` ='" . $this->address . "', "
                . "`education_subject` ='" . $this->education_subject . "', "
                . "`email` ='" . $this->email . "', "
                . "`status` ='" . $this->status . "' "
                . "WHERE `id` = '" . $this->id . "'";


        $db = new Database();

        $result = $db->readQuery($query);

        if ($result) {

            return $this->__construct($this->id);
        } else {

            return FALSE;
        }
    }

    public function delete() {



        $this->deletePost();


        if ($this->image_name) {
            unlink(Helper::getSitePath() . "upload/lecture/profile/" . $this->image_name);
        } elseif ($this->nic_front || $this->image_name) {
            unlink(Helper::getSitePath() . "upload/lecture/nic_card/front/" . $this->nic_front);
            unlink(Helper::getSitePath() . "upload/lecture/nic_card/front/thumb/" . $this->nic_front);
            unlink(Helper::getSitePath() . "upload/lecture/nic_card/back/thumb/" . $this->nic_back);
            unlink(Helper::getSitePath() . "upload/lecture/nic_card/back/" . $this->nic_back);
        }


        $query = 'DELETE FROM `lecture` WHERE id="' . $this->id . '"';


        $db = new Database();



        return $db->readQuery($query);
    }

    public function deletePost() {



        $POST = new Post(NULL);
        $POST_IMAGES = new PostImage(NULL);

        foreach ($POST->getPostsByStudent($this->id) as $post) {

            foreach ($POST_IMAGES->getPhotosByPostId($post['id']) as $post_images) {
                unlink(Helper::getSitePath() . "upload/post/" . $post_images['image_name']);

                unlink(Helper::getSitePath() . "upload/post/thumb/" . $post_images['image_name']);
                unlink(Helper::getSitePath() . "upload/post/thumb2/" . $post_images['image_name']);



                $POST_IMAGES->id = $post_images["id"];

                $POST_IMAGES->delete();
            }
            $POST->id = $post["id"];

            $POST->delete();
        }
    }

}