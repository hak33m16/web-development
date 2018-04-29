<?php

/////////////////////////////////////////////////////////
//
// Table Data Gateway for the 'groupmessages' table.
//
////////////////////////////////////
//
// Abdel-Hakeem Badran
// 04/28/2018
//
///////////////////////////

class GroupMessagesTableGateway extends TableDataGateway
{    
	public function __construct($dbAdapter) 
	{
		parent::__construct($dbAdapter);
	}
  
	protected function getDomainObjectClassName()  
	{
		return "GroupMessage";
	} 
	
	protected function getTableName()
	{
		return "groupmessages";
	}
	
	protected function getOrderFields() 
	{
		return 'time';
	}
  
    protected function getPrimaryKeyName() {
		return "";
    }

	public function insert($group) {
        $this->dbAdapter->insert( $this->getTableName(), $group->getFieldValues() );
    }

}

?>