<style type="text/css">   
    th{text-align: left;}
</style>
<?php if(!empty($filters['client_name']) || !empty($filters['datep1']) && !empty($filters['datep2']) || $filters['status'] != ''){ ?>
<fieldset>
    
    <?php if(isset($filters['client_name']) && !empty($filters['client_name'])){
     echo 'Filtrado pelo cliente: '.$filters['client_name'].'<br/>';
    }
    if(!empty($filters['datep1']) && !empty($filters['datep2'])){
     echo 'Filtrado no periodo: '.date('d/m/Y', strtotime($filters['datep1'])).' a '.date('d/m/Y', strtotime($filters['datep2'])).'<br/>';
    }
    if(isset($filters['status']) && $filters['status'] != ''){
     echo 'Filtrado pelo status: '.$status_name[$filters['status']];
    }
    ?>
    
</fieldset><br/><br/>

<?php } ?>

<table width="100%" border="0">
    <tr>
        <th>Nome do Cliente</th>
        <th>Data</th>
        <th>Status</th>
        <th>Preço Total</th>
    </tr>

    <?php foreach ($sales_list as $sale): ?>
    
    <tr>
        <td><?php echo $sale['name']; ?></td>
        <td><?php echo date('d/m/Y', strtotime($sale['date_sale'])); ?></td>
        <td><?php echo $status_name[$sale['status']]; ?></td>
        <td><?php echo number_format($sale['total_price'], 2, ',','.'); ?></td>
    </tr>    
    <?php endforeach; ?>
</table>


