<div class="card">
	<?php if ($data['client']['is_deleted']): ?>
    <div class="card-header bg-danger">
      <h2 class="mb-0 text-white">Клиент в архиве</h2>
    </div>
	<?php else: ?>
    <div class="card-header bg-transparent">
      <h2 class="mb-0"><?= $data['title']; ?></h2>
    </div>
	<?php endif; ?>
  <div class="card-body">
    <div class="row">
      <div class="col-12 col-md-6">
        <div class="mb-4">
          <h4 class="mb-4">Контакты</h4>
          <table class="table">
            <tr>
              <td class="px-0" width="40%">Имя / название</td>
              <td class="px-0"><?= $data['client']['name']; ?></td>
            </tr>
            <tr>
              <td class="px-0">Телефон</td>
              <td class="px-0"><?= $data['CONFIG']['PHONE_PREFIX']; ?> <?= $data['client']['mobile_phone']; ?></td>
            </tr>
            <tr>
              <td class="px-0">Почта</td>
              <td class="px-0"><?= $data['client']['email']; ?></td>
            </tr>
            <tr>
              <td class="px-0">Комментарий</td>
              <td class="px-0"><?= nl2br($data['client']['note']); ?></td>
            </tr>
          </table>
        </div>
        <div class="mb-4">
          <a href="<?= $data['CONFIG']['HOST'] . '/clients.php?action=edit_client_card&id=' . $data['client']['id']; ?>"
             class="btn btn-primary" role="button" aria-pressed="true">Редактировать</a>
					<?php if ($data['client']['is_deleted']): ?>
            <a href="<?= $data['CONFIG']['HOST'] . '/clients.php?action=restore_client_data&id=' . $data['client']['id']; ?>"
               class="btn btn-success" role="button" aria-pressed="true">Вернуть из архива</a>
					<?php else: ?>
            <a href="<?= $data['CONFIG']['HOST'] . '/clients.php?action=archive_client_data&id=' . $data['client']['id']; ?>"
               class="btn btn-outline-danger" role="button" aria-pressed="true">В архив</a>
					<?php endif; ?>
        </div>
      </div>
      <div class="col-12 col-md-6">
        <div class="mb-4">
          <h4 class="mb-4">Заявки на дизайн</h4>
          <table class="table table-sm">
						<?php foreach ($data['designOrders'] as $order): ?>
              <tr onclick="window.location.href='<?= $data['CONFIG']['HOST'] . '/design.php?action=order_info_card&id=' .
								$order['id']; ?>'; return false" style="cursor: pointer">
                <td><?= $order['order_name_out'] . ' / ' . $order['order_name_in']; ?></td>
                <td><?= $data['PROG_DATA']['STATUS_LIST_DESIGN'][$order['current_status']]['icon'] ?? '???'; ?></td>
                <td><?= $order['deadline_date']; ?></td>
              </tr>
						<?php endforeach; ?>
						<?php if (empty($data['designOrders'])): ?>
              <tr>
                <td class="text-gray">заявок нет</td>
              </tr>
						<?php endif; ?>
          </table>
        </div>
        <div class="mb-4">
          <h4 class="mb-4">Заявки на производство</h4>
          <table class="table table-sm">
						<?php foreach ($data['productionOrders'] as $order): ?>
              <tr onclick="window.location.href='<?= $data['CONFIG']['HOST'] . '/production.php?action=order_info_card&id=' .
								$order['id']; ?>'; return false" style="cursor: pointer">
                <td><?= $order['order_name_out'] . ' / ' . $order['order_name_in']; ?></td>
                <td><?= $order['general_deadline']; ?></td>
              </tr>
						<?php endforeach; ?>
						<?php if (empty($data['productionOrders'])): ?>
              <tr>
                <td class="text-gray">заявок нет</td>
              </tr>
						<?php endif; ?>
          </table>
        </div>
      </div>
    </div>
		<?php if ($data['showMoney'] ?? false): ?>
      <hr>
      <div class="mb-4">
        <h4 class="mb-4">Деньги</h4>
        <p>
          Баланс:
					<?php if ($data['balance'] > 0): ?>
            <b class="text-success"><?= $data['balance']; ?></b> (предоплата)
					<?php elseif ($data['balance'] < 0): ?>
            <b class="text-danger"><?= $data['balance']; ?></b> (долг клиента)
					<?php else: ?>
            <b><?= $data['balance']; ?></b>
					<?php endif; ?>
        </p>
				<?php echo renderTemplate($_SERVER['DOCUMENT_ROOT'] . '/src/templates/money/transactions_table.php', $data); ?>
				<?php if ($_SESSION['user']['auth_money_new'] ?? false): ?>
					<?php
						$data['clientId'] = $data['client']['id'];
						$data['clients'] = [['id' => $data['client']['id'], 'name' => $data['client']['name']]];
						$data['redirectSuccess'] = $data['CONFIG']['HOST'] . '/clients.php?action=client_info_card&id=' . $data['client']['id'];
						$data['redirectError'] = $data['redirectSuccess'];
						echo renderTemplate($_SERVER['DOCUMENT_ROOT'] . '/src/templates/money/transaction_form.php', $data);
					?>
				<?php endif; ?>
      </div>
		<?php endif; ?>
  </div>
</div>
