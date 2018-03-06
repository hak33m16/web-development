<?php

//include 'DatabaseHelper.class.php';
include 'objects/Genres.class.php';

class GenresCollection {
    
    private $base_query = null;//"SELECT * FROM genres";
    private $genres = null; // Cast array to type Artist
    
    function __construct() {
        
    }
    
    function find_genres($painting_id) {
        
        $this->base_query = "
            SELECT DISTINCT * FROM genres WHERE GenreID=
                (
                SELECT DISTINCT *
                    FROM (
                        SELECT DISTINCT GenreID FROM paintinggenres WHERE PaintingID=" . (string)$painting_id . "
                    ) AS uniquegenres
                )
        ";
        
        $response = DatabaseHelper::runQuery($this->base_query, null);
        $content = $response->fetchAll();
        
        $this->genres = array();
        
        foreach( $content as $genres_array ) {
            array_push( $this->genres, new Genres($genres_array) );
        }
        
        return $this->genres;
        
    }
    
}

?>