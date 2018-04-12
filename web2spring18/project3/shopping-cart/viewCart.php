<!--
    This page gets the cart contents from the Cart class and displays the cart items with 
    the total price. Also, the user would be able to add more item to the cart by Continue 
    Shopping button or Checkout from cart. Checkout button redirects the user to the checkout.php 
    page to preview the order before submit.
    Source: https://www.codexworld.com/simple-php-shopping-cart-using-sessions/
    File: viewCart.php
    Author 1: CodexWorld
    
    Author 2    :   Abdel-Hakeem Badran
    Date:       :   04/11/2018
-->
<?php

// Includes the auto-include function.
include 'includes/db-config.php';

$cart = new Cart;

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>View Cart - Shopping Cart</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <style>
    .container{
        padding: 50px;
        }
    input[type="number"]{
        width: 20%;
        }
    </style>
    <script>
    function updateCartItem(obj,id){
        $.get("cartAction.php", {action:"updateCartItem", id:id, quantity:obj.value}, function(data){
            if(data == 'ok'){
                location.reload();
            }else{
                alert('Cart update failed, please try again.');
            }
        });
    }
    </script>
</head>
</head>
<body>
<div class="container">
    <h1>Shopping Cart</h1>
    <table class="table">
    <thead>
        <tr>
            <th>Product</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Subtotal</th>
            <th>&nbsp;</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if ( $cart->total_items() > 0 ) {
			
            //get cart items from session
			$cart_products = array();
            $cart_order_items = $cart->contents();
			foreach ($cart_order_items as $orderItem) {
				$cart_products[] = Products::findByKey( $orderItem->product_id );
			}
			
            //foreach($cart_content as $orderItem) {
			for ( $i = 0; $i < count( $cart_products ); ++ $i ) {
        ?>
        <tr>
            <td><?=$cart_products[$i]->name?></td>
            <td><?=$cart_products[$i]->price?></td>
            <td><input type="number" class="form-control text-center" value="<?=$cart_order_items[$i]->quantity?>" onchange="updateCartItem(this, '<?=$cart_order_items[$i]->product_id?>')"></td>
            <td><?php echo "$" . $cart_products[$i]->price * $cart_order_items[$i]->quantity . " USD"; ?></td>
            <td>
                <!--<a href="cartAction.php?action=updateCartItem&id=" class="btn btn-info"><i class="glyphicon glyphicon-refresh"></i></a>-->
                <a href="cartAction.php?action=removeCartItem&id=<?=$cart_order_items[$i]->product_id?>" class="btn btn-danger" onclick="return confirm('Are you sure?')"><i class="glyphicon glyphicon-trash"></i></a>
            </td>
        </tr>
        <?php } }else{ ?>
        <tr><td colspan="5"><p>Your cart is empty.....</p></td>
        <?php } ?>
    </tbody>
    <tfoot>
        <tr>
            <td><a href="index.php" class="btn btn-warning"><i class="glyphicon glyphicon-menu-left"></i> Continue Shopping</a></td>
            <td colspan="2"></td>
            <?php if( $cart->total_items() > 0 ) { ?>
            <td class="text-center"><strong>Total <?php echo '$'.$cart->total_price().' USD'; ?></strong></td>
            <td><a href="checkout.php" class="btn btn-success btn-block">Checkout <i class="glyphicon glyphicon-menu-right"></i></a></td>
            <?php } ?>
        </tr>
    </tfoot>
    </table>
</div>
</body>
</html>