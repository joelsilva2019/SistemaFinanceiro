<?php

class Purchases extends Model {
    
    
    public function getCount($id_company){
        $r = 0;
        $sql = $this->db->prepare("SELECT COUNT(*) as c FROM purchases WHERE id_company = :id_company");
        $sql->bindValue(":id_company", $id_company);
        $sql->execute();
        $row = $sql->fetch();
        $r = $row['c'];
        return $r;
    }
    
    public function getCountPurchasesSalesman($salesman, $id_company){
        $r = 0;
        $sql = $this->db->prepare("SELECT COUNT(*) as c FROM purchases WHERE salesman = :salesman AND id_company = :id_company");
        $sql->bindValue(":salesman", $salesman);    
        $sql->bindValue(":id_company", $id_company);
        $sql->execute();
        $row = $sql->fetch();
        $r = $row['c'];
        return $r;
    }

    public function getList($offset, $id_company){
        $array = array();
        $sql = $this->db->prepare("SELECT purchases.id, purchases.date_purchase, purchases.salesman, purchases.total_price, purchases.status, users.email"
                . " FROM purchases LEFT JOIN users ON users.id = purchases.id_user "
                . "WHERE purchases.id_company = :id_company ORDER BY purchases.date_purchase DESC LIMIT $offset, 10");
        $sql->bindValue(':id_company', $id_company);
        $sql->execute();
        
        if($sql->rowCount() > 0){
            $array = $sql->fetchAll();
        }
        
        return $array;
    }
    
    public function getIds($id_company){
        
        $array = array();
        $sql = $this->db->prepare("SELECT id FROM purchases WHERE id_company = :id_company");
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
        $sql = $this->db->prepare("SELECT *, (select users.email from users where users.id = purchases.id_user) as user_email"
                . " FROM purchases WHERE purchases.id = :id AND purchases.id_company = :id_company");
        $sql->bindValue(":id", $id);
        $sql->bindValue(":id_company", $id_company);
        $sql->execute();
        
        if($sql->rowCount() > 0){
            $array['info'] = $sql->fetch();
        }
        
        
        $sql = $this->db->prepare("SELECT purchases_products.quant, purchases_products.purchase_price, inventory.name "
                . "FROM purchases_products "
                . "LEFT JOIN inventory ON inventory.id = purchases_products.id_product "
                . "WHERE purchases_products.id_purchase = :id_purchase AND purchases_products.id_company = :id_company");
        $sql->bindValue(":id_purchase", $id);
        $sql->bindValue(":id_company", $id_company);
        $sql->execute();
        
        if($sql->rowCount() > 0){
            $array['prods'] = $sql->fetchAll();
        }
        return $array;
    }
    
    public function getPurchasesSalesman($salesman, $id_company, $offset){
        $array = array();
        $sql = $this->db->prepare("SELECT * FROM purchases WHERE salesman = :salesman AND id_company = :id_company LIMIT $offset, 10");
        $sql->bindValue(':salesman', $salesman);
        $sql->bindValue(':id_company', $id_company);
        $sql->execute();
        
        if($sql->rowCount() > 0){
            $array = $sql->fetchAll();
        }
        return $array;
    }
    
    public function getSalesman($id_company){
        $array = array();
        $sql = $this->db->prepare("SELECT salesman FROM purchases WHERE id_company = :id_company");
        $sql->bindValue(':id_company', $id_company);
        $sql->execute();
        
        if($sql->rowCount() > 0){
           foreach($sql->fetchAll() as $v){
               $array[] = $v['salesman'];
           }
            
        }        
        return $array;
    }
    
    public function searchPurchasesByName($name, $id_company){
        $array = array();
        $sql = $this->db->prepare("SELECT id, salesman FROM purchases WHERE salesman LIKE :salesman AND id_company = :id_company LIMIT 1");
        $sql->bindValue(':salesman', '%'.$name.'%');
        $sql->bindValue(':id_company', $id_company);
        $sql->execute();
        
        if($sql->rowCount() > 0){
            $array = $sql->fetchAll();
        }
       
        return $array;
    }
    
    public function changeStatus($status, $id,$id_company){
        
        $sql = $this->db->prepare("UPDATE purchases SET status = :status WHERE id = :id AND id_company = :id_company");
        $sql->bindValue(':status', $status);
        $sql->bindValue(':id', $id);
        $sql->bindValue(':id_company', $id_company);
        $sql->execute();
    }
    
    function getExpansesList($period1, $period2, $id_company){
        $array = array();
        $currentDay = $period1;
        while ($period2 != $currentDay){
            $array[$currentDay] = 0;
            $currentDay = date("Y-m-d", strtotime("+1 days", strtotime($currentDay)));
        }
        
        $sql = $this->db->prepare("SELECT DATE_FORMAT(date_purchase, '%Y-%m-%d') as date_purchase, SUM(total_price) as total FROM purchases "
                . "WHERE id_company = :id_company AND date_purchase BETWEEN :period1 AND :period2 GROUP "
                . "BY DATE_FORMAT(date_purchase,'%Y-%m-%d')");
        $sql->bindValue(":id_company", $id_company);
        $sql->bindValue(":period1", $period1);
        $sql->bindValue(":period2", $period2);
        $sql->execute();
        
        if($sql->rowCount() > 0){
            
            foreach ($sql->fetchAll() as $sitem){
                $array[$sitem['date_purchase']] = $sitem['total'];
            }
            
        }
        
        return $array;
    }
    
    public function getQuantPurchasesStatus($period1, $period2, $id_company){
        $array = array('0' => 0, '1' => 0, '2' => 0);
        $sql = $this->db->prepare("SELECT COUNT(id) as total, status FROM purchases "
                . "WHERE id_company = :id_company AND date_purchase BETWEEN :period1 AND :period2 GROUP "
                . "BY status ORDER BY status ASC");
        $sql->bindValue(":id_company", $id_company);
        $sql->bindValue(":period1", $period1);
        $sql->bindValue(":period2", $period2);
        $sql->execute();
        
        if($sql->rowCount() > 0){
            foreach ($sql->fetchAll() as $sitem){
                $array[$sitem['status']] = $sitem['total'];
            }   
        }
      
        return $array;
        
    }
    
    public function getPurchasesFiltered($id_company, $salesman_name, $period1, $period2, $status, $order){
        
        $array = array();
        $sql = "SELECT *FROM purchases WHERE ";
        
        $where = array();
        
        $where[] = "id_company = :id_company";
        
        if(!empty($salesman_name)){
            $where[] = "salesman LIKE '%".$salesman_name."%'";
        }
        
        if(!empty($period1) && !empty($period2)){
            $where[] = "date_purchase BETWEEN :period1 AND :period2";
        }
        
        if($status != ''){
            $where[] = "status = :status";
        }
        
        $sql .= implode(" AND ", $where);
        
        switch ($order){
            case
                'date_desc':
                default:
                $sql .= " ORDER BY date_purchase DESC";
            break;
            case
                'date_asc':
                $sql .= " ORDER BY date_purchase ASC";
            break;
            case
                'status':
                $sql .= " ORDER BY status";
                break;    
        }
        
        $sql = $this->db->prepare($sql);
        $sql->bindValue(":id_company", $id_company);
        
        if(!empty($period1) && !empty($period2)){
            $sql->bindValue(":period1", $period1);
            $sql->bindValue(":period2", $period2);
        }
        
        if($status != ''){
            $sql->bindValue(":status", $status);
        }
        
        $sql->execute();
        
        if($sql->rowCount() > 0){
            $array = $sql->fetchAll();
        }
        return $array;
    }
    
    public function add($id_company, $id_user,$salesman,$quant, $status){
        $inventory = new Inventory();
        $sql = $this->db->prepare("INSERT INTO purchases SET id_company = :id_company, id_user = :id_user,salesman = :salesman, date_purchase = NOW(), total_price = :total_price, status = :status");
        $sql->bindValue(':id_company', $id_company);
        $sql->bindValue(':id_user', $id_user);
        $sql->bindValue(':salesman', $salesman);
        $sql->bindValue(':total_price', '0');
        $sql->bindValue(':status', $status);
        $sql->execute();
     
        $id_purchase = $this->db->lastInsertId();
        
        $total_price = 0;
        
        foreach ($quant as $id_prod => $quant_prod){
            $sql = $this->db->prepare("SELECT price_purchase FROM inventory WHERE id = :id AND id_company = :id_company");
            $sql->bindValue(':id', $id_prod);
            $sql->bindValue(':id_company', $id_company);
            $sql->execute();
           
            if($sql->rowCount() > 0){
               $row = $sql->fetch();
               $price = $row['price_purchase'];
               
               $sqlp = $this->db->prepare("INSERT INTO purchases_products SET id_company = :id_company, id_purchase = :id_purchase, id_product = :id_product, quant = :quant, purchase_price = :purchase_price");
               $sqlp->bindValue(":id_company", $id_company);
               $sqlp->bindValue(":id_purchase", $id_purchase);
               $sqlp->bindValue(":id_product", $id_prod);
               $sqlp->bindValue(":quant", $quant_prod);
               $sqlp->bindValue(":purchase_price", $price);
               $sqlp->execute();
               
               $inventory->more($id_prod, $id_company, $quant_prod, $id_user);
               
               $total_price += $price * $quant_prod;
            }
            
        }
        
        $sql = $this->db->prepare("UPDATE purchases SET total_price = :total_price WHERE id = :id AND id_company = :id_company");
        $sql->bindValue(":total_price", $total_price);
        $sql->bindValue(":id", $id_purchase);
        $sql->bindValue(":id_company", $id_company);
        $sql->execute();
    }

    
    
}
