<h1>Clientes - Editar</h1>

<form method="POST">
    <input type="text" name="name" value="<?php echo $client_info['name']; ?>" required placeholder="*Nome"/><br/><br/>
    <input type="email" name="email" value="<?php echo $client_info['email']; ?>" placeholder="E-mail"/><br/><br/>
    <input type="text" name="phone" value="<?php echo $client_info['phone']; ?>" placeholder="Telefone"/><br/><br/>

    <label style="font-size: 17px;">*Estrelas do Cliente:</label><br/><br/>
    <select name="stars">

        <option value="1" <?php echo ($client_info['stars'] == '1') ? 'selected="selected"':''; ?> >1 estrela</option>  
        <option value="2" <?php echo ($client_info['stars'] == '2') ? 'selected="selected"':''; ?> >2 estrelas</option>  
        <option value="3" <?php echo ($client_info['stars'] == '3') ? 'selected="selected"':''; ?> >3 estrelas</option>  
        <option value="4" <?php echo ($client_info['stars'] == '4') ? 'selected="selected"':''; ?> >4 estrelas</option>  
        <option value="5" <?php echo ($client_info['stars'] == '5') ? 'selected="selected"':''; ?> >5 estrelas</option>  
    </select><br/><br/>

    <label style="font-size: 17px;">Observações Internas:</label><br/><br/>

    <textarea name="internal_obs">
        <?php echo $client_info['internal_obs']; ?>
    </textarea><br/><br/>

    <input type="text" name="address_zipcode" value="<?php echo $client_info['address_zipcode']; ?>" placeholder="Cep" /><br/><br/>
    <input type="text" name="address" value="<?php echo $client_info['address']; ?>" placeholder="Endereço" /><br/><br/>
    <input type="text" name="address_number" value="<?php echo $client_info['address_number']; ?>"placeholder="Número" /><br/><br/>
    <input type="text" name="address2" value="<?php echo $client_info['address2']; ?>" placeholder="Complemento" /><br/><br/>
    <input type="text" name="address_neighb" value="<?php echo $client_info['address_neighb']; ?>" placeholder="Bairro" /><br/><br/>
    <input type="text" name="address_city" value="<?php echo $client_info['address_city']; ?>" placeholder="Cidade" /><br/><br/>
    <input type="text" name="address_state" value="<?php echo $client_info['address_state']; ?>" placeholder="Estado" /><br/><br/>
    <input type="text" name="address_country" value="<?php echo $client_info['address_country']; ?>" placeholder="País" /><br/><br/>

    <input type="submit" value="Editar"/>
</form>
    <script type="text/javascript" src="<?php echo BASE_URL; ?>Assets/js/jquery.mask.js"></script> 
    <script type="text/javascript" src="<?php echo BASE_URL; ?>Assets/js/script_clients_add.js"></script>    