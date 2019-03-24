<h1>Grupos - Editar grupo de permissões</h1>

<form method="POST">

    <input type="text" name="group" value="<?php echo $info_group['name']; ?>"/><br/><br/>  
    <label>Permissões</label><br/>
    <input type="checkbox" id="checkTodos"/> Selecionar todas<br/><br/>
    
    <?php foreach ($permissions_list as $permission): ?>
        <div class="p_item">
            <input type="checkbox" name="permissions[]" value="<?php echo $permission['id']; ?>" id="p_<?php echo $permission['id']; ?>" <?php echo (in_array($permission['id'],$info_group['params'])) ? 'checked="checked"': ''; ?> />
            <label for="p_<?php echo $permission['id']; ?>"><?php echo $permission['name']; ?></label><br/>
        </div>  
    <?php endforeach; ?><br/><br/>

    <input type="submit" value="Editar"/>
</form>

