<div class="card">
  <div class="card-header bg-transparent">
    <h2 class="mb-0"><?= $data['title'] ?></h2>
  </div>
  <div class="card-body">
    <form action="<?= $data['config']['HOST'] . '/design.php' ?>" method="POST">
      <input type="hidden" name="action" value="new_order_data">
      <input type="hidden" name="form_id" value="<?= $data['formId'] ?>">
      <div class="row mb-4">
        <fieldset class="col-12 col-md-6">
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
        </fieldset>

        <fieldset class="col-12 col-md-6">
          <h3>Данные заказа</h3>
          <div class="mb-4">
            <small class="text-gray">описание (<?= $data['config']['MIN_LEN_B'] . '-' . $data['config']['MAX_LEN_B'] ?>)</small>
            <textarea name="task_text" class="form-control" rows="5" required
                      minlength="<?= $data['config']['MIN_LEN_B'] ?>"
                      maxlength="<?= $data['config']['MAX_LEN_B'] ?>"></textarea>
          </div>
          <div class="form-row">
            <div class="form-group col-12 mb-4">
              <small class="text-gray">Формат</small>
              <div class="">
                <div class="mt-2">
                  <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" id="design_format_2d" name="design_format" value="2D" required
                           class="custom-control-input">
                    <label class="custom-control-label" for="design_format_2d">2D</label>
                  </div>
                  <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" id="design_format_3d" name="design_format" value="3D" required
                           class="custom-control-input">
                    <label class="custom-control-label" for="design_format_3d">3D</label>
                  </div>
                </div>
              </div>
            </div>
            <div class="form-group col-12 mb-4">
              <small class="text-gray">дата сдачи</small>
              <div class="">
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                  </div>
                  <input type="text" name="deadline_date" class="form-control datepicker" required
                         placeholder="" value="">
                </div>
              </div>
            </div>
          </div>
        </fieldset>
      </div>
      <input class="btn btn-primary" type="submit" value="Сохранить">
    </form>
  </div>
</div>