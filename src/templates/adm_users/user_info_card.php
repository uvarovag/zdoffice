<div class="card">
	<?php if ($data['user']['is_block']): ?>
    <div class="card-header bg-danger">
      <h2 class="mb-0 text-white">Пользователь заблокирован</h2>
    </div>
	<?php else: ?>
    <div class="card-header bg-transparent">
      <h2 class="mb-0"><?= $data['title']; ?></h2>
    </div>
	<?php endif; ?>
  <div class="card-body">
    <div class="row">
      <div class="col-12 col-md-6">
        <div class="mb-4">
          <h4 class="mb-4">Данные</h4>
          <table class="table">
            <tr>
              <td class="px-0" width="60%">Логин</td>
              <td class="px-0"><?= $data['user']['login']; ?></td>
            </tr>
            <tr>
              <td class="px-0">Фамилия</td>
              <td class="px-0"><?= $data['user']['last_name']; ?></td>
            </tr>
            <tr>
              <td class="px-0">Имя</td>
              <td class="px-0"><?= $data['user']['first_name']; ?></td>
            </tr>
            <tr>
              <td class="px-0">Должность</td>
              <td class="px-0"><?= $data['PROG_DATA']['USERS_POSITIONS_LIST'][$data['user']['position']] ?? '???'; ?></td>
            </tr>
            <tr>
              <td class="px-0">Телефон</td>
              <td class="px-0"><?= $data['CONFIG']['PHONE_PREFIX']; ?> <?= $data['user']['mobile_phone']; ?></td>
            </tr>
            <tr>
              <td class="px-0">Почта</td>
              <td class="px-0"><?= $data['user']['email']; ?></td>
            </tr>
            <tr>
              <td class="px-0">Дата регистрации</td>
              <td class="px-0"><?= $data['user']['reg_datetime']; ?></td>
            </tr>
            <tr>
              <td class="px-0">Дата последнего изменения данных</td>
              <td class="px-0"><?= $data['user']['last_modify_datetime']; ?></td>
            </tr>
          </table>
        </div>
        <div class="mb-4">
          <hr>
          <h4 class="mb-4">Дизайн</h4>
          <table class="table">
            <tr class="">
              <td class="px-0" width="60%">создать заявку</td>
              <td class="px-0"><?= $data['user']['auth_design_order_new'] ? '<i class="ni ni-fat-add text-success"></i>' :
									'<i class="ni ni-fat-delete text-danger"></i>'; ?></td>
            </tr>
            <tr class="">
              <td class="px-0">просматривать заявки</td>
              <td class="px-0"><?= $data['user']['auth_design_order_view'] ? '<i class="ni ni-fat-add text-success"></i>' :
									'<i class="ni ni-fat-delete text-danger"></i>'; ?></td>
            </tr>
            <tr class="">
              <td class="px-0">распределять заявки</td>
              <td class="px-0"><?= $data['user']['auth_design_order_select_designer'] ? '<i class="ni ni-fat-add text-success"></i>' :
									'<i class="ni ni-fat-delete text-danger"></i>'; ?></td>
            </tr>
            <tr class="">
              <td class="px-0">менять приоритет заявки</td>
              <td class="px-0"><?= $data['user']['auth_design_order_change_priority'] ? '<i class="ni ni-fat-add text-success"></i>' :
									'<i class="ni ni-fat-delete text-danger"></i>'; ?></td>
            </tr>
						<?php foreach ($data['PROG_DATA']['DESIGN_TYPES'] as $dKey => $dVal): ?>
              <tr class="">
                <td class="px-0"><b><?= $dVal; ?></b> менять статус заявки</td>
                <td class="px-0"><?= $data['user']['auth_design_order_change_status_' . $dKey] ? '<i class="ni ni-fat-add text-success"></i>' :
										'<i class="ni ni-fat-delete text-danger"></i>'; ?></td>
              </tr>
						<?php endforeach; ?>
          </table>
        </div>

        <div class="mb-4">
          <hr>
          <h4 class="mb-4">Производство</h4>
          <table class="table mb-4">
            <tr class="">
              <td class="px-0" width="60%">создать заявку</td>
              <td class="px-0"><?= $data['user']['auth_production_order_new'] ? '<i class="ni ni-fat-add text-success"></i>' :
									'<i class="ni ni-fat-delete text-danger"></i>'; ?></td>
            </tr>
            <tr class="">
              <td class="px-0">просматривать заявки</td>
              <td class="px-0"><?= $data['user']['auth_production_order_view'] ? '<i class="ni ni-fat-add text-success"></i>' :
									'<i class="ni ni-fat-delete text-danger"></i>'; ?></td>
            </tr>
            <tr class="">
              <td class="px-0">менять приоритет заявки</td>
              <td class="px-0"><?= $data['user']['auth_production_order_change_priority'] ? '<i class="ni ni-fat-add text-success"></i>' :
									'<i class="ni ni-fat-delete text-danger"></i>'; ?></td>
            </tr>
            <tr class="">
              <td class="px-0">запустить в работу заявку</td>
              <td class="px-0"><?= $data['user']['auth_production_order_start'] ? '<i class="ni ni-fat-add text-success"></i>' :
									'<i class="ni ni-fat-delete text-danger"></i>'; ?></td>
            </tr>
            <tr class="">
              <td class="px-0">подтвердить отмену заявки</td>
              <td class="px-0"><?= $data['user']['auth_production_order_cancel'] ? '<i class="ni ni-fat-add text-success"></i>' :
									'<i class="ni ni-fat-delete text-danger"></i>'; ?></td>
            </tr>
						<?php foreach ($data['PROG_DATA']['DEPARTMENTS_LIST'] as $depKey => $depVal): ?>
              <tr class="">
                <td class="px-0"><b><?= $depVal; ?></b> менять статус заявки</td>
                <td class="px-0"><?= $data['user']['auth_production_order_change_status_' . $depKey] ? '<i class="ni ni-fat-add text-success"></i>' :
										'<i class="ni ni-fat-delete text-danger"></i>'; ?></td>
              </tr>
            <?php endforeach; ?>
          </table>
        </div>
      </div>
      <div class="col-12 col-md-6">
        <div class="mb-4">
          <h4 class="mb-4">Логи</h4>
          <table class="table mb-4 table-sm">
						<?php foreach ($data['userLogs'] as $log): ?>
              <tr>
                <td><?= $log['log_info']; ?></td>
                <td><?= $log['log_datetime']; ?></td>
                <td><?= $log['log_ip']; ?></td>
              </tr>
						<?php endforeach; ?>
          </table>
        </div>
      </div>
    </div>
    <div class="mb-4">
      <a href="<?= $data['CONFIG']['HOST'] . '/adm_users.php?action=edit_user_card&id=' . $data['user']['id']; ?>"
         class="btn btn-primary" role="button" aria-pressed="true">Редактировать</a>
    </div>
  </div>
</div>