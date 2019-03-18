<?php

class AjaxController extends Model {
    
    
    public function __construct() {
        $users = new Users();
        if ($users->isLogged() == false) {
            header("Location: " . BASE_URL . "Login");
            exit;
        }
    }

    function index() {}
    
    function search_clients(){
        $data = array();
        $users = new Users();
        $users->setUser();
        $clients = new Clients();
        if(isset($_GET['q']) && !empty($_GET['q'])){
            
            $q = addslashes($_GET['q']);
            $clients_search = $clients->searchClientsByName($q, $users->getCompany());
            
            foreach ($clients_search as $citem){
                $data[] = array(
                    'name' => $citem['name'],
                    'link' => BASE_URL.'Clients/edit/'.$citem['id'],
                    'id'   => $citem['id']    
                );
                
            }
            
        }
        
        echo json_encode($data);
    }
    
    function search_inventory(){
        $data = array();
        $users = new Users();
        $users->setUser();
        $iventory = new Inventory();
        if(isset($_GET['q']) && !empty($_GET['q'])){
            
            $q = addslashes($_GET['q']);
            $inventory_search = $iventory->searchInventoryByName($q, $users->getCompany());
            
            foreach ($inventory_search as $item){
                $data[] = array(
                    'name' => $item['name'],
                    'link'=> BASE_URL.'Inventory/edit/'.$item['id'],
                    'id'  => $item['id'],
                    'price' => $item['price']    
                );
                
            }
            
        }
        
        echo json_encode($data);
    }
    
        public function add_client(){
        $data = array();
        $users = new Users();
        $users->setUser();
        $clients = new Clients();
        
        if(isset($_POST['name']) && !empty($_POST['name'])){
            $name = addslashes($_POST['name']);
            $data['id'] = $clients->add($users->getCompany(), $name);  
        }
        
        
        echo json_encode($data);
    }
    
    public function add_advance(){
        $data = array();
        $users = new Users();
        $users->setUser();
        $clients = new Clients();
        
        if(isset($_POST['advance']) && !empty($_POST['advance'])){
           $id_sale = addslashes($_POST['idSale']); 
           $id_client = addslashes($_POST['idClient']); 
           $advance = addslashes($_POST['advance']);
           $advance = str_replace(".", "", $advance);
           $advance = str_replace(",", ".", $advance);
           
          $clients->addAdvance($users->getCompany(), $id_client, $id_sale, $advance);
            
        }
        
    }
    
    
}
