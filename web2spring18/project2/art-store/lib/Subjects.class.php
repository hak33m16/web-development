<?php
class Subjects {
    private $subject_name;

    function __construct() {
        $this->subject_name = $result['SubjectName'];
    }

    function get_subject() {
        return $this->subject_name;
    }
}
?>