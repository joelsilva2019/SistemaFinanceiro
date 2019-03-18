<h1>Estoque - Editar Produto</h1>

<form method="POST">
    <label>Nome do Produto</label><br/>
    <input type="text" name="name" value="<?php echo $inventory_info['name']; ?>" required/><br/><br/>
    <label>Categorias</label><br/>
    <select name="category">
        <?php foreach ($category_list as $category): ?>
        <option value="<?php echo $category['id']; ?>" <?php echo ($category['id'] == $inventory_info['id_category']) ? 'selected="selected"' : ''; ?>><?php echo $category['name']; ?></option>
        <?php endforeach; ?>
    </select><br/><br/>
    <label>Preço de venda</label><br/>
    <input type="text" name="price" value="<?php echo number_format($inventory_info['price'], 2); ?>" required/><br/><br/>
    <label>Preço de compra</label><br/>
    <input type="text" name="price_purchase" value="<?php echo number_format($inventory_info['price_purchase'], 2); ?>" required/><br/><br/>
    <label>Quantidade</label><br/>
    <input type="number" name="quant" value="<?php echo $inventory_info['quant']; ?>" required/><br/><br/>
    <label>Quantidade min.</label><br/>
    <input type="number" name="min_quant" value="<?php echo $inventory_info['min_quant']; ?>" required/><br/><br/>

    <input type="submit" value="Salvar"/>
</form>

    <script type="text/javascript" src="<?php echo BASE_URL; ?>Assets/js/jquery.mask.js"></script>    
    <script type="text/javascript" src="<?php echo BASE_URL; ?>Assets/js/iventory_add.js"></script>
