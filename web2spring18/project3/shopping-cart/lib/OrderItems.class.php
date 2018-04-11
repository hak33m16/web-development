<?php

// Represents a single row for the OrderItems table. 
// This a concrete implementation of the Domain Model/Active Architecture pattern.

////////////////////////////////////
//
// Abdel-Hakeem Badran
// 04/10/2018
//
// Class	: 	OrderItems
// Parent	: 	DomainObject
//
///////////////////////////

class OrderItems extends DomainObject
{
    public function __construct(array $data, $pdo=null, $generateExc=false)
    {
        parent::__construct($data, $pdo, $generateExc);
    }
    
    ////////////////////////////////////////////////
    //
    // Common getters implemented in concrete.
    //
    //////////////////////////////////
    //
    
    static function getTableName() {
		return 'order_items';
    }
   
    static function getFieldNames() {
        return array('id', 'order_id', 'product_id', 'quantity');
    }

    /////////////////////////////////////////////////
    //
    // Abstract static, expected in all concretes.
    //
    /////////////////////
    //
    
    static function findByKey($key) {
        $data = OrderItemsCollection::findByAsArray("id=" . $key);
        $PDOAdapter = DatabaseAdapterFactory::getInstance( 'PDO', array(DBCONNECTION, DBUSER, DBPASS) );
        return new OrderItems($data[0], $PDOAdapter, true);
    }
   
    //////////////////////////////////////////
    //
    // Generalized abstracts.
    //
    /////////////////
    //
    
    public function insert() {
        $this->PDOAdapter->insert( OrderItems::getTableName(), $this->fieldValues );
    }
    
    public function update() {
        throw new Exception("No 'update' implemented for class OrderItems.");
    }
    
    public function delete() {
        throw new Exception("No 'delete' implemented for class OrderItems.");
    }
    
}

?>
