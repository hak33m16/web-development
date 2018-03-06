<?php

class Subjects {
    
    private $subject_name;
    private $subject_id;
    
    function __construct($result) {
        $this->subject_name = $result['SubjectName'];
        $this->subject_id = $result['SubjectID'];
    }

    function get_subject_name() {
        return $this->subject_name;
    }
    
    function get_subject_id() {
        return $this->subject_id;
    }
    
}

?>