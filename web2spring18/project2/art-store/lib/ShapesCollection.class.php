<?php

//include 'DatabaseHelper.class.php';
include 'objects/Shapes.class.php';

class ShapesCollection {
    
    private $base_query = "SELECT * FROM shapes";
    private $shapes = null; // Cast array to type Artist
    private $limit = "30"; // default number of paintings to display
    private $limit_query = " LIMIT ";// . $;// . (string)$this->limit;
    
    function __construct() {
        
        //$limit_query .= (string)$this->limit;
        
        $response = DatabaseHelper::runQuery($this->base_query, null);
        $content = $response->fetchAll();
        
        $this->shapes = array();
        
        foreach( $content as $shapes_array ) {
            array_push( $this->shapes, new Shapes($shapes_array) );
        }
        
    }
    
    function get_shapes() {
        return $this->shapes;
    }
    
    function get_shapes_by_id($match_id) {
        
        foreach( $this->shapes as $shapes_obj ) {
            if ( $shapes_obj->get_id() == $match_id ) return $shapes_obj;
        }
        
        return null; // If no artist exists with that ID
        
    }
    
    function get_limit() {
        return $this->limit;
    }
    
}

?>