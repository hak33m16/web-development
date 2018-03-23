<?php
/*
   Represents a single row for the Subject table. 
   
   This a concrete implementation of the Domain Model pattern.
 */
class Subject extends DomainObject
{  
   
   static function getFieldNames() {
      return array('SubjectID', 'SubjectName');
   }

   public function __construct(array $data, $generateExc)
   {
      parent::__construct($data, $generateExc);
   }
   
   // implement any setters that need input checking/validation
}

?>