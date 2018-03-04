<?php

class Shapes {
    
    private $shape_id;
    private $shape_name;

    function __construct($result) {
        $this->shape_id = $result['ShapeID'];
        $this->shape_name = $result['ShapeName'];
    }

    function get_shape() {
        return $this->shape_name;
    }
    
    function get_id() {
        return $this->shape_id;
    }
    
}

?>