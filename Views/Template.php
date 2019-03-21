<!DOCTYPE html>
<html>
    <head>   
        <meta charset="UTF-8">
        <title><?php echo utf8_encode($viewData['company_name']); ?></title>
        <link href="<?php echo BASE_URL; ?>Assets/css/template.css" rel="stylesheet" />
        <script type="text/javascript" src="<?php echo BASE_URL; ?>Assets/js/jquery-3.3.1.min.js"></script>
        <script type="text/javascript">var BASE_URL = '<?php echo BASE_URL; ?>';</script>
        <script type="text/javascript" src="<?php echo BASE_URL; ?>Assets/js/script.js"></script>
    </head>

    <body>
        <div class="left_menu">
            <div class="menu_area">
                <ul>
                    <li><a href="<?php echo BASE_URL; ?>">Home</a></li>
                    <li><a href="<?php echo BASE_URL; ?>Clients">Clientes</a></li>
                    <li><a href="<?php echo BASE_URL; ?>Sales">Vendas</a></li>
                    <li><a href="<?php echo BASE_URL; ?>Inventory">Estoque</a></li>
                    <li><a href="<?php echo BASE_URL; ?>Category">Categorias</a></li>
                    <li><a href="<?php echo BASE_URL; ?>Purchases">Compras</a></li>
                    <li><a href="<?php echo BASE_URL; ?>users">Usuários</a></li>
                    <li><a href="<?php echo BASE_URL; ?>Permissions">Permissões</a></li>
                    <li><a href="<?php echo BASE_URL; ?>Report">Relátorios</a></li>
                    <li><a href="<?php echo BASE_URL; ?>Login/logout">Sair</a></li>
                </ul>
            </div>
        </div>
            <div class="container">
            <div style="clear: both"></div>
            <div class="area">
                <?php $this->loadViewInTemplate($viewName,$viewData); ?>
            </div>
        </div>      
    </body>
</html>