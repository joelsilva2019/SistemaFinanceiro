<h1>Usuários - Adicionar</h1>

<?php if (!empty($erro_msg)): ?>
<div class="warn"><?php echo $erro_msg; ?></div>
<?php endif; ?>

<form method="POST" enctype="multipart/form-data">
    <input type="email" name="email" placeholder="Email do usuário" required /><br/><br/>
    <input type="password" name="password" placeholder="Senha para o usuário" required /><br/><br/>
    <label>Grupos de Permissão:</label><br/>
    <select name="groups">
        <?php foreach ($group_list as $group): ?>
            <option value="<?php echo $group['id']; ?>"><?php echo $group['name']; ?></option>
        <?php endforeach; ?>
    </select><br/><br/>

    <div class='input-wrapper'>
        <label for='input-file'>
            Selecionar uma foto para o usuário
        </label>
        <input id='input-file' type='file' name="image"/>
        <span id='file-name'></span>
    </div><br/><br/>


    <input type="submit" value="Adicionar"/>
</form>