<div class="card">
  <form class="card-body" action="<?= $data['config']['HOST'] . '/design.php'; ?>" method="GET">
    <input type="hidden" name="action" value="orders_list">
    <div class="form-row mb-0">
      <div class="form-group col-2">
        <select class="form-control form-control-sm" name="create_user_id">
          <option value="all" selected disabled>менеджер</option>
          <option <?= $data['formData']['createUserId'] == 'all' ? 'selected' : ''; ?>
                  value="all">все
          </option>
					<?php foreach ($data['create_users'] as $user):; ?>
            <option <?= $data['formData']['createUserId'] == $user['id'] ? 'selected' : ''; ?>
                    value="<?= $user['id']; ?>"><?= $user['last_name'] . ' ' . $user['first_name']; ?></option>
					<?php endforeach; ?>
        </select>
      </div>
      <div class="form-group col-2">
        <select class="form-control form-control-sm" name="designer_id">
          <option value="all" selected disabled>дизайнер</option>
          <option <?= $data['formData']['designerId'] == 'all' ? 'selected' : ''; ?>
                  value="all">все
          </option>
          <option <?= $data['formData']['designerId'] == 'null' ? 'selected' : ''; ?>
                  value="null">не назначен
          </option>
					<?php foreach ($data['designers'] as $designer):; ?>
            <option <?= $data['formData']['designerId'] == $designer['id'] ? 'selected' : ''; ?>
                    value="<?= $designer['id']; ?>"><?= $designer['last_name'] . ' ' . $designer['first_name']; ?></option>
					<?php endforeach; ?>
        </select>
      </div>
      <div class="form-group col-2">
        <select class="form-control form-control-sm" name="priority">
          <option value="all" selected disabled>приоритет</option>
          <option <?= $data['formData']['priority'] == 'all' ? 'selected' : ''; ?>
                  value="all">все
          </option>
					<?php foreach ($data['progData']['PRIORITY_ORDERS'] as $priorityKey => $priorityVal):; ?>
            <option <?= $data['formData']['priority'] == $priorityKey ? 'selected' : ''; ?>
                    value="<?= $priorityKey; ?>"><?= $priorityVal['name']; ?></option>
					<?php endforeach; ?>
        </select>
      </div>
      <div class="form-group col-2">
        <select class="form-control form-control-sm" name="status">
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
      <div class="form-group col">
        <input type="number" class="form-control form-control-sm" name="deadline"
               value="<?= $data['formData']['deadline']; ?>" placeholder="дней до дедлайна">
      </div>
    </div>
    <div class="form-row">
      <div class="form-group col-7 mb-0">
        <input type="text" class="form-control form-control-sm" name="search"
               value="<?= $data['formData']['search']; ?>" placeholder="внутренний id / внешний id / контрагент">
      </div>
      <div class="form-group col-3 mb-0 input-daterange datepicker">
        <div class="input-group">
          <input type="text" aria-label="First name" class="form-control form-control-sm" name="date_from"
                 value="<?= $data['formData']['dateFrom']; ?>" placeholder="c">
          <input type="text" aria-label="Last name" class="form-control form-control-sm" name="date_to"
                 value="<?= $data['formData']['dateTo']; ?>" placeholder="по">
        </div>
      </div>
      <div class="form-group col mb-0">
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
        <th scope="col">Дизайнер</th>
        <th scope="col">Приоритет</th>
        <th scope="col">Стадия</th>
        <th scope="col">Дедлайн</th>
      </tr>
      </thead>
      <tbody>
			<?php foreach ($data['orders'] as $order):; ?>
        <tr class="<?= $order['error_priority'] == 2 ? 'table-danger' : ''; ?>"
            onclick="window.location.href='<?= $data['config']['HOST'] . '/design.php?action=order_info_card&id=' .
						$order['id']; ?>'; return false">
          <td><?= $order['datetime_status_0']; ?></td>
          <td><?= shortStr($order['order_name_out'], $data['config']['MAX_SYMBOLS_TABLE_CELL']); ?></td>
          <td><?= shortStr($order['client_name'], $data['config']['MAX_SYMBOLS_TABLE_CELL']); ?></td>
          <td>
            <?php if ($order['designer_id']):; ?>
            <?= shortStr($order['ud_last_name'] . ' ' . $order['ud_first_name'], $data['config']['MAX_SYMBOLS_TABLE_CELL']); ?>
            <?php else:; ?>
            не назначен
            <?php endif; ?>
          </td>
          <td>
            <?= $data['progData']['PRIORITY_ORDERS'][$order['order_priority']]['icon'] ?? '???'; ?>
          </td>
          <td><?= $data['progData']['STATUS_LIST_DESIGN'][$order['current_status']]['icon'] ?? '???'; ?></td>
          <td><?= deadlineBadge($order['deadline_date'], $data['config']['WARNING_DAYS_BEFORE_DEADLINE']); ?></td>
        </tr>
			<?php endforeach; ?>
      </tbody>
    </table>
  </div>
</div>