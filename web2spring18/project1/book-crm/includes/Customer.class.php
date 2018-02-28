<?php
/*

Represents a Customer (for the book case)

*/

class Customer {    

    public $id;
    public $name;
    public $email;
    public $university;
    public $address;
    public $city;
    public $country;
    public $sales_array;
    
    public function __construct($new_id, $new_name, $new_email, $new_uni, $new_add, $new_city, $new_country, $new_sales) {
        
        $this->id = $new_id;
        $this->name = $new_name;
        $this->email = $new_email;
        $this->university = $new_uni;
        $this->address = $new_add;
        $this->city = $new_city;
        $this->country = $new_country;
        $this->sales_array = $new_sales;
        
    }
    
}

?>