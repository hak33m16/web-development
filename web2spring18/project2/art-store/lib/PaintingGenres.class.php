<?php
class PaintingGenres {
    private $painting_genre_ID;
    private $painting_ID;
    private $genre_ID;

    function __construct($result) {
        $this->painting_genre_ID = $result['PaintingGenreID'];
        $this->painting_ID = $result['PaintingID'];
        $this->genre_ID = $result['GenreID'];
    }

    function get_pg_id() {
        return $this->painting_genre_ID;
    }

    function get_p_id() {
        return $this->painting_ID;
    }

    function get_g_id() {
        return $this->genre_ID;
    }
}

?>