<?php

// Represents a single row for the Customers table. 
// This a concrete implementation of the Domain Model/Active Architecture pattern.

////////////////////////////////////
//
// Abdel-Hakeem Badran
// 04/10/2018
//
// Class	: 	Customers
// Parent	: 	DomainObject
//
///////////////////////////

class Customers extends DomainObject
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
		return 'customers';
    }
   
    static function getFieldNames() {
        return array('id', 'name', 'email', 'phone', 'address', 'created', 'modified', 'status');
    }

    /////////////////////////////////////////////////
    //
    // Abstract static, expected in all concretes.
    //
    /////////////////////
    //
    
    static function findByKey($key) {
        $data = CustomersCollection::findByAsArray("id=" . $key);
        $PDOAdapter = DatabaseAdapterFactory::getInstance( 'PDO', array(DBCONNECTION, DBUSER, DBPASS) );
        return new Customers($data[0], $PDOAdapter, true);
    }
   
    //////////////////////////////////////////
    //
    // Generalized abstracts.
    //
    /////////////////
    //
    
    public function insert() {
        $this->PDOAdapter->insert( Customers::getTableName(), $this->fieldValues );
    }
    
    public function update() {
        throw new Exception("No 'update' implemented for class Customers.");
    }
    
    public function delete() {
        throw new Exception("No 'delete' implemented for class Products.");
    }
    
}

?>
