<?php

class Category extends Model{
    
    public function getList($id_company, $offset = 0){
        $array = array();
        if($offset > 0){
        $sql = $this->db->prepare("SELECT * FROM category WHERE id_company = :id_company LIMIT $offset, 10");
        } else {
        $sql = $this->db->prepare("SELECT * FROM category WHERE id_company = :id_company");    
        }
        $sql->bindValue(":id_company", $id_company);
        $sql->execute();
        
        if($sql->rowCount() > 0){
            $array = $sql->fetchAll();
        }
        return $array;
    }
    
    public function getIds($id_company){
        
        $array = array();
        $sql = $this->db->prepare("SELECT id FROM category WHERE id_company = :id_company");
        $sql->bindValue(':id_company', $id_company);
        $sql->execute();
        
        if($sql->rowCount() > 0){
                      
           foreach($sql->fetchAll() as $v){
               $array[] = $v['id'];
           }
            
        }
        
        return $array;
        
    }
    
    public function getInfo($id, $id_company){
        $array = array();
        $sql = $this->db->prepare("SELECT * FROM category WHERE id = :id AND id_company = :id_company");
        $sql->bindValue(":id", $id);
        $sql->bindValue(":id_company", $id_company);
        $sql->execute();
        
        if($sql->rowCount() > 0){
            $array = $sql->fetch();
        }
        
        return $array;
    }
    
    public function getCount($id_company){
        $r = 0;
        
        $sql = $this->db->prepare("SELECT COUNT(*) as c FROM category WHERE id_company = :id_company");
        $sql->bindValue(':id_company', $id_company);
        $sql->execute();
        $row = $sql->fetch();
        $r = $row['c'];
        
        return $r;
    }
    
    public function searchCategoryByName($name, $id_company){
        $array = [];
        $sql = $this->db->prepare("SELECT id, name FROM category WHERE name LIKE :name AND id_company = :id_company");
        $sql->bindValue(':name', '%'.$name.'%');
        $sql->bindValue(':id_company', $id_company);
        $sql->execute();
        
        if($sql->rowCount() > 0){
           $array = $sql->fetchAll();
        }
        return $array;   
    }
    public function add($name, $id_company){     
        $sql = $this->db->prepare("INSERT INTO category SET name = :name, id_company = :id_company");
        $sql->bindValue(":name", $name);
        $sql->bindValue(":id_company", $id_company);
        $sql->execute();
    }
    
    public function edit($id, $name, $id_company){     
        $sql = $this->db->prepare("UPDATE category SET name = :name  WHERE id = :id AND id_company = :id_company");
        $sql->bindValue(":name", $name);
        $sql->bindValue(":id", $id);
        $sql->bindValue(":id_company", $id_company);
        $sql->execute();
    }
    
    public function del($id, $id_company){
        
        $sql = $this->db->prepare("DELETE FROM category WHERE id = :id AND id_company = :id_company");
        $sql->bindValue(":id", $id);
        $sql->bindValue(":id_company", $id_company);
        $sql->execute();
        
        $sql = $this->db->prepare("DELETE FROM iventory WHERE id_category = :id_category AND id_company = :id_company");
        $sql->bindValue(":id_category", $id);
        $sql->bindValue(":id_company", $id_company);
        $sql->execute();
        
    }    
}
