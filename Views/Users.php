<h1>Usuários</h1>
         <?php if($user_edit): ?>
        <a href="<?php echo BASE_URL; ?>Users/add"><div class="button">Adicionar Usuário</div></a>
        
        <input type="text" id="search" data-type="search_users"/>
        <?php endif; ?>
        <table width="100%" border="0">
            <tr>
                <th>Email</th>
                <th>Grupo de Permissões</th>
                <th>Ações</th>
            </tr>

            <?php foreach ($user_list as $user): ?>

                <tr>
                    <td><?php echo $user['email']; ?></td>
                    <td><?php echo $user['name']; ?></td>
                    <td width="160">
                    <?php if($user_edit): ?>
                        <a href="<?php echo BASE_URL; ?>Users/edit/<?php echo $user['id']; ?>">
                        <div class="button button_small">Editar</div></a>

                        <a href="<?php echo BASE_URL; ?>Users/delete/<?php echo $user['id']; ?>" 
                        onclick="return confirm('Tem certeza que deseja excluir ?')">
                        <div class="button button_small">Excluir</div></a>
                    <?php endif; ?>
                    </td>
                </tr>

            <?php endforeach; ?>
        </table>
    
    <div class="pagination">
            <?php for($i=1;$i<=$p_count; $i++): ?>
            <div class="pag_item <?php echo ($i == $p) ? 'pag_select': ''; ?>"><a href="<?php echo BASE_URL; ?>Users?p=<?php echo $i; ?>"><?php echo $i; ?></a></div>
            <?php endfor; ?>
        </div>
    <div style="clear: both;"></div>   