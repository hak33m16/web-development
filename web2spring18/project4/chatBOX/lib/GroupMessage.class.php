<?php

///////////////////////////////////////////////////////////////////
//
// Represents a single row for the 'groupmessages' table. 
// 
// This a concrete implementation of the Domain Model pattern.
//
////////////////////////////////////////
//
// Abdel-Hakeem Badran
// 04/28/2018
//
////////////////////////////

class GroupMessage extends DomainObject
{  
   
	static function getFieldNames() {
		return array('groupid', 'ownerid', 'message', 'time');
	}

	public function __construct(array $data, $generateExc)
	{
		parent::__construct($data, $generateExc);
	}
   
   // implement any setters that need input checking/validation
}

?>