<?php
class Reviews {
    private $rating_ID;
    private $painting_ID;
    private $review_date;
    private $rating;
    private $comment;

    function __construct($result) {
        $this->rating_ID = $result['RatingID'];
        $this->painting_ID = $result['PaintingID'];
        $this->review_date = $result['ReviewDate'];
        $this->rating = $result['Rating'];
        $this->comment = $result['Comment'];
    }

    function get_rating_id() {
        return $this->rating_ID;
    }

    function get_painting_id() {
        return $this->painting_ID;
    }

    function get_review_date() {
        return $this->review_date;
    }

    function get_rating() {
        return $this->rating;
    }

    function get_comment() {
        return $this->comment;
    }
}
?>