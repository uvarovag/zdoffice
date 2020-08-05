<div class="card">
  <div class="card-header bg-transparent">
    <h2 class="mb-0">Новая заявка на производство</h2>
  </div>
  <div class="card-body">
    <form action="<?= $data['config']['HOST'] . '/design.php' ?>" method="POST">
      <input type="hidden" name="action" value="new_order">
      <input type="hidden" name="form_id" value="<?= $data['formId'] ?>">
      <div class="row mb-4">

        <fieldset class="col-12 col-md-6">
          <h3>Данные контрагента</h3>
          <div class="form-row">
            <div class="form-group col-12 mb-4">
              <small class="text-gray">id заказа (<?= 'en ' . $data['config']['MIN_LEN_A'] . '-' . $data['config']['MAX_LEN_A'] ?>)</small>
              <input type="text" name="login" class="form-control" required
                     minlength="<?= $data['config']['MIN_LEN_A'] ?>" maxlength="<?= $data['config']['MAX_LEN_A'] ?>"
                     pattern="^[a-zA-Z0-9]+$">
            </div>
            <div class="form-group col-12 mb-4">
              <small class="text-gray">контагент (<?= 'en ' . $data['config']['MIN_LEN_A'] . '-' . $data['config']['MAX_LEN_A'] ?>)</small>
              <input type="text" name="login" class="form-control" required
                     minlength="<?= $data['config']['MIN_LEN_A'] ?>" maxlength="<?= $data['config']['MAX_LEN_A'] ?>"
                     pattern="^[a-zA-Z0-9]+$">
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

          <h3>Данные Заказа</h3>
          <div class="form-row">
            <div class="form-group col-12 mb-4">
              <small class="text-gray">описание (<?= $data['config']['MIN_LEN_B'] . '-' . $data['config']['MAX_LEN_B'] ?>)</small>
              <textarea class="form-control" id="exampleFormControlTextarea1" rows="5" required
                        minlength="<?= $data['config']['MIN_LEN_B'] ?>"
                        maxlength="<?= $data['config']['MAX_LEN_B'] ?>"></textarea>
            </div>
            <div class="form-group col-12 mb-4">
              <small class="text-gray">количество</small>
              <input type="number" name="email" class="form-control" required>
            </div>
          </div>
          <div class="form-row mb-4">
            <div class="form-group col-12 mb-4">
              <small class="text-gray">прикрепить файл</small>
              <input type="file" name="email" class="form-control" required>
            </div>
          </div>
        </fieldset>

        <fieldset class="col-12 col-md-6">
          <h3>Дизайн</h3>
          <div class="form-row">
            <div class="form-group col-12 mb-4">
              <small class="text-gray">Дизайнер</small>
              <select name="position" required class="form-control">
                <option value="none" disabled selected>выбрать</option>
								<?php foreach ($data['progData']['USERS_POSITIONS_LIST'] as $posKey => $posVal): ?>
									<?php if ($data['user']['position'] == $posKey): ?>
                    <option value="<?= $posKey ?>" selected><?= $posVal ?></option>
									<?php else: ?>
                    <option value="<?= $posKey ?>"><?= $posVal ?></option>
									<?php endif; ?>
								<?php endforeach; ?>
              </select>
            </div>
          </div>

          <hr>

          <h3>Конструктор</h3>
          <div class="form-row">
            <div class="form-group col-4 mb-4">
              <small class="text-gray">Участвует в проекте</small>
              <div class="">
                <label class="custom-toggle mt-2">
                  <input type="checkbox">
                  <span class="custom-toggle-slider rounded-circle"></span>
                </label>
              </div>
            </div>
            <div class="form-group col-8 mb-4 d-none">
              <small class="text-gray">дата сдачи</small>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                </div>
                <input class="form-control datepicker" type="text" required placeholder="" value="">
              </div>
            </div>
          </div>

          <hr>

          <h3>Цех реклама</h3>
          <div class="form-row">
            <div class="form-group col-4 mb-4">
              <small class="text-gray">Участвует в проекте</small>
              <div class="">
                <label class="custom-toggle mt-2">
                  <input type="checkbox">
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
                  <input class="form-control datepicker" type="text" required placeholder="" value="">
                </div>
              </div>
            </div>
          </div>

          <hr>

          <h3>Цех мебель</h3>
          <div class="form-row">
            <div class="form-group col-4 mb-4">
              <small class="text-gray">Участвует в проекте</small>
              <div class="">
                <label class="custom-toggle mt-2">
                  <input type="checkbox">
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
                  <input class="form-control datepicker" type="text" required placeholder="" value="">
                </div>
              </div>
            </div>
          </div>

          <hr>

          <h3>Цех металл</h3>
          <div class="form-row">
            <div class="form-group col-4 mb-4">
              <small class="text-gray">Участвует в проекте</small>
              <div class="">
                <label class="custom-toggle mt-2">
                  <input type="checkbox">
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
                  <input class="form-control datepicker" type="text" required placeholder="" value="">
                </div>
              </div>
            </div>
          </div>

          <hr>

          <h3>Монтаж</h3>
          <div class="form-row">
            <div class="form-group col-4 mb-4">
              <small class="text-gray">Участвует в проекте</small>
              <div class="">
                <label class="custom-toggle mt-2">
                  <input type="checkbox">
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
                  <input class="form-control datepicker" type="text" required placeholder="" value="">
                </div>
              </div>
            </div>
          </div>
          <div class="mb-4">
            <small class="text-gray">Описание монтажа (<?= $data['config']['MIN_LEN_B'] . '-' . $data['config']['MAX_LEN_B'] ?>)</small>
            <textarea class="form-control" id="exampleFormControlTextarea1" rows="5" required
                      minlength="<?= $data['config']['MIN_LEN_B'] ?>"
                      maxlength="<?= $data['config']['MAX_LEN_B'] ?>"></textarea>
          </div>
          <div class="mb-4">
            <small class="text-gray">Адрес монтажа (<?= $data['config']['MIN_LEN_B'] . '-' . $data['config']['MAX_LEN_B'] ?>)</small>
            <textarea class="form-control" id="exampleFormControlTextarea1" rows="5" required
                      minlength="<?= $data['config']['MIN_LEN_B'] ?>"
                      maxlength="<?= $data['config']['MAX_LEN_B'] ?>"></textarea>
          </div>
        </fieldset>

      </div>
      <input class="btn btn-primary" type="submit" value="Сохранить">
    </form>
  </div>
</div>
