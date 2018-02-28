<?php
/*
   Represents a Order (for the book case)
*/

class Order {
    
    public $order_id;
    public $customer_id;
    public $book_isbn;
    public $book_title;
    public $book_category;
    
    public function __construct($new_order_id, $new_customer_id, $new_isbn, $new_title, $new_category) {
        
        $this->order_id = $new_order_id;
        $this->customer_id = $new_customer_id;
        $this->book_isbn = $new_isbn;
        $this->book_title = $new_title;
        $this->book_category = $new_category;
        
    }
    
}

?>