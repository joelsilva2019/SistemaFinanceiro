
<?php if($sales_edit): ?>
    <a href="<?php echo BASE_URL; ?>Sales/add"><div class="button">Adicionar Venda</div></a>
    
    <input type="text" id="search" data-type="search_sales" autocomplete="off"/>
<?php endif; ?>

<div class="tab_name">
    <div class="name_table">
    <h1>Produtos Vendidos</h1>
    <span>Aqui você pode gerenciar os produtos da sua empresa</span>
    </div><br/>

<table width="100%" border="0" cellspacing="0" class="table-responsive">
    <tbody>
    <tr>
        <th>Nome do Cliente</th>
        <th>Data</th>
        <th>Status da venda</th>
        <th>Status de entrega</th>
        <th>Preço Total</th>
        <th>Ações</th>
    </tr>

    <?php foreach ($sales_list as $sale): ?>
    <tr>
        <td><?php echo ($sale['name'] != '' ? $sale['name'] : 'Desconhecido'); ?></td>
        <td><?php echo date('d/m/Y', strtotime($sale['date_sale'])); ?></td>
        <td><?php echo $status_name[$sale['status']]; ?></td>
        <td><?php echo $status_sale_name[$sale['status_sale']]; ?></td>
        <td>R$ <?php echo number_format($sale['total_price'], 2, ',','.'); ?></td>
        <td width="230">
        <?php if($sales_edit): ?>
           <a href="<?php echo BASE_URL; ?>Sales/edit/<?php echo $sale['id']; ?>"><div class="button button_small">Editar</div></a>
           <a href="<?php echo BASE_URL; ?>Invoice/invoice_sale/<?php echo $sale['id']; ?>"><div class="button button_small">Emitir nota Fiscal</div></a>
        <?php endif; ?>
        </td>
    </tr>    
    <?php endforeach; ?>
    </tbody>
</table>
</div>    
    
    <div class="pagination">
            <?php for($i=1;$i<=$p_count; $i++): ?>
            <div class="pag_item <?php echo ($i == $p) ? 'pag_select': ''; ?>"><a href="<?php echo BASE_URL; ?>Sales?p=<?php echo $i; ?>"><?php echo $i; ?></a></div>
            <?php endfor; ?>
        </div>
    <div style="clear: both;"></div>