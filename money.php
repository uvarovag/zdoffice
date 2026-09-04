<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/src/include.php');

require_once($_SERVER['DOCUMENT_ROOT'] . '/src/header_session_start.php');

require_once($_SERVER['DOCUMENT_ROOT'] . '/src/header_tmp_data.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/src/header_alert_massage.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/src/header_authorization_user.php');

date_default_timezone_set($PROG_CONFIG['TIMEZONE']);
$_SESSION['navList'] = cleanActiveTabs($_SESSION['navList']);

///////////////////////////////////////////////////////////////////////////////////////////////

if (isset($_GET['action']) && $_GET['action'] === 'money_journal') {

	errorIfAccessDenied($_SESSION['user']['auth_money_view'],
		$PROG_CONFIG['HOST'] . '/money.php?error_massage=' . $PROG_DATA['ERROR']['ACCESS_DENIED'] . ' ' . __LINE__);

	if (isset($_SESSION['navList']['moneyJournal']['isActive']))
		$_SESSION['navList']['moneyJournal']['isActive'] = true;
	$tmpLayoutData['title'] = 'Деньги';

	$_SESSION['formId'] = md5(time());
	$tmpLayoutContentData['formId'] = $_SESSION['formId'];

	$tmpLayoutContentData['formData']['date_from'] = $_GET['date_from'] ?? '';
	$tmpLayoutContentData['formData']['date_to'] = $_GET['date_to'] ?? '';
	$tmpLayoutContentData['formData']['type'] = $_GET['type'] ?? 'any';

	$sqlQuerySelect = 'SELECT mt.*, c.name AS client_name, u.last_name AS user_last_name, u.first_name AS user_first_name,
		DATE_FORMAT(mt.create_datetime, ' . $PROG_CONFIG['DATETIME_FORMAT'] . ') AS create_datetime
		FROM money_transactions mt
		LEFT JOIN clients c ON mt.client_id = c.id
		LEFT JOIN adm_users u ON mt.user_id = u.id ';
	$sqlQueryWhere = 'WHERE (mt.is_deleted = 0 OR mt.is_deleted IS NULL) ';
	$sqlParameters = [];
	$sqlSortBy = 'ORDER BY mt.id DESC ';

	if (isset($_GET['date_from']) && $_GET['date_from']) {
		$sqlQueryWhere = $sqlQueryWhere . 'AND mt.create_datetime >= ? ';
		$sqlParameters[] = $_GET['date_from'] . ' 00:00:00';
	}

	if (isset($_GET['date_to']) && $_GET['date_to']) {
		$sqlQueryWhere = $sqlQueryWhere . 'AND mt.create_datetime <= ? ';
		$sqlParameters[] = $_GET['date_to'] . ' 23:59:59';
	}

	if (isset($_GET['type']) && $_GET['type'] != 'any' && array_key_exists((int)$_GET['type'], $PROG_DATA['MONEY_TYPES_LIST'])) {
		$sqlQueryWhere = $sqlQueryWhere . 'AND mt.type = ? ';
		$sqlParameters[] = (int)$_GET['type'];
	}

	$paginationData =
		getPagination($PROG_CONFIG, $PROG_CONFIG['HOST'] . '/money.php', $con,
			'SELECT COUNT(*) as pgn FROM money_transactions mt ' . $sqlQueryWhere, $sqlParameters);

	$tmpLayoutData['pagination'] = $paginationData['tmpPagination'];
	$sqlPagination = $paginationData['sqlPagination'];

	$tmpLayoutContentData['transactions'] =
		dbSelectData($con, $sqlQuerySelect . $sqlQueryWhere . $sqlSortBy . $sqlPagination, $sqlParameters);

	$totalsQuery = 'SELECT
			SUM(CASE WHEN mt.type = ? THEN mt.amount ELSE 0 END) AS totalIncome,
			SUM(CASE WHEN mt.type = ? THEN mt.amount ELSE 0 END) AS totalExpense,
			SUM(CASE WHEN mt.type = ? THEN mt.amount ELSE 0 END) AS totalCharge
		FROM money_transactions mt ' . $sqlQueryWhere;

	$tmpLayoutContentData['totals'] = dbSelectData($con, $totalsQuery, array_merge([
		$PROG_DATA['MONEY_TYPES_ID']['INCOME'],
		$PROG_DATA['MONEY_TYPES_ID']['EXPENSE'],
		$PROG_DATA['MONEY_TYPES_ID']['CHARGE']
	], $sqlParameters))[0] ?? ['totalIncome' => 0, 'totalExpense' => 0, 'totalCharge' => 0];

	$tmpLayoutContentData['clients'] =
		dbSelectData($con, 'SELECT id, name FROM clients WHERE is_deleted = 0 ORDER BY name', []);

	$tmpLayoutData['content'] =
		renderTemplate($_SERVER['DOCUMENT_ROOT'] . '/src/templates/money/journal.php', $tmpLayoutContentData);
}


///////////////////////////////////////////////////////////////////////////////////////////////

if (isset($_POST['action']) && isset($_POST['form_id']) && $_POST['action'] === 'new_transaction') {

	errorIfAccessDenied($_SESSION['user']['auth_money_new'],
		$_POST['redirect_error'] . '&error_massage=' . $PROG_DATA['ERROR']['ACCESS_DENIED'] . ' ' . __LINE__);

	errorIfDoubleClick($_SESSION['formId'], $_POST['form_id'],
		$_POST['redirect_error'] . '&error_massage=' . $PROG_DATA['ERROR']['DOUBLE_CLICK'] . ' ' . __LINE__);

	$_SESSION['formId'] = 'none';

	if (isValidTransaction($PROG_CONFIG, $PROG_DATA['MONEY_TYPES_ID']) === false) {
		redirectToIf(false, '', $_POST['redirect_error'] . '&error_massage=' . $PROG_DATA['ERROR']['INPUT_DATA']);
	}

	$newTransactionId = createTransaction($con, $_SESSION['user']['id']);

	redirectToIf($newTransactionId,
		$_POST['redirect_success'] . '&alert_massage=' . $PROG_DATA['ALERT']['OK'],
		$_POST['redirect_error'] . '&error_massage=' . $PROG_DATA['ERROR']['BD_WRITE']);
}


///////////////////////////////////////////////////////////////////////////////////////////////

if (isset($_GET['action']) && isset($_GET['id']) && $_GET['action'] === 'delete_transaction_data') {

	errorIfAccessDenied($_SESSION['user']['auth_money_delete'],
		$PROG_CONFIG['HOST'] . '/money.php?error_massage=' . $PROG_DATA['ERROR']['ACCESS_DENIED'] . ' ' . __LINE__);

	$redirectBack = isset($_GET['redirect_back']) ? $_GET['redirect_back'] : $PROG_CONFIG['HOST'] . '/money.php?action=money_journal';

	$transaction = dbSelectData($con, 'SELECT is_auto FROM money_transactions WHERE id = ?', [$_GET['id']])[0] ?? [];

	// автоматические списания (списание по заявке при переводе в "выполнено") удалить нельзя -
	// они должны быть неотъемлемым следом смены статуса заявки, а не редактируемой вручную записью
	if (($transaction['is_auto'] ?? 0) == 1) {
		redirectToIf(false, '', $redirectBack . '&error_massage=Упс, автоматические списания удалить нельзя!');
	}

	$deleteTransaction = setTransactionIsDeletedVal($con, $_GET['id'], 1);

	redirectToIf($deleteTransaction,
		$redirectBack . '&alert_massage=' . $PROG_DATA['ALERT']['OK'],
		$redirectBack . '&error_massage=' . $PROG_DATA['ERROR']['BD_WRITE']);
}


echo renderTemplate($_SERVER['DOCUMENT_ROOT'] . '/src/templates/layout.php', $tmpLayoutData);
