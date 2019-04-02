<?php

class InvoiceController extends Controller{
    
    public function __construct() {
        $users = new Users();
        if ($users->isLogged() == false) {
            header("Location: " . BASE_URL . "Login");
            exit;
        }
    }
    
    function index(){
        
        $data = array();
        $users = new Users();
        $users->setUser();
        $companies = new Companies($users->getCompany());
        $data['company_name'] = $companies->getName();
        $data['user_image'] = $users->getImage();
        $data['user_email'] = $users->getEmail();

        if ($users->hasPermission('invoice_view')) {
        
            
            $this->loadTemplate('Invoice', $data);
        } else {
            header("Location: ".BASE_URL); 
        }
     
    }
    
    
    
    
}

