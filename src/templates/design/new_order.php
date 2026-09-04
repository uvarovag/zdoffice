<div class="card">
  <div class="card-header bg-transparent">
    <h2 class="mb-0"><?= $data['title']; ?></h2>
  </div>
  <div class="card-body">
    <form action="<?= $data['CONFIG']['HOST'] . '/design.php'; ?>" method="POST">
      <input type="hidden" name="action" value="new_order_data">
      <input type="hidden" name="form_id" value="<?= $data['formId']; ?>">
      <div class="row">
        <div class="col-12 col-md-6">
          <div class="mb-4">
            <h4>Данные контрагента</h4>
            <div class="form-row">
              <div class="form-group col-12 mb-4">
                <small class="text-gray">Внешний счет (<?= 'en ' . $data['CONFIG']['MIN_LEN_A'] . '-' . $data['CONFIG']['MAX_LEN_A']; ?>)</small>
                <input type="text" name="order_name_out" class="form-control"
                       minlength="<?= $data['CONFIG']['MIN_LEN_A']; ?>" maxlength="<?= $data['CONFIG']['MAX_LEN_A']; ?>"
                       pattern="^[a-zA-Z0-9 ]+$">
              </div>
              <div class="form-group col-12 mb-4">
                <small class="text-gray">клиент</small>
                <select name="client_id" class="form-control" required>
                  <option value=""></option>
									<?php foreach ($data['clients'] as $client): ?>
                    <option value="<?= $client['id']; ?>">
											<?= $client['name'] . ' — ' . $data['CONFIG']['PHONE_PREFIX'] . ' ' . $client['mobile_phone']; ?>
                    </option>
									<?php endforeach; ?>
                </select>
              </div>
              <div class="form-group col-12 mb-4">
                <small class="text-gray">стоимость заявки</small>
                <input type="number" name="order_amount" class="form-control" step="0.01" min="0.01" required>
              </div>
            </div>
          </div>
        </div>

        <div class="col-12 col-md-6">
          <div class="mb-4">
            <h4>Данные заказа</h4>
            <div class="mb-4">
              <small class="text-gray">описание (<?= $data['CONFIG']['MIN_LEN_B'] . '-' . $data['CONFIG']['MAX_LEN_B']; ?>)</small>
              <textarea name="task_text" class="form-control" rows="5" required
                        minlength="<?= $data['CONFIG']['MIN_LEN_B']; ?>"
                        maxlength="<?= $data['CONFIG']['MAX_LEN_B']; ?>"></textarea>
            </div>

            <div class="form-row">
              <div class="form-group col-12 mb-4">
                <small class="text-gray">Тип дизайна</small>
                <select name="design_format" class="form-control" required>
                  <option></option>
									<?php foreach ($data['PROG_DATA']['DESIGN_TYPES'] as $dKey => $dVal): ?>
                    <option value="<?= $dKey; ?>"><?= $dVal; ?></option>
									<?php endforeach; ?>
                </select>
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
          </div>
        </div>
      </div>
      <div class="mb-4">
        <input class="btn btn-primary" type="submit" value="Сохранить">
      </div>
    </form>
  </div>
</div>