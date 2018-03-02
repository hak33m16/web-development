<?php
class PaintingSubjects {
    private $painting_subject_ID;
    private $painting_ID;
    private $subject_ID;

    function __construct($result) {
        $this->painting_subject_ID = $result['PaintingSubjectID'];
        $this->painting_ID = $result['PaintingID'];
        $this->subject_ID = $result['SubjectID'];
    }

    function get_ps_id() {
        return $this->painting_subject_ID;
    }

    function get_p_id() {
        return $this->painting_ID;
    }

    function get_s_id() {
        return $this->subject_ID;
    }
}
?>