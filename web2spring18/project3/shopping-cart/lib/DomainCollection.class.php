<?php

////////////////////////////////////
//
// Abdel-Hakeem Badran
// 04/10/2018
//
///////////////////////////

abstract class DomainCollection
{
    protected $PDODBAdapter = null;

    public function __construct( $dbadapter )
    {
        if ( is_null($dbadapter) ) {
            throw new Exception("Database adapter null.");
        } else {
            $this->PDODBAdapter = $dbadapter;
        }
    }

    ////////////////////////////////////////
    //
    // Abstract Methods
    //
    ///////////////////////

    abstract static public function findAll($sortFields);
    abstract static public function findBy($whereClause, $parameterValues, $sortFields);
    abstract static public function findByAsArray($whereClause, $parameterValues, $sortFields);

    abstract public function insertMultiple($objectArray);
    abstract public function updateMultiple($objectArray);
    abstract public function deleteMultiple($objectArray);
    
    abstract static protected function convertRecordsToObjects($results);
    abstract static protected function getDomainObjectClassName();
    abstract static protected function getTableName();
    abstract static protected function getOrderFields();
	abstract static protected function getPrimaryKeyName();

    /////////////////////////////////////////
    //
    // Public Finders
    //
    ///////////////////////

    // Subclasses can override this if they need a non-standard SELECT.
    protected function getSelectStatement()
    {
        $className = $this->getDomainObjectClassName();
        return "SELECT " . $className::fieldNameList() . " FROM " . $this->getTableName();
    }
    
    // Converts the array of record data that comes from the database adapter into
    // an object of the appropriate Domain Object subclass type.
    protected function convertRowToObject($result)
    {
        $className = $this->getDomainObjectClassName();
        return new $className($result,false);
    }
    
}



























    
    //protected function getPrimaryKeyName() { return "id"; }
    
    //public function getCollection() { return $collection; }  
    
	//abstract public function findAll($sortFields=null);
	//abstract public function findBy($whereClause, $parameterValues=array(), $sortFields=null);
	
    /*public function findAll($sortFields=null)
    {
        $sql = $this->getSelectStatement();
        // add sort order if required
        if (! is_null($sortFields)) {
            $sql .= ' ORDER BY ' . $sortFields;
        }
        
        //print_r( $this->convertRecordsToObjects($this->PDODBAdapter->fetchAsArray($sql)) );
        
        return $this->convertRecordsToObjects($this->PDODBAdapter->fetchAsArray($sql));
        //$this->collection = $this->convertRecordsToObjects($this->PDODBAdapter->fetchAsArray($sql));

    }*/

    /*
   public function findAllSorted($ascending)
   {
      $sql = $this->getSelectStatement() . ' ORDER BY ' . $this->getOrderFields();
      if (! $ascending) {
         $sql .= " DESC";
      }
      return $this->convertRecordsToObjects($this->PDODBAdapter->fetchAsArray($sql));
   }*/

   /*public function findBy($whereClause, $parameterValues=array(), $sortFields=null)
   {
      $sql = $this->getSelectStatement() . ' WHERE ' . $whereClause;
      // add sort order if required
      if (! is_null($sortFields)) {
         $sql .= ' ORDER BY ' . $sortFields;
      }
      $result = $this->PDODBAdapter->fetchAsArray($sql, $parameterValues);
      return $this->convertRecordsToObjects($result);
   }*/

   /*
   public function findById($id)
   {
      $sql = $this->getSelectStatement() . ' WHERE ' . $this->getPrimaryKeyName() . '=:id';
      return $this->convertRowToObject($this->PDODBAdapter->fetchRow($sql, Array(':id' => $id)) );
   }*/

   //////////////////////////////////
   //
   // Helper Functions
   //
   ////////////////////////



   /*
      Converts the array of records that comes from the database adapter into
      an array of object of the appropriate Domain Object subclass type
   */
   /*
   protected static function convertRecordsToObjects($results)
   {
      $className = $this->getDomainObjectClassName();
      $rows = Array();
      foreach ($results as $row)
      {
         $instance = new $className($row, false);
         $rows[] = $instance;
      }
      return $rows;
   }*/

//}

?>