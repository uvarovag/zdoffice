<div class="card">
  <div class="card-header bg-transparent">
    <h2 class="mb-0">Новая заявка на производство</h2>
  </div>
  <div class="card-body">
    <form action="<?= $data['config']['host'] . '/design.php' ?>" method="POST">
      <input type="hidden" name="action" value="new_order">
      <input type="hidden" name="form_id" value="<?= $data['formId'] ?>">
      <fieldset>
        <h3>Данные контрагента</h3>
        <div class="form-row">
          <div class="form-group col-12 col-md-6 mb-4">
            <small class="text-gray">id заказа (<?= 'en ' . $data['config']['minLenA'] . '-' . $data['config']['maxLenA']?>)</small>
            <input type="text" name="login" class="form-control" required
                   pattern="<?= $data['config']['regexpA'] ?>{<?= $data['config']['minLenA'] ?>,<?= $data['config']['maxLenA'] ?>}">
          </div>

          <div class="form-group col-12 col-md-6 mb-4">
            <small class="text-gray">контагент (<?= 'en ' . $data['config']['minLenA'] . '-' . $data['config']['maxLenA']?>)</small>
            <input type="text" name="login" class="form-control" required
                   pattern="<?= $data['config']['regexpA'] ?>{<?= $data['config']['minLenA'] ?>,<?= $data['config']['maxLenA'] ?>}">
          </div>


          <div class="form-group col-12 col-md-6 mb-4">
            <small class="text-gray">телефон</small>
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1"><?= $data['config']['phone_prefix']?></span>
              </div>
              <input type="tel" name="mobile_phone" class="form-control" required
                     pattern="<?= $data['config']['regexpC'] ?>"
                     placeholder="XX XXX XX XX"">
            </div>
          </div>
          <div class="form-group col-12 col-md-6 mb-4">
            <small class="text-gray">почта</small>
            <input type="email" name="email" class="form-control" required>
          </div>
        </div>
      </fieldset>

      <hr>

      <fieldset>
        <h3>Данные Заказа</h3>
        <div class="form-row">
          <div class="form-group col-12 col-md-6 mb-4">
            <small class="text-gray">описание (<?= $data['config']['minLenB'] . '-' . $data['config']['maxLenB']?>)</small>
            <textarea class="form-control" id="exampleFormControlTextarea1" rows="4" required
                      minlength="<?= $data['config']['minLenB']?>"
                      maxlength="<?= $data['config']['maxLenB']?>"></textarea>
          </div>
          <div class="form-group col-12 col-md-6 mb-4">
            <small class="text-gray">количество</small>
            <input type="number" name="email" class="form-control" required>
          </div>

        </div>


      </fieldset>

      <hr>

      <fieldset>
        <h3>Дизайн</h3>
        <div class="form-row">

          <div class="form-group col-12 col-md-6 mb-4">
            <small class="text-gray">Дизайнер</small>
            <select name="position" required class="form-control">
              <option value="none" disabled selected>выбрать</option>
							<?php foreach ($data['progData']['usersPositionsList'] as $posKey => $posVal): ?>
								<?php if ($data['user']['position'] == $posKey): ?>
                  <option value="<?= $posKey ?>" selected><?= $posVal ?></option>
								<?php else: ?>
                  <option value="<?= $posKey ?>"><?= $posVal ?></option>
								<?php endif; ?>
							<?php endforeach; ?>
            </select>
          </div>

        </div>
      </fieldset>

      <hr>

      <fieldset>
        <h3>Конструктор</h3>
        <div class="form-row">

          <div class="form-group col-12 col-md-6 mb-4">
            <small class="text-gray">Учавствет в проекте</small>
            <div class="">
              <label class="custom-toggle mt-2">
                <input type="checkbox">
                <span class="custom-toggle-slider rounded-circle"></span>
              </label>
            </div>
          </div>

          <div class="form-group col-12 col-md-6 mb-4">
            <small class="text-gray">дата сдачи</small>
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
              </div>
              <input class="form-control datepicker" type="text" required placeholder="" value="">
            </div>
          </div>

        </div>
      </fieldset>

      <hr>

      <fieldset>
        <h3>Цех реклама</h3>
        <div class="form-row">

          <div class="form-group col-12 col-md-6 mb-4">
            <small class="text-gray">Учавствет в проекте</small>
            <div class="">
              <label class="custom-toggle mt-2">
                <input type="checkbox">
                <span class="custom-toggle-slider rounded-circle"></span>
              </label>
            </div>
          </div>

          <div class="form-group col-12 col-md-6 mb-4">
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
      </fieldset>

      <hr>

      <fieldset>
        <h3>Цех мебель</h3>
        <div class="form-row">

          <div class="form-group col-12 col-md-6 mb-4">
            <small class="text-gray">Учавствет в проекте</small>
            <div class="">
              <label class="custom-toggle mt-2">
                <input type="checkbox">
                <span class="custom-toggle-slider rounded-circle"></span>
              </label>
            </div>
          </div>

          <div class="form-group col-12 col-md-6 mb-4">
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
      </fieldset>

      <hr>

      <fieldset>
        <h3>Цех металл</h3>
        <div class="form-row">

          <div class="form-group col-12 col-md-6 mb-4">
            <small class="text-gray">Учавствет в проекте</small>
            <div class="">
              <label class="custom-toggle mt-2">
                <input type="checkbox">
                <span class="custom-toggle-slider rounded-circle"></span>
              </label>
            </div>
          </div>

          <div class="form-group col-12 col-md-6 mb-4">
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
      </fieldset>

      <hr>

      <fieldset>
        <h3>Монтаж</h3>
        <div class="form-row">

          <div class="form-group col-12 col-md-6 mb-4">
            <small class="text-gray">Учавствет в проекте</small>
            <div class="">
              <label class="custom-toggle mt-2">
                <input type="checkbox">
                <span class="custom-toggle-slider rounded-circle"></span>
              </label>
            </div>
          </div>

          <div class="col-12 col-md-6 mb-4">
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
          <small class="text-gray">Описание монтажа (<?= $data['config']['minLenB'] . '-' . $data['config']['maxLenB']?>)</small>
          <textarea class="form-control" id="exampleFormControlTextarea1" rows="2" required
                    minlength="<?= $data['config']['minLenB']?>"
                    maxlength="<?= $data['config']['maxLenB']?>"></textarea>
        </div>

        <div class="mb-4">
          <small class="text-gray">Адрес монтажа (<?= $data['config']['minLenB'] . '-' . $data['config']['maxLenB']?>)</small>
          <textarea class="form-control" id="exampleFormControlTextarea1" rows="2" required
                    minlength="<?= $data['config']['minLenB']?>"
                    maxlength="<?= $data['config']['maxLenB']?>"></textarea>
        </div>


      </fieldset>

      <hr>

      <fieldset>
        <h3>Прикрепить Файлы</h3>
        <div class="form-row mb-4">
          <div class="form-group col-12 col-md-6 mb-4">
            <small class="text-gray">почта</small>
            <div class="custom-file">
              <input type="file" class="custom-file-input" id="customFile">
              <label class="custom-file-label" for="customFile">Choose file</label>
            </div>
          </div>
          <div class="form-group col-12 col-md-6 mb-4">
            <small class="text-gray">почта</small>
            <input type="text" name="email" class="form-control" required>
          </div>
        </div>
      </fieldset>






      <input class="btn btn-primary" type="submit" value="Сохранить">
    </form>
  </div>
</div>