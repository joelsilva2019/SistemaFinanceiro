<?php

class LoginController extends Controller {

    public function index() {

        $data = array();
        $u = new Users();

        if (isset($_POST['email']) && !empty($_POST['email'])) {

            $email = addslashes($_POST['email']);
            $pass = addslashes($_POST['password']);

            if ($u->doLogin($email, $pass)) {
                header("Location: " . BASE_URL);
                exit;
            } else {
                $data['erro'] = "E-mail e/ou senha errados.";
            }
        }

        $this->loadView("Login", $data);
    }
    
    public function logout(){
        $users = new Users();
        $users->logOut();
        header("Location: ".BASE_URL);       
    }

}
