<?php

class Sales extends Model {
    
    public function getList($offset, $id_company){
        $array = array();
        $sql = $this->db->prepare("SELECT sales.id, sales.date_sale, sales.total_price, sales.status,sales.status_sale,clients.name"
                . " FROM sales LEFT JOIN clients ON clients.id = sales.id_client "
                . "WHERE sales.id_company = :id_company ORDER BY sales.date_sale DESC LIMIT $offset, 10");
        $sql->bindValue(':id_company', $id_company);
        $sql->execute();
        
        if($sql->rowCount() > 0){
            $array = $sql->fetchAll();
        }
        
        return $array;
    }
    
    public function getIds($id_company){
        $array = array();
        $sql = $this->db->prepare("SELECT id FROM sales WHERE id_company = :id_company");
        $sql->bindValue(':id_company', $id_company);
        $sql->execute();
        
        if($sql->rowCount() > 0){
           foreach($sql->fetchAll() as $v){
               $array[] = $v['id'];
           }
            
        }        
        return $array;
    }
    
    public function getIdClient($id_company){
        $array = array();
        $sql = $this->db->prepare("SELECT id_client FROM sales WHERE id_company = :id_company");
        $sql->bindValue(':id_company', $id_company);
        $sql->execute();
        
        if($sql->rowCount() > 0){
           foreach($sql->fetchAll() as $v){
               $array[] = $v['id_client'];
           }
            
        }        
        return $array;
    }

    public function getInfo($id, $id_company){
    
        $array = array();
        $sql = $this->db->prepare("SELECT *, (select clients.name from clients where clients.id = sales.id_client) as client_name"
                . " FROM sales WHERE sales.id = :id AND sales.id_company = :id_company");
        $sql->bindValue(":id", $id);
        $sql->bindValue(":id_company", $id_company);
        $sql->execute();
        
        if($sql->rowCount() > 0){
            $array['info'] = $sql->fetch();
        }
        
        
        $sql = $this->db->prepare("SELECT sales_products.quant, sales_products.sale_price, inventory.name "
                . "FROM sales_products "
                . "LEFT JOIN inventory ON inventory.id = sales_products.id_product "
                . "WHERE sales_products.id_sale = :id_sale AND sales_products.id_company = :id_company");
        $sql->bindValue(":id_sale", $id);
        $sql->bindValue(":id_company", $id_company);
        $sql->execute();
        
        if($sql->rowCount() > 0){
            $array['prods'] = $sql->fetchAll();
        }
        return $array;
    }
    
    public function getCount($id_company){
        $r = 0;
        $sql = $this->db->prepare("SELECT COUNT(*) as c FROM sales WHERE id_company = :id_company");
        $sql->bindValue(":id_company", $id_company);
        $sql->execute();
        $row = $sql->fetch();
        $r = $row['c'];
        
        return $r;
    }
    
    public function getTotalRevenue($period1, $period2, $id_company){
        $float = 0;
        $sql = $this->db->prepare("SELECT SUM(total_price) as total FROM sales WHERE id_company = :id_company AND date_sale BETWEEN :period1 AND :period2");
        $sql->bindValue(":id_company", $id_company);
        $sql->bindValue(":period1", $period1);
        $sql->bindValue(":period2", $period2);
        $sql->execute();
        $r = $sql->fetch();
        $float = $r['total'];
        
        return $float;
    }
    
    function getRevenueList($period1, $period2, $id_company){
        $array = array();
        $currentDay = $period1;
        while ($period2 != $currentDay){
            $array[$currentDay] = 0;
            $currentDay = date("Y-m-d", strtotime("+1 days", strtotime($currentDay)));
        }
        
        $sql = $this->db->prepare("SELECT DATE_FORMAT(date_sale, '%Y-%m-%d') as date_sale, SUM(total_price) as total FROM sales "
                . "WHERE id_company = :id_company AND date_sale BETWEEN :period1 AND :period2 GROUP "
                . "BY DATE_FORMAT(date_sale,'%Y-%m-%d')");
        $sql->bindValue(":id_company", $id_company);
        $sql->bindValue(":period1", $period1);
        $sql->bindValue(":period2", $period2);
        $sql->execute();
        
        if($sql->rowCount() > 0){
            
            foreach ($sql->fetchAll() as $sitem){
                $array[$sitem['date_sale']] = $sitem['total'];
            }
            
        }
        
        return $array;
    }
    
    public function getQuantStatusList($period1, $period2, $id_company){
        $array = array('0'=> 0, '1' => 0, '2' => 0);
        $sql = $this->db->prepare("SELECT COUNT(id) as total, status FROM sales "
                . "WHERE id_company = :id_company AND date_sale BETWEEN :period1 AND :period2 GROUP "
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

        public function getTotalExpanses($period1, $period2, $id_company){
        $float = 0;
        $sql = $this->db->prepare("SELECT SUM(total_price) as total FROM purchases WHERE id_company = :id_company AND date_purchase BETWEEN :period1 AND :period2");
        $sql->bindValue(":id_company", $id_company);
        $sql->bindValue(":period1", $period1);
        $sql->bindValue(":period2", $period2);
        $sql->execute();
        $r = $sql->fetch();
        $float = $r['total'];
        
        return $float;
    }
    
    public function getTotalProductsSold($period1, $period2, $id_company){
     
        $int = 0;
        $sql = $this->db->prepare("SELECT id FROM sales WHERE id_company = :id_company AND date_sale BETWEEN :period1 AND :period2");
        $sql->bindValue(":id_company", $id_company);
        $sql->bindValue(":period1", $period1);
        $sql->bindValue(":period2", $period2);
        $sql->execute();
        
        if($sql->rowCount() > 0){
            $prods = array();
            foreach ($sql->fetchAll() as $pitem){
                $prods[] =  $pitem['id'];   
            }
           $sql = $this->db->query("SELECT COUNT(*) as total FROM sales_products WHERE id_sale IN (". implode(",", $prods).") AND id_company = '$id_company'");
           $r = $sql->fetch();
           $int = $r['total'];
        }
        return $int;
    }
    
    public function getSalesClient($id_client, $id_company){
        $array = array();
        $sql = $this->db->prepare("SELECT clients.name, sales.id, sales.date_sale, sales.total_price, sales.status, sales.status_sale FROM sales "
                . "LEFT JOIN clients ON clients.id = sales.id_client "
                . "WHERE sales.id_client = :id_client AND sales.id_company = :id_company");
        $sql->bindValue(':id_client', $id_client);
        $sql->bindValue(':id_company', $id_company);
        $sql->execute();
        
        if($sql->rowCount() > 0){
            $array = $sql->fetchAll();
        }
        return $array;
    }
    
    public function searchSalesByName($name, $id_company){
        $array = array();
        $sql = $this->db->prepare("SELECT sales.id, sales.id_client, clients.name FROM sales "
                . "LEFT JOIN clients ON clients.id = sales.id_client "
                . "WHERE clients.name LIKE :name AND sales.id_company = :id_company");
        $sql->bindValue(':name', '%'.$name.'%');
        $sql->bindValue(':id_company', $id_company);
        $sql->execute();
        
        if($sql->rowCount() > 0){
            $array = $sql->fetchAll();
        }
       
        return $array;
    }


        public function changeStatus($status,$status_sale,$id,$id_company){
        
        $sql = $this->db->prepare("UPDATE sales SET status = :status, status_sale = :status_sale WHERE id = :id AND id_company = :id_company");
        $sql->bindValue(':status', $status);
        $sql->bindValue(':status_sale', $status_sale);
        $sql->bindValue(':id', $id);
        $sql->bindValue(':id_company', $id_company);
        $sql->execute();
    }

    public function add($id_company, $id_client, $id_user, $quant, $status,$status_sale){
        $inventory = new Inventory();
        $sql = $this->db->prepare("INSERT INTO sales SET id_company = :id_company, id_client = :id_client, id_user = :id_user, date_sale = NOW(), total_price = :total_price, status = :status, status_sale = :status_sale");
        $sql->bindValue(':id_company', $id_company);
        $sql->bindValue(':id_client', $id_client);
        $sql->bindValue(':id_user', $id_user);
        $sql->bindValue(':total_price', '0');
        $sql->bindValue(':status', $status);
        $sql->bindValue(':status_sale', $status_sale);
        $sql->execute();
     
        $id_sale = $this->db->lastInsertId();
        
        $total_price = 0;
        
        foreach ($quant as $id_prod => $quant_prod){
            $sql = $this->db->prepare("SELECT price FROM inventory WHERE id = :id AND id_company = :id_company");
            $sql->bindValue(':id', $id_prod);
            $sql->bindValue(':id_company', $id_company);
            $sql->execute();
           
            if($sql->rowCount() > 0){
               $row = $sql->fetch();
               $price = $row['price'];
               
               $sqlp = $this->db->prepare("INSERT INTO sales_products SET id_company = :id_company, id_sale = :id_sale, id_product = :id_product, quant = :quant, sale_price = :sale_price");
               $sqlp->bindValue(":id_company", $id_company);
               $sqlp->bindValue(":id_sale", $id_sale);
               $sqlp->bindValue(":id_product", $id_prod);
               $sqlp->bindValue(":quant", $quant_prod);
               $sqlp->bindValue(":sale_price", $price);
               $sqlp->execute();
               
               $inventory->decrease($id_prod, $id_company, $quant_prod, $id_user);
               
               $total_price += $price * $quant_prod;
            }
            
        }
        
        $sql = $this->db->prepare("UPDATE sales SET total_price = :total_price WHERE id = :id AND id_company = :id_company");
        $sql->bindValue(":total_price", $total_price);
        $sql->bindValue(":id", $id_sale);
        $sql->bindValue(":id_company", $id_company);
        $sql->execute();
    }
    
    public function getSalesFiltered($id_company, $client_name, $period1, $period2, $status, $order){
        
        $array = array();
        $sql = "SELECT clients.name, sales.date_sale, sales.total_price, sales.status"
                . " FROM sales LEFT JOIN clients ON clients.id = sales.id_client"
                . " WHERE ";
        
        $where = array();
        
        $where[] = "sales.id_company = :id_company";
        
        if(!empty($client_name)){
            $where[] = "clients.name LIKE '%".$client_name."%'";
        }
        
        if(!empty($period1) && !empty($period2)){
            $where[] = "sales.date_sale BETWEEN :period1 AND :period2";
        }
        
        if($status != ''){
            $where[] = "sales.status = :status";
        }
        
        $sql .= implode(" AND ", $where);
        
        switch ($order){
            case
                'date_desc':
                default:
                $sql .= " ORDER BY sales.date_sale DESC";
            break;
            case
                'date_asc':
                $sql .= " ORDER BY sales.date_sale ASC";
            break;
            case
                'status':
                $sql .= " ORDER BY sales.status";
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
    
}
