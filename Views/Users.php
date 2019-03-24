<h1>Usuários</h1>
         <?php if($user_edit): ?>
        <a href="<?php echo BASE_URL; ?>Users/add"><div class="button">Adicionar Usuário</div></a>
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
    