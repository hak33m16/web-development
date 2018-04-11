<?php

// Represents a single row for the Orders table. 
// This a concrete implementation of the Domain Model/Active Architecture pattern.

////////////////////////////////////
//
// Abdel-Hakeem Badran
// 04/10/2018
//
// Class	: 	Orders
// Parent	: 	DomainObject
//
///////////////////////////

class Orders extends DomainObject
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
		return 'orders';
    }
   
    static function getFieldNames() {
        return array('id', 'customer_id', 'total_price', 'created', 'modified', 'status');
    }

    /////////////////////////////////////////////////
    //
    // Abstract static, expected in all concretes.
    //
    /////////////////////
    //
    
    static function findByKey($key) {
        $data = OrdersCollection::findByAsArray("id=" . $key);
        $PDOAdapter = DatabaseAdapterFactory::getInstance( 'PDO', array(DBCONNECTION, DBUSER, DBPASS) );
        return new Orders($data[0], $PDOAdapter, true);
    }
   
    //////////////////////////////////////////
    //
    // Generalized abstracts.
    //
    /////////////////
    //
    
    public function insert() {
        $this->PDOAdapter->insert( Orders::getTableName(), $this->fieldValues );
    }
    
    public function update() {
        throw new Exception("No 'update' implemented for class Orders.");
    }
    
    public function delete() {
        throw new Exception("No 'delete' implemented for class Orders.");
    }
    
}

?>
