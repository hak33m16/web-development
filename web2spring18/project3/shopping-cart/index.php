<!--
    In this page, we’ve used bootstrap to design the products list, you can omit bootstrap 
    and use your web page design. All the products will be fetched from the products 
    table and listed with the “Add to cart” button. Add to cart button redirects the 
    user to the cartAction.php page with addToCart request and respective product ID.
    Source: https://www.codexworld.com/simple-php-shopping-cart-using-sessions/
    File: index.php
    Author 1: CodexWorld
    Author 2: Abdel-Hakeem Badran
-->
<?php

include 'includes/db-config.php';

$domainControllerInstance = new DomainLevelController( null );
$products = $domainControllerInstance->productsCollection;

$temp = new Cart();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>PHP Shopping Cart Tutorial</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <style>
    .container{
        padding: 50px;
        }
    .cart-link{
        width: 100%;
        text-align: right;
        display: block;
        font-size: 22px;
        }
    </style>
</head>
</head>
<body>
<div class="container">
    <h1>Products</h1>
    <a href="viewCart.php" class="cart-link" title="View Cart"><i class="glyphicon glyphicon-shopping-cart"></i></a>
    <div id="products" class="row list-group">
        <?php
            if ( !is_null( $products ) ) {
                foreach ( $products as $product ) {
        ?>
        <div class="item col-lg-4">
            <div class="thumbnail">
                <div class="caption">
                    <h4 class="list-group-item-heading"><?=$product->name?></h4>
                    <p class="list-group-item-text"><?=$product->description?></p>
                    <div class="row">
                        <div class="col-md-6">
                            <p class="lead"><?=$product->price?></p>
                        </div>
                        <div class="col-md-6">
                            <a class="btn btn-success" href="cartAction.php?action=addToCart&id=<?=$product->id?>">Add to cart</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
                } // end for
            } else { // end if, go to else
        ?>
        <p>Product(s) not found.....</p>
        <?php
            }
        ?>
    </div>
</div>
</body>
</html>