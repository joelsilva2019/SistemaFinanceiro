<h1>Categorias</h1>

 <?php if($category_add): ?>
        <a href="<?php echo BASE_URL; ?>Category/add"><div class="button">Adicionar Categoria</div></a>
        <?php endif; ?>
        
        <table width="100%" border="0">
            <tr>
                <th>Nome</th>
                <th>Ações</th>
            </tr>

            <?php foreach ($category_list as $category): ?>

                <tr>
                    <td><?php echo $category['name']; ?></td>
                    
                    <td style="text-align: center;" width="160">
                        <?php if($category_edit): ?>
                        <a href="<?php echo BASE_URL; ?>Category/edit/<?php echo $category['id']; ?>">
                            <div class="button button_small">Editar</div></a>

                        <a href="<?php echo BASE_URL; ?>Category/delete/<?php echo $category['id']; ?>" 
                           onclick="return confirm('Tem certeza que deseja excluir ?, você irá apagar todos os produtos dessa categoria.')">
                            <div class="button button_small">Excluir</div></a>
                        <?php endif; ?>     
                    </td>
                </tr>

            <?php endforeach; ?>
        </table>

