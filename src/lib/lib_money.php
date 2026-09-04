<?php

function createTransaction($con, $userId) {

	// is_auto всегда 0 здесь — эта функция обслуживает только ручной ввод
	// (action=new_transaction в money.php); автосписание за заявку заводится
	// отдельным путём прямо из change_status, не через эту функцию
	$newTransactionData = [
		'is_deleted' => 0,
		'type' => (int)$_POST['type'],
		'is_auto' => 0,
		'amount' => (float)$_POST['amount'],
		'category' => correctFormat($_POST['category']),
		'comment' => correctFormat($_POST['comment']),
		'user_id' => $userId,
		'create_datetime' => date('Y-m-d H:i:s')
	];

	// client_id/order_id/order_type — необязательные (NULL-able) колонки.
	// dbGetPrepareStmt() молча пропускает не-int/string/double значения при
	// биндинге, а dbInsertData() всё равно ставит "?" под каждый ключ массива,
	// поэтому передавать сюда PHP null нельзя (собьётся количество "?" и
	// забинженных значений) — ключ просто не добавляется, если значения нет,
	// и колонка получает NULL по умолчанию со стороны MySQL.
	if (isset($_POST['client_id']) && $_POST['client_id'] !== '')
		$newTransactionData['client_id'] = (int)$_POST['client_id'];

	if (isset($_POST['order_id']) && $_POST['order_id'] !== '' &&
		isset($_POST['order_type']) && $_POST['order_type'] !== '') {
		$newTransactionData['order_id'] = (int)$_POST['order_id'];
		$newTransactionData['order_type'] = (int)$_POST['order_type'];
	}

	return dbInsertData($con, 'money_transactions', $newTransactionData);
}

function setTransactionIsDeletedVal($con, $transactionId, $isDeletedVal) {

	$data = [
		'is_deleted' => $isDeletedVal,
		'id' => $transactionId
	];

	return dbExecQuery($con, 'UPDATE money_transactions SET is_deleted = ? WHERE id = ?', $data);
}

function getClientBalance($con, $clientId, $moneyTypesId) {

	$row = dbSelectData($con,
		'SELECT
			SUM(CASE WHEN type = ? THEN amount ELSE 0 END) -
			SUM(CASE WHEN type = ? THEN amount ELSE 0 END) AS balance
		FROM money_transactions
		WHERE client_id = ? AND (is_deleted = 0 OR is_deleted IS NULL)',
		[$moneyTypesId['INCOME'], $moneyTypesId['CHARGE'], $clientId])[0] ?? [];

	return $row['balance'] ?? 0;
}
