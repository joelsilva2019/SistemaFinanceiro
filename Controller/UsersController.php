<?php

class UsersController extends Controller {

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

        if ($users->hasPermission('users_view')) {
            $data['user_list'] = $users->getList($users->getCompany());
            
            $this->loadTemplate("Users", $data);
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
        $data['user_email'] = $users->getEmail();

        if ($users->hasPermission('users_view')) {
            $permissions = new Permissions();
            
            if(isset($_POST['email']) && !empty($_POST['email'])){
                
                $email = addslashes($_POST['email']);
                $pass = addslashes($_POST['password']);
                $groups = addslashes($_POST['groups']);
                
                $e = $users->add($email, $pass, $groups, $users->getCompany());
                if($e == '1'){
                  header("Location: ".BASE_URL."Users");
                } else {
                  $data['erro_msg'] = "Esse usuário ja esta cadastrado!";  
                }
            }
            
            $data['group_list'] = $permissions->getListGroup($users->getCompany());
            $this->loadTemplate("Users_add", $data);
        } else {
            header("Location: " . BASE_URL);
        }
    }
    
     function edit($id) {
        $data = array();
        $users = new Users();
        $users->setUser();
        $companies = new Companies($users->getCompany());
        $data['company_name'] = $companies->getName();
        $data['user_email'] = $users->getEmail();

        if ($users->hasPermission('users_view')) {
            $permissions = new Permissions();
            
            if(isset($_POST['groups']) && !empty($_POST['groups'])){
  
                $pass = addslashes($_POST['password']);
                $groups = addslashes($_POST['groups']);
                
                $users->edit($pass, $groups, $id, $users->getCompany());
                
                header("Location: ".BASE_URL."Users");
            }
            $data['user_info'] = $users->getInfo($id, $users->getCompany());
            $data['group_list'] = $permissions->getListGroup($users->getCompany());
            $this->loadTemplate("Users_edit", $data);
        } else {
            header("Location: " . BASE_URL);
        }
    }
    
    function delete($id) {
        $data = array();
        $users = new Users();
        $users->setUser();
        $companies = new Companies($users->getCompany());
        $data['company_name'] = $companies->getName();
        $data['user_email'] = $users->getEmail();

        if ($users->hasPermission('users_view')) {
            
            $users->del($id, $users->getCompany());
            header("Location: " . BASE_URL . "Users");
            
        } else {
            header("Location: " . BASE_URL);
        }
    }

}