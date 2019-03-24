<?php

class InventoryController extends Controller {
 
    public function __construct() {
        $users = new Users();
        if ($users->isLogged() == false) {
            header("Location: " . BASE_URL . "Login");
            exit;
        }
    }

    function index() {
        
        $data = array();
        $users = new Users();
        $users->setUser();
        $companies = new Companies($users->getCompany());
        $data['company_name'] = $companies->getName();
        $data['user_image'] = $users->getImage();
        $data['user_email'] = $users->getEmail();

        if ($users->hasPermission('inventory_view')){
    
            $inventory = new Inventory();
            $offset = 0;
            $data['p'] = 1;
            if(isset($_GET['p']) && !empty($_GET['p'])){
                $data['p'] = intval($_GET['p']);
                if($data['p'] == 0){
                    $data['p'] = 1;
                }
            }
            
            $offset = (10 * ($data['p']-1));
            
            $data['inventory_list'] = $inventory->getList($offset,$users->getCompany());
            $data['inventory_count'] = $inventory->getCount($users->getCompany());
            $data['p_count'] = ceil($data['inventory_count']/10);
            $data['inventory_add'] = $users->hasPermission('inventory_add');
            $data['inventory_edit'] = $users->hasPermission('inventory_edit');
            
            $this->loadTemplate('Inventory', $data); 
        } else {
            header("Location: " . BASE_URL);
        }
   }
   
   function add() {
        
        $data = array();
        $users = new Users();
        $users->setUser();
        $companies = new Companies($users->getCompany());
        $data['company_name'] = $companies->getName();
        $data['user_image'] = $users->getImage();
        $data['user_email'] = $users->getEmail();

        if ($users->hasPermission('inventory_add')){
    
            $category = new Category();
            $inventory = new Inventory();
            
            
            if(isset($_POST['name']) && !empty($_POST['name'])){
                $name = addslashes($_POST['name']);                
                $quant = addslashes($_POST['quant']);
                $min_quant = addslashes($_POST['min_quant']);
                //FORMATANDO PREÇO DE COMPRA
                $price_purchase = addslashes($_POST['price_purchase']);
                $price_purchase = str_replace(".", "", $price_purchase);
                $price_purchase = str_replace(",", ".", $price_purchase);
                //FORMATANDO PREÇO DE VENDA
                $price = addslashes($_POST['price']);
                $price = str_replace(".", "", $price);
                $price = str_replace(",", ".", $price);
                
                $id_category = addslashes($_POST['category']);
                
                $inventory->add($users->getCompany(),$id_category, $users->getId(), $name, $price, $price_purchase, $quant, $min_quant);
                header("Location: ".BASE_URL."Inventory");
            }
            
            $data['category_list'] = $category->getList($users->getCompany());
            $this->loadTemplate('Inventory_add', $data); 
        } else {
            header("Location: " . BASE_URL);
        }
   }
   
    function edit($id) {
        
        $data = array();
        $users = new Users();
        $users->setUser();
        $inventory = new Inventory();
        $data['inventory_id'] = $inventory->getIds($users->getCompany());
        if(in_array($id, $data['inventory_id'])){
            
            
        $companies = new Companies($users->getCompany());
        $data['company_name'] = $companies->getName();
        $data['user_image'] = $users->getImage();
        $data['user_email'] = $users->getEmail();

        if ($users->hasPermission('inventory_add')){
            $category = new Category();          
            if(isset($_POST['name']) && !empty($_POST['name'])){
                $name = addslashes($_POST['name']);
                $quant = addslashes($_POST['quant']);
                $min_quant = addslashes($_POST['min_quant']);
                
                $price = addslashes($_POST['price']);
                $price = str_replace(".", "", $price);
                $price = str_replace(",", ".", $price);
                
                $price_purchase = addslashes($_POST['price_purchase']);
                $price_purchase = str_replace(".", "", $price_purchase);
                $price_purchase = str_replace(",", ".", $price_purchase);
                
                $id_category = addslashes($_POST['category']);
                
                $inventory->edit($id,$users->getCompany(),$id_category, $users->getId(), $name, $price, $price_purchase, $quant, $min_quant);
                header("Location: ".BASE_URL."Inventory");
            }
            $data['category_list'] = $category->getList($users->getCompany());
            $data['inventory_info'] = $inventory->getInfo($id, $users->getCompany());
            $this->loadTemplate('Inventory_edit', $data); 
        } else {
            header("Location: " . BASE_URL);
        }
        } else {
           header("Location: " . BASE_URL); 
        }
   }
   
   public function delete($id){
       $users = new Users();
       $users->setUser();
       $inventory = new Inventory();
       $data['inventory_id'] = $inventory->getIds($users->getCompany());
       if(in_array($id, $data['inventory_id'])){
            
        
       if($users->hasPermission('inventory_edit')){
           $inventory->del($id, $users->getCompany(), $users->getId());
           header("Location: ".BASE_URL."Inventory");
       }
   }else {
       header("Location: ".BASE_URL);
   }
   
}

}