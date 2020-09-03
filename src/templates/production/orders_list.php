<div class="card">
  <div class="card-header bg-transparent">
    <h2 class="mb-0"><?= $data['title'] ?></h2>
  </div>
  <div class="card-body table-responsive m-0 p-0">
    <table class="table table-hover">
      <thead>
      <tr>
        <th scope="col">Дата создания</th>
        <th scope="col">Счет бонсенс</th>
        <th scope="col">Контрагент</th>
        <th scope="col">Менеджер</th>
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
          <td>
            <?= $order[firstActiveDepartment($order) . '_datetime_status_0'] ?? '???' ?>
          </td>
          <td><?= shortStr($order['order_name_out'], $data['config']['MAX_SYMBOLS_TABLE_CELL']) ?></td>
          <td><?= shortStr($order['client_name'], $data['config']['MAX_SYMBOLS_TABLE_CELL']) ?></td>
          <td>
            <?= shortStr($order['uc_last_name'] . ' ' . $order['uc_first_name'], $data['config']['MAX_SYMBOLS_TABLE_CELL']) ?>
          </td>
          <td>
            <?= shortStr($order['ud_last_name'] . ' ' . $order['ud_first_name'], $data['config']['MAX_SYMBOLS_TABLE_CELL']) ?>
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