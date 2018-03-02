<?php

class Artist {
    
    private $artist_id;
    private $first_name;
    private $last_name;
    private $nationality;
    private $gender;
    private $year_of_birth;
    private $year_of_death;
    private $details;
    private $artist_link;

    function __construct($result) {
        $this->artist_id = $result['ArtistID'];
        $this->first_name = $result['FirstName'];
        $this->last_name = $result['LastName'];
        $this->nationality = $result['Nationality'];
        $this->gender = $result['Gender'];
        $this->year_of_birth = $result['YearOfBirth'];
        $this->year_of_death = $result['YearOfDeath'];
        $this->details = $result['Details'];
        $this->artist_link = $result['ArtistLink'];
    }

    function get_id() {
        return $this->artist_id;
    }

    function get_first_name() {
        return $this->first_name;
    }

    function get_last_name() {
        return $this->last_name;
    }

    function get_nationality() {
        return $this->nationality;
    }

    function get_gender() {
        return $this->gender;
    }

    function get_birth_year() {
        return $this->year_of_birth;
    }

    function get_death_year() {
        return $this->year_of_death;
    }
    
    function get_details() {
        return $this->details;
    }

    function get_link() {
        return $this->artist_link;
    }
}

?>