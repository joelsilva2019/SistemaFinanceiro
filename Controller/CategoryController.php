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
            
            $offset = 0;
            $data['p'] = 1;
            if(isset($_GET['p']) && !empty($_GET['p'])){
                $data['p'] = intval($_GET['p']);
                if($data['p'] == 0){
                    $data['p'] = 1;
                }
            }
            
            $offset = (10 * ($data['p']-1));
            
            $data['category_count'] = $category->getCount($users->getCompany());
            $data['p_count'] = ceil($data['category_count']/10);
            
            $data['category_list'] = $category->getList($users->getCompany(), $offset);
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

        if ($users->hasPermission('category_edit')) {
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

        if ($users->hasPermission('category_edit')) {
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