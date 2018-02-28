<?php
/*
    Place utility functions here
*/

    function purify_file($data) {
        
        return $data;
        
    }

    function populate_customers() {
        
        $my_file = 'data/customers.txt';
        $handle = fopen($my_file, 'r');
        $data = fread($handle, filesize($my_file));
        
        $customer_array = [];
        
        $customers_by_line = explode("\n", $data);
        array_pop($customers_by_line); // remove empty line
        foreach ($customers_by_line as $customer) {
            
            $customer_info = explode(";", $customer);
            
            $temp_customer = new Customer(  $customer_info[0], $customer_info[1] . ' ' . $customer_info[2], $customer_info[3],
                                            $customer_info[4], $customer_info[5], $customer_info[6], $customer_info[8], $customer_info[11] );
            
            array_push($customer_array, $temp_customer);
            
        }
        
        return $customer_array;
        
    }
    
    function populate_orders() {
        
        $my_file = 'data/orders.txt';
        $handle = fopen($my_file, 'r');
        $data = fread($handle, filesize($my_file));
        
        $order_array = [];
        
        $orders_by_line = explode("\n", $data);
        array_pop($orders_by_line); // remove empty line
        foreach ($orders_by_line as $order) {
            
            $order_info = explode(",", $order);
            
            $temp_order = new Order($order_info[0], $order_info[1], $order_info[2],
                                    $order_info[3], $order_info[4] );
            
            array_push($order_array, $temp_order);
            
        }
        
        return $order_array;
        
    }

?>