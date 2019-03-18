<?php

class Users extends Model {

    private $userInfo;
    private $permissions;

    function isLogged() {

        if (isset($_SESSION['ccUser']) && !empty($_SESSION['ccUser'])) {
            return true;
        } else {
            return false;
        }
    }

    function doLogin($email, $password) {

        $sql = $this->db->prepare("SELECT * FROM users WHERE email = :email AND password = :password");
        $sql->bindValue(':email', $email);
        $sql->bindValue(':password', md5($password));
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $row = $sql->fetch();
            $_SESSION['ccUser'] = $row['id'];
            return true;
        } else {
            return false;
        }
    }

    function setUser() {

        if (isset($_SESSION['ccUser']) && !empty($_SESSION['ccUser'])) {
            $id = $_SESSION['ccUser'];
            $sql = $this->db->prepare("SELECT * FROM users WHERE id = :id");
            $sql->bindValue(':id', $id);
            $sql->execute();

            if ($sql->rowCount() > 0) {
                $this->userInfo = $sql->fetch();
                $this->permissions = new Permissions();
                $this->permissions->setGroups($this->userInfo['id_group'], $this->userInfo['id_company']);
            }
        }
    }

    function getCompany() {
        if (isset($this->userInfo['id_company']) && !empty($this->userInfo['id_company'])) {
            return $this->userInfo['id_company'];
        } else {
            return 0;
        }
    }

    public function getEmail() {
        if (isset($this->userInfo['email']) && !empty($this->userInfo['email'])) {
            return $this->userInfo['email'];
        } else {
            return '';
        }
    }
    
    public function getId() {
        if (isset($this->userInfo['id']) && !empty($this->userInfo['id'])) {
            return $this->userInfo['id'];
        } else {
            return 0;
        }
    }
    
    
    public function getInfo($id, $id_company){
        $array = array();
        $sql = $this->db->prepare("SELECT * FROM users WHERE id = :id AND id_company = :id_company");
        $sql->bindValue(':id', $id);
        $sql->bindValue(':id_company', $id_company);
        $sql->execute();
        
        if($sql->rowCount() > 0){
            $array = $sql->fetch();
        }
        return $array;
    }

    public function logOut() {
        unset($_SESSION['ccUser']);
    }

    public function hasPermission($name) {
        return $this->permissions->hasPermission($name);
    }
    
    public function findUsersInGroup($id){
        
        $sql = $this->db->prepare("SELECT COUNT(*) as c FROM users WHERE id_group = :id");
        $sql->bindValue(':id', $id);
        $sql->execute();
        $row = $sql->fetch();
        
        if($row['c'] == '0'){
            return false; 
        } else {
            return true;
        }
        
    }
    
    public function getList($id_company){
       $array = array(); 
       $sql = $this->db->prepare("SELECT users.id, users.email, permission_groups.name"
               . " FROM users LEFT JOIN permission_groups ON permission_groups.id = users.id_group"
               . " WHERE users.id_company = :id_company");
       $sql->bindValue(':id_company', $id_company);
       $sql->execute();
        
       if($sql->rowCount() > 0){
           $array = $sql->fetchAll();
       }
       return $array; 
    }

    public function add($email, $pass, $groups, $id_company) {

        $sql = $this->db->prepare("SELECT COUNT(*) as c FROM users WHERE email = :email");
        $sql->bindValue(':email', $email);
        $sql->execute();
        $row = $sql->fetch();

        if ($row['c'] == '0') {

            $sql = $this->db->prepare("INSERT INTO users SET id_company = :id_company, email = :email, password = :password, id_group = :id_group");
            $sql->bindValue(':id_company', $id_company);
            $sql->bindValue(':email', $email);
            $sql->bindValue(':password', md5($pass));
            $sql->bindValue(':id_group', $groups);
            $sql->execute();
            return '1';
        } else {
            return '0';
        }
    }
    
    public function edit($pass, $groups, $id, $id_company){
        $sql = $this->db->prepare("UPDATE users SET id_group = :group WHERE id = :id AND :id_company = :id_company");
        $sql->bindValue(':group', $groups);
        $sql->bindValue(':id', $id);
        $sql->bindValue(':id_company', $id_company);
        $sql->execute();
        
        if(!empty($pass)){
            
        $sql = $this->db->prepare("UPDATE users SET password = :password WHERE id = :id AND :id_company = :id_company");
        $sql->bindValue(':password', md5($pass));
        $sql->bindValue(':id', $id);
        $sql->bindValue(':id_company', $id_company);
        $sql->execute();
        
        }
    }
    
    public function del($id, $id_company){
        $sql = $this->db->prepare("DELETE FROM users WHERE id = :id AND id_company = :id_company");
        $sql->bindValue(':id', $id);
        $sql->bindValue(':id_company', $id_company);
        $sql->execute();
    }

}
