<?php

////////////////////////////////////
//
// Abdel-Hakeem Badran
// 04/10/2018
//
// Class	: 	OrdersCollection
// Parent	: 	DomainCollection
//
///////////////////////////

class OrdersCollection extends DomainCollection
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
    
    public function addOrderItem($orderitem) {
        $orderitem->insert();
    }
    
    public function removeOrderItem($orderitem) {
        $orderitem->delete();
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
		$sql = "SELECT " . Orders::fieldNameList() . " FROM " . Orders::getTableName();
        if (! is_null($sortFields)) {
            $sql .= ' ORDER BY ' . $sortFields;
        }
        // Static methods must define their own instance of the adapter.
        $PDOAdapter = DatabaseAdapterFactory::getInstance( 'PDO', array(DBCONNECTION, DBUSER, DBPASS) );

        return OrdersCollection::convertRecordsToObjects( $PDOAdapter->fetchAsArray($sql) );
	}
	
    public static function findBy($whereClause, $parameterValues=array(), $sortFields=null)
    {
	    $sql = "SELECT " . Orders::fieldNameList() . " FROM " . Orders::getTableName() . " WHERE " . $whereClause;

        // Add sort order, only if required.
        if (! is_null($sortFields)) {
            $sql .= ' ORDER BY ' . $sortFields;
        }
        
        $PDOAdapter = DatabaseAdapterFactory::getInstance( 'PDO', array(DBCONNECTION, DBUSER, DBPASS) );
        $result = $PDOAdapter->fetchAsArray($sql, $parameterValues);
        
        return OrdersCollection::convertRecordsToObjects($result);
    }
    
    public static function findByAsArray($whereClause, $parameterValues=array(), $sortFields=null)
    {
	    $sql = "SELECT " . Orders::fieldNameList() . " FROM " . Orders::getTableName() . " WHERE " . $whereClause;

        // Add sort order, only if required.
        if (! is_null($sortFields)) {
            $sql .= ' ORDER BY ' . $sortFields;
        }
        
        $PDOAdapter = DatabaseAdapterFactory::getInstance( 'PDO', array(DBCONNECTION, DBUSER, DBPASS) );
        $result = $PDOAdapter->fetchAsArray($sql, $parameterValues);
        
        return $result;//OrdersCollection::convertRecordsToObjects($result);
    }
	
    /////////////////////////////////////////////////////
    //
    // Abstract database manipulation functions.
    //
    /////////////////////////////
    
    public function insertMultiple($objectArray=null)
    {
        foreach ( $objectArray as $orderitem ) {
            if ( is_a( $orderitem, 'Orders' ) ) {
                $orderitem->insert();
            } else {
                throw new Exception("Object type does not match expected: Orders");
            }
        }
    }
    
    public function updateMultiple($objectArray=null)
    {
        foreach ( $objectArray as $orderitem ) {
            if ( is_a( $orderitem, 'Orders' ) ) {
                $orderitem->update();
            } else {
                throw new Exception("Object type does not match expected: Orders");
            }
        }
    }
    
    public function deleteMultiple($objectArray=null)
    {
        foreach ( $objectArray as $orderitem ) {
            if ( is_a( $orderitem, 'Orders' ) ) {
                $orderitem->delete();
            } else {
                throw new Exception("Object type does not match expected: Orders");
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
        $className = OrdersCollection::getDomainObjectClassName();
        
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
        return "Orders";
    } 
    
    protected static function getTableName()
    {
        return "orders";
    }
    
    protected static function getOrderFields() 
    {
        return 'id';
    }
    
    protected static function getPrimaryKeyName() {
        return "id";
    }
    
}

?>