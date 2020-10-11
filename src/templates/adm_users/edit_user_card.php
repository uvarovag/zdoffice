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
    <form action="<?= $data['CONFIG']['HOST'] . '/adm_users.php'; ?>" method="POST">
      <input type="hidden" name="action" value="edit_user_data">
      <input type="hidden" name="id" value="<?= $data['user']['id']; ?>">
      <input type="hidden" name="form_id" value="<?= $data['formId']; ?>">
      <div class="row">
        <div class="col-12 col-md-6">
          <div class="mb-4">
            <h4>Данные пользователя</h4>
            <div class="form-row">
              <div class="form-group col-12 mb-4">
                <small class="text-gray">логин (<?= 'en ' . $data['CONFIG']['MIN_LEN_A'] . '-' . $data['CONFIG']['MAX_LEN_A']; ?>)</small>
                <input type="text" name="login" class="form-control" required readonly
                       minlength="<?= $data['CONFIG']['MIN_LEN_A']; ?>" maxlength="<?= $data['CONFIG']['MAX_LEN_A']; ?>"
                       pattern="^[a-zA-Z0-9]+$"
                       value="<?= $data['user']['login']; ?>">
              </div>
              <div class="form-group col-12 mb-4">
                <small class="text-gray">пароль (<?= 'en ' . $data['CONFIG']['MIN_LEN_A'] . '-' . $data['CONFIG']['MAX_LEN_A']; ?>)</small>
                <input type="password" name="password" class="form-control" required
                       minlength="<?= $data['CONFIG']['MIN_LEN_A']; ?>" maxlength="<?= $data['CONFIG']['MAX_LEN_A']; ?>"
                       pattern="^[a-zA-Z0-9]+$"
                       value="<?= $data['user']['password']; ?>">
              </div>
              <div class="form-group col-12 mb-4">
                <small class="text-gray">фамилия (<?= 'ru ' . $data['CONFIG']['MIN_LEN_A'] . '-' . $data['CONFIG']['MAX_LEN_A']; ?>)</small>
                <input type="text" name="last_name" class="form-control" required
                       minlength="<?= $data['CONFIG']['MIN_LEN_A']; ?>" maxlength="<?= $data['CONFIG']['MAX_LEN_A']; ?>"
                       pattern="^[а-яА-ЯёЁ0-9]+$"
                       value="<?= $data['user']['last_name']; ?>">
              </div>
              <div class="form-group col-12 mb-4">
                <small class="text-gray">имя (<?= 'ru ' . $data['CONFIG']['MIN_LEN_A'] . '-' . $data['CONFIG']['MAX_LEN_A']; ?>)</small>
                <input type="text" name="first_name" class="form-control" required
                       minlength="<?= $data['CONFIG']['MIN_LEN_A']; ?>" maxlength="<?= $data['CONFIG']['MAX_LEN_A']; ?>"
                       pattern="^[а-яА-ЯёЁ0-9]+$"
                       value="<?= $data['user']['first_name']; ?>">
              </div>
            </div>
            <div class="form-row">
              <div class="form-group col-12 mb-4">
                <small class="text-gray">должность</small>
                <select name="position" required class="form-control">
                  <option value="none" disabled selected>выбрать</option>
									<?php foreach ($data['PROG_DATA']['USERS_POSITIONS_LIST'] as $posKey => $posVal): ?>
										<?php if ($data['user']['position'] == $posKey): ?>
                      <option value="<?= $posKey; ?>" selected><?= $posVal; ?></option>
										<?php else: ?>
                      <option value="<?= $posKey; ?>"><?= $posVal; ?></option>
										<?php endif; ?>
									<?php endforeach; ?>
                </select>
              </div>
              <div class="form-group col-12 mb-4">
                <small class="text-gray">телефон</small>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1"><?= $data['CONFIG']['PHONE_PREFIX']; ?></span>
                  </div>
                  <input type="tel" name="mobile_phone" class="form-control" required
                         pattern="\d{2}\s\d{3}\s\d{2}\s\d{2}"
                         value="<?= $data['user']['mobile_phone']; ?>">
                </div>
              </div>
              <div class="form-group col-12 mb-4">
                <small class="text-gray">почта</small>
                <input type="email" name="email" class="form-control" required value="<?= $data['user']['email']; ?>">
              </div>
            </div>
          </div>
        </div>

        <div class="col-12 col-md-6">
          <div class="mb-4">
            <h4>Дизайн</h4>
            <div class="custom-control custom-checkbox mb-2">
              <input type="checkbox" name="design_order_new" id="design_order_new"
                     class="custom-control-input" <?= $data['user']['auth_design_order_new'] ? 'checked' : ''; ?>>
              <label class="custom-control-label" for="design_order_new">создать заявку</label>
            </div>
            <div class="custom-control custom-checkbox mb-2">
              <input type="checkbox" name="design_order_view" id="design_order_view"
                     class="custom-control-input" <?= $data['user']['auth_design_order_view'] ? 'checked' : ''; ?>>
              <label class="custom-control-label" for="design_order_view">просматривать заявки</label>
            </div>

            <div class="custom-control custom-checkbox mb-2">
              <input type="checkbox" name="design_order_select_designer" id="design_order_select_designer"
                     class="custom-control-input" <?= $data['user']['auth_design_order_select_designer'] ? 'checked' : ''; ?>>
              <label class="custom-control-label" for="design_order_select_designer">распределять заявки</label>
            </div>
            <div class="custom-control custom-checkbox mb-2">
              <input type="checkbox" name="design_order_change_priority" id="design_order_change_priority"
                     class="custom-control-input" <?= $data['user']['auth_design_order_change_priority'] ? 'checked' : ''; ?>>
              <label class="custom-control-label" for="design_order_change_priority">менять приоритет заявки</label>
            </div>
						<?php foreach ($data['PROG_DATA']['DESIGN_TYPES'] as $dKey => $dVal): ?>
              <div class="custom-control custom-checkbox mb-2">
                <input type="checkbox" name="design_order_change_status_<?= $dKey; ?>" id="design_order_change_status_<?= $dKey; ?>"
                       class="custom-control-input" <?= $data['user']['auth_design_order_change_status_' . $dKey] ? 'checked' : ''; ?>>
                <label class="custom-control-label" for="design_order_change_status_<?= $dKey; ?>">
                  <b><?= $dVal; ?></b> менять статус заявки</label>
              </div>
						<?php endforeach; ?>

          </div>

          <div class="mb-4">
            <hr>
            <h4>Производство</h4>
            <div class="custom-control custom-checkbox mb-2">
              <input type="checkbox" name="production_order_new" id="production_order_new"
                     class="custom-control-input" <?= $data['user']['auth_production_order_new'] ? 'checked' : ''; ?>>
              <label class="custom-control-label" for="production_order_new">создать заявку</label>
            </div>
            <div class="custom-control custom-checkbox mb-2">
              <input type="checkbox" name="production_order_view" id="production_order_view"
                     class="custom-control-input" <?= $data['user']['auth_production_order_view'] ? 'checked' : ''; ?>>
              <label class="custom-control-label" for="production_order_view">просматривать заявки</label>
            </div>
            <div class="custom-control custom-checkbox mb-2">
              <input type="checkbox" name="production_order_change_priority" id="production_order_change_priority"
                     class="custom-control-input" <?= $data['user']['auth_production_order_change_priority'] ? 'checked' : ''; ?>>
              <label class="custom-control-label" for="production_order_change_priority">менять приоритет заявки</label>
            </div>
            <div class="custom-control custom-checkbox mb-2">
              <input type="checkbox" name="production_order_start" id="production_order_start"
                     class="custom-control-input" <?= $data['user']['auth_production_order_start'] ? 'checked' : ''; ?>>
              <label class="custom-control-label" for="production_order_start">запустить в работу заявку</label>
            </div>
            <div class="custom-control custom-checkbox mb-2">
              <input type="checkbox" name="production_order_cancel" id="production_order_cancel"
                     class="custom-control-input" <?= $data['user']['auth_production_order_cancel'] ? 'checked' : ''; ?>>
              <label class="custom-control-label" for="production_order_cancel">подтвердить отмену заявки</label>
            </div>
						<?php foreach ($data['PROG_DATA']['DEPARTMENTS_LIST'] as $depKey => $depVal): ?>
              <div class="custom-control custom-checkbox mb-2">
                <input type="checkbox" name="production_order_change_status_<?= $depKey; ?>" id="production_order_change_status_<?= $depKey; ?>"
                       class="custom-control-input" <?= $data['user']['auth_production_order_change_status_' . $depKey] ? 'checked' : ''; ?>>
                <label class="custom-control-label" for="production_order_change_status_<?= $depKey; ?>">
                  <b><?= $depVal; ?></b> менять статус заявки</label>
              </div>
            <?php endforeach; ?>
          </div>
        </div>
      </div>
      <div class="">
        <input class="btn btn-primary mb-4" type="submit" value="Сохранить">
				<?php if ($data['user']['is_block']): ?>
          <a href="<?= $data['CONFIG']['HOST'] . '/adm_users.php?action=unlock_user_data&id=' . $data['user']['id']; ?>"
             class="btn btn-success mb-4" role="button" aria-pressed="true">Разблокировать</a>
				<?php else: ?>
          <a href="<?= $data['CONFIG']['HOST'] . '/adm_users.php?action=block_user_data&id=' . $data['user']['id']; ?>"
             class="btn btn-danger mb-4" role="button" aria-pressed="true">Заблокировать</a>
				<?php endif; ?>
      </div>
    </form>
  </div>
</div>