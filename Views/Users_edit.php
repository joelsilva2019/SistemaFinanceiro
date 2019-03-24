<h1>Usuários - Editar</h1>

<form method="POST" enctype="multipart/form-data">
    <label>Email</label><br/>
    
    <?php echo (!empty($user_info['email'])) ? $user_info['email'] : ''; ?><br/><br/>
    <input type="password" name="password" placeholder="Atualizar senha" /><br/><br/>
    <label>Grupos de Permissão:</label><br/>
    <select name="groups">
        <?php foreach ($group_list as $group): ?>
        <option value="<?php echo $group['id']; ?>" <?php echo ($group['id'] == $user_info['id_group']) ? 'selected="selected"': ''; ?> ><?php echo $group['name']; ?></option>
        <?php endforeach; ?>
    </select><br/><br/>
    
    <div class='input-wrapper'>
        <label for='input-file'>
             Editar a foto do usuário
        </label>
        <input id='input-file' type='file' name="image"/>
        <span id='file-name'></span>
    </div><br/><br/>
    
    <input type="submit" value="Editar"/>
</form>

