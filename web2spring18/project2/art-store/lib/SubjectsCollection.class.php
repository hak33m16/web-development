<?php

//include 'DatabaseHelper.class.php';
include 'objects/Subjects.class.php';

class SubjectsCollection {
    
    private $base_query = null;//"SELECT * FROM genres";
    private $subjects = null; // Cast array to type Artist
    
    function __construct() {
        
    }
    
    function find_subjects($painting_id) {
        
        /*$this->base_query = "
            SELECT DISTINCT *
            FROM subjects
            INNER JOIN
        ";*/
		
		$this->base_query =
		"
		SELECT *
		FROM subjects AS A
		INNER JOIN paintingsubjects AS B
		ON A.SubjectID=B.SubjectID AND B.PaintingID=" . (string)$painting_id
		;
		
		//$this->base_query = "SELECT * FROM subjects";
        
        $response = DatabaseHelper::runQuery($this->base_query, null);
        $content = $response->fetchAll();
        
        $this->subjects = array();
        
        foreach( $content as $subjects_array ) {
            array_push( $this->subjects, new Subjects($subjects_array) );
        }
        
        return $this->subjects;
        
    }
    
}

?>