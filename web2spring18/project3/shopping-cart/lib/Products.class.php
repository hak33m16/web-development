<?php

// Represents a single row for the Products table. 
// This a concrete implementation of the Domain Model/Active Architecture pattern.

////////////////////////////////////
//
// Abdel-Hakeem Badran
// 04/10/2018
//
// Class	: 	Products
// Parent	: 	DomainObject
//
///////////////////////////

class Products extends DomainObject
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
		return 'products';
    }
   
    static function getFieldNames() {
        return array('id', 'name', 'description', 'price', 'created', 'modified', 'status');
    }

    /////////////////////////////////////////////////
    //
    // Abstract static, expected in all concretes.
    //
    /////////////////////
    //
    
    static function findByKey($key) {
        $data = ProductsCollection::findByAsArray("id=" . $key);
        $PDOAdapter = DatabaseAdapterFactory::getInstance( 'PDO', array(DBCONNECTION, DBUSER, DBPASS) );
        return new Products($data[0], $PDOAdapter, true);
    }
   
    //////////////////////////////////////////
    //
    // Generalized abstracts.
    //
    /////////////////
    //
    
    public function insert() {
        //print_r($this->fieldValues);
        //echo "<br>" . Products::getTableName();
        //print_r($this->PDOAdapter);
        $this->PDOAdapter->insert( Products::getTableName(), $this->fieldValues );
    }
    
    public function update() {
        throw new Exception("No 'update' implemented for class Products.");
    }
    
    public function delete() {
        throw new Exception("No 'delete' implemented for class Products.");
    }
    
}

?>