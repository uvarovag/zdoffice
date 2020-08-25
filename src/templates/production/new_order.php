<div class="card">
  <div class="card-header bg-transparent">
    <h2 class="mb-0">Новая заявка на производство</h2>
  </div>
  <div class="card-body">
    <form action="<?= $data['config']['HOST'] . '/production.php' ?>" method="POST">
      <input type="hidden" name="action" value="new_order_data">
      <input type="hidden" name="form_id" value="<?= $data['formId'] ?>">
      <input type="hidden" name="redirect_success"
             value="<?= $data['config']['HOST'] . '/production.php?action=new_order_card'; ?>">
      <input type="hidden" name="redirect_error"
             value="<?= $data['config']['HOST'] . '/production.php?action=new_order_card'; ?>">
      <div class="row">

        <div class="col-12 col-md-6">
          <div class="mb-4">
            <h3>Данные контрагента</h3>
            <div class="form-row">
              <div class="form-group col-12 mb-4">
                <small class="text-gray">id заказа (<?= 'en ' . $data['config']['MIN_LEN_A'] . '-' . $data['config']['MAX_LEN_A'] ?>)</small>
                <input type="text" name="order_name_out" class="form-control" required
                       minlength="<?= $data['config']['MIN_LEN_A'] ?>" maxlength="<?= $data['config']['MAX_LEN_A'] ?>"
                       pattern="^[a-zA-Z0-9 ]+$">
              </div>
              <div class="form-group col-12 mb-4">
                <small class="text-gray">контагент (<?= 'en ' . $data['config']['MIN_LEN_A'] . '-' . $data['config']['MAX_LEN_A'] ?>)</small>
                <input type="text" name="client_name" class="form-control" required
                       minlength="<?= $data['config']['MIN_LEN_A'] ?>" maxlength="<?= $data['config']['MAX_LEN_A'] ?>"
                       pattern="^[a-zA-Z0-9 ]+$">
              </div>
              <div class="form-group col-12 mb-4">
                <small class="text-gray">телефон</small>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1"><?= $data['config']['PHONE_PREFIX'] ?></span>
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
            <hr>
          </div>

          <div class="mb-4">
            <h3>Данные Заказа</h3>
            <div class="form-row">
              <div class="form-group col-12 mb-4">
                <small class="text-gray">описание (<?= $data['config']['MIN_LEN_B'] . '-' . $data['config']['MAX_LEN_B'] ?>)</small>
                <textarea name="task_text" class="form-control" rows="5" required
                          minlength="<?= $data['config']['MIN_LEN_B'] ?>"
                          maxlength="<?= $data['config']['MAX_LEN_B'] ?>"></textarea>
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
									<?php foreach ($data['designerList'] as $designerd): ?>
                    <option value="<?= $designerd['id'] ?>"><?= $designerd['last_name'] . ' ' . $designerd['first_name'] ?></option>
									<?php endforeach; ?>
                </select>
              </div>
            </div>
          </div>
        </div>

        <div class="col-12 col-md-6">
          <div class="mb-4">
            <h3>Конструктор</h3>
            <div class="form-row">
              <div class="form-group col-4 mb-4">
                <small class="text-gray">Участвует в проекте</small>
                <div class="">
                  <label class="custom-toggle mt-2">
                    <input type="checkbox" name="const">
                    <span class="custom-toggle-slider rounded-circle"></span>
                  </label>
                </div>
              </div>
              <div class="form-group col-8 mb-4">
                <small class="text-gray">дата сдачи</small>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                  </div>
                  <input class="form-control datepicker" type="text" name="const_deadline" value="">
                </div>
              </div>
            </div>
            <hr>
          </div>

          <div class="mb-4">
            <h3>Цех реклама</h3>
            <div class="form-row">
              <div class="form-group col-4 mb-4">
                <small class="text-gray">Участвует в проекте</small>
                <div class="">
                  <label class="custom-toggle mt-2">
                    <input type="checkbox" name="adv">
                    <span class="custom-toggle-slider rounded-circle"></span>
                  </label>
                </div>
              </div>
              <div class="form-group col-8 mb-4">
                <small class="text-gray">дата сдачи</small>
                <div class="">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                    </div>
                    <input class="form-control datepicker" type="text" name="adv_deadline" value="">
                  </div>
                </div>
              </div>
            </div>
            <hr>
          </div>

          <div class="mb-4">
            <h3>Цех мебель</h3>
            <div class="form-row">
              <div class="form-group col-4 mb-4">
                <small class="text-gray">Участвует в проекте</small>
                <div class="">
                  <label class="custom-toggle mt-2">
                    <input type="checkbox" name="furn">
                    <span class="custom-toggle-slider rounded-circle"></span>
                  </label>
                </div>
              </div>
              <div class="form-group col-8 mb-4">
                <small class="text-gray">дата сдачи</small>
                <div class="">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                    </div>
                    <input class="form-control datepicker" type="text" name="furn_deadline" value="">
                  </div>
                </div>
              </div>
            </div>
            <hr>
          </div>

          <div class="mb-4">
            <h3>Цех металл</h3>
            <div class="form-row">
              <div class="form-group col-4 mb-4">
                <small class="text-gray">Участвует в проекте</small>
                <div class="">
                  <label class="custom-toggle mt-2">
                    <input type="checkbox" name="steel">
                    <span class="custom-toggle-slider rounded-circle"></span>
                  </label>
                </div>
              </div>
              <div class="form-group col-8 mb-4">
                <small class="text-gray">дата сдачи</small>
                <div class="">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                    </div>
                    <input class="form-control datepicker" type="text" name="steel_deadline" value="">
                  </div>
                </div>
              </div>
            </div>
            <hr>
          </div>

          <div class="mb-4">
            <h3>Склад</h3>
            <div class="form-row">
              <div class="form-group col-4 mb-4">
                <small class="text-gray">Участвует в проекте</small>
                <div class="">
                  <label class="custom-toggle mt-2">
                    <input type="checkbox" name="supply">
                    <span class="custom-toggle-slider rounded-circle"></span>
                  </label>
                </div>
              </div>
              <div class="form-group col-8 mb-4">
                <small class="text-gray">дата сдачи</small>
                <div class="">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                    </div>
                    <input class="form-control datepicker" type="text" name="supply_deadline" value="">
                  </div>
                </div>
              </div>
            </div>
            <hr>
          </div>

          <div class="mb-4">
            <h3>Монтаж</h3>
            <div class="form-row">
              <div class="form-group col-4 mb-4">
                <small class="text-gray">Участвует в проекте</small>
                <div class="">
                  <label class="custom-toggle mt-2">
                    <input type="checkbox" name="install">
                    <span class="custom-toggle-slider rounded-circle"></span>
                  </label>
                </div>
              </div>
              <div class="form-group col-8 mb-4">
                <small class="text-gray">дата сдачи</small>
                <div class="">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                    </div>
                    <input class="form-control datepicker" type="text" name="install_deadline" value="">
                  </div>
                </div>
              </div>
            </div>
            <div class="mb-4">
              <small class="text-gray">Описание монтажа (<?= $data['config']['MIN_LEN_B'] . '-' . $data['config']['MAX_LEN_B'] ?>)</small>
              <textarea class="form-control" id="exampleFormControlTextarea1" rows="5" name="install_task"
                        minlength="<?= $data['config']['MIN_LEN_B'] ?>"
                        maxlength="<?= $data['config']['MAX_LEN_B'] ?>"></textarea>
            </div>
            <div class="mb-4">
              <small class="text-gray">Адрес монтажа (<?= $data['config']['MIN_LEN_C'] . '-' . $data['config']['MAX_LEN_C'] ?>)</small>
              <textarea class="form-control" id="exampleFormControlTextarea1" rows="5" name="install_address"
                        minlength="<?= $data['config']['MIN_LEN_C'] ?>"
                        maxlength="<?= $data['config']['MAX_LEN_C'] ?>"></textarea>
            </div>
          </div>

        </div>

      </div>
      <input class="btn btn-primary" type="submit" value="Сохранить">
    </form>
  </div>
</div>
