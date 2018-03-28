<!--
    The customer is redirected to this page if their order is submitted successfully.
    Source: https://www.codexworld.com/simple-php-shopping-cart-using-sessions/
    File: orderSuccess.php
    Author 1: CodexWorld
    Author 2: ...
-->
<?php
if(!isset($_GET['id'])){
    header("Location: index.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Order Success!</title>
    <meta charset="utf-8">
    <style>
    .container{
        width: 100%;
        padding: 50px;
        }
    p{
        color:#34a853;
        font-size: 18px;
        }
    </style>
</head>
</head>
<body>
<div class="container">
    <h1>Order Status</h1>
    <p>Your order has submitted successfully. Order ID is #<?php echo $_GET['id']; ?></p>
</div>
</body>
</html>