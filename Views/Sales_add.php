<h1>Venda - Adicionar</h1>

<form method="POST">
    <?php if(!empty($erro)): ?>
    <div class="warn" style="color: #000066;"><?php echo $erro; ?></div>
    <?php endif; ?>
    <input type="hidden" name="client_id"/>
    <input type="text" name="client_name" id="client_name" data-type="search_clients" placeholder="Buscar Cliente" autocomplete="off" />   
    <button class="add_client" >+</button><br/><br/>
    
    <input type="text" name="total_price" placeholder="Preço Total 0,00" disabled="disabled"/><br/><br/>
    
    <label for="status">Status da venda: </label><br/>
    <select name="status">
        <option value="0">Aguardando Pagament.</option>
        <option value="1">Pago</option>
        <option value="2">Cancelado</option>
    </select><br/><br/>
    
    <label for="status_sale">Status da entrega: </label><br/>
    <select name="status_sale">
        <option value="0">Entregue</option>
        <option value="1">A entregar</option>
        <option value="2">A receber</option>
    </select><br/><br/>
    
    <hr/>
    <fieldset>
        <legend>Adicionar Produto</legend>
        <input type="text" id="add_prod" data-type="search_inventory" autocomplete="off"/> 
    </fieldset><br/>
    <table width="100%" border="0" id="table_prod" class="table-responsive">
        <tbody>
        <tr>
            <th>Nome</th>
            <th>Quant.</th>
            <th>Preço Unit.</th>
            <th>Sub-Total</th>
            <th>Excluir</th>
        </tr>
        </tbody>
    </table><br/><br/>
    
    <input type="submit" value="Adicionar"/>
    
</form>
<script type="text/javascript" src="<?php echo BASE_URL; ?>Assets/js/script_sales_add.js"></script>
<script type="text/javascript" src="<?php echo BASE_URL; ?>Assets/js/jquery.mask.js"></script> 