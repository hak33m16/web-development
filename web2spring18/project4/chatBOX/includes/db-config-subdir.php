<?php

define('DBCONNECTION', "mysql:host=localhost;dbname=chatbox");
define('DBUSER', "wb2s18user");
define('DBPASS', "wb2s18pass");

spl_autoload_register(function ($class) {
    $file = '../lib/' . $class . '.class.php';
    if (file_exists($file)) 
      include $file;
});

?>