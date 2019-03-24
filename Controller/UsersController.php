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
        $data['user_image'] = $users->getImage();

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
        $data['user_image'] = $users->getImage();
        $data['user_email'] = $users->getEmail();

        if ($users->hasPermission('users_view')) {
            $permissions = new Permissions();
            
            if(isset($_POST['email']) && !empty($_POST['email'])){
                
                $email = addslashes($_POST['email']);
                $pass = addslashes($_POST['password']);
                $groups = addslashes($_POST['groups']);
                                
                $e = $users->add($email, $pass, $groups, $users->getCompany());
                if($e == '1'){
                  //user insert image  
                  if (isset($_FILES['image']) && !empty($_FILES['image']['tmp_name'])) {
                        $permitidos = ['image/jpg', 'image/jpeg', 'image/png'];
                        if (in_array($_FILES['image']['type'], $permitidos)) {
                            $md5Name = md5(time() . rand(0, 9999));
                        }
                        
                        $extension = explode("/", $_FILES['image']['type']);
                        $extension = end($extension);


                        move_uploaded_file($_FILES['image']['tmp_name'], "Assets/images/users/" . $md5Name . "." . $extension);
                        $md5Name = $md5Name . "." . $extension;
                        $users->updateImg($users->getCompany(),$users->getIdInsert(),$md5Name);
                    }

                    header("Location: " . BASE_URL . "Users");
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
    
     function edit($id = null) { 
        $data = array();
        $users = new Users();
        $users->setUser();
        $data['user_ids'] = $users->getIds($users->getCompany());
        if(in_array($id, $data['user_ids'])){
        
        $companies = new Companies($users->getCompany());
        $data['company_name'] = $companies->getName();
        $data['user_image'] = $users->getImage();
        $data['user_email'] = $users->getEmail();

        if ($users->hasPermission('users_view')) {
            $permissions = new Permissions();
            
            if(isset($_POST['groups']) && !empty($_POST['groups'])){
  
                $pass = addslashes($_POST['password']);
                $groups = addslashes($_POST['groups']);
                
                $users->edit($pass, $groups, $id, $users->getCompany());
                
                //user insert image  
                if (isset($_FILES['image']) && !empty($_FILES['image']['tmp_name'])) {
                    $permitidos = ['image/jpg', 'image/jpeg', 'image/png'];
                    if (in_array($_FILES['image']['type'], $permitidos)) {
                        $md5Name = md5(time() . rand(0, 9999));
                    }

                    $extension = explode("/", $_FILES['image']['type']);
                    $extension = end($extension);


                    move_uploaded_file($_FILES['image']['tmp_name'], "Assets/images/users/" . $md5Name . "." . $extension);
                    $md5Name = $md5Name . "." . $extension;
                    $users->updateImg($users->getCompany(), $id, $md5Name);
                }

                header("Location: ".BASE_URL."Users");
            }
            $data['user_info'] = $users->getInfo($id, $users->getCompany());
            $data['group_list'] = $permissions->getListGroup($users->getCompany());
            $this->loadTemplate("Users_edit", $data);
        } else {
            header("Location: " . BASE_URL);
        }
       } else {
           header("Location: " . BASE_URL);
       }
    }
    
    function delete($id) {
        $data = array();
        $users = new Users();
        $users->setUser();
        $data['user_ids'] = $users->getIds($users->getCompany());
        if(in_array($id, $data['user_ids'])){
        $companies = new Companies($users->getCompany());
        $data['company_name'] = $companies->getName();
        $data['user_email'] = $users->getEmail();

        if ($users->hasPermission('users_view')) {
            
            $users->del($id, $users->getCompany());
            header("Location: " . BASE_URL . "Users");
            
        } else {
            header("Location: " . BASE_URL);
        }
      } else {
          header("Location: " . BASE_URL);
      }
    }

}