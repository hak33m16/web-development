<?php

include 'ArtistCollection.class.php';

class CRMAEngine{
	
	public $artist_collection = null;
   
	public function __construct(){
		$this->artist_collection = new ArtistCollection();
	}
    
	/*public function getEmployeeCollection(){
		return $this->empCollection;
	}
    
	public function getEmployeeToDoCollection(){
		return $this->empToDoCollection;
	}*/
    
}

?>