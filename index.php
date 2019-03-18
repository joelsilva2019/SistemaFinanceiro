<?php

session_start();
include_once 'Config.php';
include_once 'vendor/autoload.php';

spl_autoload_register(function ($class){

    if(strpos($class,"Controller") > -1){
        if(file_exists("Controller/".$class.".php")){
            include_once "Controller/".$class.".php";
        }
    } elseif (file_exists("Models/".$class.".php")){
            include_once "Models/".$class.".php";
    } elseif (file_exists("Core/".$class.".php")){
        include_once "Core/".$class.".php";
    }
    
});

$core = new Core();
$core->run();
