<!--
    This file is used to connect and select the database.
    Source: https://www.codexworld.com/simple-php-shopping-cart-using-sessions/
    File: dbConfig.php
    Author 1: CodexWorld
    Author 2: ...
-->
<?php
//DB details
$dbHost = 'localhost';
$dbUsername = 'wb2s18user';
$dbPassword = 'wb2s18pass';
$dbName = 'shopping_cart';

//Create connection and select DB
$db = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

if ($db->connect_error) {
    die("Unable to connect database: " . $db->connect_error);
} 
?>