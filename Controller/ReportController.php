<?php

class ReportController extends Controller{
      
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

        if ($users->hasPermission('report_view')) {
            $this->loadTemplate("Report", $data);
        } else {
            header("Location: " . BASE_URL);
        }
        
    }
    
    public function sales(){
        
        $data = array();
        $users = new Users();
        $users->setUser();
        $companies = new Companies($users->getCompany());
        $data['company_name'] = $companies->getName();
        $data['user_email'] = $users->getEmail();
        $data['status_name'] = array(
          0 => 'Aguardando Pagament.',
          1 => 'Pago',
          2 => 'Cancelado'  
            
        );

        if ($users->hasPermission('report_view')) {
            

            $this->loadTemplate("Report_sale", $data);
        } else {
            header("Location: " . BASE_URL);
        }
    }
    
    public function sales_pdf(){
        
        $data = array();
        $users = new Users();
        $users->setUser();
        $data['status_name'] = array(
          0 => 'Aguardando Pagament.',
          1 => 'Pago',
          2 => 'Cancelado'  
            
        );

        if ($users->hasPermission('report_view')) {
            
            $sales = new Sales();
            $client_name = addslashes($_GET['client_name']);
            $period1 = addslashes($_GET['datep1']);
            $period2 = addslashes($_GET['datep2']);
            $status = addslashes($_GET['status']);
            $order = addslashes($_GET['order']);
            
            $data['sales_list'] = $sales->getSalesFiltered($users->getCompany(), $client_name, $period1, $period2, $status, $order);
            $data['filters'] = $_GET;
            
            ob_start();
            $this->loadView("Report_sale_pdf", $data);
            $html = ob_get_contents();
            ob_end_clean();
            
            
            $mpdf = new \Mpdf\Mpdf();
            $mpdf->WriteHTML($html);
            $mpdf->Output();
 
        } else {
            header("Location: " . BASE_URL);
        }
    }
    
    public function purchases(){
        
        $data = array();
        $users = new Users();
        $users->setUser();
        $companies = new Companies($users->getCompany());
        $data['company_name'] = $companies->getName();
        $data['user_email'] = $users->getEmail();
        $data['status_name'] = array(
          0 => 'Aguardando Pagament.',
          1 => 'Pago',
          2 => 'Cancelado'  
            
        );

        if ($users->hasPermission('report_view')) {
            

            $this->loadTemplate("Report_purchase", $data);
        } else {
            header("Location: " . BASE_URL);
        }
    }
    
    public function purchases_pdf(){
        
        $data = array();
        $users = new Users();
        $users->setUser();
        $data['status_name'] = array(
          0 => 'Aguardando Pagament.',
          1 => 'Pago',
          2 => 'Cancelado'  
            
        );

        if ($users->hasPermission('report_view')) {
            
            $purchases = new Purchases();
            
            $salesman_name = addslashes($_GET['salesman_name']);
            $period1 = addslashes($_GET['datep1']);
            $period2 = addslashes($_GET['datep2']);
            $status = addslashes($_GET['status']);
            $order = addslashes($_GET['order']);
            
            $data['purchases_list'] = $purchases->getPurchasesFiltered($users->getCompany(), $salesman_name, $period1, $period2, $status, $order);
            $data['filters'] = $_GET;
            
            ob_start();
            $this->loadView("Report_purchase_pdf", $data);
            $html = ob_get_contents();
            ob_end_clean();
            
            
            $mpdf = new \Mpdf\Mpdf();
            $mpdf->WriteHTML($html);
            $mpdf->Output();
 
        } else {
            header("Location: " . BASE_URL);
        }
    }
    
    public function inventory(){
        
        $data = array();
        $users = new Users();
        $users->setUser();
        $companies = new Companies($users->getCompany());
        $data['company_name'] = $companies->getName();
        $data['user_email'] = $users->getEmail();
        if ($users->hasPermission('report_view')) {
            $category = new Category();

            $data['category_list'] = $category->getList($users->getCompany());
            $this->loadTemplate("Report_inventory", $data);
        } else {
            header("Location: " . BASE_URL);
        }
    }
    
    public function inventory_pdf(){
        
        $data = array();
        $users = new Users();
        $users->setUser();

        if ($users->hasPermission('report_view')) {
            
            $inventory = new Inventory();
            
            if(isset($_GET['category'])){
                $id_category = addslashes($_GET['category']);
                $data['inventory_list'] = $inventory->getInventoryFiltered($users->getCompany(), $id_category);  
            }
            
            
            $data['filters'] = $_GET;
            
            ob_start();
            $this->loadView("Report_inventory_pdf", $data);
            $html = ob_get_contents();
            ob_end_clean();
            
            
            $mpdf = new \Mpdf\Mpdf();
            $mpdf->WriteHTML($html);
            $mpdf->Output();
 
        } else {
            header("Location: " . BASE_URL);
        }
    }
 
}
