<h1>Compras - Editar</h1>

<strong>Usuário: </strong><br/>
<?php echo $purchase_info['info']['user_email']; ?><br/><br/>

<strong>Nome do Vendedor: </strong><br/>
<?php echo $purchase_info['info']['salesman']; ?><br/><br/>
<strong>Data da Compra: </strong><br/>
<?php echo date('d/m/Y', strtotime($purchase_info['info']['date_purchase'])); ?><br/><br/>

<strong>Preço total da Compra: </strong><br/>
R$ <?php echo number_format($purchase_info['info']['total_price'], 2, ',','.'); ?><br/><br/>

<strong>Status: </strong><br/>

<?php if($purchases_edit): ?>
<form method="POST">
    <select name="status">
        <?php foreach ($status_name as $k => $v): ?>
        <option value="<?php echo $k; ?>" <?php echo ($k == $purchase_info['info']['status']) ? 'selected="selected"' : ''; ?>><?php echo $v; ?></option>
        <?php endforeach; ?>
    </select><br/><br/>

<?php else: ?>
<?php echo $status_name[$purchase_info['info']['status']]; ?>
<?php endif; ?>
<hr/>
<fieldset>
<legend>Adicionar Produto</legend>
        <input type="text" id="add_prod" data-type="search_inventory" autocomplete="off"/> 
</fieldset><br/>

<h3>Produtos da Compra: </h3>

<table width="100%" border="0" id="table_prod">
    <tr>
        <th>Nome do Produto</th>
        <th>Quantidade</th>
        <th>Preço Unitário</th>
        <th>Preço Total</th>
    </tr>
<?php foreach ($purchase_info['prods'] as $prod): ?>
    <tr>
        <td><?php echo $prod['name']; ?></td>
        <td><input type="number" name="quant[<?php echo $prod['id_product']; ?>]" value="<?php echo $prod['quant']; ?>" onchange="updateSubtotal(this);" data-price="<?php echo $prod['purchase_price']; ?>"/></td>
        <td><?php echo number_format($prod['purchase_price'], 2, ',','.'); ?></td>
        <td class="sub_total"><?php echo number_format($prod['purchase_price'] * $prod['quant'],2,',','.'); ?></td>
        <td><a href="<?php echo BASE_URL; ?>Purchases/delete_prod/<?php echo $prod['id_product']; ?>/<?php echo $purchase_info['info']['id']; ?>" class="button button_small">Excluir</a></td>
    </tr>


<?php endforeach; ?>
</table><br/><br/>
  <input type="submit" value="Salvar"/>
</form>
<script type="text/javascript" src="<?php echo BASE_URL; ?>Assets/js/script_purchases_edit.js"></script>

