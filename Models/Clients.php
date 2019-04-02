<?php

class Clients extends Model {

    public function addAdvance($id_company,$id_client, $id_sale,$advance){
        $sql = $this->db->prepare("INSERT INTO advance_clients SET id_company = :id_company, id_client = :id_client, id_sale = :id_sale, advance = :advance, date_advance = NOW()");
        $sql->bindValue(":id_company", $id_company);
        $sql->bindValue(":id_client", $id_client);
        $sql->bindValue(":id_sale", $id_sale);
        $sql->bindValue(":advance", $advance);      
        $sql->execute();      
    }
    
    public function delAdvance($id_company, $id){
        $sql = $this->db->prepare("DELETE FROM advance_clients WHERE id = :id AND id_company = :id_company");
        $sql->bindValue(':id', $id);
        $sql->bindValue(':id_company', $id_company);
        $sql->execute();
    }


    public function getAdvance($id_sale, $id_company){
        
        $array = array();
        
        $sql = $this->db->prepare("SELECT * FROM advance_clients WHERE id_sale = :id_sale AND id_company = :id_company ORDER BY date_advance DESC");
        $sql->bindValue(":id_sale", $id_sale);
        $sql->bindValue(":id_company", $id_company);
        $sql->execute(); 
        
        if($sql->rowCount() > 0){
            $array = $sql->fetchAll();
            foreach ($array as $c => $v){
                $array[$c]['date_advance'] = date('d/m/Y H:i:s', strtotime($v['date_advance']));
            }
        }
        
        return $array; 
    }
    
    public function getTotalAdvance($id_sale, $id_company){
        
        $r = 0;
        
        $sql = $this->db->prepare("SELECT SUM(advance) as total FROM advance_clients WHERE id_sale = :id_sale AND id_company = :id_company");
        $sql->bindValue(":id_sale", $id_sale);
        $sql->bindValue(":id_company", $id_company);
        $sql->execute(); 
        
        $row = $sql->fetch();
        
        $r = $row['total'];
        
        return $r; 
    }

    public function getList($offset, $id_company){
        $array = array();
        
        $sql = $this->db->prepare("SELECT * FROM clients WHERE id_company = :id_company LIMIT $offset, 10");
        $sql->bindValue(':id_company', $id_company);
        $sql->execute();
        
        if($sql->rowCount() > 0){
            $array = $sql->fetchAll();
        }
        return $array;
    }
    
    public function getIds($id_company){
        
        $array = array();
        $sql = $this->db->prepare("SELECT id FROM clients WHERE id_company = :id_company");
        $sql->bindValue(':id_company', $id_company);
        $sql->execute();
        
        if($sql->rowCount() > 0){
                      
           foreach($sql->fetchAll() as $v){
               $array[] = $v['id'];
           }
            
        }
        
        return $array;
        
    }
    
    public function getClient($id, $id_company){
        $array = array();
        
        $sql = $this->db->prepare("SELECT * FROM clients WHERE id = :id AND id_company = :id_company");
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
        
        $sql = $this->db->prepare("SELECT COUNT(*) as c FROM clients WHERE id_company = :id_company");
        $sql->bindValue(':id_company', $id_company);
        $sql->execute();
        $row = $sql->fetch();
        $r = $row['c'];
        
        return $r;
    }
    
    public function searchClientsByName($name, $id_company){
        
        $array = array();
        $sql = $this->db->prepare("SELECT id, name FROM clients WHERE name LIKE :name AND id_company = :id_company LIMIT 10");
        $sql->bindValue(':name', '%'.$name.'%');
        $sql->bindValue(':id_company', $id_company);
        $sql->execute();
        
        if($sql->rowCount() > 0){
            $array = $sql->fetchAll();
        }
        
        return $array;
    }

    public function add($id_company, $name, $email = '', $phone = '', $stars = '3', $internal_obs = '',
            $address_zipcode = '',$address = '', $address_number = '', $address2 = '', $address_neighb = '', 
            $address_city = '',$address_state = '', $address_country = ''){
        
        $sql = $this->db->prepare("INSERT INTO clients SET id_company = :id_company, name = :name, email = :email, phone = :phone,"
                . " stars = :stars, internal_obs = :internal_obs, address_zipcode = :address_zipcode, address = :address, "
                . "address_number = :address_number, address2 = :address2, address_neighb = :address_neighb, "
                . "address_city = :address_city, address_state = :address_state, address_country = :address_country");
        $sql->bindValue(':id_company', $id_company);
        $sql->bindValue(':name', $name);;
        $sql->bindValue(':email', $email);;
        $sql->bindValue(':phone', $phone);
        $sql->bindValue(':stars', $stars);
        $sql->bindValue(':internal_obs', $internal_obs);
        $sql->bindValue(':address_zipcode', $address_zipcode);
        $sql->bindValue(':address', $address);
        $sql->bindValue(':address_number', $address_number);
        $sql->bindValue(':address2', $address2);
        $sql->bindValue(':address_neighb', $address_neighb);
        $sql->bindValue(':address_city', $address_city);
        $sql->bindValue(':address_state', $address_state);
        $sql->bindValue(':address_country', $address_country);
        $sql->execute();
        
        return $this->db->lastInsertId();
    }
    
    public function edit($id,$id_company, $name, $email, $phone, $stars, $internal_obs,
            $address_zipcode,$address, $address_number, $address2, $address_neighb, 
            $address_city,$address_state, $address_country){
        
        $sql = $this->db->prepare("UPDATE clients SET id_company = :id_company, name = :name, email = :email, phone = :phone,"
                . " stars = :stars, internal_obs = :internal_obs, address_zipcode = :address_zipcode, address = :address, "
                . "address_number = :address_number, address2 = :address2, address_neighb = :address_neighb, "
                . "address_city = :address_city, address_state = :address_state, address_country = :address_country WHERE id = :id AND "
                . "id_company = :id_company2");
        $sql->bindValue(':id_company', $id_company);
        $sql->bindValue(':name', $name);;
        $sql->bindValue(':email', $email);;
        $sql->bindValue(':phone', $phone);
        $sql->bindValue(':stars', $stars);
        $sql->bindValue(':internal_obs', $internal_obs);
        $sql->bindValue(':address_zipcode', $address_zipcode);
        $sql->bindValue(':address', $address);
        $sql->bindValue(':address_number', $address_number);
        $sql->bindValue(':address2', $address2);
        $sql->bindValue(':address_neighb', $address_neighb);
        $sql->bindValue(':address_city', $address_city);
        $sql->bindValue(':address_state', $address_state);
        $sql->bindValue(':address_country', $address_country);
        $sql->bindValue(':id', $id);
        $sql->bindValue(':id_company2', $id_company);
        $sql->execute();
    }
    
    
    public function delete($id, $id_company){
        
        $sql = $this->db->prepare("DELETE FROM clients WHERE id = :id AND id_company = :id_company");
        $sql->bindValue(':id', $id);
        $sql->bindValue(':id_company', $id_company);
        $sql->execute();
        
        $sql_advance = $this->db->prepare("DELETE FROM advance_clients WHERE id_client = :id_client AND id_company = :id_company");
        $sql_advance->bindValue(':id_client', $id);
        $sql_advance->bindValue(':id_company', $id_company);
        $sql_advance->execute();
     
        $sql_sales = $this->db->prepare("SELECT id FROM sales WHERE id_client = :id_client AND id_company = :id_company");
        $sql_sales->bindValue(':id_client', $id);
        $sql_sales->bindValue(':id_company', $id_company);
        $sql_sales->execute();
        
        if($sql_sales->rowCount() > 0){
            $ids = array();
            foreach ($sql_sales->fetchAll() as $v){
                $ids[] = $v['id'];
            }
            
            $sql_sales = $this->db->prepare("DELETE FROM sales_products WHERE id_sale IN (".implode(',', $ids).") AND id_company = :id_company");
            $sql_sales->bindValue(':id_company', $id_company);
            $sql_sales->execute();
            
            $sql_sales = $this->db->prepare("DELETE FROM sales WHERE id IN (".implode(',', $ids).") AND id_company = :id_company");
            $sql_sales->bindValue(':id_company', $id_company);
            $sql_sales->execute();
            
        }
        
        
        
        
    }
    
}
