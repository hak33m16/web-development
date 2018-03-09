<?php

class Matt {

	private $id;
    private $title;
	private $color_code;
    
    function __construct($result) {
		$this->id = $result['MattID'];
		$this->title = $result['Title'];
		$this->color_code = $result['ColorCode'];
    }

	function get_id() {
		return $this->id;
	}
	
	function get_title() {
		return $this->title;
	}
	
	function get_color_code() {
		return $this->color_code;
	}
    
}

?>