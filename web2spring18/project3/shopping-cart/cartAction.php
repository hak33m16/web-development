<!--
    This file handles all the action requested by the user from view page. 
    The code blocks would be executed based on the requested action. The following operations can 
    happen based on the action.
    addToCart – Fetches the product details from the products table by the specified product 
        ID and insert the item into the cart using Cart class. After successful operation, the user is redirected to the viewCart.php page.
    updateCartItem – Updates the cart by specific rowid using Cart 
        class and returns the status message.
    removeCartItem – Removes the item from the cart by the specific 
        item id using Cart class. After successful operation, the user is redirected to the viewCart.php page.
    placeOrder – Inserts the cart items data to the orders and order_items 
        table and destroy the cart data from the session. using Cart class. After successful operation, 
        the user is redirected to the orderSuccess.php page.
    Source: https://www.codexworld.com/simple-php-shopping-cart-using-sessions/
    File: cartAction.php
    Author 1: CodexWorld
    Author 2: ...
-->
<?php

// Includes auto-include function.
include 'includes/db-config.php';

$cart = new Cart();

// Check if the page has been accessed correctly.
if ( isset($_GET['action']) && !empty($_GET['action']) ) {
    
    // Check if we can add the requested item id to the cart
    if ( $_GET['action'] == 'addToCart' && !empty($_GET['id']) ) {
        
        $product = Products::findByKey( $_GET['id'] );
        
        $cart->insert( $product );
        
        // Show user the changes to their cart
        //header("Location: viewCart.php");
    }
    
}



/*
if(isset($_GET['action']) && !empty($_GET['action'])){
    if($_GET['action'] == 'addToCart' && !empty($_GET['id'])){
        $productID = $_GET['id'];
        // get product details
        $query = $db->query("SELECT * FROM products WHERE id = ".$productID);
        $row = $query->fetch_assoc();
        $itemData = array(
            'id' => $row['id'],
            'name' => $row['name'],
            'price' => $row['price'],
            'quantity' => 1
        );
        
        $insertItem = $cart->insert($itemData);
        $redirectLoc = $insertItem?'viewCart.php':'index.php';
        header("Location: ".$redirectLoc);
    }
    elseif($_GET['action'] == 'updateCartItem' && !empty($_GET['id']))
    {
        $itemData = array(
            'row_id' => $_GET['id'],
            'quantity' => $_GET['quantity']
        );
        $updateItem = $cart->update($itemData);
        echo $updateItem?'ok':'err';die;
    }elseif($_GET['action'] == 'removeCartItem' && !empty($_GET['id']))
    {
        $deleteItem = $cart->remove($_GET['id']);
        header("Location: viewCart.php");
    }elseif($_GET['action'] == 'placeOrder' && $cart->total_items() > 0 && !empty($_SESSION['sessCustomerID']))
    {
        // insert order details into database
        $insertOrder = $db->query("INSERT INTO orders (customer_id, total_price, created, modified) VALUES ('".$_SESSION['sessCustomerID']."', '".$cart->total()."', '".date("Y-m-d H:i:s")."', '".date("Y-m-d H:i:s")."')");
        
        if($insertOrder){
            $orderID = $db->insert_id;
            $sql = '';
            // get cart items
            $cartItems = $cart->contents();
            foreach($cartItems as $item){
                $sql .= "INSERT INTO order_items (order_id, product_id, quantity) VALUES ('".$orderID."', '".$item['id']."', '".$item['quantity']."');";
            }
            // insert order items into database
            $insertOrderItems = $db->multi_query($sql);
            
            if($insertOrderItems){
                $cart->destroy();
                header("Location: orderSuccess.php?id=$orderID");
            }else{
                header("Location: checkout.php");
            }
        }else{
            header("Location: checkout.php");
        }
    }else{
        header("Location: index.php");
    }
}else{
    header("Location: index.php");
}*/