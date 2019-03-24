<?php
include_once 'Controller/Controller.php';
class Core {
    
       function run() {

        $url = explode("index.php", $_SERVER['PHP_SELF']);
        $url = end($url);
        $param = array();

        if (!empty($url)) {

            $url = explode("/", $url);
            array_shift($url);

            $currentController = $url[0] . "Controller";
            array_shift($url);

            if (isset($url[0])) {
                $currentAction = $url[0];
                array_shift($url);
            } else {

                $currentAction = "index";
            }

            if (count($url) > 0) {
                $param = $url;
            }
            
        } else {
            $currentController = "HomeController";
            $currentAction = "index";
        }
        
        if(file_exists("Controller/".$currentController.".php")){
        $c = new $currentController();
        if(method_exists($c, $currentAction)){
        call_user_func_array(array($c, $currentAction), $param);
        }else {
            header('Location: '.BASE_URL);  
        }
        
        } else {
            header('Location: '.BASE_URL);  
        }
    }

}
