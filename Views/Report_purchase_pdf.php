<style type="text/css">   
    th{text-align: left;}
</style>
<?php if(!empty($filters['salesman_name']) || !empty($filters['datep1']) && !empty($filters['datep2']) || $filters['status'] != ''): ?>
<fieldset>
    <?php if(isset($filters['salesman_name']) && !empty($filters['salesman_name'])){
     echo 'Filtrado pelo vendedor: '.$filters['salesman_name'].'<br/>';
    }
    if(!empty($filters['datep1']) && !empty($filters['datep2'])){
     echo 'Filtrado no periodo: '.date('d/m/Y', strtotime($filters['datep1'])).' a '.date('d/m/Y', strtotime($filters['datep2'])).'<br/>';
    }
    if(isset($filters['status']) && $filters['status'] != ''){
     echo 'Filtrado pelo status: '.$status_name[$filters['status']];
    }
?>
</fieldset>
<?php endif; ?>

<table width="100%" border="0">
    <tr>
        <th>Nome do Vendedor</th>
        <th>Data</th>
        <th>Status</th>
        <th>Preço Total</th>
    </tr>

    <?php foreach ($purchases_list as $purchase): ?>
    
    <tr>
        <td><?php echo $purchase['salesman']; ?></td>
        <td><?php echo date('d/m/Y', strtotime($purchase['date_purchase'])); ?></td>
        <td><?php echo $status_name[$purchase['status']]; ?></td>
        <td><?php echo number_format($purchase['total_price'], 2, ',','.'); ?></td>
    </tr>    
    <?php endforeach; ?>
</table>