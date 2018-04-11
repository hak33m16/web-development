<?php

////////////////////////////////////
//
// Abdel-Hakeem Badran
// 04/10/2018
//
// Class	: 	CustomersCollection
// Parent	: 	DomainCollection
//
///////////////////////////

class CustomersCollection extends DomainCollection
{
    // For use with non-static database manipulation functions.
    // protected $PDODBAdapter = null;

    public function __construct( $dbadapter ) {
        parent::__construct( $dbadapter );
    }
    
    /////////////////////////////////////////
    //
    // Unique concretes with no abstract.
    //
    //////////////////////
    //
    
    public function addCustomer($customer) {
        $customer->insert();
    }
    
    public function removeCustomer($customer) {
        $customer->delete();
    }
    
    //////////////////////////////////////////////////
    //
    // Functions inherited from the parent class:
    // getSelectStatement(), convertRowToObject()
    //
    
    //////////////////////////////////////////////////////////////
    //
	// Concrete static definitions for abstract static methods
    // that handle operations related to the database.
    //
    /////////////////////////

	public static function findAll($sortFields=null)
    {	
        // Static methods must define their own instance of the select statement.
		$sql = "SELECT " . Customers::fieldNameList() . " FROM " . Customers::getTableName();
        if (! is_null($sortFields)) {
            $sql .= ' ORDER BY ' . $sortFields;
        }
        // Static methods must define their own instance of the adapter.
        $PDOAdapter = DatabaseAdapterFactory::getInstance( 'PDO', array(DBCONNECTION, DBUSER, DBPASS) );

        return CustomersCollection::convertRecordsToObjects( $PDOAdapter->fetchAsArray($sql) );
	}
	
    public static function findBy($whereClause, $parameterValues=array(), $sortFields=null)
    {
	    $sql = "SELECT " . Customers::fieldNameList() . " FROM " . Customers::getTableName() . " WHERE " . $whereClause;

        // Add sort order, only if required.
        if (! is_null($sortFields)) {
            $sql .= ' ORDER BY ' . $sortFields;
        }
        
        $PDOAdapter = DatabaseAdapterFactory::getInstance( 'PDO', array(DBCONNECTION, DBUSER, DBPASS) );
        $result = $PDOAdapter->fetchAsArray($sql, $parameterValues);
        
        return CustomersCollection::convertRecordsToObjects($result);
    }
    
    public static function findByAsArray($whereClause, $parameterValues=array(), $sortFields=null)
    {
	    $sql = "SELECT " . Customers::fieldNameList() . " FROM " . Customers::getTableName() . " WHERE " . $whereClause;

        // Add sort order, only if required.
        if (! is_null($sortFields)) {
            $sql .= ' ORDER BY ' . $sortFields;
        }
        
        $PDOAdapter = DatabaseAdapterFactory::getInstance( 'PDO', array(DBCONNECTION, DBUSER, DBPASS) );
        $result = $PDOAdapter->fetchAsArray($sql, $parameterValues);
        
        return $result;//CustomersCollection::convertRecordsToObjects($result);
    }
	
    /////////////////////////////////////////////////////
    //
    // Abstract database manipulation functions.
    //
    /////////////////////////////
    
    public function insertMultiple($objectArray=null)
    {
        foreach ( $objectArray as $customer ) {
            if ( is_a( $customer, 'Customers' ) ) {
                $customer->insert();
            } else {
                throw new Exception("Object type does not match expected: Customers");
            }
        }
    }
    
    public function updateMultiple($objectArray=null)
    {
        foreach ( $objectArray as $customer ) {
            if ( is_a( $customer, 'Customers' ) ) {
                $customer->update();
            } else {
                throw new Exception("Object type does not match expected: Customers");
            }
        }
    }
    
    public function deleteMultiple($objectArray=null)
    {
        foreach ( $objectArray as $customer ) {
            if ( is_a( $customer, 'Customers' ) ) {
                $customer->delete();
            } else {
                throw new Exception("Object type does not match expected: Customers");
            }
        }
    }
    
    ////////////////////////////////
    //
    // Simple static abstract helper function(s).
    //
    /////////////////////
    
    protected static function convertRecordsToObjects($results)
    {
        $className = CustomersCollection::getDomainObjectClassName();
        
        // Static methods must define their own instance of the adapter.
        $PDOAdapter = DatabaseAdapterFactory::getInstance( 'PDO', array(DBCONNECTION, DBUSER, DBPASS) );
        
        $rows = Array();
        foreach ($results as $row)
        {
            $instance = new $className($row, $PDOAdapter, false);
            $rows[] = $instance;
        }
        
        return $rows;
    }
    
    //////////////////////////////////////
    //
    // Simple information abstracts.
    //
    //////////////////
    
    protected static function getDomainObjectClassName()  
    {
        return "Customers";
    } 
    
    protected static function getTableName()
    {
        return "customers";
    }
    
    protected static function getOrderFields() 
    {
        return 'name';
    }
    
    protected static function getPrimaryKeyName() {
        return "id";
    }
    
}

?>