<?php

class InvoiceController extends Controller {

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

        if ($users->hasPermission('invoice_view')) {



            $this->loadTemplate('Invoice_notes', $data);
        } else {
            header("Location: " . BASE_URL);
        }
    }

    function invoice_sale($id) {

        if (!empty($id)) {
            $data = array();
            $users = new Users();
            $users->setUser();
            $companies = new Companies($users->getCompany());
            $data['company_name'] = $companies->getName();
            $data['user_image'] = $users->getImage();
            $data['user_email'] = $users->getEmail();

            if ($users->hasPermission('invoice_view')) {
                $sales = new Sales();

                if (isset($_POST['issuer_cnpj']) && !empty($_POST['issuer_cnpj'])) {
                    //INFORMAÇÕES DO REMETENTE DA NOTA 
                    $type_op_nfe = addslashes($_POST['type_op_nfe']);
                    $type_nfe = addslashes($_POST['type_nfe']);
                    $issuer_cnpj = addslashes($_POST['issuer_cnpj']);
                    $issuer_social_reason = addslashes($_POST['issuer_social_reason']);
                    $issuer_trading_name = addslashes($_POST['issuer_trading_name']);
                    $issuer_zipcode = addslashes($_POST['issuer_zipcode']);
                    $issuer_address = addslashes($_POST['issuer_address']);
                    $issuer_number = addslashes($_POST['issuer_number']);
                    $issuer_neighbor = addslashes($_POST['issuer_neighbor']);
                    $issuer_city = addslashes($_POST['issuer_city']);
                    $issuer_state = addslashes($_POST['issuer_state']);
                    $issuer_phone = addslashes($_POST['issuer_phone']);
                    $issuer_email = addslashes($_POST['issuer_email']);
                    $issuer_register = addslashes($_POST['issuer_register']);
                    $crt = addslashes($_POST['issuer_crt']);
                    
                    //INFORMAÇÕES DO DESTINATÁRIO DA NOTA
                    
                    
                }

                $data['sale_info_prods'] = $sales->getInfo($id, $users->getCompany());
                $this->loadTemplate('Invoice', $data);
            } else {
                header("Location: " . BASE_URL);
            }
        }
    }

}
