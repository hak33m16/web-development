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
<div class="footBtn">
    <a href="index.php" class="btn btn-warning"><i class="glyphicon glyphicon-menu-left"></i> Continue Shopping</a>
</div>
</body>
</html>