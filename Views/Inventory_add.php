<h1>Estoque - Adicionar Produto</h1>

<form method="POST">
    
    <input type="text" name="name" placeholder="*Nome do Produto" required/><br/><br/>
    <select name="category">
        <?php foreach ($category_list as $category): ?>
        <option value="<?php echo $category['id']; ?>"><?php echo $category['name']; ?></option>
        <?php endforeach; ?>
    </select><br/><br/>
    
    <label><strong>Forma de Venda:</strong></label><br/>
    <select name="sale_style">
        <option>Peça</option>
        <option>Metro</option>
        <option>Lata</option>
        <option>Saco</option>
        <option>Kg</option>
        <option>Gramas</option>
    </select><br/><br/>
    
    <input type="text" name="price" placeholder="*Preço de venda 0,00" required/><br/><br/>
    <input type="text" name="price_purchase" placeholder="*Preço de compra 0,00" required/><br/><br/>
    <input type="number" name="prod_code" placeholder="Código do produto" required /><br/><br/>
    <input type="number" name="quant" placeholder="*Quantidade em estoque" required/><br/><br/>
    <input type="number" name="min_quant" placeholder="*Quantidade Mínima em estoque" required/><br/><br/>

    <input type="submit" value="Adicionar"/>
</form>
   
    <script type="text/javascript" src="<?php echo BASE_URL; ?>Assets/js/jquery.mask.js"></script>    
    <script type="text/javascript" src="<?php echo BASE_URL; ?>Assets/js/iventory_add.js"></script>










