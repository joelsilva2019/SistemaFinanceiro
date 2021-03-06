
<?php if ($purchases_edit): ?>
    <a href="<?php echo BASE_URL; ?>Purchases/add"><div class="button">Adicionar Compra</div></a>
    
    <input type="text" id="search" data-type="search_purchases" autocomplete="off" />
<?php endif; ?>

<div class="tab_name">
    <div class="name_table">
    <h1>Compras da empresa</h1>
    <span>Aqui você pode gerenciar as compras da sua empresa</span>
    </div><br/>    
<table width="100%" border="0" class="table-responsive">
    <tbody>
    <tr>
        <th>Email do Usuário</th>
        <th>Nome do Vendedor</th>
        <th>Data</th>
        <th>Status</th>
        <th>Preço Total</th>
        <th>Ações</th>
    </tr>

    <?php foreach ($purchases_list as $purchase): ?>

        <tr>
            <td><?php echo $purchase['email']; ?></td>
            <td><?php echo $purchase['salesman']; ?></td>
            <td><?php echo date('d/m/Y', strtotime($purchase['date_purchase'])); ?></td>
            <td><?php echo $status_name[$purchase['status']]; ?></td>
            <td><?php echo number_format($purchase['total_price'], 2, ',', '.'); ?></td>
            <td width="80">
            <?php if ($purchases_edit): ?>
                <a href="<?php echo BASE_URL; ?>Purchases/edit/<?php echo $purchase['id']; ?>"><div class="button button_small">Editar</div></a>
            <?php endif; ?>
            </td>
           </tr>
        
    <?php endforeach; ?>
    </tbody>
</table>
</div>
    
<div class="pagination">
    <?php for ($i = 1; $i <= $p_count; $i++): ?>
        <div class="pag_item <?php echo ($i == $p) ? 'pag_select' : ''; ?>"><a href="<?php echo BASE_URL; ?>Purchases?p=<?php echo $i; ?>"><?php echo $i; ?></a></div>
    <?php endfor; ?>
</div>
<div style="clear: both;"></div>