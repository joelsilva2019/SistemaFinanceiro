<?php
include_once 'Environment.php';

define("BASE_URL", "http://localhost/ContaAzul/");

global $config;
$config = array();
if(ENVIRONMENT == "development"){    
    $config['dbName'] = "contaazul";
    $config['dbHost'] = "127.0.0.1";
    $config['dbUser'] = "root";
    $config['dbPass'] = "";  
} else {
    $config['dbName'] = "contaazul";
    $config['dbHost'] = "127.0.0.1";
    $config['dbUser'] = "root";
    $config['dbPass'] = ""; 
}
