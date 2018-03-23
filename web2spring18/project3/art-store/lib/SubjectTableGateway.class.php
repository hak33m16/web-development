<?php
/*
  Table Data Gateway for the Artist table. 
 */
class SubjectTableGateway extends TableDataGateway
{    
   public function __construct($dbAdapter) 
   {
      parent::__construct($dbAdapter);
   }
  
   protected function getDomainObjectClassName()  
   {
      return "Subject";
   } 
   protected function getTableName()
   {
      return "Subjects";
   }
   protected function getOrderFields() 
   {
      return 'SubjectName';
   }
   
   protected function getPrimaryKeyName() {
      return "SubjectID";
   }
   
}

?>