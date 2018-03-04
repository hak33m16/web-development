<?php

include 'DatabaseHelper.class.php';
include 'objects/Artist.class.php';

class ArtistCollection {
    
    private $base_query = "SELECT * FROM artists";
    private $artists = null; // Cast array to type Artist
    private $limit = 30; // default number of paintings to display
    private $limit_query = " LIMIT 30";// . (string)$this->limit;
    
    function __construct() {
        
        //$limit_query .= (string)$this->limit;
        
        $response = DatabaseHelper::runQuery($this->base_query, null);
        $content = $response->fetchAll();
        
        $this->artists = array();
        
        foreach( $content as $artist_array ) {
            array_push( $this->artists, new Artist($artist_array) );
        }
        
    }
    
    function get_artists() {
        return $this->artists;
    }
    
    function get_artist_by_id($match_id) {
        
        foreach( $this->artists as $artist_obj ) {
            if ( $artist_obj->get_id() == $match_id ) return $artist_obj;
        }
        
        return null; // If no artist exists with that ID
        
    }
    
    function get_limit() {
        return $this->limit;
    }
    
}

?>