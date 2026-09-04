<div class="card">
  <div class="card-header bg-transparent">
    <h2 class="mb-0"><?= $data['title']; ?></h2>
  </div>
  <div class="card-body">
    <form action="<?= $data['CONFIG']['HOST'] . '/adm_users.php'; ?>" method="POST">
      <input type="hidden" name="action" value="new_user_data">
      <input type="hidden" name="form_id" value="<?= $data['formId']; ?>">
      <div class="row">
        <div class="col-12 col-md-6">
          <div class="mb-4">
            <h4>Данные пользователя</h4>
            <div class="form-row">
              <div class="form-group col-12 mb-4">
                <small class="text-gray">логин (<?= 'en ' . $data['CONFIG']['MIN_LEN_A'] . '-' . $data['CONFIG']['MAX_LEN_A']; ?>)</small>
                <input type="text" name="login" class="form-control" required
                       minlength="<?= $data['CONFIG']['MIN_LEN_A']; ?>" maxlength="<?= $data['CONFIG']['MAX_LEN_A']; ?>"
                       pattern="^[a-zA-Z0-9]+$">
              </div>
              <div class="form-group col-12 mb-4">
                <small class="text-gray">пароль (en <?= $data['CONFIG']['MIN_LEN_PASSWORD'] . '-' . $data['CONFIG']['MAX_LEN_A']; ?>, буквы и цифры)</small>
                <input type="password" name="password" class="form-control" required
                       minlength="<?= $data['CONFIG']['MIN_LEN_PASSWORD']; ?>" maxlength="<?= $data['CONFIG']['MAX_LEN_A']; ?>"
                       pattern="^(?=.*[a-zA-Z])(?=.*[0-9])[a-zA-Z0-9]{<?= $data['CONFIG']['MIN_LEN_PASSWORD']; ?>,<?= $data['CONFIG']['MAX_LEN_A']; ?>}$"
                       title="Минимум <?= $data['CONFIG']['MIN_LEN_PASSWORD']; ?> символов, должны быть и буквы, и цифры">
              </div>
              <div class="form-group col-12 mb-4">
                <small class="text-gray">фамилия (<?= 'ru ' . $data['CONFIG']['MIN_LEN_A'] . '-' . $data['CONFIG']['MAX_LEN_A']; ?>)</small>
                <input type="text" name="last_name" class="form-control" required
                       minlength="<?= $data['CONFIG']['MIN_LEN_A']; ?>" maxlength="<?= $data['CONFIG']['MAX_LEN_A']; ?>"
                       pattern="^[а-яА-ЯёЁ0-9]+$">
              </div>
              <div class="form-group col-12 mb-4">
                <small class="text-gray">имя (<?= 'ru ' . $data['CONFIG']['MIN_LEN_A'] . '-' . $data['CONFIG']['MAX_LEN_A']; ?>)</small>
                <input type="text" name="first_name" class="form-control" required
                       minlength="<?= $data['CONFIG']['MIN_LEN_A']; ?>" maxlength="<?= $data['CONFIG']['MAX_LEN_A']; ?>"
                       pattern="^[а-яА-ЯёЁ0-9]+$">
              </div>
            </div>
            <div class="form-row">
              <div class="form-group col-12 mb-4">
                <small class="text-gray">должность</small>
                <select name="position" required class="form-control">
                  <option></option>
									<?php foreach ($data['PROG_DATA']['USERS_POSITIONS_LIST'] as $posKey => $posVal): ?>
                    <option value="<?= $posKey; ?>"><?= $posVal; ?></option>
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
                         placeholder="XX XXX XX XX"">
                </div>
              </div>
              <div class="form-group col-12 mb-4">
                <small class="text-gray">почта</small>
                <input type="email" name="email" class="form-control" required>
              </div>
            </div>
          </div>
        </div>

        <div class="col-12 col-md-6">
          <div class="mb-4">
            <h4>Дизайн</h4>
            <div class="custom-control custom-checkbox mb-2">
              <input type="checkbox" name="design_order_new" id="auth_design_order_new" class="custom-control-input">
              <label class="custom-control-label" for="auth_design_order_new">создать заявку</label>
            </div>
            <div class="custom-control custom-checkbox mb-2">
              <input type="checkbox" name="design_order_view" id="auth_design_order_view" class="custom-control-input">
              <label class="custom-control-label" for="auth_design_order_view">просматривать заявки</label>
            </div>
            <div class="custom-control custom-checkbox mb-2">
              <input type="checkbox" name="design_order_select_designer" id="auth_design_order_select_designer" class="custom-control-input">
              <label class="custom-control-label" for="auth_design_order_select_designer">распределять заявки</label>
            </div>
            <div class="custom-control custom-checkbox mb-2">
              <input type="checkbox" name="design_order_change_priority" id="auth_design_order_change_priority" class="custom-control-input">
              <label class="custom-control-label" for="auth_design_order_change_priority">менять приоритет заявки</label>
            </div>
						<?php foreach ($data['PROG_DATA']['DESIGN_TYPES'] as $dKey => $dVal): ?>
              <div class="custom-control custom-checkbox mb-2">
                <input type="checkbox" name="design_order_change_status_<?= $dKey; ?>" id="auth_design_order_change_status_<?= $dKey; ?>" class="custom-control-input">
                <label class="custom-control-label" for="auth_design_order_change_status_<?= $dKey; ?>">
                  <b><?= $dVal; ?></b> менять статус заявки</label>
              </div>
						<?php endforeach; ?>
          </div>
          <div class="mb-4">
            <hr>
            <h4>Производство</h4>
            <div class="custom-control custom-checkbox mb-2">
              <input type="checkbox" name="production_order_new" id="auth_production_order_new" class="custom-control-input">
              <label class="custom-control-label" for="auth_production_order_new">создать заявку</label>
            </div>
            <div class="custom-control custom-checkbox mb-2">
              <input type="checkbox" name="production_order_view" id="auth_production_order_view" class="custom-control-input">
              <label class="custom-control-label" for="auth_production_order_view">просматривать заявки</label>
            </div>
            <div class="custom-control custom-checkbox mb-2">
              <input type="checkbox" name="production_order_change_priority" id="auth_production_order_change_priority" class="custom-control-input">
              <label class="custom-control-label" for="auth_production_order_change_priority">менять приоритет заявки</label>
            </div>
            <div class="custom-control custom-checkbox mb-2">
              <input type="checkbox" name="production_order_start" id="auth_production_order_start" class="custom-control-input">
              <label class="custom-control-label" for="auth_production_order_start">запустить в работу заявку</label>
            </div>
            <div class="custom-control custom-checkbox mb-2">
              <input type="checkbox" name="production_order_cancel" id="auth_production_order_cancel" class="custom-control-input">
              <label class="custom-control-label" for="auth_production_order_cancel">подтвердить отмену заявки</label>
            </div>
						<?php foreach ($data['PROG_DATA']['DEPARTMENTS_LIST'] as $depKey => $depVal): ?>
              <div class="custom-control custom-checkbox mb-2">
                <input type="checkbox" name="production_order_change_status_<?= $depKey; ?>" id="auth_production_order_change_status_<?= $depKey; ?>"
                       class="custom-control-input">
                <label class="custom-control-label" for="auth_production_order_change_status_<?= $depKey; ?>">
                  <b><?= $depVal; ?></b> менять статус заявки</label>
              </div>
            <?php endforeach; ?>
          </div>
          <div class="mb-4">
            <hr>
            <h4>Клиенты</h4>
            <div class="custom-control custom-checkbox mb-2">
              <input type="checkbox" name="clients_view" id="auth_clients_view" class="custom-control-input">
              <label class="custom-control-label" for="auth_clients_view">просматривать клиентов</label>
            </div>
            <div class="custom-control custom-checkbox mb-2">
              <input type="checkbox" name="clients_new" id="auth_clients_new" class="custom-control-input">
              <label class="custom-control-label" for="auth_clients_new">создавать клиентов</label>
            </div>
            <div class="custom-control custom-checkbox mb-2">
              <input type="checkbox" name="clients_edit" id="auth_clients_edit" class="custom-control-input">
              <label class="custom-control-label" for="auth_clients_edit">редактировать клиентов</label>
            </div>
          </div>
          <div class="mb-4">
            <hr>
            <h4>Деньги</h4>
            <div class="custom-control custom-checkbox mb-2">
              <input type="checkbox" name="money_view" id="auth_money_view" class="custom-control-input">
              <label class="custom-control-label" for="auth_money_view">просматривать раздел «Деньги»</label>
            </div>
            <div class="custom-control custom-checkbox mb-2">
              <input type="checkbox" name="money_new" id="auth_money_new" class="custom-control-input">
              <label class="custom-control-label" for="auth_money_new">вносить операции</label>
            </div>
            <div class="custom-control custom-checkbox mb-2">
              <input type="checkbox" name="money_delete" id="auth_money_delete" class="custom-control-input">
              <label class="custom-control-label" for="auth_money_delete">удалять операции</label>
            </div>
          </div>
        </div>
      </div>
      <div class="mb-4">
        <input class="btn btn-primary" type="submit" value="Сохранить">
      </div>
    </form>
  </div>
</div>