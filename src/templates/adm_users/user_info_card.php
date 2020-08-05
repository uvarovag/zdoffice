<div class="card">
	<?php if ($data['user']['is_block']): ?>
    <div class="card-header bg-danger">
      <h2 class="mb-0 text-white">Пользователь заблокирован</h2>
    </div>
	<?php else: ?>
    <div class="card-header bg-transparent">
      <h2 class="mb-0"><?= $data['title'] ?></h2>
    </div>
	<?php endif; ?>
  <div class="card-body">
    <div class="row mb-4">
      <div class="col-12 col-md-6">
        <h3 class="mb-4">Данные</h3>
        <table class="table">
          <tr>
            <th class="px-0">Логин</th>
            <th class="px-0"><?= $data['user']['login'] ?></th>
          </tr>
          <tr>
            <th class="px-0">Фамилия</th>
            <th class="px-0"><?= $data['user']['last_name'] ?></th>
          </tr>
          <tr>
            <th class="px-0">Имя</th>
            <th class="px-0"><?= $data['user']['first_name'] ?></th>
          </tr>
          <tr>
            <th class="px-0">Должность</th>
            <th class="px-0"><?= $data['progData']['USERS_POSITIONS_LIST'][$data['user']['position']] ?? '???' ?></th>
          </tr>
          <tr>
            <th class="px-0">Телефон</th>
            <th class="px-0"><?= $data['config']['PHONE_PREFIX'] ?>
              </span> <span><?= $data['user']['mobile_phone'] ?></th>
          </tr>
          <tr>
            <th class="px-0">Почта</th>
            <th class="px-0"><?= $data['user']['email'] ?></th>
          </tr>
          <tr>
            <th class="px-0">Дата регистрации</th>
            <th class="px-0"><?= $data['user']['reg_datetime'] ?></th>
          </tr>
          <tr>
            <th class="px-0">Дата последнего изменения данных</th>
            <th class="px-0"><?= $data['user']['last_modify_datetime'] ?></th>
          </tr>
        </table>

        <hr>
        <h3 class="mb-4">Дизайн</h3>
        <table class="table">
          <tr class="<?= $data['user']['auth_design_order_new'] ? 'text-success' : 'text-danger'; ?>">
            <th class="px-0">создать заявку</th>
            <th class="px-0" width="25%"><?= $data['user']['auth_design_order_new'] ? '<i class="ni ni-fat-add text-success"></i>' :
								'<i class="ni ni-fat-delete text-danger"></i>'; ?></th>
          </tr>
          <tr class="<?= $data['user']['auth_design_order_view'] ? 'text-success' : 'text-danger'; ?>">
            <th class="px-0">просматривать заявки</th>
            <th class="px-0"><?= $data['user']['auth_design_order_view'] ? '<i class="ni ni-fat-add text-success"></i>' :
								'<i class="ni ni-fat-delete text-danger"></i>'; ?></th>
          </tr>
          <tr class="<?= $data['user']['auth_design_order_change_status'] ? 'text-success' : 'text-danger'; ?>">
            <th class="px-0">менять статус заявки</th>
            <th class="px-0"><?= $data['user']['auth_design_order_change_status'] ? '<i class="ni ni-fat-add text-success"></i>' :
								'<i class="ni ni-fat-delete text-danger"></i>'; ?></th>
          </tr>
          <tr class="<?= $data['user']['auth_design_order_select_designer'] ? 'text-success' : 'text-danger'; ?>">
            <th class="px-0">распределять заявки</th>
            <th class="px-0"><?= $data['user']['auth_design_order_select_designer'] ? '<i class="ni ni-fat-add text-success"></i>' :
								'<i class="ni ni-fat-delete text-danger"></i>'; ?></th>
          </tr>
          <tr class="<?= $data['user']['auth_design_order_change_priority'] ? 'text-success' : 'text-danger'; ?>">
            <th class="px-0">менять приоритет заявки</th>
            <th class="px-0"><?= $data['user']['auth_design_order_change_priority'] ? '<i class="ni ni-fat-add text-success"></i>' :
								'<i class="ni ni-fat-delete text-danger"></i>'; ?></th>
          </tr>
        </table>

        <hr>
        <h3 class="mb-4">Производство</h3>
        <table class="table mb-4">
          <tr class="<?= $data['user']['auth_production_order_new'] ? 'text-success' : 'text-danger'; ?>">
            <th class="px-0">создать заявку</th>
            <th class="px-0" width="25%"><?= $data['user']['auth_production_order_new'] ? '<i class="ni ni-fat-add text-success"></i>' :
								'<i class="ni ni-fat-delete text-danger"></i>'; ?></th>
          </tr>
          <tr class="<?= $data['user']['auth_production_order_view'] ? 'text-success' : 'text-danger'; ?>">
            <th class="px-0">просматривать заявки</th>
            <th class="px-0"><?= $data['user']['auth_production_order_view'] ? '<i class="ni ni-fat-add text-success"></i>' :
								'<i class="ni ni-fat-delete text-danger"></i>'; ?></th>
          </tr>
          <tr class="<?= $data['user']['auth_production_order_change_priority'] ? 'text-success' : 'text-danger'; ?>">
            <th class="px-0">менять приоритет заявки</th>
            <th class="px-0"><?= $data['user']['auth_production_order_change_priority'] ? '<i class="ni ni-fat-add text-success"></i>' :
								'<i class="ni ni-fat-delete text-danger"></i>'; ?></th>
          </tr>
          <tr class="<?= $data['user']['auth_production_order_start'] ? 'text-success' : 'text-danger'; ?>">
            <th class="px-0">запустить в работу заявку</th>
            <th class="px-0"><?= $data['user']['auth_production_order_start'] ? '<i class="ni ni-fat-add text-success"></i>' :
								'<i class="ni ni-fat-delete text-danger"></i>'; ?></th>
          </tr>
          <tr class="<?= $data['user']['auth_production_order_cancel'] ? 'text-success' : 'text-danger'; ?>">
            <th class="px-0">подтвердить отмену заявки</th>
            <th class="px-0"><?= $data['user']['auth_production_order_cancel'] ? '<i class="ni ni-fat-add text-success"></i>' :
								'<i class="ni ni-fat-delete text-danger"></i>'; ?></th>
          </tr>
          <tr class="<?= $data['user']['auth_production_order_change_status_const'] ? 'text-success' : 'text-danger'; ?>">
            <th class="px-0"><b>конструктор</b> менять статус заявки</th>
            <th class="px-0"><?= $data['user']['auth_production_order_change_status_const'] ? '<i class="ni ni-fat-add text-success"></i>' :
								'<i class="ni ni-fat-delete text-danger"></i>'; ?></th>
          </tr>
          <tr class="<?= $data['user']['auth_production_order_change_status_adv'] ? 'text-success' : 'text-danger'; ?>">
            <th class="px-0"><b>реклама</b> менять статус заявки</th>
            <th class="px-0"><?= $data['user']['auth_production_order_change_status_adv'] ? '<i class="ni ni-fat-add text-success"></i>' :
								'<i class="ni ni-fat-delete text-danger"></i>'; ?></th>
          </tr>
          <tr class="<?= $data['user']['auth_production_order_change_status_furn'] ? 'text-success' : 'text-danger'; ?>">
            <th class="px-0"><b>мебель</b> менять статус заявки</th>
            <th class="px-0"><?= $data['user']['auth_production_order_change_status_furn'] ? '<i class="ni ni-fat-add text-success"></i>' :
								'<i class="ni ni-fat-delete text-danger"></i>'; ?></th>
          </tr>
          <tr class="<?= $data['user']['auth_production_order_change_status_steel'] ? 'text-success' : 'text-danger'; ?>">
            <th class="px-0"><b>металл</b> менять статус заявки</th>
            <th class="px-0"><?= $data['user']['auth_production_order_change_status_steel'] ? '<i class="ni ni-fat-add text-success"></i>' :
								'<i class="ni ni-fat-delete text-danger"></i>'; ?></th>
          </tr>
          <tr class="<?= $data['user']['auth_production_order_change_status_install'] ? 'text-success' : 'text-danger'; ?>">
            <th class="px-0"><b>монтаж</b> менять статус заявки</th>
            <th class="px-0"><?= $data['user']['auth_production_order_change_status_install'] ? '<i class="ni ni-fat-add text-success"></i>' :
								'<i class="ni ni-fat-delete text-danger"></i>'; ?></th>
          </tr>
          <tr class="<?= $data['user']['auth_production_order_change_status_supply'] ? 'text-success' : 'text-danger'; ?>">
            <th class="px-0"><b>склад</b> менять статус заявки</th>
            <th class="px-0"><?= $data['user']['auth_production_order_change_status_supply'] ? '<i class="ni ni-fat-add text-success"></i>' :
								'<i class="ni ni-fat-delete text-danger"></i>'; ?></th>
          </tr>
        </table>
      </div>
    </div>
    <a href="<?= $data['config']['HOST'] . '/adm_users.php?action=edit_user_card&id=' . $data['user']['id'] ?>"
       class="btn btn-primary" role="button" aria-pressed="true">Редактировать</a>
  </div>
</div>