<?php

class Glass {

	private $id;
    private $title;
	private $description;
	private $price;
    
    function __construct($result) {
		//print_r($result);
		
		$this->id = $result['GlassID'];
		$this->title = $result['Title'];
		$this->description = $result['Description'];
		$this->price = $result['Price'];
    }

	function get_id() {
		return $this->id;
	}
	
	function get_title() {
		return $this->title;
	}
	
	function get_price() {
		return $this->price;
	}
	
	function get_description() {
		return $this->description;
	}
    
}

?>