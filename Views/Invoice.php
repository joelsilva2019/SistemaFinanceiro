<div class="tab_name">
    <div class="name_table">
        <h1>Emitir Nota Fiscal</h1>
    </div>
    
    <form>
        <div class="nfe_info">
            <h2>Informaçoes da nota fiscal</h2>
            
            <label>Tipo de Operação da NF-e</label>
            <select name="type_op_nfe">
                <option value="0">Entrada</option>
                <option value="1">Saída</option>
            </select><br/><br/>
            
            <label>Natureza de Operação da NF-e</label>
            <select name="type_nfe">
                <option value="venda">Venda</option>
                <option value="compra">Compra</option>
                <option value="transferência">Transferência</option>
                <option value="devolução">Devolução</option>
                <option value="importação">Importação</option>
                <option value="consignação">Consignação</option>
                <option value="remessa">Remessa</option>
            </select><br/><br/>
            
        </div>    
        
    <div class="issuer_nfe">
    <h2>Emitente</h2>
    <input style="width: 30%;float: left;margin-left: 10px;" type="text" name="issuer_cnpj" class="issuer_cnpj" placeholder="CNPJ"/>
    <input style="width: 30%;float: left;margin-left: 10px;;" type="text" name="issuer_social_reason" placeholder="Razão Social"/>
    <input style="width: 30%;float: left;margin-left: 10px;" type="text" name="issuer_trading_name" placeholder="Nome Fantasia"/>
    <input style="width: 30%;float: left;margin-left: 10px;" type="text" name="issuer_zipcode" placeholder="Cep"/>
    <input style="width: 30%;float: left;margin-left: 10px;margin-top: 5px;" type="text" name="issuer_address" placeholder="Endereço"/>
    <input style="width: 30%;float: left;margin-left: 10px;margin-top: 5px;" type="text" name="issuer_number" placeholder="Número"/>
    <input style="width: 30%;float: left;margin-left: 10px;margin-top: 5px;" type="text" name="issuer_neighbor" placeholder="Bairro"/>
    <input style="width: 30%;float: left;margin-left: 10px;margin-top: 5px;" type="text" name="issuer_city" placeholder="Cidade"/>
    <input style="width: 30%;float: left;margin-left: 10px;margin-top: 5px;" type="text" name="issuer_state" placeholder="Estado"/>
    <input style="width: 30%;float: left;margin-left: 10px;margin-top: 5px;" type="text" name="issuer_phone" placeholder="Telefone"/>
    <input style="width: 30%;margin-left: 10px;margin-top: 5px;" type="text" name="issuer_email" placeholder="E-mail"/>
    <input style="width: 30%;margin-left: 10px;margin-top: 5px;" type="text" name="issuer_register" placeholder="Inscrição Estadual"/><br/><br/>
    <label> Regime Tributário: </label><br/>
    <select name="issuer_crt" style="width: 50%;">
        <option value="1">Simples Nacional</option>
        <option value="2">Simples Nacional – excesso de sublimite da receita bruta</option>
        <option value="3">Regime Normal</option>
    </select>
    </div>
        
    <div class="client_nfe">
    <h2>Destinatário</h2>
    <input style="width: 30%;float: left;margin-left: 10px;" type="text" name="client_cpf_cnpj" placeholder="CNPJ ou CPF"/>
    <input style="width: 30%;float: left;margin-left: 10px;;" type="text" name="client_name" placeholder="Razão Social ou nome completo"/>
    <input style="width: 30%;float: left;margin-left: 10px;" type="text" name="client_zipcode" placeholder="Cep"/>
    <input style="width: 30%;float: left;margin-left: 10px;margin-top: 5px;" type="text" name="client_address" placeholder="Endereço"/>
    <input style="width: 30%;float: left;margin-left: 10px;margin-top: 5px;" type="text" name="client_number" placeholder="Número"/>
    <input style="width: 30%;float: left;margin-left: 10px;margin-top: 5px;" type="text" name="client_complement" placeholder="Complemento"/>
    <input style="width: 30%;float: left;margin-left: 10px;margin-top: 5px;" type="text" name="client_neighbor" placeholder="Bairro"/>
    <input style="width: 30%;float: left;margin-left: 10px;margin-top: 5px;" type="text" name="client_city" placeholder="Cidade"/>
    <input style="width: 30%;float: left;margin-left: 10px;margin-top: 5px;" type="text" name="client_state" placeholder="Estado"/>
    <input style="width: 30%;float: left;margin-left: 10px;margin-top: 5px;" type="text" name="client_ddd" placeholder="DDD"/>
    <input style="width: 30%;float: left;margin-left: 10px;margin-top: 5px;" type="text" name="client_phone" placeholder="Telefone"/>
    <input style="width: 30%;margin-left: 10px;margin-top: 5px;" type="text" name="client_email" placeholder="E-mail"/><br/>
    <input type="radio" name="client_icms"/>Contribuinte ICMS
    <input type="radio" name="client_icms"/>Não Contribuinte
    <input style="width: 30%;margin-left: 10px;margin-top: 5px;" type="text" name="client_register" placeholder="Inscrição Estadual"/>
</div><br/><br/>

<div class="prods_nfe">
    
    <h2>Produtos</h2>
    <table class="table-responsive" width="80%">
        <tbody>
        <tr>
            <th>Nome</th>
            <th>Código do Produto</th>
            <th>Quantidade</th>
            <th>Unidade</th>
            <th>Preço</th>
            <th>Subtotal</th>
        </tr>
        <?php foreach ($sale_info_prods['prods'] as $prod): ?>
        <tr>
            <td><?php echo $prod['name']; ?></td>
            <td><?php echo $prod['prod_code']; ?></td>
            <td><?php echo $prod['quant']; ?></td>
            <td><?php echo $prod['sale_style']; ?></td>
            <td><?php echo $prod['sale_price']; ?></td>
            <td><?php echo ($prod['sale_price'] * $prod['quant']); ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
    </table>
        <div class="total-price">
            <span>Total da compra:</span>
           R$ <?php echo number_format($sale_info_prods['info']['total_price'], 2, ',', '.'); ?>
        </div>
   
</div>
    
        <input type="submit" value="Emitir nota fiscal"/><br/><br/>
    </form>
    <div style="clear: both;"></div> 
</div>
<script type="text/javascript" src="<?php echo  BASE_URL; ?>/Assets/js/script_invoice.js"></script>