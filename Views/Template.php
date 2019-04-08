
<!DOCTYPE html>
<html>
    <head>   
        <meta charset="UTF-8">
        <title><?php echo utf8_encode($viewData['company_name']); ?></title>
        <meta name="description" content="Sistema de controle financeiro e estoque para pequenas e médias empresas."/>
        <meta name="keywords" content="Sistema Finaceiro, Cadastro de clientes, Controle de vendas, Controle de Coompras, Estoque de Produtos."/>
        <meta name="author" content="Joel silva e silva - JS sites"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=1.0"/>
        <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
        <link href="<?php echo BASE_URL; ?>Assets/css/template.css" rel="stylesheet" />
        <script type="text/javascript" src="<?php echo BASE_URL; ?>Assets/js/jquery-3.3.1.min.js"></script>
        <script type="text/javascript">var BASE_URL = '<?php echo BASE_URL; ?>';</script>
        <script type="text/javascript" src="<?php echo BASE_URL; ?>Assets/js/script.js"></script>
    </head>

    <body>
        <div class="menu-mobile-area"><img src="<?php echo BASE_URL; ?>Assets/images/icon/category.png" width="40" height="40" class="menu-mobile" id="action" /></div>
        <section class="left_menu" id="menu-left">

            <section class="user_area">

                <div class="user_img">
                    <div class="radius-img">
                        <img src="<?php echo BASE_URL; ?>/Assets/images/users/<?php echo $viewData['user_image']; ?>" width="100"/>
                    </div>
                </div>
                <div class="user_email"><?php echo $viewData['user_email']; ?></div>
            </section>

            <nav class="menu_area">
                <ul>
                    <li><a href="<?php echo BASE_URL; ?>" title="Home">Home</a></li>
                    <li><a href="<?php echo BASE_URL; ?>Clients" title="Clientes">Clientes</a></li>
                    <li><a href="<?php echo BASE_URL; ?>Sales" title="Vendas">Vendas</a></li>
                    <li><a href="<?php echo BASE_URL; ?>Inventory" title="Estoque">Estoque</a></li>
                    <li><a href="<?php echo BASE_URL; ?>Category" title="Categorias">Categorias</a></li>
                    <li><a href="<?php echo BASE_URL; ?>Purchases" title="Compras">Compras</a></li>
                    <li><a href="<?php echo BASE_URL; ?>users" title="Usuários">Usuários</a></li>
                    <li><a href="<?php echo BASE_URL; ?>Permissions" title="Permissões">Permissões</a></li>
                    <li><a href="<?php echo BASE_URL; ?>Report" title="Relátorios">Relátorios</a></li>
                    <li><a href="<?php echo BASE_URL; ?>Invoice" title="Nota Fiscal">Nota Fiscal</a></li>
                    <li><a href="<?php echo BASE_URL; ?>Login/logout" title="Sair">Sair</a></li>
                </ul>
            </nav>
        </section>
        <main class="container">
            <div style="clear: both"></div>
            <div class="area">
                <?php $this->loadViewInTemplate($viewName, $viewData); ?>
            </div>
        </main>      
    </body>
</html>