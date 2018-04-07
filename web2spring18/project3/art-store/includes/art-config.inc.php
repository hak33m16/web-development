<?php

//error_reporting(E_ALL);
//ini_set('display_errors', 1);

/* note: connection for cloud9 ... you will need to modify for your own environment */
//$ip = getenv('IP');
//$ip = "localhost";
//$port = '3306';

$dbconnection = "mysql:host=localhost;dbname=art;charset=utf8";
$dbusername = "wb2s18user";
$dbpassword = "wb2s18pass";

define('DBCONNECTION', $dbconnection);
define('DBUSER', $dbusername);
define('DBPASS', $dbpassword);

//define('DBCONNECTION', "mysql:host=$ip;port=$port;dbname=art;charset=utf8mb4;");
//define('DBUSER', getenv('C9_USER'));
//define('DBPASS', '');

spl_autoload_register(function ($class) {
    $file = 'lib/' . $class . '.class.php';
    if (file_exists($file)) 
      include $file;
});

//$dbAdapter = DatabaseAdapterFactory::create('PDO', array(DBCONNECTION, DBUSER, DBPASS));

?>
