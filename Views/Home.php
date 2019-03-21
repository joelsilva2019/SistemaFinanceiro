<div class="notification_temp">
    <a href="<?php echo BASE_URL; ?>Home/history"><div class="notification_count">
            <?php echo $history_inventory_count; ?>
        </div>
        <div class="notification"/>
        <img src="<?php echo BASE_URL; ?>/Assets/images/notification.png" width="15"/>
</div>
</a>
</div>
<div class="db-row row1">
    <div class="grid-1">
        <div class="db-grid-area">
            <div class="db-area-count"><?php echo $products_sold; ?></div>
        <div class="db-area-legend">Produtos vendidos</div>
    </div>
    </div>
    
    
    <div class="grid-1">
        <div class="db-grid-area">
            <div class="db-area-count">R$ <?php echo number_format($revenue, 2,",","."); ?></div>
        <div class="db-area-legend">Receitas</div>
    </div>
    </div>
    
   
    <div class="grid-1">
        <div class="db-grid-area">
        <div class="db-area-count">R$ <?php echo number_format($expanses, 2,",","."); ?></div>
        <div class="db-area-legend">Despesas</div>
    </div>
    </div> 
</div>

<div class="db-row row2">
    <div class="grid-2">
        <div class="db-info">
            <div class="db-info-title"><strong>Relátorio de despesas dos ultimos 30 dias</strong></div>
            <div class="db-info-body">
                <canvas id="rel3"></canvas>
            </div>
        </div>
    </div>
    <div class="grid-1">
        <div class="db-info">
            <div class="db-info-title"><strong>Status de compras</strong></div>
            <div class="db-info-body"><canvas id="rel4" height="314"></canvas></div>
        </div>
    </div>
</div>

<div class="db-row row2">
    <div class="grid-2">
        <div class="db-info">
            <div class="db-info-title"><strong>Relátorio de receitas dos ultimos 30 dias</strong></div>
            <div class="db-info-body">
                <canvas id="rel1"></canvas>
            </div>
        </div>
    </div>
    <div class="grid-1">
        <div class="db-info">
            <div class="db-info-title"><strong>Status de vendas</strong></div>
            <div class="db-info-body">
                <canvas id="rel2" height="314"></canvas></div>
        </div>
    </div>
</div>

<script type="text/javascript">
var days_list = <?php echo json_encode($days_list); ?>;
var revenue_list = <?php echo json_encode(array_values($revenue_list)); ?>;
var expanses_list = <?php echo json_encode(array_values($expanses_list)); ?>;
var status_name_list = <?php echo json_encode(array_values($status_name)); ?>;
var status_list = <?php echo json_encode(array_values($status_list)); ?>;
var status_purchase_list = <?php echo json_encode(array_values($status_purchase_list)); ?>
</script>
<script type="text/javascript" src="<?php echo BASE_URL ?>Assets/js/Chart.min.js"></script>
<script type="text/javascript" src="<?php echo BASE_URL ?>Assets/js/script_home.js"></script>










