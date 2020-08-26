<div class="card">
  <div class="card-header bg-transparent">
    <h2 class="mb-0"><?= $data['title'] ?></h2>
  </div>
  <div class="card-body">
    <form action="<?= $data['config']['HOST'] . '/adm_users.php' ?>" method="POST">
      <input type="hidden" name="action" value="new_user_data">
      <input type="hidden" name="form_id" value="<?= $data['formId'] ?>">
      <div class="row">
        <div class="col-12 col-md-6">
          <div class="mb-4">
            <h3>Данные пользователя</h3>
            <div class="form-row">
              <div class="form-group col-12 mb-4">
                <small class="text-gray">логин (<?= 'en ' . $data['config']['MIN_LEN_A'] . '-' . $data['config']['MAX_LEN_A'] ?>)</small>
                <input type="text" name="login" class="form-control" required
                       minlength="<?= $data['config']['MIN_LEN_A'] ?>" maxlength="<?= $data['config']['MAX_LEN_A'] ?>"
                       pattern="^[a-zA-Z0-9]+$">
              </div>
              <div class="form-group col-12 mb-4">
                <small class="text-gray">пароль (<?= 'en ' . $data['config']['MIN_LEN_A'] . '-' . $data['config']['MAX_LEN_A'] ?>)</small>
                <input type="password" name="password" class="form-control" required
                       minlength="<?= $data['config']['MIN_LEN_A'] ?>" maxlength="<?= $data['config']['MAX_LEN_A'] ?>"
                       pattern="^[a-zA-Z0-9]+$">
              </div>
              <div class="form-group col-12 mb-4">
                <small class="text-gray">фамилия (<?= 'ru ' . $data['config']['MIN_LEN_A'] . '-' . $data['config']['MAX_LEN_A'] ?>)</small>
                <input type="text" name="last_name" class="form-control" required
                       minlength="<?= $data['config']['MIN_LEN_A'] ?>" maxlength="<?= $data['config']['MAX_LEN_A'] ?>"
                       pattern="^[а-яА-ЯёЁ0-9]+$">
              </div>
              <div class="form-group col-12 mb-4">
                <small class="text-gray">имя (<?= 'ru ' . $data['config']['MIN_LEN_A'] . '-' . $data['config']['MAX_LEN_A'] ?>)</small>
                <input type="text" name="first_name" class="form-control" required
                       minlength="<?= $data['config']['MIN_LEN_A'] ?>" maxlength="<?= $data['config']['MAX_LEN_A'] ?>"
                       pattern="^[а-яА-ЯёЁ0-9]+$">
              </div>
            </div>
            <div class="form-row">
              <div class="form-group col-12 mb-4">
                <small class="text-gray">должность</small>
                <select name="position" required class="form-control">
                  <option></option>
									<?php foreach ($data['progData']['USERS_POSITIONS_LIST'] as $posKey => $posVal): ?>
                    <option value="<?= $posKey ?>"><?= $posVal ?></option>
									<?php endforeach; ?>
                </select>
              </div>
              <div class="form-group col-12 mb-4">
                <small class="text-gray">телефон</small>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1"><?= $data['config']['PHONE_PREFIX']; ?></span>
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
            <h3>Дизайн</h3>
            <div class="custom-control custom-checkbox mb-2">
              <input type="checkbox" name="design_order_new" id="auth_design_order_new" class="custom-control-input">
              <label class="custom-control-label" for="auth_design_order_new">создать заявку</label>
            </div>
            <div class="custom-control custom-checkbox mb-2">
              <input type="checkbox" name="design_order_view" id="auth_design_order_view" class="custom-control-input">
              <label class="custom-control-label" for="auth_design_order_view">просматривать заявки</label>
            </div>
            <div class="custom-control custom-checkbox mb-2">
              <input type="checkbox" name="design_order_change_status" id="auth_design_order_change_status" class="custom-control-input">
              <label class="custom-control-label" for="auth_design_order_change_status">менять статус заявки</label>
            </div>
            <div class="custom-control custom-checkbox mb-2">
              <input type="checkbox" name="design_order_select_designer" id="auth_design_order_select_designer" class="custom-control-input">
              <label class="custom-control-label" for="auth_design_order_select_designer">распределять заявки</label>
            </div>
            <div class="custom-control custom-checkbox mb-2">
              <input type="checkbox" name="design_order_change_priority" id="auth_design_order_change_priority" class="custom-control-input">
              <label class="custom-control-label" for="auth_design_order_change_priority">менять приоритет заявки</label>
            </div>
          </div>
          <div class="mb-4">
            <hr>
            <h3>Производство</h3>
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
            <div class="custom-control custom-checkbox mb-2">
              <input type="checkbox" name="production_order_change_status_const" id="auth_production_order_change_status_const"
                     class="custom-control-input">
              <label class="custom-control-label" for="auth_production_order_change_status_const">
                <b>конструктор</b> менять статус заявки</label>
            </div>
            <div class="custom-control custom-checkbox mb-2">
              <input type="checkbox" name="production_order_change_status_adv" id="auth_production_order_change_status_adv"
                     class="custom-control-input">
              <label class="custom-control-label" for="auth_production_order_change_status_adv">
                <b>реклама</b> менять статус заявки</label>
            </div>
            <div class="custom-control custom-checkbox mb-2">
              <input type="checkbox" name="production_order_change_status_furn" id="auth_production_order_change_status_furn"
                     class="custom-control-input">
              <label class="custom-control-label" for="auth_production_order_change_status_furn">
                <b>мебель</b> менять статус заявки</label>
            </div>
            <div class="custom-control custom-checkbox mb-2">
              <input type="checkbox" name="production_order_change_status_steel" id="auth_production_order_change_status_steel"
                     class="custom-control-input">
              <label class="custom-control-label" for="auth_production_order_change_status_steel">
                <b>металл</b> менять статус заявки</label>
            </div>
            <div class="custom-control custom-checkbox mb-2">
              <input type="checkbox" name="production_order_change_status_install" id="auth_production_order_change_status_install"
                     class="custom-control-input">
              <label class="custom-control-label" for="auth_production_order_change_status_install">
                <b>монтаж</b> менять статус заявки</label>
            </div>
            <div class="custom-control custom-checkbox mb-2">
              <input type="checkbox" name="production_order_change_status_supply" id="auth_production_order_change_status_supply"
                     class="custom-control-input">
              <label class="custom-control-label" for="auth_production_order_change_status_supply">
                <b>склад</b> менять статус заявки</label>
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