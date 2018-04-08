<?php

class ProductsCollection extends DomainCollection
{
    
    public function __construct( $dbadapter ) {
        parent::__construct( $dbadapter );
    }
    
   protected function getDomainObjectClassName()  
   {
      return "Products";
   } 
   protected function getTableName()
   {
      return "products";
   }
   protected function getOrderFields() 
   {
      return 'name';
   }
   
   protected function getPrimaryKeyName() {
      return "id";
   }
    
}

?>