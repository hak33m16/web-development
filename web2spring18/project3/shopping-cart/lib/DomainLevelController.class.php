<?php

////////////////////////////////////
//
// Abdel-Hakeem Badran
// 04/10/2018
//
// Class	: 	DomainLevelController
//
///////////////////////////

class DomainLevelController {
	
	public $ordersCollection = null;
	public $productsCollection = null;
	public $customersCollection = null;
	public $orderItemsCollection = null;
	
	public function __construct($PDOConnection) {
		
		$this->ordersCollection = OrdersCollection::findAll();
		$this->productsCollection = ProductsCollection::findAll();
		$this->customersCollection = CustomersCollection::findAll();
		$this->orderItemsCollection = OrderItemsCollection::findAll();
		
	}
	
}

?>