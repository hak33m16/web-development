<?php
/*
  Table Data Gateway for the Artist table. 
 */
class PaintingTableGateway extends TableDataGateway
{    
	public function __construct($dbAdapter) 
	{
		parent::__construct($dbAdapter);
	}
  
	protected function getDomainObjectClassName()  
	{
		return "Painting";
	} 
	protected function getTableName()
	{
		return "Paintings";
	}
	protected function getOrderFields() 
	{
		return 'Title';
	}
   
	protected function getPrimaryKeyName() {
		return "PaintingID";
	}
   
    /* Unique Concrete Definitions */
   
    public function getAllByGenre($genreID)
    {
	   
	   	$sql = '
        SELECT * FROM genres
		INNER JOIN paintinggenres
		ON genres.GenreID=paintinggenres.GenreID
        INNER JOIN paintings
        ON paintinggenres.PaintingID=paintings.PaintingID
		WHERE genres.GenreID=' . $genreID
		;
	   
	    return $this->convertRecordsToObjects( $this->dbAdapter->fetchAsArray( $sql ) );
		//print_r($temp);
		//return $temp;
		
    }   
   
	public function getAllByArtist($artistID) {
		
		$sql = '
		SELECT * FROM paintings
		WHERE ArtistID=' . $artistID
		;
		
		return $this->convertRecordsToObjects( $this->dbAdapter->fetchAsArray( $sql ) );
		
	}
	
	public function getAllByGallery($galleryID) {
		
		$sql = '
		SELECT * FROM paintings
		WHERE GalleryID=' . $galleryID
		;
		
		return $this->convertRecordsToObjects( $this->dbAdapter->fetchAsArray( $sql ) );
		
	}
	
	public function getAllByShape($shapeID) {
		
		$sql = '
		SELECT * FROM paintings
		WHERE ShapeID=' . $shapeID
		;
		
		return $this->convertRecordsToObjects( $this->dbAdapter->fetchAsArray( $sql ) );
		
	}
    
}

?>