<?php

include 'ArtistCollection.class.php';
include 'PaintingCollection.class.php';
include 'GalleriesCollection.class.php';
include 'ShapesCollection.class.php';

class CRMAEngine{
	
	public $artist_collection = null;
    public $painting_collection = null;
    public $galleries_collection = null;
    public $shapes_collection = null;
    
	public function __construct(){
		$this->artist_collection = new ArtistCollection();
        $this->painting_collection = new PaintingCollection();
        $this->galleries_collection = new GalleriesCollection();
        $this->shapes_collection = new ShapesCollection();
	}
    
	/*public function getEmployeeCollection(){
		return $this->empCollection;
	}
    
	public function getEmployeeToDoCollection(){
		return $this->empToDoCollection;
	}*/
    
}

?>