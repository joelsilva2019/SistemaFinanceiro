<h1>Clientes</h1>
         
        <?php if($has_permission): ?>
        <a href="<?php echo BASE_URL; ?>Clients/add"><div class="button">Adicionar Clientes</div></a>
        <?php endif; ?>
        <input type="text" id="search" data-type="search_clients"/>
        <table width="100%" border="0">
            <tr>
                <th>Nome</th>
                <th>Telefone</th>
                <th>Cidade</th>
                <th>Estrelas</th>
                <th>Ações</th>
            </tr>

            <?php foreach ($clients_list as $client): ?>

                <tr>
                    <td><?php echo $client['name']; ?></td>
                    <td width="150"><?php echo $client['phone']; ?></td>
                    <td><?php echo $client['address_city']; ?></td>
                    <td style="text-align: center;" width="50"><?php echo $client['stars']; ?></td>
                    <td style="text-align: center;" width="160">
                        <?php if($has_permission): ?>
                        <a href="<?php echo BASE_URL; ?>Clients/edit/<?php echo $client['id']; ?>">
                            <div class="button button_small">Editar</div></a>

                        <a href="<?php echo BASE_URL; ?>Clients/delete/<?php echo $client['id']; ?>" 
                           onclick="return confirm('Tem certeza que deseja excluir ?')">
                            <div class="button button_small">Excluir</div></a>
                        <?php else: ?>
                         <a href="<?php echo BASE_URL; ?>Clients/view/<?php echo $client['id']; ?>">
                            <div class="button button_small">Visualizar</div></a>
                        <?php endif; ?>
                    </td>
                </tr>

            <?php endforeach; ?>
        </table>
    
        <div class="pagination">
            <?php for($i=1;$i<=$p_count; $i++): ?>
            <div class="pag_item <?php echo ($i == $p) ? 'pag_select': ''; ?>"><a href="<?php echo BASE_URL; ?>Clients?p=<?php echo $i; ?>"><?php echo $i; ?></a></div>
            <?php endfor; ?>
        </div>
        <div style="clear: both;"></div>