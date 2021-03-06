<?php

class PurchasesController extends Controller {

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
        $data['user_email'] = $users->getEmail();
        $data['user_image'] = $users->getImage();
        $data['status_name'] = array(
          0 => 'Aguardando Pagament.',
          1 => 'Pago',
          2 => 'Cancelado'  
            
        );
        
        if ($users->hasPermission('purchases_view')) {
            $purchases = new Purchases();
            $offset = 0;
            $data['p'] = 1;
            if(isset($_GET['p']) && !empty($_GET['p'])){
                $data['p'] = intval($_GET['p']);
                if($data['p'] == 0){
                    $data['p'] = 1;
                }
            }
            
            $offset = (10 * ($data['p']-1));
            
            $data['purchases_count'] = $purchases->getCount($users->getCompany());
            $data['p_count'] = ceil($data['purchases_count']/10);
            $data['purchases_edit'] = $users->hasPermission('purchases_edit');
            $data['purchases_list'] = $purchases->getList($offset,$users->getCompany());
            $this->loadTemplate("Purchases", $data);
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

        if ($users->hasPermission('purchases_edit')) {
            $purchases = new Purchases();
            
            if(isset($_POST['salesman']) && !empty($_POST['salesman'])){
                
                $status = addslashes($_POST['status']);
                if(isset($_POST['quant'])){
                   $quant = $_POST['quant'];
                } else {
                   $quant = 0;
                }
                $salesman = addslashes($_POST['salesman']);
                
                $countArray = (is_array($quant) ? count($quant) : 0);
                if($countArray > 0){
                $purchases->add($users->getCompany(),$users->getId(),$salesman, $quant, $status);
                header("Location: ".BASE_URL."Purchases");
                } else {
                  $data['erro'] = "Você não pode adicionar uma venda sem produtos !!";  
                }
                
            }
                
            
         
            $this->loadTemplate("Purchases_add", $data);
        } else {
            header("Location: " . BASE_URL);
        }
     }
     
     function edit($id) {
         
        $data = array();
        $users = new Users();
        $users->setUser();
        $purchases = new Purchases();
        $data['purchases_id'] = $purchases->getIds($users->getCompany());
        if(in_array($id, $data['purchases_id'])){
            
        
        $companies = new Companies($users->getCompany());
        $data['company_name'] = $companies->getName();
        $data['user_email'] = $users->getEmail();
        $data['user_image'] = $users->getImage();
        $data['status_name'] = array(
          0 => 'Aguardando Pagament.',
          1 => 'Pago',
          2 => 'Cancelado'    
        );
        
        if ($users->hasPermission('purchases_edit')) {
            $data['purchases_edit'] = $users->hasPermission('purchases_edit');
            
            if(isset($_POST['status']) && $data['purchases_edit'] == true){
                $status = addslashes($_POST['status']);
                $quant = $_POST['quant'];
                
                $purchases->edit($status, $quant, $id,$users->getCompany());
                header("Location: ".BASE_URL."Purchases");
                
            }
            
            $data['purchase_info'] = $purchases->getInfo($id, $users->getCompany());
            $this->loadTemplate("Purchases_edit", $data);
        } else {
            header("Location: " . BASE_URL);
        }
     } else {
            header("Location: " . BASE_URL);
       }
   }
   
   public function purchases_salesman($salesman){
        
        $data = [];
        $users = new Users();
        $users->setUser();
        $purchases = new Purchases();
        $data['purchases_salesman'] = $purchases->getSalesman($users->getCompany());
        if(in_array($salesman, $data['purchases_salesman'])){
        $companies = new Companies($users->getCompany());
        $data['company_name'] = $companies->getName();
        $data['user_image'] = $users->getImage();
        $data['user_email'] = $users->getEmail();    
            
        $data['status_name'] = array(
          0 => 'Aguardando Pagament.',
          1 => 'Pago',
          2 => 'Cancelado'  
            
        );   
            
         if($users->hasPermission('purchases_view')){   
        
             $offset = 0;
            $data['p'] = 1;
            if(isset($_GET['p']) && !empty($_GET['p'])){
                $data['p'] = intval($_GET['p']);
                if($data['p'] == 0){
                    $data['p'] = 1;
                }
            }
            
            $offset = (10 * ($data['p']-1));
            
           $data['purchases_salesman_count'] = $purchases->getCountPurchasesSalesman($salesman, $users->getCompany());
           $data['p_count'] = ceil($data['purchases_salesman_count']/10);
             
             
           $data['salesman'] = $salesman;  
           $data['purchases_edit'] = $users->hasPermission('purchases_edit');  
           $data['purchases_salesman'] = $purchases->getPurchasesSalesman($salesman, $users->getCompany(), $offset);  
           $this->loadTemplate('Purchases_salesman', $data);
         } else {
             header("Location: ".BASE_URL);
         }
        
       } else {
            header("Location: ".BASE_URL); 
        }
    }
    
    public function delete_prod($id_prod, $id_purchase){
        
        $users = new Users();
        $users->setUser();
        
        if(!empty($id_prod)){
         $purchases = new Purchases();
         $purchases->delete($id_prod, $id_purchase, $users->getCompany());
         header("Location: ".BASE_URL."Purchases/edit/".$id_purchase);
        } else {
          header("Location: ".BASE_URL);  
        }
    }
}