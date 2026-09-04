<div class="card">
  <form class="card-body" action="<?= $data['CONFIG']['HOST'] . '/money.php'; ?>" method="GET">
    <input type="hidden" name="action" value="money_journal">
    <div class="form-row">
      <div class="form-group col mb-0">
        <small class="text-gray">с</small>
        <input type="text" class="form-control form-control-sm datepicker" name="date_from"
               value="<?= $data['formData']['date_from']; ?>">
      </div>
      <div class="form-group col mb-0">
        <small class="text-gray">по</small>
        <input type="text" class="form-control form-control-sm datepicker" name="date_to"
               value="<?= $data['formData']['date_to']; ?>">
      </div>
      <div class="form-group col mb-0">
        <small class="text-gray">тип</small>
        <select class="form-control form-control-sm" name="type">
          <option value="any" <?= $data['formData']['type'] == 'any' ? 'selected' : ''; ?>>любой</option>
					<?php foreach ($data['PROG_DATA']['MONEY_TYPES_LIST'] as $typeKey => $typeVal): ?>
            <option value="<?= $typeKey; ?>" <?= $data['formData']['type'] == $typeKey ? 'selected' : ''; ?>><?= $typeVal['name']; ?></option>
					<?php endforeach; ?>
        </select>
      </div>
      <div class="form-group col-2 mb-0 d-flex align-items-end">
        <button type="submit" class="btn btn-sm btn-primary btn-block">Найти</button>
      </div>
    </div>
  </form>
</div>

<div class="card">
  <div class="card-header bg-transparent">
    <h2 class="mb-0"><?= $data['title']; ?></h2>
  </div>
  <div class="card-body">
    <div class="row mb-4">
      <div class="col-4">
        <h4 class="text-success">Приход: <?= $data['totals']['totalIncome'] ?? 0; ?></h4>
      </div>
      <div class="col-4">
        <h4 class="text-danger">Расход: <?= $data['totals']['totalExpense'] ?? 0; ?></h4>
      </div>
      <div class="col-4">
        <h4 class="text-secondary">Списано за заявки: <?= $data['totals']['totalCharge'] ?? 0; ?></h4>
      </div>
    </div>
		<?php
			$data['canDelete'] = $_SESSION['user']['auth_money_delete'] ?? false;
			$data['redirectBack'] = $data['CONFIG']['HOST'] . '/money.php' . getStringFromGetQuery($_GET);
			echo renderTemplate($_SERVER['DOCUMENT_ROOT'] . '/src/templates/money/transactions_table.php', $data);
		?>
  </div>
</div>

<?php if ($_SESSION['user']['auth_money_new'] ?? false): ?>
	<?php
		$data['redirectSuccess'] = $data['CONFIG']['HOST'] . '/money.php' . getStringFromGetQuery($_GET);
		$data['redirectError'] = $data['redirectSuccess'];
		echo renderTemplate($_SERVER['DOCUMENT_ROOT'] . '/src/templates/money/transaction_form.php', $data);
	?>
<?php endif; ?>
