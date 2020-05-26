<?php

/**
 * Description of Product
 *
 * @author sublime holdings
 * @web www.sublime.lk
 */
class LectureAssessment {

    //put your code here
    public $id;
    public $lecture_id;
    public $title;
    public $file_name;

    public function __construct($id) {
        if ($id) {

            $query = "SELECT `id`,`lecture_id`,`title`,`file_name` FROM `lecture_assessment` WHERE `id`=" . $id;

            $db = new Database();

            $result = mysql_fetch_array($db->readQuery($query));

            $this->id = $result['id'];
            $this->lecture_id = $result['lecture_id'];
            $this->title = $result['title'];
            $this->file_name = $result['file_name'];

            return $this;
        }
    }

    public function create() {

        $query = "INSERT INTO `lecture_assessment` (`lecture_id`, `title`, `file_name`) VALUES  ('" . $this->lecture_id . "', '" . $this->title . "','" . $this->file_name . "')";

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

        $query = "SELECT * FROM `lecture_assessment` ORDER BY `lecture_id` ASC";
        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }

        return $array_res;
    }

    public function update() {

        $query = 'UPDATE `lecture_assessment` SET `lecture_id`= "' . $this->lecture_id . '" WHERE id="' . $this->id . '"';

        $db = new Database();
        $result = $db->readQuery($query);

        if ($result) {
            return $this->__construct($this->id);
        } else {
            return FALSE;
        }
    }

    public function delete() {

        $query = 'DELETE FROM `lecture_assessment` WHERE id="' . $this->id . '"';

        $db = new Database();

        return $db->readQuery($query);
    }

    public function getAssessmentByLecture($id) {

        $query = "SELECT * FROM `lecture_assessment` WHERE `lecture_id` = '" . $id . "'  ";
 
        $db = new Database();

        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }
      
        return $array_res;
    }

}
