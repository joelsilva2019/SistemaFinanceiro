<h1>Clientes - adicionar</h1>

<form method="POST">
    <input type="text" name="name" placeholder="*Nome do Cliente" required/><br/><br/>
    <input type="email" name="email" placeholder="Email" /><br/><br/>
    <input type="text" name="phone" placeholder="Telefone" /><br/><br/>

    <label style="font-size: 17px;">*Estrelas do Cliente:</label><br/><br/>
    <select name="stars">

        <option value="1">1 estrela</option>  
        <option value="2">2 estrelas</option>  
        <option value="3" selected="selected">3 estrelas</option>  
        <option value="4">4 estrelas</option>  
        <option value="5">5 estrelas</option>  
    </select><br/><br/>

    <label style="font-size: 17px;">Observações Internas:</label><br/><br/>

    <textarea name="internal_obs">
        
    </textarea><br/><br/>

    <input type="text" name="address_zipcode" placeholder="Cep" /><br/><br/>
    <input type="text" name="address" placeholder="Endereço" /><br/><br/>
    <input type="text" name="address_number" placeholder="Número" /><br/><br/>
    <input type="text" name="address2" placeholder="Complemento" /><br/><br/>
    <input type="text" name="address_neighb" placeholder="Bairro" /><br/><br/>
    <input type="text" name="address_city" placeholder="Cidade" /><br/><br/>
    <input type="text" name="address_state" placeholder="Estado" /><br/><br/>
    <input type="text" name="address_country" placeholder="País" /><br/><br/>

    <input type="submit" value="Adicionar"/>
</form>
    <script type="text/javascript" src="<?php echo BASE_URL; ?>Assets/js/jquery.mask.js"></script> 
    <script type="text/javascript" src="<?php echo BASE_URL; ?>Assets/js/script_clients_add.js"></script>    








