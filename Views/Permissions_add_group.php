<h1>Permissões - Adicionar Grupo de permissões</h1>

<form method="POST">

    <input type="text" name="group" placeholder="Nome do grupo"/><br/><br/>
    <label>Permissões</label><br/>
    <input type="checkbox" id="checkTodos"/> Selecionar todas<br/><br/>
    
    <?php foreach ($permissions_list as $permission): ?>
        <div class="p_item">
            <input type="checkbox" name="permissions[]" value="<?php echo $permission['id']; ?>" id="p_<?php echo $permission['id']; ?>"/>
            <label for="p_<?php echo $permission['id']; ?>"><?php echo $permission['name']; ?></label><br/>
        </div>  
    <?php endforeach; ?><br/><br/>

    <input type="submit" value="Adicionar"/>
</form>

