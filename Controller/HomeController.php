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
        $inventory = new Inventory();
        $companies = new Companies($users->getCompany());
        $data['company_name'] = $companies->getName();
        $data['history_inventory_count'] = $inventory->getHistoryCount(date("Y-m-d", strtotime("-7days")), date("Y-m-d"), $users->getCompany());
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
    
    public function history() {
        $data = array();
        $users = new Users();
        $users->setUser();
        $companies = new Companies($users->getCompany());
        $data['company_name'] = $companies->getName();
        $data['history_actions'] = array(
            'add' => 'Adicionado',
            'del' => 'Deletado',
            'edt' => 'Editado',
            'upe' => 'Atualizado',
            'dcs' => 'Baixado no estoque'
        );
        $inventory = new Inventory();

        $offset = 0;
        $data['p'] = 1;
        if (isset($_GET['p']) && !empty($_GET['p'])) {
            $data['p'] = intval($_GET['p']);
            if ($data['p'] == 0) {
                $data['p'] = 1;
            }
        }

        $offset = (10 * ($data['p'] - 1));

        $data['history_list'] = $inventory->getHistory(date("Y-m-d", strtotime("-7days")), date("Y-m-d"), $users->getCompany(), $offset);
        $data['history_count'] = $inventory->getHistoryCount(date("Y-m-d", strtotime("-7days")), date("Y-m-d"), $users->getCompany());
        $data['p_count'] = ceil($data['history_count'] / 10);


        
        $this->loadTemplate('History', $data);
    }

}
