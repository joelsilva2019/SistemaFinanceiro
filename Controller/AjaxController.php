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
                    'price' => $item['price'],   
                    'price_purchase' => $item['price_purchase']     
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
    
    public function getAdvances(){
        $data = array();
        $users = new Users();
        $users->setUser();
        $clients = new Clients();
        
        if(isset($_POST['id']) && !empty('id')){
            $id_sale = addslashes($_POST['id']);
            $data['advances'] = $clients->getAdvance($id_sale, $users->getCompany()); 
        }
            
          echo json_encode($data);
    }
    
    function search_sales(){
        $data = array();
        $users = new Users();
        $users->setUser();
        $sales = new Sales();
        if(isset($_GET['q']) && !empty($_GET['q'])){
            
            $q = addslashes($_GET['q']);
            $sales_search = $sales->searchSalesByName($q, $users->getCompany());
            
            foreach ($sales_search as $sitem){
                $data[] = array(
                    'name' => $sitem['name'],
                    'link' => BASE_URL.'Sales/sales_client/'.$sitem['id_client'],
                    'id'   => $sitem['id']    
                );
                
            }
            
        }
        
        echo json_encode($data);
    }
    
    function search_purchases(){
        $data = array();
        $users = new Users();
        $users->setUser();
        $purchases = new Purchases();
        if(isset($_GET['q']) && !empty($_GET['q'])){
            
            $q = addslashes($_GET['q']);
            $purchases_search = $purchases->searchPurchasesByName($q, $users->getCompany());
            
            foreach ($purchases_search as $pitem){
                $data[] = array(
                    'name' => $pitem['salesman'],
                    'link' => BASE_URL.'Purchases/purchases_salesman/'.$pitem['salesman'],
                    'id'   => $pitem['id']    
                );
                
            }
            
        }
        
        echo json_encode($data);
    }
    
    
}
