<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/src/include.php');

require_once($_SERVER['DOCUMENT_ROOT'] . '/src/header_session_start.php');

require_once($_SERVER['DOCUMENT_ROOT'] . '/src/header_tmp_data.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/src/header_alert_massage.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/src/header_authorization_user.php');

date_default_timezone_set($PROG_CONFIG['TIMEZONE']);
$_SESSION['navList'] = cleanActiveTabs($_SESSION['navList']);

///////////////////////////////////////////////////////////////////////////////////////////////

if (isset($_GET['action']) && $_GET['action'] === 'clients_list') {

	errorIfAccessDenied($_SESSION['user']['auth_clients_view'],
		$PROG_CONFIG['HOST'] . '/clients.php?error_massage=' . $PROG_DATA['ERROR']['ACCESS_DENIED'] . ' ' . __LINE__);

	if (isset($_SESSION['navList']['clientsList']['isActive']))
		$_SESSION['navList']['clientsList']['isActive'] = true;
	$tmpLayoutData['title'] = 'Клиенты';

	$tmpLayoutContentData['formData']['search'] = $_GET['search'] ?? '';

	$sqlQuerySelect = 'SELECT * FROM clients ';
	$sqlQueryWhere = 'WHERE is_deleted = 0 ';
	$sqlParameters = [];
	$sqlSortBy = 'ORDER BY id DESC ';

	if (isset($_GET['search']) && $_GET['search']) {
		$sqlQueryWhere = $sqlQueryWhere . 'AND (name LIKE ? OR mobile_phone LIKE ?) ';
		$sqlParameters[] = '%' . $_GET['search'] . '%';
		$sqlParameters[] = '%' . $_GET['search'] . '%';
	}

	$paginationData =
		getPagination($PROG_CONFIG, $PROG_CONFIG['HOST'] . '/clients.php', $con, 'SELECT COUNT(*) as pgn FROM clients ' .
			$sqlQueryWhere, $sqlParameters);

	$tmpLayoutData['pagination'] = $paginationData['tmpPagination'];
	$sqlPagination = $paginationData['sqlPagination'];

	$tmpLayoutContentData['clients'] =
		dbSelectData($con, $sqlQuerySelect . $sqlQueryWhere . $sqlSortBy . $sqlPagination, $sqlParameters);

	$tmpLayoutData['content'] =
		renderTemplate($_SERVER['DOCUMENT_ROOT'] . '/src/templates/clients/clients_list.php', $tmpLayoutContentData);
}


///////////////////////////////////////////////////////////////////////////////////////////////

if (isset($_GET['action']) && $_GET['action'] === 'new_client_card') {

	errorIfAccessDenied($_SESSION['user']['auth_clients_new'],
		$PROG_CONFIG['HOST'] . '/clients.php?error_massage=' . $PROG_DATA['ERROR']['ACCESS_DENIED'] . ' ' . __LINE__);

	$_SESSION['formId'] = md5(time());
	$tmpLayoutContentData['formId'] = $_SESSION['formId'];

	if (isset($_SESSION['navList']['newClientCard']['isActive']))
		$_SESSION['navList']['newClientCard']['isActive'] = true;
	$tmpLayoutData['title'] = 'Добавить клиента';

	$tmpLayoutData['content'] =
		renderTemplate($_SERVER['DOCUMENT_ROOT'] . '/src/templates/clients/new_client_card.php', $tmpLayoutContentData);
}


///////////////////////////////////////////////////////////////////////////////////////////////

if (isset($_GET['action']) && isset($_GET['id']) && $_GET['action'] === 'edit_client_card') {

	errorIfAccessDenied($_SESSION['user']['auth_clients_edit'],
		$PROG_CONFIG['HOST'] . '/clients.php?error_massage=' . $PROG_DATA['ERROR']['ACCESS_DENIED'] . ' ' . __LINE__);

	$_SESSION['formId'] = md5(time());
	$tmpLayoutContentData['formId'] = $_SESSION['formId'];

	$tmpLayoutData['title'] = 'Редактировать клиента';

	$tmpLayoutContentData['client'] =
		dbSelectData($con, 'SELECT * FROM clients WHERE id = ?', [$_GET['id']])[0] ?? [];

	if (empty($tmpLayoutContentData['client'])) {
		redirectToIf(false, '',
			$PROG_CONFIG['HOST'] . '/clients.php?action=clients_list&error_massage=' . $PROG_DATA['ERROR']['ID']);
	}

	$tmpLayoutData['content'] =
		renderTemplate($_SERVER['DOCUMENT_ROOT'] . '/src/templates/clients/edit_client_card.php', $tmpLayoutContentData);
}


///////////////////////////////////////////////////////////////////////////////////////////////

if (isset($_GET['action']) && isset($_GET['id']) && $_GET['action'] === 'client_info_card') {

	errorIfAccessDenied($_SESSION['user']['auth_clients_view'],
		$PROG_CONFIG['HOST'] . '/clients.php?error_massage=' . $PROG_DATA['ERROR']['ACCESS_DENIED'] . ' ' . __LINE__);

	$_SESSION['formId'] = md5(time());
	$tmpLayoutContentData['formId'] = $_SESSION['formId'];

	$tmpLayoutData['title'] = 'Карта клиента';

	$tmpLayoutContentData['client'] =
		dbSelectData($con, 'SELECT * FROM clients WHERE id = ?', [$_GET['id']])[0] ?? [];

	if (empty($tmpLayoutContentData['client'])) {
		redirectToIf(false, '',
			$PROG_CONFIG['HOST'] . '/clients.php?action=clients_list&error_massage=' . $PROG_DATA['ERROR']['ID']);
	}

	$tmpLayoutContentData['designOrders'] = dbSelectData($con, 'SELECT id, order_name_in, order_name_out, current_status,
		DATE_FORMAT(deadline_date, ' . $PROG_CONFIG['DATE_FORMAT'] . ') AS deadline_date
		FROM design_orders WHERE client_id = ? ORDER BY id DESC', [$_GET['id']]);

	$tmpLayoutContentData['productionOrders'] = dbSelectData($con, 'SELECT id, order_name_in, order_name_out,
		DATE_FORMAT(general_deadline, ' . $PROG_CONFIG['DATE_FORMAT'] . ') AS general_deadline
		FROM production_orders WHERE client_id = ? ORDER BY id DESC', [$_GET['id']]);

	// финансовый блок на карточке клиента виден только тем, у кого отдельно есть право на "Деньги" -
	// доступ к клиентам и доступ к деньгам это разные права
	if ($_SESSION['user']['auth_money_view'] ?? false) {
		$tmpLayoutContentData['showMoney'] = true;
		$tmpLayoutContentData['canDelete'] = $_SESSION['user']['auth_money_delete'] ?? false;
		$tmpLayoutContentData['redirectBack'] =
			$PROG_CONFIG['HOST'] . '/clients.php?action=client_info_card&id=' . $_GET['id'];

		$tmpLayoutContentData['balance'] = getClientBalance($con, $_GET['id'], $PROG_DATA['MONEY_TYPES_ID']);

		$tmpLayoutContentData['transactions'] = dbSelectData($con,
			'SELECT mt.*, c.name AS client_name, u.last_name AS user_last_name, u.first_name AS user_first_name,
				DATE_FORMAT(mt.create_datetime, ' . $PROG_CONFIG['DATETIME_FORMAT'] . ') AS create_datetime
			FROM money_transactions mt
			LEFT JOIN clients c ON mt.client_id = c.id
			LEFT JOIN adm_users u ON mt.user_id = u.id
			WHERE mt.client_id = ? AND (mt.is_deleted = 0 OR mt.is_deleted IS NULL)
			ORDER BY mt.id DESC', [$_GET['id']]);
	}

	$tmpLayoutData['content'] =
		renderTemplate($_SERVER['DOCUMENT_ROOT'] . '/src/templates/clients/client_info_card.php', $tmpLayoutContentData);
}


///////////////////////////////////////////////////////////////////////////////////////////////

if (isset($_POST['action']) && isset($_POST['form_id']) && $_POST['action'] === 'new_client_data') {

	errorIfAccessDenied($_SESSION['user']['auth_clients_new'],
		$PROG_CONFIG['HOST'] . '/clients.php?error_massage=' . $PROG_DATA['ERROR']['ACCESS_DENIED'] . ' ' . __LINE__);

	errorIfDoubleClick($_SESSION['formId'], $_POST['form_id'],
		$PROG_CONFIG['HOST'] . '/clients.php?action=new_client_card&error_massage=' .
		$PROG_DATA['ERROR']['DOUBLE_CLICK'] . ' ' . __LINE__);

	$_SESSION['formId'] = 'none';

	if (isValidNewClientData($PROG_CONFIG) === false) {
		redirectToIf(false, '',
			$PROG_CONFIG['HOST'] . '/clients.php?action=new_client_card&error_massage=' . $PROG_DATA['ERROR']['INPUT_DATA']);
	}

	$newClientId = createNewClient($con, $_SESSION['user']['id']);

	redirectToIf($newClientId,
		$PROG_CONFIG['HOST'] . '/clients.php?action=client_info_card&id=' . $newClientId . '&alert_massage=' . $PROG_DATA['ALERT']['OK'],
		$PROG_CONFIG['HOST'] . '/clients.php?action=new_client_card&error_massage=' . $PROG_DATA['ERROR']['BD_WRITE']);
}


///////////////////////////////////////////////////////////////////////////////////////////////

if (isset($_POST['action']) && isset($_POST['form_id']) && isset($_POST['id']) && $_POST['action'] === 'edit_client_data') {

	errorIfAccessDenied($_SESSION['user']['auth_clients_edit'],
		$PROG_CONFIG['HOST'] . '/clients.php?error_massage=' . $PROG_DATA['ERROR']['ACCESS_DENIED'] . ' ' . __LINE__);

	errorIfDoubleClick($_SESSION['formId'], $_POST['form_id'],
		$PROG_CONFIG['HOST'] . '/clients.php?action=edit_client_card&id=' .
		$_POST['id'] . '&error_massage=' . $PROG_DATA['ERROR']['DOUBLE_CLICK'] . ' ' . __LINE__);

	$_SESSION['formId'] = 'none';

	if (isValidNewClientData($PROG_CONFIG) === false) {
		redirectToIf(false, '',
			$PROG_CONFIG['HOST'] . '/clients.php?action=edit_client_card&id=' .
			$_POST['id'] . '&error_massage=' . $PROG_DATA['ERROR']['INPUT_DATA']);
	}

	$editClient = editClientData($con);

	redirectToIf($editClient,
		$PROG_CONFIG['HOST'] . '/clients.php?action=client_info_card&id=' . $_POST['id'] . '&alert_massage=' . $PROG_DATA['ALERT']['OK'],
		$PROG_CONFIG['HOST'] . '/clients.php?action=edit_client_card&id=' . $_POST['id'] . '&error_massage=' . $PROG_DATA['ERROR']['BD_WRITE']);
}


///////////////////////////////////////////////////////////////////////////////////////////////

if (isset($_GET['action']) && isset($_GET['id']) && $_GET['action'] === 'archive_client_data') {

	errorIfAccessDenied($_SESSION['user']['auth_clients_edit'],
		$PROG_CONFIG['HOST'] . '/clients.php?error_massage=' . $PROG_DATA['ERROR']['ACCESS_DENIED'] . ' ' . __LINE__);

	$archiveClient = setClientIsDeletedVal($con, $_GET['id'], 1);

	redirectToIf($archiveClient,
		$PROG_CONFIG['HOST'] . '/clients.php?action=client_info_card&id=' . $_GET['id'] . '&alert_massage=' . $PROG_DATA['ALERT']['OK'],
		$PROG_CONFIG['HOST'] . '/clients.php?action=client_info_card&id=' . $_GET['id'] . '&error_massage=' . $PROG_DATA['ERROR']['BD_WRITE']);
}


///////////////////////////////////////////////////////////////////////////////////////////////

if (isset($_GET['action']) && isset($_GET['id']) && $_GET['action'] === 'restore_client_data') {

	errorIfAccessDenied($_SESSION['user']['auth_clients_edit'],
		$PROG_CONFIG['HOST'] . '/clients.php?error_massage=' . $PROG_DATA['ERROR']['ACCESS_DENIED'] . ' ' . __LINE__);

	$restoreClient = setClientIsDeletedVal($con, $_GET['id'], 0);

	redirectToIf($restoreClient,
		$PROG_CONFIG['HOST'] . '/clients.php?action=client_info_card&id=' . $_GET['id'] . '&alert_massage=' . $PROG_DATA['ALERT']['OK'],
		$PROG_CONFIG['HOST'] . '/clients.php?action=client_info_card&id=' . $_GET['id'] . '&error_massage=' . $PROG_DATA['ERROR']['BD_WRITE']);
}


echo renderTemplate($_SERVER['DOCUMENT_ROOT'] . '/src/templates/layout.php', $tmpLayoutData);
