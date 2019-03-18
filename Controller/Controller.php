<?php

class Controller {
    
    function loadView($viewName, $viewData){
        extract($viewData);
        include_once "Views/".$viewName.".php";
        
    } 
    function loadTemplate($viewName, $viewData){
        include_once "Views/Template.php";
    }
    
    function loadViewInTemplate($viewName, $viewData){
        extract($viewData);
        include_once "Views/".$viewName.".php";
    }
    
}
