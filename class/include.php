<?phpinclude_once(dirname(__FILE__) . '/Database.php');include_once(dirname(__FILE__) . '/User.php');include_once(dirname(__FILE__) . '/Student.php');include_once(dirname(__FILE__) . '/Post.php');include_once(dirname(__FILE__) . '/PostImage.php');include_once(dirname(__FILE__) . '/Message.php');include_once(dirname(__FILE__) . '/Page.php');include_once(dirname(__FILE__) . '/City.php');include_once(dirname(__FILE__) . '/District.php');include_once(dirname(__FILE__) . '/Lecture.php');include_once(dirname(__FILE__) . '/EducationCategory.php');include_once(dirname(__FILE__) . '/EducationSubCategory.php');include_once(dirname(__FILE__) . '/EducationSubject.php');include_once(dirname(__FILE__) . '/SubjectSubCategory.php');include_once(dirname(__FILE__) . '/LectureSubject.php');include_once(dirname(__FILE__) . '/StudentSubject.php');include_once(dirname(__FILE__) . '/LectureClass.php');include_once(dirname(__FILE__) . '/ClassType.php');include_once(dirname(__FILE__) . '/StudentRegistration.php');include_once(dirname(__FILE__) . '/LectureMcq.php');include_once(dirname(__FILE__) . '/LectureTutorial.php');include_once(dirname(__FILE__) . '/Upload.php');include_once(dirname(__FILE__) . '/Helper.php');include_once(dirname(__FILE__) . '/Setting.php');function dd($data) {    var_dump($data);    exit();}function redirect($url) {    $string = '<script type="text/javascript">';    $string .= 'window.location = "' . $url . '"';    $string .= '</script>';    echo $string;    exit();}