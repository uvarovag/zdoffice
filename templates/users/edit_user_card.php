<div class="card">
	<?php if ($data['user']['is_block']): ?>
    <div class="card-header bg-danger">
      <h2 class="mb-0 text-white">Пользователь заблокирован</h2>
    </div>
	<?php else: ?>
    <div class="card-header bg-transparent">
      <h2 class="mb-0">Редактировать данные пользователя</h2>
    </div>
	<?php endif; ?>
  <div class="card-body">
    <form action="/users.php" method="POST">
      <input type="hidden" name="action" value="edit_user_data">
      <input type="hidden" name="id" value="<?= $data['user']['id']?>">
      <input type="hidden" name="form_id" value="<?= $data['form_id'] ?>">
      <fieldset>
        <div class="row">
          <div class="col-12 col-md mb-4">
            <input type="text" name="login" class="form-control" required readonly
                   pattern="<?= $data['config']['regexp_a'] ?>{<?= $data['config']['min_len_a'] ?>,<?= $data['config']['max_len_a'] ?>}"
                   value="<?= $data['user']['login']?>">
          </div>
          <div class="col-12 col-md mb-4">
            <input type="text" name="password" class="form-control" required
                   pattern="<?= $data['config']['regexp_a'] ?>{<?= $data['config']['min_len_a'] ?>,<?= $data['config']['max_len_a'] ?>}"
                   value="<?= $data['user']['password']?>">
          </div>
        </div>
        <div class="row">
          <div class="col-12 col-md mb-4">
            <input type="text" name="last_name" class="form-control" required
                   pattern="<?= $data['config']['regexp_b'] ?>{<?= $data['config']['min_len_a'] ?>,<?= $data['config']['max_len_a'] ?>}"
                   value="<?= $data['user']['last_name']?>">
          </div>
          <div class="col-12 col-md mb-4">
            <input type="text" name="first_name" class="form-control" required
                   pattern="<?= $data['config']['regexp_b'] ?>{<?= $data['config']['min_len_a'] ?>,<?= $data['config']['max_len_a'] ?>}"
                   value="<?= $data['user']['first_name']?>">
          </div>
        </div>
        <div class="row">
          <div class="col-12 col-md-6 col-lg-4 mb-4">
            <input type="text" name="position" class="form-control" required
                   pattern="<?= $data['config']['regexp_b'] ?>{<?= $data['config']['min_len_a'] ?>,<?= $data['config']['max_len_a'] ?>}"
                   value="<?= $data['user']['position']?>">
          </div>
          <div class="col-12 col-md-6 col-lg-4 mb-4 input-group">
            <div class="input-group-prepend">
              <span class="input-group-text" id="basic-addon1"><?= $data['config']['phone_prefix']?></span>
            </div>
            <input type="tel" name="mobile_phone" class="form-control" required
                   pattern="\d{2}\s\d{3}\s\d{2}\s\d{2}" value="<?= $data['user']['mobile_phone']?>">
          </div>
          <div class="col-12 col-md-6 col-lg-4 mb-4">
            <input type="email" name="email" class="form-control" required value="<?= $data['user']['email']?>">
          </div>
        </div>
      </fieldset>

      <hr>

      <div class="row">
        <fieldset class="col-12 col-md-6 mb-4">
          <h3 class="mb-4">Дизайн</h3>
          <div class="custom-control custom-checkbox mb-2">
            <input type="checkbox" name="design_order_new" id="design_order_new"
                   class="custom-control-input" <?= $data['user']['auth_design_order_new'] ? 'checked' : '' ?>>
            <label class="custom-control-label" for="design_order_new">создать заявку</label>
          </div>
          <div class="custom-control custom-checkbox mb-2">
            <input type="checkbox" name="design_order_view" id="design_order_view"
                   class="custom-control-input" <?= $data['user']['auth_design_order_view'] ? 'checked' : '' ?>>
            <label class="custom-control-label" for="design_order_view">просматривать заявки</label>
          </div>
          <div class="custom-control custom-checkbox mb-2">
            <input type="checkbox" name="design_order_change_status" id="design_order_change_status"
                   class="custom-control-input" <?= $data['user']['auth_design_order_change_status'] ? 'checked' : '' ?>>
            <label class="custom-control-label" for="design_order_change_status">менять статус заявки</label>
          </div>
          <div class="custom-control custom-checkbox mb-2">
            <input type="checkbox" name="design_order_select_designer" id="design_order_select_designer"
                   class="custom-control-input" <?= $data['user']['auth_design_order_select_designer'] ? 'checked' : '' ?>>
            <label class="custom-control-label" for="design_order_select_designer">распределять заявки</label>
          </div>
          <div class="custom-control custom-checkbox mb-2">
            <input type="checkbox" name="design_order_change_priority" id="design_order_change_priority"
                   class="custom-control-input" <?= $data['user']['auth_design_order_change_priority'] ? 'checked' : '' ?>>
            <label class="custom-control-label" for="design_order_change_priority">менять приоритет заявки</label>
          </div>
        </fieldset>
        <fieldset class="col-12 col-lg-6 mb-4">
          <h3 class="mb-4">Производство</h3>
          <div class="custom-control custom-checkbox mb-2">
            <input type="checkbox" name="production_order_new" id="production_order_new"
                   class="custom-control-input" <?= $data['user']['auth_production_order_new'] ? 'checked' : '' ?>>
            <label class="custom-control-label" for="production_order_new">создать заявку</label>
          </div>
          <div class="custom-control custom-checkbox mb-2">
            <input type="checkbox" name="production_order_view" id="production_order_view"
                   class="custom-control-input" <?= $data['user']['auth_production_order_view'] ? 'checked' : '' ?>>
            <label class="custom-control-label" for="production_order_view">просматривать заявки</label>
          </div>
          <div class="custom-control custom-checkbox mb-2">
            <input type="checkbox" name="production_order_change_priority" id="production_order_change_priority"
                   class="custom-control-input" <?= $data['user']['auth_production_order_change_priority'] ? 'checked' : '' ?>>
            <label class="custom-control-label" for="production_order_change_priority">менять приоритет заявки</label>
          </div>
          <div class="custom-control custom-checkbox mb-2">
            <input type="checkbox" name="production_order_start" id="production_order_start"
                   class="custom-control-input" <?= $data['user']['auth_production_order_start'] ? 'checked' : '' ?>>
            <label class="custom-control-label" for="production_order_start">запустить в работу заявку</label>
          </div>
          <div class="custom-control custom-checkbox mb-2">
            <input type="checkbox" name="production_order_cancel" id="production_order_cancel"
                   class="custom-control-input" <?= $data['user']['auth_production_order_cancel'] ? 'checked' : '' ?>>
            <label class="custom-control-label" for="production_order_cancel">подтвердить отмену заявки</label>
          </div>
          <div class="custom-control custom-checkbox mb-2">
            <input type="checkbox" name="production_order_change_status_const" id="production_order_change_status_const"
                   class="custom-control-input" <?= $data['user']['auth_production_order_change_status_const'] ? 'checked' : '' ?>>
            <label class="custom-control-label" for="production_order_change_status_const">
              <b>конструктор</b> менять статус заявки</label>
          </div>
          <div class="custom-control custom-checkbox mb-2">
            <input type="checkbox" name="production_order_change_status_adv" id="production_order_change_status_adv"
                   class="custom-control-input" <?= $data['user']['auth_production_order_change_status_adv'] ? 'checked' : '' ?>>
            <label class="custom-control-label" for="production_order_change_status_adv">
              <b>реклама</b> менять статус заявки</label>
          </div>
          <div class="custom-control custom-checkbox mb-2">
            <input type="checkbox" name="production_order_change_status_furn" id="production_order_change_status_furn"
                   class="custom-control-input" <?= $data['user']['auth_production_order_change_status_furn'] ? 'checked' : '' ?>>
            <label class="custom-control-label" for="production_order_change_status_furn">
              <b>мебель</b> менять статус заявки</label>
          </div>
          <div class="custom-control custom-checkbox mb-2">
            <input type="checkbox" name="production_order_change_status_steel" id="production_order_change_status_steel"
                   class="custom-control-input" <?= $data['user']['auth_production_order_change_status_steel'] ? 'checked' : '' ?>>
            <label class="custom-control-label" for="production_order_change_status_steel">
              <b>металл</b> менять статус заявки</label>
          </div>
          <div class="custom-control custom-checkbox mb-2">
            <input type="checkbox" name="production_order_change_status_install" id="production_order_change_status_install"
                   class="custom-control-input" <?= $data['user']['auth_production_order_change_status_install'] ? 'checked' : '' ?>>
            <label class="custom-control-label" for="production_order_change_status_install">
              <b>монтаж</b> менять статус заявки</label>
          </div>
          <div class="custom-control custom-checkbox mb-2">
            <input type="checkbox" name="production_order_change_status_supply" id="production_order_change_status_supply"
                   class="custom-control-input" <?= $data['user']['auth_production_order_change_status_supply'] ? 'checked' : '' ?>>
            <label class="custom-control-label" for="production_order_change_status_supply">
              <b>склад</b> менять статус заявки</label>
          </div>
        </fieldset>
      </div>
      <input class="btn btn-primary" type="submit" value="Сохранить">
			<?php if ($data['user']['is_block']): ?>
        <a href="<?= $data['config']['host'] . '/users.php?action=unlock_user_data&id=' . $data['user']['id']?>"
           class="btn btn-success" role="button" aria-pressed="true">Разблокировать</a>
			<?php else: ?>
        <a href="<?= $data['config']['host'] . '/users.php?action=block_user_data&id=' . $data['user']['id']?>"
           class="btn btn-danger" role="button" aria-pressed="true">Заблокировать</a>
			<?php endif; ?>
    </form>
  </div>
</div>