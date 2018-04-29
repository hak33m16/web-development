<?php

////////////////////////////////////
//
// Abdel-Hakeem Badran
// 04/10/2018
//
// Class	: 	DomainLevelController
//
// Facade class for interacting with
// domain-level objects in the UI.
//
///////////////////////////

class DomainLevelController {

	//////////////////////////////////////
	//
	// Object construction area.
	//

	private $PDODBConnection = null;
	
	public function __construct($PDOConnection) {
		$this->PDODBConnection = $PDOConnection;
		
		$this->userGateway = new UsersTableGateway($this->PDODBConnection);
		$this->groupGateway = new GroupsTableGateway($this->PDODBConnection);
		$this->groupMessageGateway = new GroupMessagesTableGateway($this->PDODBConnection);
	}
	
	//////////////////////////////////////
	//
	// User management section.
	//
	
	private $usersCollection = array();	
	private $userGateway = null;
	
	public function findAllUsers() {
		$this->usersCollection = $this->userGateway->findAll();
		return $this->usersCollection;
	}
	
	public function addUser($user) {
		$this->userGateway->insert($user);
	}
	
	public function findUserBy($key, $value) {
		return $this->userGateway->findBy($key . "='" . $value . "'")[0];
	}
	
	//////////////////////////////////////
	//
	// Group management section.
	//
	
	private $groupsCollection = array();
	private $groupGateway = null;
	
	public function findAllGroups() {
		$this->groupsCollection = $this->groupGateway->findAll();
		return $this->groupsCollection;
	}
	
	public function findGroupById($groupid) {
		return $this->groupGateway->findBy("id=" . $groupid)[0];
	}
	
	public function addGroup($group) {
		$this->groupGateway->insert($group);
	}
	
	//////////////////////////////////////
	//
	// GroupMessage management section.
	//
	
	private $groupMessagesCollection = array();
	private $groupMessageGateway = null;
	
	public function findAllMessages() {
		$this->groupMessagesCollection = $this->groupMessageGateway->findAll();
		return $this->groupMessagesCollection;
	}
	
	public function findRecentMessagesByGroupId($groupid) {
		$this->groupMessagesCollection = $this->groupMessageGateway->findBy("groupid=" . $groupid . " LIMIT 100 ");
		return $this->groupMessagesCollection;
	}
	
	public function addMessage($groupMessage) {
		$this->groupMessageGateway->insert($groupMessage);
	}
	
	/*public $ordersCollection = null;
	public $productsCollection = null;
	public $customersCollection = null;
	public $orderItemsCollection = null;
	
	public function __construct($PDOConnection) {
		
		$this->ordersCollection = OrdersCollection::findAll();
		$this->productsCollection = ProductsCollection::findAll();
		$this->customersCollection = CustomersCollection::findAll();
		$this->orderItemsCollection = OrderItemsCollection::findAll();
		
	}*/
	
}

?>