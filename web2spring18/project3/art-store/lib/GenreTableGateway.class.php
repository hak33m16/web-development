<?php
/*
  Table Data Gateway for the Genre table.
 */
class GenreTableGateway extends TableDataGateway
{    
   public function __construct($dbAdapter) 
   {
      parent::__construct($dbAdapter);
   }
  
   protected function getDomainObjectClassName()  
   {
      return "Genre";
   } 
   protected function getTableName()
   {
      return "Genres";
   }
   protected function getOrderFields() 
   {
      return 'GenreName';
   }
  
   protected function getPrimaryKeyName() {
      return "GenreID";
   }


   public function findForPainting($artWorkId) {
      $sql = "SELECT Genres.GenreID as GenreID, GenreName, EraID, Description, Link FROM Genres INNER JOIN PaintingGenres ON Genres.GenreID = PaintingGenres.GenreID WHERE PaintingGenres.PaintingID=?";

      $result = $this->dbAdapter->fetchAsArray($sql, Array($artWorkId));    

      return $this->convertRecordsToObjects($result); 
   }
}

?>