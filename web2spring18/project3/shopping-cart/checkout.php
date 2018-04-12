<!--
    This page gets the cart contents from the Cart class and displays the cart items with the total price. Also, 
    the user would be able to add more item to the cart by Continue Shopping button or Checkout from cart. 
    Checkout button redirects the user to the checkout.php page to preview the order before submit.
    Source: https://www.codexworld.com/simple-php-shopping-cart-using-sessions/
    File: checkout.php
    Author 1: CodexWorld
    Author 2: ...
-->
<?php

include 'includes/db-config.php';

include 'lib/Cart.class.php';
$cart = new Cart;

// redirect to home if cart is empty
if($cart->total_items() <= 0){
    header("Location: index.php");
}

// set customer ID in session
$_SESSION['sessionCustomerID'] = 1;

// get customer details by session customer ID
// $query = $db->query("SELECT * FROM customers WHERE id = ".$_SESSION['sessCustomerID']);
// $custRow = $query->fetch_assoc();
$customer = Customers::findByKey( $_SESSION['sessionCustomerID'] );

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Checkout - PHP Shopping Cart Tutorial</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <style>
    .container{width: 100%;padding: 50px;}
    .table{width: 65%;float: left;}
    .shipAddr{width: 30%;float: left;margin-left: 30px;}
    .footBtn{width: 95%;float: left;}
    .orderBtn {float: right;}
    </style>
</head>
<body>
<div class="container">
    <h1>Order Preview</h1>
    <table class="table">
    <thead>
        <tr>
            <th>Product</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Subtotal</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if($cart->total_items() > 0){
            //get cart items from session
            $cart_contents = $cart->contents();
            foreach( $cart_contents as $order_item ){
				$product = Products::findByKey( $order_item->product_id );
        ?>
        <tr>
            <td><?=$product->name?></td>
            <td><?php echo "$" . $product->price . " USD"; 	?></td>
            <td><?=$order_item->quantity?></td>
            <td><?php echo "$" . $product->price * $order_item->quantity . " USD"; ?></td>
        </tr>
        <?php } }else{ ?>
        <tr><td colspan="4"><p>No items in your cart......</p></td>
        <?php } ?>
    </tbody>
    <tfoot>
        <tr>
            <td colspan="3"></td>
            <?php if($cart->total_items() > 0){ ?>
            <td class="text-center"><strong>Total <?php echo '$'.$cart->total_price().' USD'; ?></strong></td>
            <?php } ?>
        </tr>
    </tfoot>
    </table>
    <div class="shipAddr">
        <h4>Shipping Details</h4>
        <p><?php echo $customer->name; ?></p>
        <p><?php echo $customer->email; ?></p>
        <p><?php echo $customer->phone; ?></p>
        <p><?php echo $customer->address; ?></p>
    </div>
    <div class="footBtn">
        <a href="index.php" class="btn btn-warning"><i class="glyphicon glyphicon-menu-left"></i> Continue Shopping</a>
        <a href="cartAction.php?action=placeOrder" class="btn btn-success orderBtn">Place Order <i class="glyphicon glyphicon-menu-right"></i></a>
    </div>
</div>
</body>
</html>