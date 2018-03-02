<?php
    include 'include/art-config.inc.php';
    spl_autoload_register(function ($class){
        $file = 'lib/' . $class . '.class.php';
        if (file_exists($file)) include $file;
    });
?>