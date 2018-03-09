<?php

//include 'DatabaseHelper.class.php';
include 'objects/Frame.class.php';
include 'objects/Glass.class.php';
include 'objects/Matt.class.php';

class TypesCollection {
    
    //private $base_query = null;//"SELECT * FROM genres";
    //private $subjects = null; // Cast array to type Artist
    
	private $frame_query = "SELECT * FROM typesframes WHERE Title!='[None]'";
	private $glass_query = "SELECT * FROM typesglass WHERE Title!='[None]'";
	private $matt_query = "SELECT * FROM typesmatt WHERE Title!='[None]'";
	
	private $frames = null;
	private $glass = null;
	private $matt = null;
	
    function __construct() {
        
		/* Pull Frames */
		
		$response = DatabaseHelper::runQuery($this->frame_query, null);
		$content = $response->fetchAll();
        
        $this->frames = array();
        
        foreach( $content as $frames_array ) {
            array_push( $this->frames, new Frame($frames_array) );
        }
		
		/* Pull Glass */
		
		$response = DatabaseHelper::runQuery($this->glass_query, null);
		$content = $response->fetchAll();
        
        $this->glass = array();
        
        foreach( $content as $glass_array ) {
            array_push( $this->glass, new Glass($glass_array) );
        }
		
		/* Pull Matt */
		
		$response = DatabaseHelper::runQuery($this->matt_query, null);
		$content = $response->fetchAll();
        
        $this->matt = array();
        
        foreach( $content as $matt_array ) {
            array_push( $this->matt, new Matt($matt_array) );
        }
		
    }
    
	function get_frames() {
		return $this->frames;
	}
	
	function get_glasses() {
		return $this->glass;
	}
	
	function get_mattes() {
		return $this->matt;
	}
    
}

?>