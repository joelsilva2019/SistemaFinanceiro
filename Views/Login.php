
<html>
    <head>   
        <title>Login</title>
        <link href="<?php echo BASE_URL; ?>Assets/css/login.css" rel="stylesheet" />
    </head>

    <body>
        <div class="loginarea">
            <img src="<?php echo BASE_URL; ?>Assets/images/logo.png" width="260">
            <form method="POST">
                <input type="email" name="email" placeholder="Digite aqui seu email"/>
                <input type="password" name="password" placeholder="Digite aqui sua senha"/>
                <input type="submit" value="Enviar"/>
                    <?php if (!empty($erro)): ?>
                       <div class="warning"><?php echo $erro; ?></div>
                   <?php endif; ?>
            </form>
        </div>
    </body>
</html>

