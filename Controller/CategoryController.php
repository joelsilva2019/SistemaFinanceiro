<?php


class CategoryController extends Controller {

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

        if ($users->hasPermission('category_view')) {
            $category = new Category();
            
            $data['category_list'] = $category->getList($users->getCompany());
            $data['category_add'] = $users->hasPermission('category_add');
            $data['category_edit'] = $users->hasPermission('category_edit');
            $this->loadTemplate("Category", $data);
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

        if ($users->hasPermission('category_add')) {
            $category = new Category();
            
            if(isset($_POST['category']) && !empty($_POST['category'])){
               $name = addslashes($_POST['category']);
               
               $category->add($name, $users->getCompany());
               header("Location: ".BASE_URL."Category");
            }
         
            $this->loadTemplate("Category_add", $data);
        }
    }
    
    function edit($id) {
        
        $data = array();
        $users = new Users();
        $users->setUser();
        $category = new Category();
        $data['category_id'] = $category->getIds($users->getCompany());
        if(in_array($id, $data['category_id'])){
        
        $companies = new Companies($users->getCompany());
        $data['company_name'] = $companies->getName();
        $data['user_image'] = $users->getImage();
        $data['user_email'] = $users->getEmail();

        if ($users->hasPermission('category_add')) {
            if(isset($_POST['category']) && !empty($_POST['category'])){
               $name = addslashes($_POST['category']);
               
               $category->edit($id,$name, $users->getCompany());
               header("Location: ".BASE_URL."Category");
            }
         
            $data['category_info'] = $category->getInfo($id, $users->getCompany());
            $this->loadTemplate("Category_edit", $data);
        }
      } else {
          header("Location: ".BASE_URL);
      }
    }
    
    function delete($id){
        
    $users = new Users();
    $users->setUser();
    $category = new Category();
    $data['category_id'] = $category->getIds($users->getCompany());
    if(in_array($id, $data['category_id'])){
    
    if($users->hasPermission('category_edit')){
       $category->del($id, $users->getCompany());
       header("Location: ".BASE_URL."Category");
    }    
           
    } else {
       header("Location: ".BASE_URL); 
    }
    
  }

}