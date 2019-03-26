<h1>Compras do vendedor</h1>
<table width="100%" border="0">
    <tr>
        <th>Nome do Vendedor</th>
        <th>Data</th>
        <th>Status</th>
        <th>Preço Total</th>
        <th>Ações</th>
    </tr>

    <?php foreach ($purchases_salesman as $purchase): ?>

        <tr>
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
</table>
