<div class="card">
  <div class="card-header bg-transparent">
    <h2 class="mb-0">Новый пользователь</h2>
  </div>
  <div class="card-body">
    <form action="/users.php" method="POST">
      <input type="hidden" name="action" value="add_user">
      <input type="hidden" name="form_id" value="<?= $data['form_id'] ?>">
      <fieldset>
        <div class="row">
          <div class="col-12 col-md mb-4">
            <input type="text" name="login" class="form-control" required pattern="[A-Za-z0-9 ]{5,20}" placeholder="логин">
          </div>
          <div class="col-12 col-md mb-4">
            <input type="text" name="password" class="form-control" required pattern="[A-Za-z0-9 ]{5,20}" placeholder="пароль">
          </div>
        </div>
        <div class="row">
          <div class="col-12 col-md mb-4">
            <input type="text" name="last_name" class="form-control" required pattern="[А-Яа-яЁё0-9 ]{5,20}" placeholder="фамилия">
          </div>
          <div class="col-12 col-md mb-4">
            <input type="text" name="first_name" class="form-control" required pattern="[А-Яа-яЁё0-9 ]{5,20}" placeholder="имя">
          </div>
        </div>
        <div class="row">
          <div class="col-12 col-md-6 col-lg-4 mb-4">
            <input type="text" name="position" class="form-control" required pattern="[А-Яа-яЁё0-9 ]{5,20}" placeholder="должность">
          </div>
          <div class="col-12 col-md-6 col-lg-4 mb-4 input-group">
            <div class="input-group-prepend">
              <span class="input-group-text" id="basic-addon1">+998</span>
            </div>
            <input type="tel" name="mobile_phone" class="form-control" required placeholder="XX XXX XX XX" pattern="\d{2}\s\d{3}\s\d{2}\s\d{2}"">
          </div>
          <div class="col-12 col-md-6 col-lg-4 mb-4">
            <input type="email" name="email" class="form-control" required placeholder="почта">
          </div>
        </div>
      </fieldset>

      <hr>

      <div class="row">
        <fieldset class="col-12 col-md-6 mb-4">
          <h3 class="mb-4">Дизайн</h3>
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
        </fieldset>
        <fieldset class="col-12 col-lg-6 mb-4">
          <h3 class="mb-4">Производство</h3>
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
          <hr>
          <div class="custom-control custom-checkbox mb-2">
            <input type="checkbox" name="production_order_change_status_const" id="auth_production_order_change_status_const" class="custom-control-input">
            <label class="custom-control-label" for="auth_production_order_change_status_const"><b>конструктор</b> менять статус заявки</label>
          </div>
          <div class="custom-control custom-checkbox mb-2">
            <input type="checkbox" name="production_order_change_status_adv" id="auth_production_order_change_status_adv" class="custom-control-input">
            <label class="custom-control-label" for="auth_production_order_change_status_adv"><b>реклама</b> менять статус заявки</label>
          </div>
          <div class="custom-control custom-checkbox mb-2">
            <input type="checkbox" name="production_order_change_status_furn" id="auth_production_order_change_status_furn" class="custom-control-input">
            <label class="custom-control-label" for="auth_production_order_change_status_furn"><b>мебель</b> менять статус заявки</label>
          </div>
          <div class="custom-control custom-checkbox mb-2">
            <input type="checkbox" name="production_order_change_status_steel" id="auth_production_order_change_status_steel" class="custom-control-input">
            <label class="custom-control-label" for="auth_production_order_change_status_steel"><b>металл</b> менять статус заявки</label>
          </div>
          <div class="custom-control custom-checkbox mb-2">
            <input type="checkbox" name="production_order_change_status_install" id="auth_production_order_change_status_install" class="custom-control-input">
            <label class="custom-control-label" for="auth_production_order_change_status_install"><b>монтаж</b> менять статус заявки</label>
          </div>
          <div class="custom-control custom-checkbox mb-2">
            <input type="checkbox" name="production_order_change_status_supply" id="auth_production_order_change_status_supply" class="custom-control-input">
            <label class="custom-control-label" for="auth_production_order_change_status_supply"><b>склад</b> менять статус заявки</label>
          </div>
        </fieldset>
      </div>
      <hr>
      <input class="btn btn-primary" type="submit" value="Сохранить">
    </form>
  </div>
</div>