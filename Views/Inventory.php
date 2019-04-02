
<?php if ($inventory_edit): ?>
    <a href="<?php echo BASE_URL; ?>Inventory/add"><div class="button">Adicionar Produto</div></a>

<input type="text" id="search" data-type="search_inventory" autocomplete="off" />
<?php endif; ?>

<div class="tab_name">
    <div class="name_table">
    <h1>Controle de estoque</h1>
    <span>Aqui você pode gerenciar os produtos da sua empresa</span>
    </div><br/>
<table width="100%" border="0" class="table-responsive">
    <tbody>
    <tr>
        <th>Nome</th>
        <th>Categoria</th>
        <th>Preço</th>
        <th>Preço de compra</th>
        <th>Quantidade</th>
        <th>Quant.Min.</th>
        <th>Ações</th>
    </tr>

    <?php foreach ($inventory_list as $product): ?>
        <tr>
            <td width="200"><?php echo $product['name']; ?></td>
            <td><?php echo $product['category_name']; ?></td>
            <td width="110">R$ <?php echo number_format($product['price'], 2, ',', '.'); ?></td>
            <td width="110">R$ <?php echo number_format($product['price_purchase'], 2, ',', '.'); ?></td>
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
            <td width="160">
                <?php if ($inventory_edit): ?>
                    <a href="<?php echo BASE_URL; ?>Inventory/edit/<?php echo $product['id']; ?>">
                        <div class="button button_small">Editar</div></a>

                    <a href="<?php echo BASE_URL; ?>Inventory/delete/<?php echo $product['id']; ?>" 
                       onclick="return confirm('Tem certeza que deseja excluir ?')">
                       <div class="button button_small">Excluir</div></a>
                <?php endif; ?>       
                </td>
        </tr>
    <?php endforeach; ?><br/>
</tbody>
</table>    
</div>
        <div class="pagination">
            <?php for($i=1;$i<=$p_count; $i++): ?>
            <div class="pag_item <?php echo ($i == $p) ? 'pag_select': ''; ?>"><a href="<?php echo BASE_URL; ?>Inventory?p=<?php echo $i; ?>"><?php echo $i; ?></a></div>
            <?php endfor; ?>
        </div>
        <div style="clear: both;"></div>


