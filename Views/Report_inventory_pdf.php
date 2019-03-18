<style type="text/css">   
    th{text-align: left;}
</style>

<table width="100%" border="0">
    <tr>
        <th>Nome</th>
        <th>Categoria</th>
        <th>Preço</th>
        <th>Quantidade</th>
        <th>Quant.Min.</th>
    </tr>

<?php foreach ($inventory_list as $product): ?>
        <tr>
            <td><?php echo $product['name']; ?></td>
            <td><?php echo $product['category_name']; ?></td>
            <td>R$ <?php echo number_format($product['price'], 2, ',', '.'); ?></td>
            <td>              
                <?php
                if ($product['min_quant'] > $product['quant']) {
                    echo '<span style="color:red;">' . $product['quant'] . '</span>';
                } else {
                    echo $product['quant'];
                }
                ?>
            </td>
            <td><?php echo $product['min_quant']; ?></td>

<?php endforeach; ?>   
</table>


