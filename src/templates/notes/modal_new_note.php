<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <form class="modal-content" action="<?= $data['CONFIG']['HOST'] . '/notes.php'; ?>" method="POST">
      <input type="hidden" name="action" value="new_note">
      <input type="hidden" name="form_id" value="<?= $data['formId']; ?>">
      <input type="hidden" name="order_id" value="<?= $data['orderId']; ?>">
      <input type="hidden" name="order_type" value="<?= $data['orderType']; ?>">
      <input type="hidden" name="redirect_success"
             value="<?= $data['redirectSuccess']; ?>">
      <input type="hidden" name="redirect_error"
             value="<?= $data['redirectError']; ?>">
      <div class="modal-header">
        <h4 class="modal-title" id="exampleModalLabel">Новая заметка</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
				<textarea name="note" class="form-control mb-4" rows="5" required
                  minlength="<?= $data['CONFIG']['MIN_LEN_C']; ?>"
                  maxlength="<?= $data['CONFIG']['MAX_LEN_C']; ?>"></textarea>
				<?php foreach ($data['PROG_DATA']['PRIORITY_ORDERS'] as $priorityKey => $priorityVal): ?>
          <div class="form-check form-check-inline">
            <input class="form-check-input" id="priority_checkbox_<?= $priorityKey; ?>" type="radio" name="priority"
                   value="<?= $priorityKey; ?>" <?= $priorityKey == $data['PROG_DATA']['PRIORITY_ID']['NORM'] ? ' checked' : ''; ?>>
            <label class="form-check-label" for="priority_checkbox_<?= $priorityKey; ?>"><?= $priorityVal['icon']; ?></label>
          </div>
				<?php endforeach; ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Отмена</button>
        <input class="btn btn-primary" type="submit" value="Сохранить">
      </div>
    </form>
  </div>
</div>