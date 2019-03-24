<?php

class Controller {
    
    function loadView($viewName, $viewData){
        extract($viewData);
        if(file_exists("Views/".$viewName.".php")){
            include_once "Views/".$viewName.".php";
        } else {
            include_once 'Views/404.php';
        }      
    }
        
    
    
    function loadTemplate($viewName, $viewData){
        if(file_exists("Views/Template.php")){
            include_once "Views/Template.php";
        } else {
            include_once 'Views/404.php';
        }  
    }
    
    function loadViewInTemplate($viewName, $viewData){
        extract($viewData);
       if(file_exists("Views/".$viewName.".php")){
            include_once "Views/".$viewName.".php";
        } else {
            include_once 'Views/404.php';
        }
    }
    
}
