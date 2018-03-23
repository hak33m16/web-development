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
   
   //findById($id)
   public function getAllByGenre($genreid)
   {
	   
      //$sql = $this->getSelectStatement() . ' WHERE ' . $this->getPrimaryKeyName() . '=:id';
      //return $this->convertRowToObject($this->dbAdapter->fetchRow($sql, Array(':id' => $id)) );
   }   
   
}

?>