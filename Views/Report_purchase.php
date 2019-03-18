<h1>Relatórios de Compra</h1>

<form method="GET" onsubmit="openPopUp(this);">
    <div class="report_filter">
        <strong>Nome do Vendedor</strong><br/>
        <input type="text" name="salesman_name"/> 
    </div>

    <div class="report_filter">
        <strong>Período</strong><br/>
        <input type="date" name="datep1"/><br/>
        <strong>Até</strong><br/>
        <input type="date" name="datep2"/>
    </div>


    <div class="report_filter">
        <select name="status">
            <option value="">Todos os status</option>
            <?php foreach ($status_name as $k => $v): ?>
                <option value="<?php echo $k; ?>"><?php echo $v; ?></option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="report_filter">
        <select name="order">
            <option value="date_desc">Mais recente</option>
            <option value="date_asc">Mais antigo</option>
            <option value="status">status da Compra</option>
        </select>
    </div>

    <div style="clear: both"></div> 

    <div style="text-align: center;">
        <input type="submit" value="Gerar relatório"/>
    </div> 

</form>

<script src="<?php echo BASE_URL; ?>Assets/js/script_report_purchase.js"></script>

