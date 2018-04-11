<?php
/*
  Encapsulates common functionality needed by all row data gateway objects.
 
  DomainObject is an enterprise data pattern identified by Fowler. This pattern's 
  intent is to encapsulate a single row of a database table. Each field in the underlying
  database record is accessible via getters/setters with same name as field names
 
  Inspired by:   http://martinfowler.com/eaaCatalog/rowDataGateway.html
                 http://www.devshed.com/c/a/PHP/PHP-Services-Layers-Data-Mappers
                 https://github.com/codeinthehole/domain-model-mapper
 */

////////////////////////////
//
// Abdel-Hakeem Badran
// 04/10/2018
//
/////////////////////
//

abstract class DomainObject 
{
    protected $PDOAdapter = null;

    public function setAdapter($newAdapter) { $PDOAdapter = $newAdapter; }
    public function getAdapter() { return $PDOAdapter; }
    
    protected $fieldValues = array(); 
    protected $generateException = true;

    //////////////////////////
    //
    // Class constructor
    //
    ///////////////
    //
    
    public function __construct(array $data, $pdoInstance=null, $generateExc=false)
    {
        $this->generateException = $generateExc;
        $this->PDOAdapter = $pdoInstance;
        
        // given an array of field name+values for a single row, assign them as properties
        foreach ($data as $name => $value) {
            $this->$name = $value;
        }
    }
    
    ///////////////////////////////////////////////
    //
    // Abstract methods requiring implementation.
    //
    //////////////////////
    //
    
    abstract static public function findByKey($key);
    
    abstract public function insert();
    abstract public function update();
    abstract public function delete();
    
    ///////////////////////////////////////
    //
    // Common functions among all concretes.
    //
    /////////////////////
    //
   
    // Returns a list of field names for the concrete row
    public static function fieldNameList()
    {   
        $staticClassName = get_called_class();
        return implode(",", $staticClassName::getFieldNames());
    }
   
   
    // Does the passed field exist in this class?
    protected function doesFieldExist($name)
    {
        $className = get_class($this);
        return in_array($name, $className::getFieldNames());  
    }   
   
   
    // Will generate exception if passed name doesnt exist in field list (which
    // is defined by the concrete subclass)
    private function checkFieldName($name) 
    {
        if (! $this->doesFieldExist($name) && $this->generateException) {
            throw new Exception('The field ' . $name . ' is not allowed for this row.');    
        }   
    }
    
    //////////////////////////////////////////////////
    //
    // PHP Magic Functions for Object Manipulation
    //
    /////////////////////////
    //
    
    // PHP magic function that get the value assigned to the specified field via the corresponding getter (if it exists);
    // otherwise, get the value directly from the '$fieldValues' protected array
    public function __get($name)
    {
        $accessor = 'get' . ucfirst($name);          
        if (method_exists($this, $accessor) && is_callable(array($this, $accessor))) {
            return $this->$accessor;    
        }
        
        if (isset($this->fieldValues[$name])) {
            return $this->fieldValues[$name];   
        }
        
        if ($this->generateException) {
            throw new Exception('The field ' . $name . ' has not been set for this row yet.');
        } else {
            return "";
        }
    }
    
   
    // PHP magic function that assigns a value to the specified field via the corresponding mutator (if it exists); 
    // otherwise, assign the value directly to the '$fieldValues' protected array 
    public function __set($name, $value)
    {   
        $this->checkFieldName($name);
        $mutator = 'set' . ucfirst($name);
        if (method_exists($this, $mutator) && is_callable(array($this, $mutator))) {
            
            $this->$mutator($value);         
            
        } else {
            
            if ( !is_null($value) ) {
                $this->fieldValues[$name] = $value;
            } else {
                $this->fieldValues[$name] = "";
            }
            
        }    
    }
    
    // PHP magic function that checks if the specified field has been assigned to the entity
    public function __isset($name)
    {
        $this->checkFieldName($name);
        return isset($this->fieldValues[$name]);
    }
    
    // PHP magic function that unsets the specified field from the entity
    public function __unset($name)
    {
        $this->checkFieldName($name);
        if (isset($this->fieldValues[$name])) {
            unset($this->fieldValues[$name]);
        }
    }

}

?>