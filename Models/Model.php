<?php


class Model {
  
    protected $db;
    
    function __construct() {
        global $config;
        $this->db = new PDO("mysql:dbname=".$config['dbName'].";host=".$config['dbHost'],$config['dbUser'], $config['dbPass']);
    }
    
    
}
