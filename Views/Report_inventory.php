<h1>Relatórios de Estoque</h1>

<form method="GET" onsubmit="openPopUp(this);">
    
    <select name="category">
        <option value="">Todas as categorias</option>
        <?php foreach ($category_list as $category): ?>
        <option value="<?php echo $category['id']; ?>"><?php echo $category['name']; ?></option>
        <?php endforeach; ?>
    </select>
    
    <div style="text-align: center; margin-top: 30px; ">
        <input type="submit" value="Gerar relatório de produtos em baixa no estoque"/>
    </div> 

</form>

<script src="<?php echo BASE_URL; ?>Assets/js/script_report_inventory.js"></script>

