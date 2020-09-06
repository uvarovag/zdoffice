<div class="card">
  <div class="card-header bg-transparent">
    <h2 class="mb-0">Новая заявка на производство</h2>
  </div>
  <div class="card-body">
    <form action="<?= $data['CONFIG']['HOST'] . '/production.php'; ?>" method="POST">
      <input type="hidden" name="action" value="new_order_data">
      <input type="hidden" name="form_id" value="<?= $data['formId']; ?>">
      <input type="hidden" name="redirect_success"
             value="<?= $data['CONFIG']['HOST'] . '/production.php?action=new_order_card'; ?>">
      <input type="hidden" name="redirect_error"
             value="<?= $data['CONFIG']['HOST'] . '/production.php?action=new_order_card'; ?>">
      <div class="row">

        <div class="col-12 col-md-6">
          <div class="mb-4">
            <h4>Данные контрагента</h4>
            <div class="form-row">
              <div class="form-group col-12 mb-4">
                <small class="text-gray">Счет бонсенс (<?= 'en ' . $data['CONFIG']['MIN_LEN_A'] . '-' . $data['CONFIG']['MAX_LEN_A']; ?>)</small>
                <input type="text" name="order_name_out" class="form-control" required
                       minlength="<?= $data['CONFIG']['MIN_LEN_A']; ?>" maxlength="<?= $data['CONFIG']['MAX_LEN_A']; ?>"
                       pattern="^[a-zA-Z0-9 ]+$">
              </div>
              <div class="form-group col-12 mb-4">
                <small class="text-gray">контагент (<?= 'en ' . $data['CONFIG']['MIN_LEN_A'] . '-' . $data['CONFIG']['MAX_LEN_A']; ?>)</small>
                <input type="text" name="client_name" class="form-control" required
                       minlength="<?= $data['CONFIG']['MIN_LEN_A']; ?>" maxlength="<?= $data['CONFIG']['MAX_LEN_A']; ?>"
                       pattern="^[a-zA-Z0-9 ]+$">
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
                <input type="email" name="email" class="form-control">
              </div>
            </div>
            <hr>
          </div>

          <div class="mb-4">
            <h4>Данные Заказа</h4>
            <div class="form-row">
              <div class="form-group col-12 mb-4">
                <small class="text-gray">описание (<?= $data['CONFIG']['MIN_LEN_B'] . '-' . $data['CONFIG']['MAX_LEN_B']; ?>)</small>
                <textarea name="task_text" class="form-control" rows="5" required
                          minlength="<?= $data['CONFIG']['MIN_LEN_B']; ?>"
                          maxlength="<?= $data['CONFIG']['MAX_LEN_B']; ?>"></textarea>
              </div>
              <div class="form-group col-12 mb-4">
                <small class="text-gray">количество</small>
                <input type="number" name="task_quantity" class="form-control" required>
              </div>
            </div>
            <div class="form-row">
              <div class="form-group col-12 mb-4">
                <small class="text-gray">дизайнер</small>
                <select name="designer_id" class="form-control" required>
                  <option></option>
									<?php foreach ($data['designers'] as $designerd): ?>
                    <option value="<?= $designerd['id']; ?>"><?= $designerd['last_name'] . ' ' . $designerd['first_name']; ?></option>
									<?php endforeach; ?>
                </select>
              </div>
            </div>
          </div>
        </div>

        <div class="col-12 col-md-6">
          <div class="mb-4">
            <h4>Конструктор</h4>
            <div class="form-row">
              <div class="form-group col-4 mb-4">
                <small class="text-gray">Участвует в проекте</small>
                <div class="">
                  <label class="custom-toggle my-2">
                    <input class="at-least-one-enabled if-enabled-required" data-required=".input-const" data-dnone=".block-const" type="checkbox" name="const">
                    <span class="custom-toggle-slider rounded-circle"></span>
                  </label>
                </div>
              </div>
              <div class="block-const d-none form-group col-8 mb-4">
                <small class="text-gray">дата сдачи</small>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                  </div>
                  <input class="input-const form-control datepicker" type="text" name="const_deadline" value="">
                </div>
              </div>
            </div>
            <hr>
          </div>

          <div class="mb-4">
            <h4>Цех реклама</h4>
            <div class="form-row">
              <div class="form-group col-4 mb-4">
                <small class="text-gray">Участвует в проекте</small>
                <div class="">
                  <label class="custom-toggle my-2">
                    <input class="at-least-one-enabled if-enabled-required" data-required=".input-advv" data-dnone=".block-advv" type="checkbox" name="adv">
                    <span class="custom-toggle-slider rounded-circle"></span>
                  </label>
                </div>
              </div>
              <div class="block-advv d-none form-group col-8 mb-4">
                <small class="text-gray">дата сдачи</small>
                <div class="">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                    </div>
                    <input class="input-advv form-control datepicker" type="text" name="adv_deadline" value="">
                  </div>
                </div>
              </div>
            </div>
            <hr>
          </div>

          <div class="mb-4">
            <h4>Цех мебель</h4>
            <div class="form-row">
              <div class="form-group col-4 mb-4">
                <small class="text-gray">Участвует в проекте</small>
                <div class="">
                  <label class="custom-toggle my-2">
                    <input class="at-least-one-enabled if-enabled-required" data-required=".input-furn" data-dnone=".block-furn" type="checkbox" name="furn">
                    <span class="custom-toggle-slider rounded-circle"></span>
                  </label>
                </div>
              </div>
              <div class="block-furn d-none form-group col-8 mb-4">
                <small class="text-gray">дата сдачи</small>
                <div class="">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                    </div>
                    <input class="input-furn form-control datepicker" type="text" name="furn_deadline" value="">
                  </div>
                </div>
              </div>
            </div>
            <hr>
          </div>

          <div class="mb-4">
            <h4>Цех металл</h4>
            <div class="form-row">
              <div class="form-group col-4 mb-4">
                <small class="text-gray">Участвует в проекте</small>
                <div class="">
                  <label class="custom-toggle my-2">
                    <input class="at-least-one-enabled if-enabled-required" data-required=".input-steel" data-dnone=".block-steel" type="checkbox" name="steel">
                    <span class="custom-toggle-slider rounded-circle"></span>
                  </label>
                </div>
              </div>
              <div class="block-steel d-none form-group col-8 mb-4">
                <small class="text-gray">дата сдачи</small>
                <div class="">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                    </div>
                    <input class="input-steel form-control datepicker" type="text" name="steel_deadline" value="">
                  </div>
                </div>
              </div>
            </div>
            <hr>
          </div>

          <div class="mb-4">
            <h4>Склад</h4>
            <div class="form-row">
              <div class="form-group col-4 mb-4">
                <small class="text-gray">Участвует в проекте</small>
                <div class="">
                  <label class="custom-toggle my-2">
                    <input class="at-least-one-enabled if-enabled-required" data-required=".input-supply" data-dnone=".block-supply" type="checkbox" name="supply">
                    <span class="custom-toggle-slider rounded-circle"></span>
                  </label>
                </div>
              </div>
              <div class="block-supply d-none form-group col-8 mb-4">
                <small class="text-gray">дата сдачи</small>
                <div class="">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                    </div>
                    <input class="input-supply form-control datepicker" type="text" name="supply_deadline" value="">
                  </div>
                </div>
              </div>
            </div>
            <hr>
          </div>

          <div class="mb-4">
            <h4>Монтаж</h4>
            <div class="form-row">
              <div class="form-group col-4 mb-4">
                <small class="text-gray">Участвует в проекте</small>
                <div class="">
                  <label class="custom-toggle my-2">
                    <input class="at-least-one-enabled if-enabled-required" data-required=".input-install" data-dnone=".block-install" type="checkbox" name="install">
                    <span class="custom-toggle-slider rounded-circle"></span>
                  </label>
                </div>
              </div>
              <div class="block-install d-none form-group col-8 mb-4">
                <small class="text-gray">дата сдачи</small>
                <div class="">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                    </div>
                    <input class="input-install form-control datepicker" type="text" name="install_deadline" value="">
                  </div>
                </div>
              </div>
            </div>
            <div class="block-install d-none mb-4">
              <small class="text-gray">Описание монтажа (<?= $data['CONFIG']['MIN_LEN_B'] . '-' . $data['CONFIG']['MAX_LEN_B']; ?>)</small>
              <textarea class="form-control" id="exampleFormControlTextarea1" rows="5" name="install_task"
                        minlength="<?= $data['CONFIG']['MIN_LEN_B']; ?>"
                        maxlength="<?= $data['CONFIG']['MAX_LEN_B']; ?>"></textarea>
            </div>
            <div class="block-install d-none mb-4">
              <small class="text-gray">Адрес монтажа (<?= $data['CONFIG']['MIN_LEN_C'] . '-' . $data['CONFIG']['MAX_LEN_C']; ?>)</small>
              <textarea class="form-control" id="exampleFormControlTextarea1" rows="5" name="install_address"
                        minlength="<?= $data['CONFIG']['MIN_LEN_C']; ?>"
                        maxlength="<?= $data['CONFIG']['MAX_LEN_C']; ?>"></textarea>
            </div>
          </div>
        </div>
      </div>
      <div class="mb-4">
        <input class="btn btn-primary at-least-one-enabled_disabled" type="submit" value="Сохранить" disabled>
      </div>
      <small class="at-least-one-enabled_dnone text-danger">Выбрать кто участвует в проекте</small>
    </form>
  </div>
</div>
