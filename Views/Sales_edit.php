<h1>Vendas - Editar</h1>

<strong>Nome do Cliente: </strong><br/>
<?php echo $sales_info['info']['client_name']; ?><br/><br/>
<strong>Data da Venda: </strong><br/>
<?php echo date('d/m/Y', strtotime($sales_info['info']['date_sale'])); ?><br/><br/>

<strong>Preço total da Venda: </strong><br/>
R$ <?php echo number_format($sales_info['info']['total_price'], 2, ',', '.'); ?><br/><br/>

<strong>Status: </strong><br/>
<?php if ($sales_edit): ?>
    <form method="POST">
        <select name="status">
            <?php foreach ($status_name as $k => $v): ?>
                <option value="<?php echo $k; ?>" <?php echo ($k == $sales_info['info']['status']) ? 'selected="selected"' : ''; ?>><?php echo $v; ?></option>
            <?php endforeach; ?>
        </select><br/><br/>  
    <?php else: ?>
        <?php echo $status_name[$sales_info['info']['status']].'<br/><br/>'; ?>
    <?php endif; ?>

    <strong>Status da entrega: </strong><br/>    
    <?php if ($sales_edit): ?>
        <select name="status_sale">
            <?php foreach ($status_sale_name as $k => $v): ?>
                <option value="<?php echo $k; ?>" <?php echo ($k == $sales_info['info']['status_sale']) ? 'selected="selected"' : ''; ?>><?php echo $v; ?></option>
            <?php endforeach; ?>
        </select><br/><br/>
    <?php else: ?>
        <?php echo $status_sale_name[$sales_info['info']['status_sale']].'<br/><br/>'; ?>   
    <?php endif; ?>
        
    <?php if($sales_info['info']['status'] == '0'): ?>    
        <strong>Adiatamento da venda:</strong><br/>
        <input style="width: 50%;" type="text" name="client_advance" data-id="<?php echo $sales_info['info']['id']; ?>" data-client="<?php echo $sales_info['info']['id_client']; ?>" ><button class="advance">Adicionar adiantamento</button><br/><br/>   
    <?php endif; ?>
     
    <?php if ($sales_edit): ?>    
    <input type="submit" value="Salvar"/>
    <?php endif; ?>

</form>
<?php if($sales_info['info']['status'] == '0'): ?> 
<hr/>
<h3>Adiantamentos do cliente</h3>

<table id="table_advance" data-id="<?php echo $sales_info['info']['id']; ?>" width="50%">
    <tr>
    <th>Valor</th>
    <th>Data</th>
    </tr>
</table>

<?php endif; ?>

<hr/>   

<h3>Produtos da Venda: </h3>

<table width="100%" border="0">
    <tr>
        <th>Nome do Produto</th>
        <th>Quantidade</th>
        <th>Preço Unitário</th>
        <th>Preço Total</th>
    </tr>
    <?php foreach ($sales_info['prods'] as $prod): ?>
        <tr>
            <td><?php echo $prod['name']; ?></td>
            <td><?php echo $prod['quant']; ?></td>
            <td><?php echo number_format($prod['sale_price'], 2, ',', '.'); ?></td>
            <td><?php echo number_format($prod['sale_price'] * $prod['quant'], 2, ',', '.'); ?></td>
        </tr>


    <?php endforeach; ?>
</table>
<script type="text/javascript" src="<?php echo BASE_URL; ?>Assets/js/jquery.mask.js"></script> 
<script type="text/javascript" src="<?php echo BASE_URL; ?>Assets/js/script_sales_edit.js"></script>
<script>
startAdvances();
</script>