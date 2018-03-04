<?php

//include 'DatabaseHelper.class.php';
include 'objects/Painting.class.php';

class PaintingCollection {
    
    private $base_query = "SELECT * FROM paintings";
    private $paintings = null; // Cast array to type Artist
    private $limit = "30"; // default number of paintings to display
    private $limit_query = "";//" LIMIT ";// . $;// . (string)$this->limit;
    private $appendage = null;
    
    function __construct() {
        
        $this->limit_query .= " LIMIT " . $this->limit;
        //echo $this->limit;
        
        $response = DatabaseHelper::runQuery($this->base_query . $this->limit_query, null);
        $content = $response->fetchAll();
        
        $this->appendage = "";
        $this->paintings = array();
        
        foreach( $content as $artist_array ) {
            array_push( $this->paintings, new Painting($artist_array) );
        }
        
    }
    
    function rerun_query() {
        
        //$this->limit_query .= " LIMIT " . $this->limit;
        
        $response = DatabaseHelper::runQuery($this->base_query . $this->appendage, null);
        $content = $response->fetchAll();
        
        $this->paintings = array();
        
        foreach( $content as $artist_array ) {
            array_push( $this->paintings, new Painting($artist_array) );
        }
    }
    
    function get_paintings() {
        return $this->paintings;
    }
    
    function get_paintings_by_id($match_id) {
        
        foreach( $this->paintings as $painting_obj ) {
            if ( $painting_obj->get_painting_id() == $match_id ) return $painting_obj;
        }
        
        return null; // If no artist exists with that ID
        
    }
    
    function get_limit() {
        return $this->limit;
    }
    
    function set_limit($new_limit) {
        $this->limit = (string)$new_limit;
    }
    
    function append_query($new_appendage) {
        if ( $this->appendage == "" ) $this->appendage = " WHERE";
        if ( $this->appendage != "" && $this->appendage != " WHERE" ) $this->appendage .= " AND ";
        $this->appendage .= " " . $new_appendage;
    }
    
    function clear_appendage() {
        $this->appendage = "";
    }
    
    function get_query() {
        return $this->base_query . $this->appendage;
    }
    
}

?>