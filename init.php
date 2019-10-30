<?php
// define('SUPERPAY_DIR',  __DIR__); 

// spl_autoload_register(function($className){
//     $path = str_replace('\\', DIRECTORY_SEPARATOR, $className);
//     $path = str_replace('SuperPay'. DIRECTORY_SEPARATOR, '', $path);

//     $file = SUPERPAY_DIR . '/src/' . $path . '.php';

//     if (file_exists($file)) {
//         require_once $file;
//     }
// });

// include SUPERPAY_DIR . '/test.php';

require __DIR__ . "/vendor/autoload.php";
