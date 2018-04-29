<?php

/////////////////////////////////////////////////////////
//
// Table Data Gateway for the 'groups' table.
//
////////////////////////////////////
//
// Abdel-Hakeem Badran
// 04/28/2018
//
///////////////////////////

class GroupsTableGateway extends TableDataGateway
{    
	public function __construct($dbAdapter) 
	{
		parent::__construct($dbAdapter);
	}
  
	protected function getDomainObjectClassName()  
	{
		return "Group";
	} 
	
	protected function getTableName()
	{
		return "groups";
	}
	
	protected function getOrderFields() 
	{
		return 'name';
	}
  
    protected function getPrimaryKeyName() {
		return "id";
    }

	public function insert($group) {
        $this->dbAdapter->insert( $this->getTableName(), $group->getFieldValues() );
    }
	
	/*
	public function findFor($artWorkId) {
      $sql = "SELECT Genres.GenreID as GenreID, GenreName, EraID, Description, Link FROM Genres INNER JOIN PaintingGenres ON Genres.GenreID = PaintingGenres.GenreID WHERE PaintingGenres.PaintingID=?";

      $result = $this->dbAdapter->fetchAsArray($sql, Array($artWorkId));    

      return $this->convertRecordsToObjects($result); 
	}*/
}

?>