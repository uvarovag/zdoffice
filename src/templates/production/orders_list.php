<div class="card">
  <div class="card-header bg-transparent">
    <h2 class="mb-0"><?= $data['title'] ?></h2>
  </div>
  <div class="card-body table-responsive m-0 p-0">
    <table class="table table-hover">
      <thead>
      <tr>
        <th scope="col">Внутренний ID</th>
        <th scope="col">Внешний ID</th>
        <th scope="col">Контрагент</th>
        <th scope="col">Дизайнер</th>
        <th scope="col">Приоритет</th>
        <th scope="col">Стадия</th>
      </tr>
      </thead>
      <tbody>
			<?php foreach ($data['orders'] as $order): ?>
        <tr class="<?= $order['error_priority'] == 2 ? 'table-danger' : '' ?>"
            onclick="window.location.href='<?= $data['config']['HOST'] . '/production.php?action=order_info_card&id=' .
						$order['id'] ?>'; return false">
          <td><?= $order['order_name_in'] ?></td>
          <td><?= shortStr($order['order_name_out'], $data['config']['MAX_SYMBOLS_TABLE_CELL']) ?></td>
          <td><?= shortStr($order['client_name'], $data['config']['MAX_SYMBOLS_TABLE_CELL']) ?></td>
          <td>
            <?php if ($order['designer_id']): ?>
            <?= shortStr($order['last_name'] . ' ' . $order['first_name'], $data['config']['MAX_SYMBOLS_TABLE_CELL']) ?>
            <?php else: ?>
            не назначен
            <?php endif; ?>
          </td>
          <td>
            <?= $data['progData']['PRIORITY_ORDERS'][$order['order_priority']]['icon'] ?? '???' ?>
          </td>
          <td>
            <?php if(currentGeneralStatus($order) !== false): ?>
            <?= $data['progData']['STATUS_LIST_PRODUCTION'][currentGeneralStatus($order)]['icon'] ?? '???' ?>
            <?php endif; ?>
          </td>
        </tr>
			<?php endforeach ?>
      </tbody>
    </table>
  </div>
</div>