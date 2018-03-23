<?php
/*
   Represents a single row for the Genre table. 
   
   This a concrete implementation of the Domain Model pattern.
 */
class Genre extends DomainObject
{  
   
   static function getFieldNames() {
      return array('GenreID','GenreName','EraID','Description','Link');
   }

   public function __construct(array $data, $generateExc)
   {
      parent::__construct($data, $generateExc);
   }
   
   // implement any setters that need input checking/validation
}

?>