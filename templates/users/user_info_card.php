<div class="card">
	<?php if ($data['user']['is_block']): ?>
		<div class="card-header bg-danger">
			<h2 class="mb-0 text-white">Пользователь заблокирован</h2>
		</div>
	<?php else: ?>
		<div class="card-header bg-transparent">
			<h2 class="mb-0">Карта пользователя</h2>
		</div>
	<?php endif; ?>
	<div class="card-body">
		<div class="row">
			<div class="col-12 col-md-6 mb-4">
				<h3 class="mb-4">Данные</h3>
				<div class="mb-3"><span>Логин: <?= $data['user']['login']?></span></div>
				<div class="mb-3"><span>Фамилия: <?= $data['user']['last_name']?></span></div>
				<div class="mb-3"><span>Имя: <?= $data['user']['first_name']?></span></div>
				<div class="mb-3"><span>Должность:
						<?= $data['progData']['usersPositionsList'][$data['user']['position']] ?? '???'?></span></div>
				<div class="mb-3"><span>Телефон:
						<?= $data['config']['phone_prefix']?>
					</span> <span><?= $data['user']['mobile_phone']?></span></div>
				<div class="mb-3"><span>Почта: <?= $data['user']['email']?></span></div>
				<div class="mb-3"><span>Дата регистрации: <?= $data['user']['reg_datetime']?></span></div>
				<div class="mb-3">
					<span>Дата последнего изменения данных:
						<?= $data['user']['last_modify_datetime']?></span></div>

				<hr>
				<h3 class="mb-4">Дизайн:</h3>
				<div class="mb-3">
					<?= $data['user']['auth_design_order_new'] ? '<i class="ni ni-fat-add text-success"></i>' :
						'<i class="ni ni-fat-delete text-danger"></i>'; ?>
					<span>создать заявку</span>
				</div>
				<div class="mb-3">
					<?= $data['user']['auth_design_order_view'] ? '<i class="ni ni-fat-add text-success"></i>' :
						'<i class="ni ni-fat-delete text-danger"></i>'; ?>
					<span>просматривать заявки</span>
				</div>
				<div class="mb-3">
					<?= $data['user']['auth_design_order_change_status'] ? '<i class="ni ni-fat-add text-success"></i>' :
						'<i class="ni ni-fat-delete text-danger"></i>'; ?>
					<span>менять статус заявки</span>
				</div>
				<div class="mb-3">
					<?= $data['user']['auth_design_order_select_designer'] ? '<i class="ni ni-fat-add text-success"></i>' :
						'<i class="ni ni-fat-delete text-danger"></i>'; ?>
					<span>распределять заявки</span>
				</div>
				<div class="mb-3">
					<?= $data['user']['auth_design_order_change_priority'] ? '<i class="ni ni-fat-add text-success"></i>' :
						'<i class="ni ni-fat-delete text-danger"></i>'; ?>
					<span>менять приоритет заявки</span>
				</div>

				<hr>
				<h3 class="mb-4">Производство:</h3>

				<div class="mb-3">
					<?= $data['user']['auth_production_order_new'] ? '<i class="ni ni-fat-add text-success"></i>' :
						'<i class="ni ni-fat-delete text-danger"></i>'; ?>
					<span>создать заявку</span>
				</div>
				<div class="mb-3">
					<?= $data['user']['auth_production_order_view'] ? '<i class="ni ni-fat-add text-success"></i>' :
						'<i class="ni ni-fat-delete text-danger"></i>'; ?>
					<span>просматривать заявки</span>
				</div>
				<div class="mb-3">
					<?= $data['user']['auth_production_order_change_priority'] ? '<i class="ni ni-fat-add text-success"></i>' :
						'<i class="ni ni-fat-delete text-danger"></i>'; ?>
					<span>менять приоритет заявки</span>
				</div>
				<div class="mb-3">
					<?= $data['user']['auth_production_order_start'] ? '<i class="ni ni-fat-add text-success"></i>' :
						'<i class="ni ni-fat-delete text-danger"></i>'; ?>
					<span>запустить в работу заявку</span>
				</div>
				<div class="mb-3">
					<?= $data['user']['auth_production_order_cancel'] ? '<i class="ni ni-fat-add text-success"></i>' :
						'<i class="ni ni-fat-delete text-danger"></i>'; ?>
					<span>подтвердить отмену заявки</span>
				</div>
				<div class="mb-3">
					<?= $data['user']['auth_production_order_change_status_const'] ? '<i class="ni ni-fat-add text-success"></i>' :
						'<i class="ni ni-fat-delete text-danger"></i>'; ?>
					<span><b>конструктор</b> менять статус заявки</span>
				</div>
				<div class="mb-3">
					<?= $data['user']['auth_production_order_change_status_adv'] ? '<i class="ni ni-fat-add text-success"></i>' :
						'<i class="ni ni-fat-delete text-danger"></i>'; ?>
					<span><b>реклама</b> менять статус заявки</span>
				</div>
				<div class="mb-3">
					<?= $data['user']['auth_production_order_change_status_furn'] ? '<i class="ni ni-fat-add text-success"></i>' :
						'<i class="ni ni-fat-delete text-danger"></i>'; ?>
					<span><b>мебель</b> менять статус заявки</span>
				</div>
				<div class="mb-3">
					<?= $data['user']['auth_production_order_change_status_steel'] ? '<i class="ni ni-fat-add text-success"></i>' :
						'<i class="ni ni-fat-delete text-danger"></i>'; ?>
					<span><b>металл</b> менять статус заявки</span>
				</div>
				<div class="mb-3">
					<?= $data['user']['auth_production_order_change_status_install'] ? '<i class="ni ni-fat-add text-success"></i>' :
						'<i class="ni ni-fat-delete text-danger"></i>'; ?>
					<span><b>монтаж</b> менять статус заявки</span>
				</div>
				<div class="mb-3">
					<?= $data['user']['auth_production_order_change_status_supply'] ? '<i class="ni ni-fat-add text-success"></i>' :
						'<i class="ni ni-fat-delete text-danger"></i>'; ?>
					<span><b>склад</b> менять статус заявки</span>
				</div>

			</div>

			<div class="col-12 col-md-6 mb-4">
			</div>
		</div>

		<a href="<?= $data['config']['host'] . '/users.php?action=edit_user_card&id=' . $data['user']['id']?>"
       class="btn btn-primary" role="button" aria-pressed="true">Редактировать</a>

	</div>
</div>