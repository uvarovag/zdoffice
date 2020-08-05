<div class="card">
  <div class="card-header">
    <h2 class="mb-0"><?= $data['title'] ?></h2>
  </div>
  <div class="card-body">
    <div class="row mb-4">
      <div class="col-12 col-md-6">
        <h3 class="mb-4">Данные заказа</h3>
        <table class="table">
          <tr>
            <th class="px-0">Внешний ID</th>
            <th class="px-0"><?= $data['order']['order_name_out'] ?></th>
          </tr>
          <tr>
            <th class="px-0">Внутренний ID</th>
            <th class="px-0"><?= $data['order']['order_name_in'] ?></th>
          </tr>
          <tr>
            <th class="px-0">Дизайнер</th>
            <th class="px-0"><?= $data['designerData'] ?
                $data['designerData']['last_name'] . ' ' . $data['designerData']['first_name'] :
                'не назначен'?></th>
          </tr>
          <tr>
            <th class="px-0">Приоритет</th>
            <th class="px-0"><?= $data['progData']['PRIORITY_ORDERS'][$data['order']['order_priority']]['icon'] ?? '???' ?></th>
          </tr>
          <tr>
            <th class="px-0">Статус</th>
            <th class="px-0"><?= $data['progData']['STATUS_LIST_DESIGN'][$data['order']['current_status']]['icon'] ?? '???' ?></th>
          </tr>
          <tr>
            <th class="px-0">Формат</th>
            <th class="px-0"><?= $data['order']['design_format'] ?></th>
          </tr>
          <tr>
            <th class="px-0">Дедлайн</th>
            <th class="px-0"><?= date('Y-m-d', strtotime($data['order']['deadline_date'])) ?></th>
          </tr>
        </table>
        <hr>
        <h3 class="mb-4">Описание</h3>
        <p><?= $data['order']['task_text'] ?></p>
      </div>
      <div class="col-12 col-md-6">
        <h3 class="mb-4">Данные контрагента</h3>
        <table class="table table-sm">
          <tr>
            <th class="px-0">Контрагент</th>
            <th class="px-0"><?= $data['order']['client_name'] ?></th>
          </tr>
          <tr>
            <th class="px-0">Телефон</th>
            <th class="px-0"><?= $data['order']['mobile_phone'] ?></th>
          </tr>
          <tr>
            <th class="px-0">Почта</th>
            <th class="px-0"><?= $data['order']['email'] ?></th>
          </tr>
        </table>
        <hr>
        <h3 class="mb-4">Таймлайн</h3>
        <table class="table table-sm">
          <tr>
            <th class="px-0"><?= $data['progData']['STATUS_LIST_DESIGN'][0]['name'] ?? '???' ?></th>
            <th class="px-0"><?= $data['order']['datetime_status_000'] ?></th>
          </tr>
          <tr>
            <th class="px-0"><?= $data['progData']['STATUS_LIST_DESIGN'][100]['name'] ?? '???' ?></th>
            <th class="px-0"><?= $data['order']['datetime_status_100'] ?></th>
          </tr>
          <tr>
            <th class="px-0"><?= $data['progData']['STATUS_LIST_DESIGN'][200]['name'] ?? '???' ?></th>
            <th class="px-0"><?= $data['order']['datetime_status_200'] ?></th>
          </tr>
          <tr>
            <th class="px-0"><?= $data['progData']['STATUS_LIST_DESIGN'][210]['name'] ?? '???' ?></th>
            <th class="px-0"><?= $data['order']['datetime_status_210'] ?></th>
          </tr>
          <tr>
            <th class="px-0"><?= $data['progData']['STATUS_LIST_DESIGN'][220]['name'] ?? '???' ?></th>
            <th class="px-0"><?= $data['order']['datetime_status_220'] ?></th>
          </tr>
          <tr>
            <th class="px-0"><?= $data['progData']['STATUS_LIST_DESIGN'][230]['name'] ?? '???' ?></th>
            <th class="px-0"><?= $data['order']['datetime_status_230'] ?></th>
          </tr>
          <tr>
            <th class="px-0"><?= $data['progData']['STATUS_LIST_DESIGN'][240]['name'] ?? '???' ?></th>
            <th class="px-0"><?= $data['order']['datetime_status_240'] ?></th>
          </tr>
          <tr>
            <th class="px-0"><?= $data['progData']['STATUS_LIST_DESIGN'][250]['name'] ?? '???' ?></th>
            <th class="px-0"><?= $data['order']['datetime_status_250'] ?></th>
          </tr>
          <tr>
            <th class="px-0"><?= $data['progData']['STATUS_LIST_DESIGN'][260]['name'] ?? '???' ?></th>
            <th class="px-0"><?= $data['order']['datetime_status_260'] ?></th>
          </tr>
          <tr>
            <th class="px-0"><?= $data['progData']['STATUS_LIST_DESIGN'][270]['name'] ?? '???' ?></th>
            <th class="px-0"><?= $data['order']['datetime_status_270'] ?></th>
          </tr>
          <tr>
            <th class="px-0"><?= $data['progData']['STATUS_LIST_DESIGN'][280]['name'] ?? '???' ?></th>
            <th class="px-0"><?= $data['order']['datetime_status_280'] ?></th>
          </tr>
          <tr>
            <th class="px-0"><?= $data['progData']['STATUS_LIST_DESIGN'][290]['name'] ?? '???' ?></th>
            <th class="px-0"><?= $data['order']['datetime_status_290'] ?></th>
          </tr>
          <tr>
            <th class="px-0"><?= $data['progData']['STATUS_LIST_DESIGN'][300]['name'] ?? '???' ?></th>
            <th class="px-0"><?= $data['order']['datetime_status_300'] ?></th>
          </tr>
          <tr>
            <th class="px-0"><?= $data['progData']['STATUS_LIST_DESIGN'][999]['name'] ?? '???' ?></th>
            <th class="px-0"><?= $data['order']['datetime_status_999'] ?></th>
          </tr>
        </table>
      </div>
    </div>

		<?php if (true): ?>
      <form action="<?= $data['config']['HOST'] . '/design.php' ?>" method="GET">
        <input type="hidden" name="action" value="change_designer">
        <input type="hidden" name="order_id" value="<?= $data['order']['id'] ?>">
        <h3>Назначить дизайнера</h3>
        <div class="form-row mb-4">
          <div class="form-group col-4 mb-4">
            <select name="designer_id" class="form-control" required>
              <option></option>
							<?php foreach ($data['usersPositionDesigner'] as $user): ?>
								<?php if ($user['id'] === $data['order']['designer_id']): ?>
                  <option value="<?= $user['id'] ?>" selected><?= $user['last_name'] . ' ' . $user['first_name'] ?></option>
								<?php else: ?>
                  <option value="<?= $user['id'] ?>"><?= $user['last_name'] . ' ' . $user['first_name'] ?></option>
								<?php endif; ?>
							<?php endforeach; ?>
            </select>
          </div>
          <div class="form-group col-2 mb-2">
            <input class="btn btn-primary" type="submit" value="Сохранить">
          </div>
        </div>
      </form>
		<?php endif; ?>

		<?php if (true): ?>
      <form action="<?= $data['config']['HOST'] . '/design.php' ?>" method="GET">
        <input type="hidden" name="action" value="change_priority">
        <input type="hidden" name="order_id" value="<?= $data['order']['id'] ?>">
        <h3>Изменить приоритет</h3>
        <div class="form-row mb-4">
          <div class="form-group col-4 mb-4">
            <select name="priority" class="form-control" required>
              <option></option>
							<?php foreach ($data['progData']['PRIORITY_ORDERS'] as $priorityKey => $priorityVal): ?>
								<?php if ($priorityKey === $data['order']['order_priority']): ?>
                  <option value="<?= $priorityKey ?>" selected><?= $priorityVal['name'] ?></option>
								<?php else: ?>
                  <option value="<?= $priorityKey ?>"><?= $priorityVal['name'] ?></option>
								<?php endif; ?>
							<?php endforeach; ?>
            </select>
          </div>
          <div class="form-group col-2 mb-4">
            <input class="btn btn-primary" type="submit" value="Сохранить">
          </div>
        </div>
      </form>
		<?php endif; ?>
  </div>
</div>

