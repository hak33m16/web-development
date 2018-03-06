<?php

//include 'DatabaseHelper.class.php';
include 'objects/Galleries.class.php';

class GalleriesCollection {
    
    private $base_query = "SELECT * FROM galleries";
    private $galleries = null; // Cast array to type Artist
    private $limit = "30"; // default number of paintings to display
    private $limit_query = " LIMIT ";// . $;// . (string)$this->limit;
    
    function __construct() {
        
        //$limit_query .= (string)$this->limit;
        
        $response = DatabaseHelper::runQuery($this->base_query, null);
        $content = $response->fetchAll();
        
        $this->galleries = array();
        
        foreach( $content as $galleries_array ) {
            array_push( $this->galleries, new Galleries($galleries_array) );
        }
        
    }
    
    function get_galleries() {
        return $this->galleries;
    }
    
    function get_gallery_by_id($match_id) {
        
        foreach( $this->galleries as $galleries_obj ) {
            if ( $galleries_obj->get_id() == $match_id ) return $galleries_obj;
        }
        
        return null; // If no artist exists with that ID
        
    }
    
    function get_limit() {
        return $this->limit;
    }
    
}

?>