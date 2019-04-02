         
        <?php if($clients_edit): ?>
        <a href="<?php echo BASE_URL; ?>Clients/add"><div class="button">Adicionar Clientes</div></a>
        
        <input type="text" id="search" data-type="search_clients" autocomplete="off" />
        <?php endif; ?>
        
    <div class="tab_name">
    <div class="name_table">
    <h1>Clientes Cadastrados</h1>
    <span>Aqui você pode gerenciar os clientes da sua empresa</span>
    </div><br/>
    <table width="100%" border="0" class="table-responsive">
        <tbody>
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
                        <?php if($clients_edit): ?>
                        <a href="<?php echo BASE_URL; ?>Clients/edit/<?php echo $client['id']; ?>">
                            <div class="button button_small">Editar</div></a>

                        <a href="<?php echo BASE_URL; ?>Clients/delete/<?php echo $client['id']; ?>" 
                           onclick="return confirm('Tem certeza que deseja excluir ? irá apagar todas as vendas e informações desse cliente.')">
                            <div class="button button_small">Excluir</div></a>
                        <?php else: ?>
                         <a href="<?php echo BASE_URL; ?>Clients/view/<?php echo $client['id']; ?>">
                            <div class="button button_small">Visualizar</div></a>
                        <?php endif; ?>
                    </td>
                </tr>

            <?php endforeach; ?>
        </tbody>
    </table>
    </div>
        <div class="pagination">
            <?php for($i=1;$i<=$p_count; $i++): ?>
            <div class="pag_item <?php echo ($i == $p) ? 'pag_select': ''; ?>"><a href="<?php echo BASE_URL; ?>Clients?p=<?php echo $i; ?>"><?php echo $i; ?></a></div>
            <?php endfor; ?>
        </div>
        <div style="clear: both;"></div>