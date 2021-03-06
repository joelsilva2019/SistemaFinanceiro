<?php

class Permissions extends Model {

    private $groups;
    private $permissions;

    function setGroups($id, $id_company) {
        $this->groups = $id;
        $this->permissions = array();

        $sql = $this->db->prepare("SELECT params FROM permission_groups WHERE id = :id AND id_company = :id_company");
        $sql->bindValue(':id', $id);
        $sql->bindValue(':id_company', $id_company);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $row = $sql->fetch();

            if (empty($row['params'])) {
                $row['params'] = '0';
            }

            $params = $row['params'];

            $sql = $this->db->prepare("SELECT name FROM permission_params WHERE id IN ($params) AND id_company = :id_company");
            $sql->bindValue(':id_company', $id_company);
            $sql->execute();

            if ($sql->rowCount() > 0) {
                foreach ($sql->fetchAll() as $item) {
                    $this->permissions[] = $item['name'];
                }
            }
        }
    }

    public function hasPermission($name) {
        if (in_array($name, $this->permissions)) {
            return true;
        } else {
            return false;
        }
    }

    public function getList($id) {
        $array = array();
        $sql = $this->db->prepare("SELECT * FROM permission_params WHERE id_company = :id");
        $sql->bindValue(':id', $id);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $array = $sql->fetchAll();
        }
        return $array;
    }
    
    public function getIds($id_company){
        
        $array = array();
        $sql = $this->db->prepare("SELECT id FROM permission_params WHERE id_company = :id_company");
        $sql->bindValue(':id_company', $id_company);
        $sql->execute();
        
        if($sql->rowCount() > 0){
                      
           foreach($sql->fetchAll() as $v){
               $array[] = $v['id'];
           }
            
        }
        
        return $array;
        
    }
    
    public function getIdsGroups($id_company){
        
        $array = array();
        $sql = $this->db->prepare("SELECT id FROM permission_groups WHERE id_company = :id_company");
        $sql->bindValue(':id_company', $id_company);
        $sql->execute();
        
        if($sql->rowCount() > 0){
                      
           foreach($sql->fetchAll() as $v){
               $array[] = $v['id'];
           }
            
        }
        
        return $array;
        
    }

    public function add($permission, $id_company) {
        $sql = $this->db->prepare("INSERT INTO permission_params SET id_company = :id_company, name = :name");
        $sql->bindValue(':id_company', $id_company);
        $sql->bindValue(':name', $permission);
        $sql->execute();
    }

    public function del($id) {
        $sql = $this->db->prepare("DELETE FROM permission_params WHERE id = :id");
        $sql->bindValue(':id', $id);
        $sql->execute();
    }

    public function getListGroup($id_company) {
        $array = array();

        $sql = $this->db->prepare("SELECT * FROM permission_groups WHERE id_company = :id_company");
        $sql->bindValue(':id_company', $id_company);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $array = $sql->fetchAll();
        }
        return $array;
    }
    
    public function getGroup($id, $id_company){
        $array = array();
        $sql = $this->db->prepare("SELECT * FROM permission_groups WHERE id_company = :id_company AND id = :id");
        $sql->bindValue(':id', $id);
        $sql->bindValue(':id_company', $id_company);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $array = $sql->fetch();
            $array['params'] = explode(",", $array['params']);
        }
        return $array;
    }

    public function addGroup($group, $plist, $id_company) {
        $params = implode(",", $plist);
        $sql = $this->db->prepare("INSERT INTO permission_groups SET id_company = :id_company, name = :group, params = :params");
        $sql->bindValue(':id_company', $id_company);
        $sql->bindValue(':group', $group);
        $sql->bindValue(':params', $params);
        $sql->execute();
    }
    
    public function delGroup($id) {
        $u = new Users();
        if ($u->findUsersInGroup($id) == false) {
            $sql = $this->db->prepare("DELETE FROM permission_groups WHERE id = :id");
            $sql->bindValue(':id', $id);
            $sql->execute();
        }
    }
    
    public function editGroup($group, $plist,$id, $id_company) {
        $params = implode(",", $plist);
        $sql = $this->db->prepare("UPDATE permission_groups SET id_company = :id_company, name = :group, params = :params WHERE id = :id");
        $sql->bindValue(':id_company', $id_company);
        $sql->bindValue(':group', $group);
        $sql->bindValue(':params', $params);
        $sql->bindValue(':id', $id);
        $sql->execute();
    }

}
