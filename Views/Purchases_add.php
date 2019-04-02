<h1>Compras - Adicionar</h1>

<form method="POST">
    <?php if(!empty($erro)): ?>
    <div class="warn"><?php echo $erro; ?></div>
    <?php endif; ?>
    <input type="text" name="salesman" placeholder="Nome do vendedor" required /><br/><br/>
    
    <input type="text" name="total_price" placeholder="Preço Total 0,00" disabled="disabled"/><br/><br/>
    
    <label for="status">Status da Compra: </label><br/>
    <select name="status">
        <option value="0">Aguardando Pagament.</option>
        <option value="1">Pago</option>
        <option value="2">Cancelado</option>
    </select><br/><br/>
    
    <hr/>
    <fieldset>
        <legend>Adicionar Produto</legend>
        <input type="text" id="add_prod" data-type="search_inventory" autocomplete="off"/> 
    </fieldset><br/>
    <table width="100%" border="0" id="table_prod">
        <tr>
            <th>Nome</th>
            <th>Quant.</th>
            <th>Preço Unit.</th>
            <th>Sub-Total</th>
            <th>Excluir</th>
        </tr>
    </table><br/><br/>
    
    <input type="submit" value="Adicionar"/>
    
</form>

<script type="text/javascript" src="<?php echo BASE_URL; ?>Assets/js/script_purchases_add.js"></script>
<script type="text/javascript" src="<?php echo BASE_URL; ?>Assets/js/jquery.mask.js"></script> 


