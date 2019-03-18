<h1>Clientes - Visualizar</h1>

<strong>Nome:</strong><br/>
<?php echo $client_info['name']; ?><br/><br/>

<?php if(!empty($client_info['email'])): ?>
<strong>Email:</strong><br/>
<?php echo $client_info['email']; ?><br/><br/>
<?php endif; ?>

<?php if(!empty($client_info['phone'])): ?>
<strong>Telefone:</strong><br/>
<?php echo $client_info['phone']; ?><br/><br/>
<?php endif; ?>

<?php if(!empty($client_info['address'])): ?>
<strong>Endereço:</strong><br/>
<?php echo $client_info['address']; ?><br/><br/>
<?php endif; ?>

<?php if(!empty($client_info['address_number'])): ?>
<strong>Número:</strong><br/>
<?php echo $client_info['address_number']; ?><br/><br/>
<?php endif; ?>

<?php if(!empty($client_info['address2'])): ?>
<strong>Complemento:</strong><br/>
<?php echo $client_info['address2']; ?><br/><br/>
<?php endif; ?>

<?php if(!empty($client_info['address_neighb'])): ?>
<strong>Bairro:</strong><br/>
<?php echo $client_info['address_neighb']; ?><br/><br/>
<?php endif; ?>

<?php if(!empty($client_info['address_city'])): ?>
<strong>Cidade:</strong><br/>
<?php echo $client_info['address_city']; ?><br/><br/>
<?php endif; ?>

<?php if(!empty($client_info['address_state'])): ?>
<strong>Estado:</strong><br/>
<?php echo $client_info['address_state']; ?><br/><br/>
<?php endif; ?>

<?php if(!empty($client_info['address_country'])): ?>
<strong>País:</strong><br/>
<?php echo $client_info['address_country']; ?><br/><br/>
<?php endif; ?>

<?php if(!empty($client_info['address_zipcode'])): ?>
<strong>Cep:</strong><br/>
<?php echo $client_info['address_zipcode']; ?><br/><br/>
<?php endif; ?>

<?php if(!empty($client_info['stars'])): ?>
<strong>Estrelas:</strong><br/>
<?php echo $client_info['stars']; ?><br/><br/>
<?php endif; ?>

<?php if($client_info['internal_obs'] != ''): ?>
<strong>Observaçoes Internas:</strong><br/>
<?php echo '<p>'.$client_info['internal_obs'].'</p>'; ?><br/><br/>
<?php endif;