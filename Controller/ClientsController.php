<?php
class ClientsController extends Controller {

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

        if ($users->hasPermission('clients_view')) {
            $clients = new Clients();
            $offset = 0;
            $data['p'] = 1;
            if(isset($_GET['p']) && !empty($_GET['p'])){
                $data['p'] = intval($_GET['p']);
                if($data['p'] == 0){
                    $data['p'] = 1;
                }
            }
            
            $offset = (10 * ($data['p']-1));
            
            $data['clients_list'] = $clients->getList($offset, $users->getCompany());
            $data['clients_count'] = $clients->getCount($users->getCompany());
            $data['p_count'] = ceil($data['clients_count']/10);
            $data['clients_edit'] = $users->hasPermission('clients_edit');
            $this->loadTemplate("Clients", $data);
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

        if ($users->hasPermission('clients_edit')) {
            $clients = new Clients();
            
            if(isset($_POST['name']) && !empty($_POST['name'])){
                
                $name = addslashes($_POST['name']);
                $email = addslashes($_POST['email']);
                $phone = addslashes($_POST['phone']);
                $stars = addslashes($_POST['stars']);
                $internal_obs = addslashes($_POST['internal_obs']);
                $address_zipcode = addslashes($_POST['address_zipcode']);
                $address = addslashes($_POST['address']);
                $address_number = addslashes($_POST['address_number']);
                $address2 = addslashes($_POST['address2']);
                $address_neighb = addslashes($_POST['address_neighb']);
                $address_city = addslashes($_POST['address_city']);
                $address_state = addslashes($_POST['address_state']);
                $address_country = addslashes($_POST['address_country']);
                
                $clients->add($users->getCompany(), $name, $email, $phone, $stars, $internal_obs, 
                        $address_zipcode, $address, $address_number, $address2, $address_neighb, $address_city,
                        $address_state, $address_country);
                header("Location: ".BASE_URL."Clients");
                
            }
            
            $this->loadTemplate("Clients_add", $data);
        } else {
            header("Location: " . BASE_URL);
        }
    }
    
     function edit($id) {
         
        $data = array();
        $users = new Users();
        $users->setUser();
        $clients = new Clients();
        $data['clients_id'] = $clients->getIds($users->getCompany());
        if(in_array($id, $data['clients_id'])){
            
        
        $companies = new Companies($users->getCompany());
        $data['company_name'] = $companies->getName();
        $data['user_email'] = $users->getEmail();
        $data['user_image'] = $users->getImage();

        if ($users->hasPermission('clients_edit')) {
            
            if(isset($_POST['name']) && !empty($_POST['name'])){
                
                $name = addslashes($_POST['name']);
                $email = addslashes($_POST['email']);
                $phone = addslashes($_POST['phone']);
                $stars = addslashes($_POST['stars']);
                $internal_obs = addslashes($_POST['internal_obs']);
                $address_zipcode = addslashes($_POST['address_zipcode']);
                $address = addslashes($_POST['address']);
                $address_number = addslashes($_POST['address_number']);
                $address2 = addslashes($_POST['address2']);
                $address_neighb = addslashes($_POST['address_neighb']);
                $address_city = addslashes($_POST['address_city']);
                $address_state = addslashes($_POST['address_state']);
                $address_country = addslashes($_POST['address_country']);
                
                $clients->edit($id, $users->getCompany(), $name, $email, $phone, $stars, $internal_obs, 
                        $address_zipcode, $address, $address_number, $address2, $address_neighb, $address_city,
                        $address_state, $address_country);
                header("Location: ".BASE_URL."Clients");
                
            }
            $data['client_info'] = $clients->getClient($id, $users->getCompany());
            $this->loadTemplate("Clients_edit", $data);
        } else {
            header("Location: " . BASE_URL);
        }
        } else {
            header("Location: " . BASE_URL);
        }
    }
    
    public function delete($id){
        $data = array();
        $users = new Users();
        $users->setUser();
        $clients = new Clients();
        $data['clients_id'] = $clients->getIds($users->getCompany());
        if(in_array($id, $data['clients_id'])){

        if ($users->hasPermission('clients_edit')) {          
            $clients->delete($id, $users->getCompany());
            header('Location: '.BASE_URL."Clients");
        } else {
            header("Location: " . BASE_URL);
        }
        } else {
            header("Location: " . BASE_URL);
        }
    }
    
    public function view($id){
        
        $data = array();
        $users = new Users();
        $users->setUser();
        $clients = new Clients();
        $data['clients_id'] = $clients->getIds($users->getCompany());
        if(in_array($id, $data['clients_id'])){
            
        $companies = new Companies($users->getCompany());
        $data['company_name'] = $companies->getName();
        $data['user_image'] = $users->getImage();
        $data['user_email'] = $users->getEmail();

        if ($users->hasPermission('clients_view')) {
            $data['client_info'] = $clients->getClient($id,$users->getCompany());
            $this->loadTemplate("Clients_view", $data);
        } else {
            header("Location: " . BASE_URL);
        }
        } else {
            header("Location: " . BASE_URL);
        }
    }
    
    
}