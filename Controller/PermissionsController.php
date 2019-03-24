<?php

class PermissionsController extends Controller {

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
        if ($users->hasPermission('permissions_view')) {
            $permissions = new Permissions();
            $data['permissions_list'] = $permissions->getList($users->getCompany());
            $data['permissions_list_group'] = $permissions->getListGroup($users->getCompany());  
            $this->loadTemplate("Permissions", $data);
        } else {
            header("Location: " . BASE_URL);
        }
    }

    public function add() {
        $data = array();
        $users = new Users();
        $users->setUser();
        $companies = new Companies($users->getCompany());
        $data['company_name'] = $companies->getName();
        $data['user_image'] = $users->getImage();
        $data['user_email'] = $users->getEmail();

        if ($users->hasPermission('permissions_edit')) {

            $permissions = new Permissions();
            //usuario adicionou uma nova permissão.
            if (isset($_POST['permission']) && !empty($_POST['permission'])) {
                $permission = addslashes($_POST['permission']);
                $permissions->add($permission, $users->getCompany());
                header("Location: " . BASE_URL . "Permissions");
            }
            $this->loadTemplate("Permissions_add", $data);
        } else {
            header("Location: " . BASE_URL);
        }
    }
    
    public function addGroup(){
        $data = array();
        $users = new Users();
        $users->setUser();
        $companies = new Companies($users->getCompany());
        $data['company_name'] = $companies->getName();
        $data['user_image'] = $users->getImage();
        $data['user_email'] = $users->getEmail();

        if ($users->hasPermission('permissions_edit')) {

            $permissions = new Permissions();
            $data['permissions_list'] = $permissions->getList($users->getCompany());
            //usuario adicionou uma nova permissão.
            if (isset($_POST['group']) && !empty($_POST['group'])) {
                $group = addslashes($_POST['group']);
                $plist = $_POST['permissions'];
                $permissions->addGroup($group,$plist, $users->getCompany());
                header("Location: " . BASE_URL . "Permissions");
            }
            $this->loadTemplate("Permissions_add_group", $data);
        } else {
            header("Location: " . BASE_URL);
        }
             
    }
    

    public function delete($id) {
        
        $data = array();
        $users = new Users();
        $users->setUser();
        $permissions = new Permissions();
        $data['permissions_id'] = $permissions->getIds($users->getCompany());
        if(in_array($id, $data['permissions_id'])){
        $companies = new Companies($users->getCompany());
        $data['company_name'] = $companies->getName();
        $data['user_image'] = $users->getImage();
        $data['user_email'] = $users->getEmail();

        if ($users->hasPermission('permissions_edit')) {

            
            //usuario deletou uma permissão.
            $permissions->del($id);
            header("Location: " . BASE_URL . "Permissions");    
        } else {
            header("Location: " . BASE_URL);
        }
       } else {
           header("Location: " . BASE_URL); 
       }
    }
    
    public function deleteGroup($id){
        
        $data = array();
        $users = new Users();
        $users->setUser();
        $permissions = new Permissions();
        
        $data['permissions_groups_id'] = $permissions->getIdsGroups($users->getCompany());
        if(in_array($id, $data['permissions_groups_id'])){
            
        
        $companies = new Companies($users->getCompany());
        $data['company_name'] = $companies->getName();
        $data['user_image'] = $users->getImage();
        $data['user_email'] = $users->getEmail();

        if ($users->hasPermission('permissions_edit')) {
            //usuario deletou uma permissão.
            $permissions->delGroup($id);
            header("Location: " . BASE_URL . "Permissions");    
        } else {
            header("Location: " . BASE_URL);
        }
      } else {
           header("Location: " . BASE_URL);
      }
    }
   
     public function editGroup($id = null){
        $data = array();
        $users = new Users();
        $users->setUser();
        $permissions = new Permissions();
        $data['permissions_groups_id'] = $permissions->getIdsGroups($users->getCompany());
        if(in_array($id, $data['permissions_groups_id'])){
            
        
        $companies = new Companies($users->getCompany());
        $data['company_name'] = $companies->getName();
        $data['user_image'] = $users->getImage();
        $data['user_email'] = $users->getEmail();

        if ($users->hasPermission('permissions_view')) {
            //usuario adicionou uma nova permissão.
            if (isset($_POST['group']) && !empty($_POST['group'])) {
                
                $group = addslashes($_POST['group']);
                $plist = $_POST['permissions'];
                $permissions->editGroup($group,$plist,$id,$users->getCompany());
                header("Location: " . BASE_URL . "Permissions");
                
            }
            
            $data['permissions_list'] = $permissions->getList($users->getCompany());
            $data['info_group'] = $permissions->getGroup($id, $users->getCompany());
            $this->loadTemplate("Permissions_edit_group", $data);
        } else {
            header("Location: " . BASE_URL);
        }
        
        } else {
            header("Location: " . BASE_URL);
        }
             
      }
   

}
