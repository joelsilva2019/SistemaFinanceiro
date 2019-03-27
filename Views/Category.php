<h1>Categorias</h1>

 <?php if($category_edit): ?>
        <a href="<?php echo BASE_URL; ?>Category/add"><div class="button">Adicionar Categoria</div></a>
        
        <input type="text" id="search" data-type="search_category"/>
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
        
    <div class="pagination">
            <?php for($i=1;$i<=$p_count; $i++): ?>
            <div class="pag_item <?php echo ($i == $p) ? 'pag_select': ''; ?>"><a href="<?php echo BASE_URL; ?>Category?p=<?php echo $i; ?>"><?php echo $i; ?></a></div>
            <?php endfor; ?>
    </div>
        <div style="clear: both;"></div>

