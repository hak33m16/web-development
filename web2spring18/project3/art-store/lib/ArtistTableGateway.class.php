<?php
/*
  Table Data Gateway for the Artist table. 
 */
class ArtistTableGateway extends TableDataGateway
{    
   public function __construct($dbAdapter) 
   {
      parent::__construct($dbAdapter);
   }
  
   protected function getDomainObjectClassName()  
   {
      return "Artist";
   } 
   protected function getTableName()
   {
      return "Artists";
   }
   protected function getOrderFields() 
   {
      return 'LastName,Firstname';
   }
   
   protected function getPrimaryKeyName() {
      return "ArtistID";
   }
   
}

?>