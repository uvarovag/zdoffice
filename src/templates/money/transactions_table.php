<table class="table table-hover table-sm">
  <thead>
  <tr>
    <th scope="col">Тип</th>
    <th scope="col">Сумма</th>
    <th scope="col">Статья</th>
    <th scope="col">Клиент</th>
    <th scope="col">Комментарий</th>
    <th scope="col">Кто</th>
    <th scope="col">Дата</th>
    <th scope="col"></th>
  </tr>
  </thead>
  <tbody>
	<?php foreach ($data['transactions'] as $transaction): ?>
    <tr>
      <td><?= $data['PROG_DATA']['MONEY_TYPES_LIST'][$transaction['type']]['icon'] ?? '???'; ?>
				<?php if ($transaction['is_auto']): ?>
          <i class="ni ni-lock-circle-open" data-toggle="tooltip" data-placement="top" title="автоматическая операция"></i>
				<?php endif; ?>
      </td>
      <td><?= $transaction['amount']; ?></td>
      <td><?= $transaction['category']; ?></td>
      <td>
			<?php if ($transaction['client_id']): ?>
        <a href="<?= $data['CONFIG']['HOST'] . '/clients.php?action=client_info_card&id=' . $transaction['client_id']; ?>">
					<?= $transaction['client_name'] ?? '???'; ?>
        </a>
			<?php endif; ?>
      </td>
      <td><?= $transaction['comment']; ?></td>
      <td><?= $transaction['user_last_name'] . ' ' . $transaction['user_first_name']; ?></td>
      <td><?= $transaction['create_datetime']; ?></td>
      <td>
			<?php if (($data['canDelete'] ?? false) && !$transaction['is_auto']): ?>
        <a href="<?= $data['CONFIG']['HOST'] . '/money.php?action=delete_transaction_data&id=' . $transaction['id'] .
					'&redirect_back=' . urlencode($data['redirectBack'] ?? $data['CONFIG']['HOST'] . '/money.php?action=money_journal'); ?>"
           class="text-danger" data-toggle="tooltip" data-placement="top" title="удалить операцию"
           onclick="return confirm('Удалить операцию?')">
          <i class="ni ni-fat-remove"></i>
        </a>
			<?php endif; ?>
      </td>
    </tr>
	<?php endforeach; ?>
	<?php if (empty($data['transactions'])): ?>
    <tr>
      <td class="text-gray">операций нет</td>
    </tr>
	<?php endif; ?>
  </tbody>
</table>
