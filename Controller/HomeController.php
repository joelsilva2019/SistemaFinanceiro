<?php

class HomeController extends Controller {

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
        $data['status_name'] = array(
          0 => 'Aguardando Pagament.',
          1 => 'Pago',
          2 => 'Cancelado'  
            
        );
        
        $sales = new Sales();
        $purchases = new Purchases();
        $data['products_sold'] = $sales->getTotalProductsSold(date("Y-m-d", strtotime("-30days")), date("Y-m-d"), $users->getCompany());
        $data['revenue'] = $sales->getTotalRevenue(date("Y-m-d", strtotime("-30days")), date("Y-m-d"), $users->getCompany());
        $data['expanses'] = $sales->getTotalExpanses(date("Y-m-d", strtotime("-30days")), date("Y-m-d"), $users->getCompany());
        $data['days_list'] = array();     
        for($q=31;$q>0;$q--){
            $data['days_list'][] = date('d/m', strtotime("-".$q." days"));
        }
        $data['revenue_list'] = $sales->getRevenueList(date("Y-m-d", strtotime("-30days")), date("Y-m-d"), $users->getCompany());
        $data['expanses_list'] = $purchases->getExpansesList(date("Y-m-d", strtotime("-30days")), date("Y-m-d"), $users->getCompany());
        $data['status_list'] = $sales->getQuantStatusList(date("Y-m-d", strtotime("-30days")), date("Y-m-d"), $users->getCompany());
        $data['status_purchase_list'] = $purchases->getQuantPurchasesStatus(date("Y-m-d", strtotime("-30days")), date("Y-m-d"), $users->getCompany());
        
        $this->loadTemplate("Home", $data);
    }

}
