<?php

//include 'DatabaseHelper.class.php';
include 'objects/Reviews.class.php';

class ReviewsCollection {
    
    private $base_query = "SELECT * FROM reviews";
    private $reviews = null; // Cast array to type Artist
    //private $limit = 30; // default number of paintings to display
    //private $limit_query = " LIMIT 30";// . (string)$this->limit;
    
    function __construct() {
/*
        $response = DatabaseHelper::runQuery($this->base_query, null);
        $content = $response->fetchAll();
        
        $this->reviews = array();
        
        foreach( $content as $reviews_array ) {
            array_push( $this->reviews, new Reviews($reviews_array) );
        }*/
        
    }
    
    function get_reviews_by_painting_id($match_id) {
		
		$this->base_query = "SELECT * FROM reviews WHERE PaintingID=" . (string)$match_id;
		
		$response = DatabaseHelper::runQuery($this->base_query, null);
		$content = $response->fetchAll();
        
        $this->reviews = array();
        
        foreach( $content as $reviews_array ) {
            array_push( $this->reviews, new Reviews($reviews_array) );
        }
		
        return $this->reviews;
    }
    
	/*
    function ($match_id) {
        
        foreach( $this->artists as $artist_obj ) {
            if ( $artist_obj->get_id() == $match_id ) return $artist_obj;
        }
        
        return null; // If no artist exists with that ID
        
    }*/
	
}