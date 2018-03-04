<?php

class Painting {
    
    /* Table: paintings */
    private $painting_id;
    private $artist_id;
    private $gallery_id;
    private $image_file_name;
    private $title;
    private $shape_id;
    private $museum_link;
    private $accession_number;
    private $copyright_text;
    private $description;
    private $excerpt;
    private $year_of_work;
    private $width;
    private $height;
    private $medium;
    private $cost;
    private $msrp;
    private $google_link;
    private $google_description;
    private $wiki_link;
    
    /* Table: paintinggenres */
    private $painting_genre_id;
    private $genre_id;
    
    /* Table: paintingsubjects */
    private $painting_subject_id;
    private $subject_id;
    
    public function __construct($result){ 
        $this->painting_id = $result['PaintingID'];
        $this->artist_id = $result['ArtistID'];
        $this->gallery_id = $result['GalleryID'];
        $this->image_file_name = $result['ImageFileName'];
        $this->title = $result['Title'];
        $this->shape_id = $result['ShapeID'];
        $this->museum_link = $result['MuseumLink'];
        $this->accession_number = $result['AccessionNumber'];
        $this->copyright_text = $result['CopyrightText'];
        $this->description = $result['Description'];
        $this->excerpt = $result['Excerpt'];
        $this->year_of_work = $result['YearOfWork'];
        $this->width = $result['Width'];
        $this->height = $result['Height'];
        $this->medium = $result['Medium'];
        $this->cost = $result['Cost'];
        $this->msrp = $result['MSRP'];
        $this->google_link = $result['GoogleLink'];
        $this->google_description = $result['GoogleDescription'];
        $this->wiki_link = $result['WikiLink'];
    }
    
    public function get_id(){
        return $this->painting_id;
    }

    public function set_painting_id($painting_id){
        $this->painting_id = $painting_id;
    }

    public function get_artist_id(){
        return $this->artist_id;
    }

    public function set_artist_id($artist_id){
        $this->artist_id = $artist_id;
    }

    public function get_gallery_id(){
        return $this->gallery_id;
    }

    public function set_gallery_id($gallery_id){
        $this->gallery_id = $gallery_id;
    }

    public function get_image_file_name(){
        return $this->image_file_name;
    }

    public function set_image_file_name($image_file_name){
        $this->image_file_name = $image_file_name;
    }

    public function get_title(){
        return $this->title;
    }

    public function set_title($title){
        $this->title = $title;
    }

    public function get_shape_id(){
        return $this->shape_id;
    }

    public function set_shape_id($shape_id){
        $this->shape_id = $shape_id;
    }

    public function get_museum_link(){
        return $this->museum_link;
    }

    public function set_museum_link($museum_link){
        $this->museum_link = $museum_link;
    }

    public function get_accession_number(){
        return $this->accession_number;
    }

    public function set_accession_number($accession_number){
        $this->accession_number = $accession_number;
    }

    public function get_copyright_text(){
        return $this->copyright_text;
    }

    public function set_copyright_text($copyright_text){
        $this->copyright_text = $copyright_text;
    }

    public function get_description(){
        return $this->description;
    }

    public function set_description($description){
        $this->description = $description;
    }

    public function get_excerpt(){
        return $this->excerpt;
    }

    public function set_excerpt($excerpt){
        $this->excerpt = $excerpt;
    }

    public function get_year_of_work(){
        return $this->year_of_work;
    }

    public function set_year_of_work($year_of_work){
        $this->year_of_work = $year_of_work;
    }

    public function get_width(){
        return $this->width;
    }

    public function set_width($width){
        $this->width = $width;
    }

    public function get_height(){
        return $this->height;
    }

    public function set_height($height){
        $this->height = $height;
    }

    public function get_medium(){
        return $this->medium;
    }

    public function set_medium($medium){
        $this->medium = $medium;
    }

    public function get_cost(){
        return $this->cost;
    }

    public function set_cost($cost){
        $this->cost = $cost;
    }

    public function get_msrp(){
        return $this->msrp;
    }

    public function set_msrp($msrp){
        $this->msrp = $msrp;
    }

    public function get_google_link(){
        return $this->google_link;
    }

    public function set_google_link($google_link){
        $this->google_link = $google_link;
    }

    public function get_google_description(){
        return $this->google_description;
    }

    public function set_google_description($google_description){
        $this->google_description = $google_description;
    }

    public function get_wiki_link(){
        return $this->wiki_link;
    }

    public function set_wiki_link($wiki_link){
        $this->wiki_link = $wiki_link;
    }

    public function get_painting_genre_id(){
        return $this->painting_genre_id;
    }

    public function set_painting_genre_id($painting_genre_id){
        $this->painting_genre_id = $painting_genre_id;
    }

    public function get_genre_id(){
        return $this->genre_id;
    }

    public function set_genre_id($genre_id){
        $this->genre_id = $genre_id;
    }

    public function get_painting_subject_id(){
        return $this->painting_subject_id;
    }

    public function set_painting_subject_id($painting_subject_id){
        $this->painting_subject_id = $painting_subject_id;
    }

    public function get_subject_id(){
        return $this->subject_id;
    }

    public function set_subject_id($subject_id){
        $this->subject_id = $subject_id;
    }
    
}

?>