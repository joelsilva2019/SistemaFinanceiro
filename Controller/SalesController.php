<?php

class SalesController extends Controller {

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
        $data['status_name'] = array(
          0 => 'Aguardando Pagament.',
          1 => 'Pago',
          2 => 'Cancelado'  
            
        );
        
        $data['status_sale_name'] = array(
          0 => 'Entregue',
          1 => 'A entregar',
          2 => 'A receber'             
        );

        if ($users->hasPermission('sales_view')) {
            $sales = new Sales();
            $offset = 0;
            $data['p'] = 1;
            if(isset($_GET['p']) && !empty($_GET['p'])){
                $data['p'] = intval($_GET['p']);
                if($data['p'] == 0){
                    $data['p'] = 1;
                }
            }
            
            $offset = (10 * ($data['p']-1));
            
            $data['sales_count'] = $sales->getCount($users->getCompany());
            $data['p_count'] = ceil($data['sales_count']/10);
            $data['sales_edit'] = $users->hasPermission('sales_edit');
            $data['sales_list'] = $sales->getList($offset,$users->getCompany());
            $this->loadTemplate("Sales", $data);
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

        if ($users->hasPermission('sales_edit')) {
            $sales = new Sales();
            
            if(isset($_POST['client_id']) && !empty($_POST['client_id'])){
                $id_client = addslashes($_POST['client_id']);
                $status = addslashes($_POST['status']);
                $status_sale = addslashes($_POST['status_sale']);
                $quant = $_POST['quant'];
               
                
                $sales->add($users->getCompany(), $id_client, $users->getId(), $quant, $status, $status_sale);
                header("Location: ".BASE_URL."Sales");
                
            }
         
            $this->loadTemplate("Sales_add", $data);
        } else {
            header("Location: " . BASE_URL);
        }
     }
        
        function edit($id) {
         
        $data = array();
        $users = new Users();
        $users->setUser();
        $sales = new Sales();
        $data['sales_ids'] = $sales->getIds($users->getCompany());
        if(in_array($id, $data['sales_ids'])){
        $companies = new Companies($users->getCompany());
        $data['company_name'] = $companies->getName();
        $data['user_image'] = $users->getImage();
        $data['user_email'] = $users->getEmail();
        $data['status_name'] = array(
          0 => 'Aguardando Pagament.',
          1 => 'Pago',
          2 => 'Cancelado'  
            
        );
        
        $data['status_sale_name'] = array(
          0 => 'Entregue',
          1 => 'A entregar',
          2 => 'A receber'             
        );

        if ($users->hasPermission('sales_edit')) {
            $clients = new Clients();
            $data['sales_edit'] = $users->hasPermission('sales_edit');
            
            if(isset($_POST['status']) && $data['sales_edit'] == true){
          
                $status = addslashes($_POST['status']);
                $status_sale = addslashes($_POST['status_sale']); 
                
                $sales->changeStatus($status,$status_sale, $id,$users->getCompany());
                header("Location: ".BASE_URL."Sales");
                
            }
            $data['advance_total'] = $clients->getTotalAdvance($id, $users->getCompany());
            $data['advance_info'] = $clients->getAdvance($id, $users->getCompany());
            $data['sales_info'] = $sales->getInfo($id, $users->getCompany());
            $this->loadTemplate("Sales_edit", $data);
        } else {
            header("Location: " . BASE_URL);
        }
       } else {
           header("Location: " . BASE_URL);
       } 
    
    }
    
    public function sales_client($id){
        
        $data = [];
        $users = new Users();
        $users->setUser();
        $sales = new Sales();
        $data['sales_ids'] = $sales->getIdClient($users->getCompany());
        if(in_array($id, $data['sales_ids'])){
        $companies = new Companies($users->getCompany());
        $data['company_name'] = $companies->getName();
        $data['user_image'] = $users->getImage();
        $data['user_email'] = $users->getEmail();    
            
        
        $data['status_name'] = array(
          0 => 'Aguardando Pagament.',
          1 => 'Pago',
          2 => 'Cancelado'  
            
        );
        
        $data['status_sale_name'] = array(
          0 => 'Entregue',
          1 => 'A entregar',
          2 => 'A receber'             
        );    
            
         if($users->hasPermission('sales_view')){   
        
           $data['sales_edit'] = $users->hasPermission('sales_edit');  
           $data['sales_client'] = $sales->getSalesClient($id, $users->getCompany());  
           $this->loadTemplate('Sales_client', $data);
         } else {
             header("Location: ".BASE_URL);
         }
        
       } else {
            header("Location: ".BASE_URL); 
        }
    }
        
}