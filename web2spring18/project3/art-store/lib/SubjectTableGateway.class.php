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
   
   /* Unique Concrete Definitions */
   
    public function findForPainting($paintingID) {
	   
		//$sql = $this->getSelectStatement() . ' WHERE PaintingID=' . $paintingID;
		
		$sql = '
		SELECT * FROM subjects
		LEFT JOIN paintingsubjects
		ON subjects.SubjectID=paintingsubjects.SubjectID
		WHERE PaintingID=' . $paintingID
		;

		return $this->convertRecordsToObjects( $this->dbAdapter->fetchAsArray( $sql ) );
		
		//$temp = $this->convertRecordsToObjects( $this->dbAdapter->fetchAsArray( $sql ) );
		//print_r($temp);
		//return $temp;
		
    }
   
}

?>