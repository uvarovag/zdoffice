<div class="card">
  <div class="card-header bg-transparent">
    <h4 class="mb-0">Добавить операцию</h4>
  </div>
  <div class="card-body">
    <form action="<?= $data['CONFIG']['HOST'] . '/money.php'; ?>" method="POST">
      <input type="hidden" name="action" value="new_transaction">
      <input type="hidden" name="form_id" value="<?= $data['formId']; ?>">
      <input type="hidden" name="redirect_success" value="<?= $data['redirectSuccess']; ?>">
      <input type="hidden" name="redirect_error" value="<?= $data['redirectError']; ?>">
			<?php if (isset($data['orderId'])): ?>
        <input type="hidden" name="order_id" value="<?= $data['orderId']; ?>">
        <input type="hidden" name="order_type" value="<?= $data['orderType']; ?>">
			<?php endif; ?>
      <div class="form-row">
        <div class="form-group col-12 col-md-2 mb-3">
          <small class="text-gray">тип</small>
          <select name="type" class="form-control" required>
            <option value="<?= $data['PROG_DATA']['MONEY_TYPES_ID']['INCOME']; ?>">приход</option>
            <option value="<?= $data['PROG_DATA']['MONEY_TYPES_ID']['EXPENSE']; ?>">расход</option>
          </select>
        </div>
        <div class="form-group col-12 col-md-2 mb-3">
          <small class="text-gray">сумма</small>
          <input type="number" name="amount" class="form-control" step="0.01" min="0.01" required>
        </div>
        <div class="form-group col-12 col-md-2 mb-3">
          <small class="text-gray">статья</small>
          <input type="text" name="category" class="form-control" maxlength="64">
        </div>
				<?php if (isset($data['clients'])): ?>
          <div class="form-group col-12 col-md-3 mb-3">
            <small class="text-gray">клиент</small>
            <select name="client_id" class="form-control">
              <option value="">без клиента</option>
							<?php foreach ($data['clients'] as $client): ?>
                <option value="<?= $client['id']; ?>"<?= isset($data['clientId']) && $data['clientId'] == $client['id'] ? ' selected' : ''; ?>>
									<?= $client['name']; ?>
                </option>
							<?php endforeach; ?>
            </select>
          </div>
				<?php endif; ?>
        <div class="form-group col-12 col-md-3 mb-3">
          <small class="text-gray">комментарий</small>
          <input type="text" name="comment" class="form-control" maxlength="255">
        </div>
      </div>
      <input class="btn btn-primary btn-sm" type="submit" value="Сохранить">
    </form>
  </div>
</div>
