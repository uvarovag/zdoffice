<div class="card">
  <form class="card-body" action="<?= $data['CONFIG']['HOST'] . '/production.php'; ?>" method="GET">
    <input type="hidden" name="action" value="orders_list">
    <div class="form-row mb-0">
      <div class="form-group col">
        <select class="form-control form-control-sm" name="department">
          <option value="all" selected disabled>отдел</option>
          <option <?= $data['formData']['department'] == 'all' ? 'selected' : ''; ?>
                  value="all">все
          </option>
					<?php foreach ($data['PROG_DATA']['DEPARTAMENTS_LIST'] as $depKey => $depVal): ?>
            <option <?= $data['formData']['department'] == $depKey ? 'selected' : ''; ?>
                    value="<?= $depKey; ?>"><?= $depVal; ?></option>
					<?php endforeach; ?>
        </select>
      </div>
      <div class="form-group col">
        <select class="form-control form-control-sm" name="create_user_id">
          <option value="all" selected disabled>менеджер</option>
          <option <?= $data['formData']['createUserId'] == 'all' ? 'selected' : ''; ?>
                  value="all">все
          </option>
					<?php foreach ($data['createUsers'] as $user): ?>
            <option <?= $data['formData']['createUserId'] == $user['id'] ? 'selected' : ''; ?>
                    value="<?= $user['id']; ?>"><?= $user['last_name'] . ' ' . $user['first_name']; ?></option>
					<?php endforeach; ?>
        </select>
      </div>
      <div class="form-group col">
        <select class="form-control form-control-sm" name="designer_id">
          <option value="all" selected disabled>дизайнер</option>
          <option <?= $data['formData']['designerId'] == 'all' ? 'selected' : ''; ?>
                  value="all">все
          </option>
          </option>
					<?php foreach ($data['designers'] as $designer): ?>
            <option <?= $data['formData']['designerId'] == $designer['id'] ? 'selected' : ''; ?>
                    value="<?= $designer['id']; ?>"><?= $designer['last_name'] . ' ' . $designer['first_name']; ?></option>
					<?php endforeach; ?>
        </select>
      </div>
      <div class="form-group col">
        <select class="form-control form-control-sm" name="priority">
          <option value="all" selected disabled>приоритет</option>
          <option <?= $data['formData']['priority'] == 'all' ? 'selected' : ''; ?>
                  value="all">все
          </option>
					<?php foreach ($data['PROG_DATA']['PRIORITY_ORDERS'] as $priorityKey => $priorityVal): ?>
            <option <?= $data['formData']['priority'] == $priorityKey ? 'selected' : ''; ?>
                    value="<?= $priorityKey; ?>"><?= $priorityVal['name']; ?></option>
					<?php endforeach; ?>
        </select>
      </div>
      <div class="form-group col">
        <select class="form-control form-control-sm" name="status" disabled>
          <option value="all" selected disabled>стадия</option>
          <option <?= $data['formData']['status'] == 'all' ? 'selected' : ''; ?>
                  value="all">все
          </option>
          <option <?= $data['formData']['status'] == '0' ? 'selected' : ''; ?>
                  value="0">ожидание назначения дизайнера
          </option>
          <option <?= $data['formData']['status'] == '100' ? 'selected' : ''; ?>
                  value="100">получено дизайнером
          </option>
          <option <?= $data['formData']['status'] == '200-290' ? 'selected' : ''; ?>
                  value="200-290">в работе
          </option>
          <option <?= $data['formData']['status'] == '300' ? 'selected' : ''; ?>
                  value="300">выполнено
          </option>
          <option <?= $data['formData']['status'] == '999' ? 'selected' : ''; ?>
                  value="999">отменено
          </option>
        </select>
      </div>
      <div class="form-group col-2">
        <input type="number" class="form-control form-control-sm" name="deadline"
               value="<?= $data['formData']['deadline']; ?>" placeholder="дней до дедлайна" disabled>
      </div>
    </div>
    <div class="form-row">
      <div class="form-group col mb-0">
        <input type="text" class="form-control form-control-sm" name="search"
               value="<?= $data['formData']['search']; ?>" placeholder="id / счет бонсенс / контрагент">
      </div>
      <div class="form-group col-3 mb-0 input-daterange datepicker">
        <div class="input-group">
          <input type="text" aria-label="First name" class="form-control form-control-sm" name="date_from"
                 value="<?= $data['formData']['dateFrom']; ?>" placeholder="c" disabled>
          <input type="text" aria-label="Last name" class="form-control form-control-sm" name="date_to"
                 value="<?= $data['formData']['dateTo']; ?>" placeholder="по" disabled>
        </div>
      </div>
      <div class="form-group col-2 mb-0">
        <button type="submit" class="btn btn-sm btn-primary btn-block">Найти</button>
      </div>
    </div>
  </form>
</div>

<div class="card">
  <div class="card-header bg-transparent">
    <h2 class="mb-0"><?= $data['title']; ?></h2>
  </div>
  <div class="card-body table-responsive m-0 p-0">
    <table class="table table-hover">
      <thead>
      <tr>
        <th scope="col">Дата создания</th>
        <th scope="col">Счет бонсенс</th>
        <th scope="col">Контрагент</th>
        <th scope="col">Менеджер</th>
        <th scope="col">Приоритет</th>
        <th scope="col">Стадия</th>
      </tr>
      </thead>
      <tbody>
			<?php foreach ($data['orders'] as $order): ?>
        <tr class="<?= $order['error_priority'] == 2 ? 'table-danger' : ''; ?>"
            onclick="window.location.href='<?= $data['CONFIG']['HOST'] . '/production.php?action=order_info_card&id=' .
						$order['id']; ?>'; return false">
          <td>
            <?= $order[activeDepartments($order, $data['PROG_DATA']['DEPARTAMENTS_LIST'])[0] . '_datetime_status_0'] ?? '???'; ?>
          </td>
          <td><?= shortStr($order['order_name_out'], $data['CONFIG']['MAX_SYMBOLS_TABLE_CELL']); ?></td>
          <td><?= shortStr($order['client_name'], $data['CONFIG']['MAX_SYMBOLS_TABLE_CELL']); ?></td>
          <td>
            <?= shortStr($order['uc_last_name'] . ' ' . $order['uc_first_name'], $data['CONFIG']['MAX_SYMBOLS_TABLE_CELL']); ?>
          </td>
          <td>
            <?= $data['PROG_DATA']['PRIORITY_ORDERS'][$order['order_priority']]['icon'] ?? '???'; ?>
          </td>
          <td>
            <?php if(currentGeneralStatus($order, $data['PROG_DATA']['DEPARTAMENTS_LIST']) !== false): ?>
            <?= $data['PROG_DATA']['STATUS_LIST_PRODUCTION'][currentGeneralStatus($order, $data['PROG_DATA']['DEPARTAMENTS_LIST'])]['icon'] ?? '???'; ?>
            <?php endif; ?>
          </td>
        </tr>
			<?php endforeach; ?>
      </tbody>
    </table>
  </div>
</div>