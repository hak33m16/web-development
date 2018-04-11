<?php

////////////////////////////////////
//
// Abdel-Hakeem Badran
// 04/10/2018
//
///////////////////////////

class ProductsCollection extends DomainCollection
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
    
    public function addProduct($product) {
        
    }
    
    public function removeProduct($product) {
        
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
		$sql = "SELECT " . Products::fieldNameList() . " FROM " . Products::getTableName();
        if (! is_null($sortFields)) {
            $sql .= ' ORDER BY ' . $sortFields;
        }
        // Static methods must define their own instance of the adapter.
        $PDOAdapter = DatabaseAdapterFactory::getInstance( 'PDO', array(DBCONNECTION, DBUSER, DBPASS) );

        return ProductsCollection::convertRecordsToObjects( $PDOAdapter->fetchAsArray($sql) );
	}
	
    public static function findBy($whereClause, $parameterValues=array(), $sortFields=null)
    {
	    $sql = "SELECT " . Products::fieldNameList() . " FROM " . Products::getTableName() . " WHERE " . $whereClause;

        // Add sort order, only if required.
        if (! is_null($sortFields)) {
            $sql .= ' ORDER BY ' . $sortFields;
        }
        
        $PDOAdapter = DatabaseAdapterFactory::getInstance( 'PDO', array(DBCONNECTION, DBUSER, DBPASS) );
        $result = $PDOAdapter->fetchAsArray($sql, $parameterValues);
        
        return ProductsCollection::convertRecordsToObjects($result);
    }
    
    public static function findByAsArray($whereClause, $parameterValues=array(), $sortFields=null)
    {
	    $sql = "SELECT " . Products::fieldNameList() . " FROM " . Products::getTableName() . " WHERE " . $whereClause;

        // Add sort order, only if required.
        if (! is_null($sortFields)) {
            $sql .= ' ORDER BY ' . $sortFields;
        }
        
        $PDOAdapter = DatabaseAdapterFactory::getInstance( 'PDO', array(DBCONNECTION, DBUSER, DBPASS) );
        $result = $PDOAdapter->fetchAsArray($sql, $parameterValues);
        
        return $result;//ProductsCollection::convertRecordsToObjects($result);
    }
	
    /////////////////////////////////////////////////////
    //
    // Abstract database manipulation functions.
    //
    /////////////////////////////
    
    public function insertMultiple($objectArray=null)
    {
        foreach ( $objectArray as $product ) {
            if ( is_a( $product, 'Products' ) ) {
                $product->insert();
            } else {
                throw new Exception("Object type does not match expected: Products");
            }
        }
    }
    
    public function updateMultiple($objectArray=null)
    {
        foreach ( $objectArray as $product ) {
            if ( is_a( $product, 'Products' ) ) {
                $product->update();
            } else {
                throw new Exception("Object type does not match expected: Products");
            }
        }
    }
    
    public function deleteMultiple($objectArray=null)
    {
        foreach ( $objectArray as $product ) {
            if ( is_a( $product, 'Products' ) ) {
                $product->delete();
            } else {
                throw new Exception("Object type does not match expected: Products");
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
        $className = ProductsCollection::getDomainObjectClassName();
        
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
        return "Products";
    } 
    
    protected static function getTableName()
    {
        return "products";
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