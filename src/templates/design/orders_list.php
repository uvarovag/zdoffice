<?php if ($data['CONFIG']['DEBUG_MODE_USER_ID'] == $_SESSION['user']['id']): ?>
  <div class="card">
    <div class="card-body">
			<?php if (isset($data['debug'])): ?>
        <p class="m-0"><?= $data['debug'] ?? 'no'; ?></p>
			<?php endif; ?>
			<?php if (isset($data['sql'])): ?>
        <p class="m-0"><?= $data['sql'] ?? 'no'; ?></p>
			<?php endif; ?>
    </div>
  </div>
<?php endif; ?>
<div class="card">
  <form class="card-body" action="<?= $data['CONFIG']['HOST'] . '/design.php'; ?>" method="GET">
    <input type="hidden" name="action" value="orders_list">

      <div class="form-row mb-0">

        <div class="form-group col">
          <select class="form-control form-control-sm" name="design_type">
            <option value="any" selected disabled>тип дизайна</option>
            <option <?= $data['formData']['designType'] == 'any' ? 'selected' : ''; ?>
                    value="any">любой
            </option>
						<?php foreach ($data['PROG_DATA']['DESIGN_TYPES'] as $dKey => $dVal): ?>
              <option <?= $data['formData']['designType'] == $dKey ? 'selected' : ''; ?>
                      value="<?= $dKey; ?>"><?= $dVal; ?></option>
						<?php endforeach; ?>
          </select>
        </div>

        <div class="form-group col">
          <select class="form-control form-control-sm" name="create_user_id">
            <option value="any" selected disabled>менеджер</option>
            <option <?= $data['formData']['createUserId'] == 'any' ? 'selected' : ''; ?>
                    value="any">любой
            </option>
						<?php foreach ($data['createUsers'] as $user): ?>
              <option <?= $data['formData']['createUserId'] == $user['id'] ? 'selected' : ''; ?>
                      value="<?= $user['id']; ?>"><?= $user['last_name'] . ' ' . $user['first_name']; ?></option>
						<?php endforeach; ?>
          </select>
        </div>
        <div class="form-group col">
          <select class="form-control form-control-sm" name="designer_id">
            <option value="any" selected disabled>дизайнер</option>
            <option <?= $data['formData']['designerId'] == 'any' ? 'selected' : ''; ?>
                    value="any">любой
            </option>
            <option <?= $data['formData']['designerId'] == 'null' ? 'selected' : ''; ?>
                    value="null">не назначен
            </option>
						<?php foreach ($data['designers'] as $designer): ?>
              <option <?= $data['formData']['designerId'] == $designer['id'] ? 'selected' : ''; ?>
                      value="<?= $designer['id']; ?>"><?= $designer['last_name'] . ' ' . $designer['first_name']; ?></option>
						<?php endforeach; ?>
          </select>
        </div>
        <div class="form-group col">
          <select class="form-control form-control-sm" name="priority">
            <option value="any" selected disabled>приоритет</option>
            <option <?= $data['formData']['priority'] == 'any' ? 'selected' : ''; ?>
                    value="any">любой
            </option>
						<?php foreach ($data['PROG_DATA']['PRIORITY_ORDERS'] as $priorityKey => $priorityVal): ?>
              <option <?= $data['formData']['priority'] == $priorityKey ? 'selected' : ''; ?>
                      value="<?= $priorityKey; ?>"><?= $priorityVal['name']; ?></option>
						<?php endforeach; ?>
          </select>
        </div>
        <div class="form-group col">
          <select class="form-control form-control-sm" name="status">
            <option value="any" selected disabled>стадия</option>
            <option <?= $data['formData']['status'] == '0,100,200,210,220,230,240,250,260,270,280,290' ? 'selected' : ''; ?>
                    value="0,100,200,210,220,230,240,250,260,270,280,290">активные
            </option>
            <option <?= $data['formData']['status'] == 'any' ? 'selected' : ''; ?>
                    value="any">любые
            </option>
            <option <?= $data['formData']['status'] == '0' ? 'selected' : ''; ?>
                    value="0">ожидание назначения дизайнера
            </option>
            <option <?= $data['formData']['status'] == '100' ? 'selected' : ''; ?>
                    value="100">получено дизайнером
            </option>
            <option <?= $data['formData']['status'] == '200,210,220,230,240,250,260,270,280,290' ? 'selected' : ''; ?>
                    value="200,210,220,230,240,250,260,270,280,290">в работе
            </option>
            <option <?= $data['formData']['status'] == '300' ? 'selected' : ''; ?>
                    value="300">выполнено
            </option>
            <option <?= $data['formData']['status'] == '999' ? 'selected' : ''; ?>
                    value="999">отменено
            </option>
          </select>
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
                   value="<?= $data['formData']['dateFrom']; ?>" placeholder="c">
            <input type="text" aria-label="Last name" class="form-control form-control-sm" name="date_to"
                   value="<?= $data['formData']['dateTo']; ?>" placeholder="по">
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
        <th scope="col">Контрагент</th>
        <th scope="col">Счет бонсенс</th>
        <th scope="col">Менеджер</th>
        <th scope="col">Дизайнер</th>
        <th scope="col">Приоритет</th>
        <th scope="col">Стадия</th>
        <th scope="col">Дедлайн</th>
      </tr>
      </thead>
      <tbody>
			<?php foreach ($data['orders'] as $order): ?>
        <tr class="<?= $order['error_priority'] == 2 ? 'table-danger' : ''; ?>"
            onclick="window.location.href='<?= $data['CONFIG']['HOST'] . '/design.php?action=order_info_card&id=' .
						$order['id']; ?>'; return false">
          <td>
            <span class="" data-toggle="tooltip" data-placement="top" title="<?= ($data['PROG_DATA']['DESIGN_TYPES'][$order['design_format']] ?? '???') . ' - ' . $order['task_text']; ?>"><?= $order['datetime_status_0']; ?></span>
          </td>
          <td><?= shortStr($order['client_name'], $data['CONFIG']['MAX_SYMBOLS_TABLE_CELL']); ?></td>
          <td><?= $order['order_name_out']; ?></td>
          <td>
            <span>
            <?php if ($order['create_user_id']): ?>
							<?= shortStr($order['uc_last_name'] . ' ' . $order['uc_first_name'], $data['CONFIG']['MAX_SYMBOLS_TABLE_CELL']); ?>
						<?php else: ?>
              не назначен
						<?php endif; ?>
            </span>
          </td>
          <td>
            <span>
            <?php if ($order['designer_id']): ?>
							<?= shortStr($order['ud_last_name'] . ' ' . $order['ud_first_name'], $data['CONFIG']['MAX_SYMBOLS_TABLE_CELL']); ?>
						<?php else: ?>
              не назначен
						<?php endif; ?>
            </span>
          </td>
          <td>
            <?= $data['PROG_DATA']['PRIORITY_ORDERS'][$order['order_priority']]['icon'] ?? '???'; ?>
          </td>
          <td><?= $data['PROG_DATA']['STATUS_LIST_DESIGN'][$order['current_status']]['icon'] ?? '???'; ?></td>
          <td>
            <?php if ($order['current_status'] >= $data['PROG_DATA']['STATUS_ID_DESIGN']['DONE']): ?>
            <?= $order['deadline_date']; ?>
            <?php else: ?>
            <?= deadlineBadge($order['deadline_date'], $data['CONFIG']['WARNING_DAYS_BEFORE_DEADLINE']); ?>
            <?php endif; ?>
          </td>
        </tr>
			<?php endforeach; ?>
      </tbody>
    </table>
  </div>
</div>