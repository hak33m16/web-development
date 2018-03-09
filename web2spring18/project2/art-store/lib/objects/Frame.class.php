<?php

class Frame {

	private $id;
    private $title;
	private $price;
	private $color;
	private $style; // mistyped in db as 'syle'
    
    function __construct($result) {
		$this->id = $result['FrameID'];
		$this->title = $result['Title'];
		$this->price = $result['Price'];
		$this->color = $result['Color'];
		$this->style = $result['Syle'];
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
	
	function get_color() {
		return $this->color;
	}
	
	function get_style() {
		return $this->style;
	}
    
}

?>