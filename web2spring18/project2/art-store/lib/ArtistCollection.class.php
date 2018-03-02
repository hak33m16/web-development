<?php

include 'DatabaseHelper.class.php';
include 'objects/Artist.class.php';

class ArtistCollection {
    
    private $base_query = "SELECT * FROM artists";
    private $artists = null; // Cast array to type Artist
    
    function __construct() {
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
    
    /*
        public function findById($id)
    {
        $sql = self::$baseSQL .  ' WHERE ToDoID=? ';
        $statement = DatabaseHelper::runQuery($sql, Array($id));
        return $statement->fetch();
    }
    
    public function getAllByEmployee($employeeID)
    {
        $sql = self::$baseSQL .  ' WHERE EmployeeID=? ' . self::$constraint;
        $statement = DatabaseHelper::runQuery($sql, Array($employeeID));
        return $statement->fetchAll();
    }    
    
    public function getAll()
    {
        $sql = self::$baseSQL . self::$constraint;
        $statement = DatabaseHelper::runQuery($sql, null);
        return $statement->fetchAll();        
    }    
    */
    
}

?>