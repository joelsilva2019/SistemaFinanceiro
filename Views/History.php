<h1>Histórico do Sistema</h1>

<table width="100%">
    <tr>
    <th>Usuário</th>
    <th>Produto</th>
    <th>Ação</th>
    <th>Data</th>
    </tr>
    <?php foreach ($history_list as $history): ?>
    <tr>
        <td><?php echo $history['email']; ?></td>
        <td><?php echo $history['name']; ?></td>
        <td><?php echo $history_actions[$history['action']]; ?></td>
        <td><?php echo date('d/m/Y H:i:s', strtotime($history['date_action'])); ?></td>
    </tr>
    <?php endforeach; ?>
</table>

<div class="pagination">
    <?php for ($i = 1; $i <= $p_count; $i++): ?>
        <div class="pag_item <?php echo ($i == $p) ? 'pag_select' : ''; ?>"><a href="<?php echo BASE_URL; ?>Home/history?p=<?php echo $i; ?>"><?php echo $i; ?></a></div>
    <?php endfor; ?>
</div>
<div style="clear: both;"></div>

