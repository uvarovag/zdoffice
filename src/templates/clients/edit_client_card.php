<div class="card">
  <div class="card-header bg-transparent">
    <h2 class="mb-0"><?= $data['title']; ?></h2>
  </div>
  <div class="card-body">
    <form action="<?= $data['CONFIG']['HOST'] . '/clients.php'; ?>" method="POST">
      <input type="hidden" name="action" value="edit_client_data">
      <input type="hidden" name="id" value="<?= $data['client']['id']; ?>">
      <input type="hidden" name="form_id" value="<?= $data['formId']; ?>">
      <div class="row">
        <div class="col-12 col-md-6">
          <div class="form-row">
            <div class="form-group col-12 mb-4">
              <small class="text-gray">имя / название (<?= 'ru en ' . $data['CONFIG']['MIN_LEN_A'] . '-' . $data['CONFIG']['MAX_LEN_A']; ?>)</small>
              <input type="text" name="name" class="form-control" required
                     minlength="<?= $data['CONFIG']['MIN_LEN_A']; ?>" maxlength="<?= $data['CONFIG']['MAX_LEN_A']; ?>"
                     pattern="^[a-zA-Zа-яА-ЯёЁ0-9 ]+$"
                     value="<?= $data['client']['name']; ?>">
            </div>
            <div class="form-group col-12 mb-4">
              <small class="text-gray">телефон</small>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text"><?= $data['CONFIG']['PHONE_PREFIX']; ?></span>
                </div>
                <input type="tel" name="mobile_phone" class="form-control" required
                       pattern="\d{2}\s\d{3}\s\d{2}\s\d{2}"
                       placeholder="XX XXX XX XX"
                       value="<?= $data['client']['mobile_phone']; ?>">
              </div>
            </div>
            <div class="form-group col-12 mb-4">
              <small class="text-gray">почта</small>
              <input type="email" name="email" class="form-control" value="<?= $data['client']['email']; ?>">
            </div>
            <div class="form-group col-12 mb-4">
              <small class="text-gray">комментарий (до 255 символов)</small>
              <textarea name="note" class="form-control" rows="3" maxlength="255"><?= $data['client']['note']; ?></textarea>
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
