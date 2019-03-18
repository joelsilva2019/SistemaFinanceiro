<?php

class Inventory extends Model{
    
    public function getList($offset, $id_company){
        $array = array();
        $sql = $this->db->prepare("SELECT *, (select category.name from category where category.id = inventory.id_category) as category_name FROM inventory WHERE id_company = :id_company LIMIT $offset, 10");
        $sql->bindValue(':id_company', $id_company);
        $sql->execute();
        
        if($sql->rowCount() > 0){
            $array = $sql->fetchAll();
        }
        return $array;
    }
    
    public function getInfo($id, $id_company){
        $array = array();
        
        $sql = $this->db->prepare("SELECT * FROM inventory WHERE id = :id AND id_company = :id_company");
        $sql->bindValue(':id', $id);
        $sql->bindValue(':id_company', $id_company);
        $sql->execute();
        
        if($sql->rowCount() > 0){
            $array = $sql->fetch();
        }
        
        return $array;
    }
    
    public function getCount($id_company){
        $r = 0;
        $sql = $this->db->prepare("SELECT COUNT(*) as c FROM inventory WHERE id_company = :id_company");
        $sql->bindValue(':id_company', $id_company);
        $sql->execute();
        $row = $sql->fetch();
        $r = $row['c'];
        return $r;
    }

        public function searchInventoryByName($name, $id_company){
        
        $array = array();
        $sql = $this->db->prepare("SELECT id, name, price FROM inventory WHERE name LIKE :name AND id_company = :id_company LIMIT 10");
        $sql->bindValue(':name', '%'.$name.'%');
        $sql->bindValue(':id_company', $id_company);
        $sql->execute();
        
        if($sql->rowCount() > 0){
            $array = $sql->fetchAll();
        }
        
        return $array;
    }
    
    public function setLog($id_company, $id_product, $id_user, $action){
        $sql = $this->db->prepare("INSERT INTO inventory_history SET id_company = :id_company, id_product = :id_product, id_user = :id_user, action = :action, date_action = NOW()");
        $sql->bindValue(':id_company', $id_company);
        $sql->bindValue(':id_product', $id_product);
        $sql->bindValue(':id_user', $id_user);
        $sql->bindValue(':action', $action);
        $sql->execute();   
    }
    
    public function getInventoryFiltered($id_company, $id_category){
      $array = array();
      
      $sql = "SELECT *, (select category.name from category where category.id = inventory.id_category) as category_name ,(min_quant - quant) as dif FROM inventory WHERE min_quant > quant AND id_company = :id_company"; 

      if($id_category != ''){
          $sql .= " AND id_category = :id_category";
      }
      
      $sql .= " ORDER BY dif DESC";
      
      $sql = $this->db->prepare($sql);             
      $sql->bindValue(':id_company', $id_company);
      if($id_category != ''){
          $sql->bindValue(':id_category', $id_category);
      }
      $sql->execute();
 
      if($sql->rowCount() > 0){
          $array = $sql->fetchAll();
      }
      return $array;
    }
    
    function decrease($id_prod, $id_company, $quant_prod, $id_user){
        
        $sql = $this->db->prepare("UPDATE inventory SET quant = quant - $quant_prod WHERE id = :id AND id_company = :id_company");
        $sql->bindValue(":id", $id_prod);
        $sql->bindValue(":id_company", $id_company);
        $sql->execute();
        
         $this->setLog($id_company, $id_prod, $id_user, 'dcs'); 
        
    }
    
    function more($id_prod, $id_company, $quant_prod, $id_user){
        
        $sql = $this->db->prepare("UPDATE inventory SET quant = quant + $quant_prod WHERE id = :id AND id_company = :id_company");
        $sql->bindValue(":id", $id_prod);
        $sql->bindValue(":id_company", $id_company);
        $sql->execute();
        
         $this->setLog($id_company, $id_prod, $id_user, 'upe'); 
        
    }

    public function add($id_company,$id_category, $id_user, $name, $price, $quant, $min_quant){
        
        $sql = $this->db->prepare("INSERT INTO inventory SET id_company = :id_company, id_category = :id_category, name = :name, price = :price, quant = :quant, min_quant = :min_quant");
        $sql->bindValue(':id_company', $id_company);
        $sql->bindValue(':id_category', $id_category);
        $sql->bindValue(':name', $name);
        $sql->bindValue(':price', $price);
        $sql->bindValue(':quant', $quant);
        $sql->bindValue(':min_quant', $min_quant);
        $sql->execute();
        
        $id_product = $this->db->lastInsertId();
        $this->setLog($id_company, $id_product, $id_user, 'add');
     
    }
    
    public function edit($id, $id_company, $id_category,$id_user, $name, $price, $quant, $min_quant){
        
        $sql = $this->db->prepare("UPDATE inventory SET id_category = :id_category, name = :name, price = :price, quant = :quant, min_quant = :min_quant WHERE id = :id AND id_company = :id_company");
        $sql->bindValue(':id_category', $id_category);
        $sql->bindValue(':name', $name);
        $sql->bindValue(':price', $price);
        $sql->bindValue(':quant', $quant);
        $sql->bindValue(':min_quant', $min_quant);
        $sql->bindValue(':id', $id);
        $sql->bindValue(':id_company', $id_company);
        $sql->execute();
        
        $this->setLog($id_company, $id, $id_user, 'edt'); 
    }
    
    public function del($id, $id_company, $id_user){
        $sql = $this->db->prepare("DELETE FROM inventory WHERE id = :id AND id_company = :id_company");
        $sql->bindValue(':id', $id);
        $sql->bindValue(':id_company', $id_company);
        $sql->execute();
        
        $this->setLog($id_company, $id, $id_user, 'del');
        
    }
    
    
    
    
}