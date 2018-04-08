<?php
/*
  An example of a Factory Method design pattern. This one is 
  responsible for instantiating the appropriate data adapter
*/  
class DatabaseAdapterFactory
{
    
    /*
        Singleton functionality added into class.
        Old functionality kept for backwards compatibility.
    */
    
    private static $adapterInstance_ = null;
    
    public static function getInstance($type, $connectionValues) {
        
        $adapterName = "DatabaseAdapter" . $type;
        if ( class_exists($adapterName) ) {
            
            if ( is_null( self::$adapterInstance_ ) ) {
                
                self::$adapterInstance_ = new $adapterName( $connectionValues );
                
                return self::$adapterInstance_;
                
            } else {
                
                /* Reset the state of the adapter to the new connection. */
                self::$adapterInstance_->closeConnection();
                self::$adapterInstance_->setConnectionInfo( $connectionValues );
                
                return self::$adapterInstance_;
                
            }
            
        } else {
            throw new Exception("Invalid DatabaseAdapter type.");
        }
        
    }
    
    
    
   /*
      Returns the appropriate instatiated DatabaseAdapter subclass
      
      $type -- string containing the name of the DatabaseAdapter subclass
      $connectionValues -- array containing connection details (see doc for DatabaseAdapterInterface)
   */
    public static function create($type, $connectionValues) {
        $adapter = "DatabaseAdapter" . $type;
        if (class_exists($adapter)) {
            return new $adapter($connectionValues);
        }
        else {
            throw new Exception("Data Adapter type does not exist");
        }
    } 
    
}
?>