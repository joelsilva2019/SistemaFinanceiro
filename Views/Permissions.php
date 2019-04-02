
<div class="tab_area">
    <div class="tab_item action_tab">Grupos de Permissões</div>
    <div class="tab_item">Permissões</div>    
</div>
<div class="tab_content">
    <div class="tab_body" style="display: block">
        <a href="<?php echo BASE_URL; ?>Permissions/addGroup"><div class="button">Adicionar Grupo de Permissões</div></a>
    
    <div class="tab_name">
    <div class="name_table">
    <h1>Grupo de permissões</h1>
    <span>Aqui você pode gerenciar os grupos de permissão do sistema</span>
    </div><br/>
        <table width="100%" border="0" class="table-responsive">
            <tbody>
            <tr>
                <th>Nome do Grupo</th>
                <th>Ações</th>
            </tr>

            <?php foreach ($permissions_list_group as $item): ?>

                <tr>
                    <td><?php echo $item['name']; ?></td>
                    <td width="160">
                        <a href="<?php echo BASE_URL; ?>Permissions/editGroup/<?php echo $item['id']; ?>">
                            <div class="button button_small">Editar</div></a>

                        <a href="<?php echo BASE_URL; ?>Permissions/deleteGroup/<?php echo $item['id']; ?>" 
                           onclick="return confirm('Tem certeza que deseja excluir ?')">
                            <div class="button button_small">Excluir</div></a>
                    </td>
                </tr>

            <?php endforeach; ?>
            </tbody>
        </table>
    </div>        
    </div>
    
    <div class="tab_body">
        <a href="<?php echo BASE_URL; ?>Permissions/add"><div class="button">Adicionar Permissão</div></a>
        
    <div class="tab_name">
    <div class="name_table">
    <h1>Permissões de usuários</h1>
    <span>Aqui você pode gerenciar as permissões do sistema</span>
    </div><br/>
        <table width="100%" border="0" class="table-responsive">
            <tbody>
            <tr>
                <th>Nome da Permissão</th>
                <th>Ações</th>
            </tr>

            <?php foreach ($permissions_list as $item): ?>

                <tr>
                    <td><?php echo $item['name']; ?></td>
                    <td width="50">
                        <a href="<?php echo BASE_URL; ?>Permissions/delete/<?php echo $item['id']; ?>" 
                           onclick="return confirm('Tem certeza que deseja excluir ?')"><div class="button button_small">Excluir</div></a>
                    </td>
                </tr>

            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    </div>
</div>

