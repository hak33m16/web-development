<?php
class Genres {
    
    private $genre_ID;
    private $genre_name;
    private $genre_desc;
    private $genre_link;

    function __construct($result) {
        $this->genre_ID = $result['GenreID'];
        $this->genre_name = $result['GenreName'];
        $this->genre_desc = $result['Description'];
        $this->genre_link = $result['Link'];
    }

    function get_id() {
        return $this->genre_ID;
    }

    function get_name() {
        return $this->genre_name;
    }

    function get_description() {
        return $this->genre_desc;
    }

    function get_link() {
        return $this->genre_link;
    }
    
}
?>