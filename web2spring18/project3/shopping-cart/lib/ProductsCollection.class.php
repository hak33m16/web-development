<?php

class ProductsCollection extends DomainCollection
{
    
	//protected static $PDODBAdapter = DatabaseAdapterFactory::getInstance( 'PDO', array(DBCONNECTION, DBUSER, DBPASS) );
	
    public function __construct( $dbadapter ) {
        parent::__construct( $dbadapter );
    }
    
	// Concrete redefine findAll
	public static function findAll($sortFields=null) {
		
		$sql = "SELECT " . Products::fieldNameList() . " FROM " . Products::getTableName();
		
		//$sql = $this->getSelectStatement();
        if (! is_null($sortFields)) {
            $sql .= ' ORDER BY ' . $sortFields;
        }
		
        return DomainCollection::convertRecordsToObjects( DatabaseAdapterFactory::getInstance( 'PDO', array(DBCONNECTION, DBUSER, DBPASS) ) );
		//$this->PDODBAdapter->fetchAsArray($sql));
	}
	

   public static function findBy($whereClause, $parameterValues=array(), $sortFields=null)
   {
	   $sql = null;
      //$sql = $this->getSelectStatement() . ' WHERE ' . $whereClause;
      // add sort order if required
      if (! is_null($sortFields)) {
         $sql .= ' ORDER BY ' . $sortFields;
      }
      $result = $this->PDODBAdapter->fetchAsArray($sql, $parameterValues);
      return $this->convertRecordsToObjects($result);
   }
	
	
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