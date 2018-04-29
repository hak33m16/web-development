<?php

///////////////////////////////////////////////////////////////////
//
// Represents a single row for the 'groups' table. 
// 
// This a concrete implementation of the Domain Model pattern.
//
////////////////////////////////////////
//
// Abdel-Hakeem Badran
// 04/28/2018
//
////////////////////////////

class Group extends DomainObject
{  
   
	static function getFieldNames() {
		return array('id','name');
	}

	public function __construct(array $data, $generateExc)
	{
		parent::__construct($data, $generateExc);
	}
   
   // implement any setters that need input checking/validation
}

?>