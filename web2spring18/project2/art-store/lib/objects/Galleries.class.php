<?php
class Galleries {
    
    private $gallery_id;
    private $gallery_name;
    private $gallery_native_name;
    private $gallery_city;
    private $gallery_country;
    private $latitude;
    private $longitude;
    private $gallery_web_site;

    function __construct($result) {
        $this->gallery_id = $result['GalleryID'];
        $this->gallery_name = $result['GalleryName'];
        $this->gallery_native_name = $result['GalleryNativeName'];
        $this->gallery_city = $result['GalleryCity'];
        $this->gallery_country = $result['GalleryCountry'];
        $this->latitude = $result['Latitude'];
        $this->longitude = $result['Longitude'];
        $this->gallery_web_site = $result['GalleryWebSite'];
    }

    function get_id() {
        return $this->gallery_id;
    }

    function get_name() {
        return $this->gallery_name;
    }

    function get_native_name() {
        return $this->gallery_native_name;
    }

    function get_city() {
        return $this->gallery_city;
    }

    function get_country() {
        return $this->gallery_country;
    }

    function get_latitude() {
        return $this->latitude;
    }

    function get_longitude() {
        return $this->longitude;
    }

    function get_website() {
        return $this->gallery_web_site;
    }
}
?>