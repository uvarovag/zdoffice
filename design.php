<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/src/include.php');

require_once($_SERVER['DOCUMENT_ROOT'] . '/src/header_session_start.php');

require_once($_SERVER['DOCUMENT_ROOT'] . '/src/header_tmp_data.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/src/header_alert_massage.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/src/header_authorization_user.php');

$_SESSION['navList'] = cleanActiveTabs($_SESSION['navList']);

///////////////////////////////////////////////////////////////////////////////////////////////


if (isset($_GET['action']) && $_GET['action'] == 'new_order_card') {

	$_SESSION['navList']['designNewOrder']['isActive'] = true;
	$tmpLayoutData['title'] = 'Новая заявка на дизайн';

	$tmpLayoutData['content'] = renderTemplate($_SERVER['DOCUMENT_ROOT'] .
		'/src/templates/design/new_order.php', $tmpLayoutContentData);
}

///////////////////////////////////////////////////////////////////////////////////////////////

if (isset($_GET['action']) && isset($_GET['id']) && $_GET['action'] == 'order_info_card') {

	$tmpLayoutData['title'] = 'Заявка на дизайн';

	$tmpLayoutContentData['order'] =
		dbSelectData($con, 'SELECT *, 
		DATE_FORMAT(deadline_date, ' . $PROG_CONFIG['DATE_FORMAT'] . ') AS deadline_date,
		DATE_FORMAT(datetime_status_000, ' . $PROG_CONFIG['DATETIME_FORMAT'] . ') AS datetime_status_000, 
		DATE_FORMAT(datetime_status_100, ' . $PROG_CONFIG['DATETIME_FORMAT'] . ') AS datetime_status_100, 
		DATE_FORMAT(datetime_status_200, ' . $PROG_CONFIG['DATETIME_FORMAT'] . ') AS datetime_status_200, 
		DATE_FORMAT(datetime_status_210, ' . $PROG_CONFIG['DATETIME_FORMAT'] . ') AS datetime_status_210, 
		DATE_FORMAT(datetime_status_220, ' . $PROG_CONFIG['DATETIME_FORMAT'] . ') AS datetime_status_220, 
		DATE_FORMAT(datetime_status_230, ' . $PROG_CONFIG['DATETIME_FORMAT'] . ') AS datetime_status_230, 
		DATE_FORMAT(datetime_status_240, ' . $PROG_CONFIG['DATETIME_FORMAT'] . ') AS datetime_status_240, 
		DATE_FORMAT(datetime_status_250, ' . $PROG_CONFIG['DATETIME_FORMAT'] . ') AS datetime_status_250, 
		DATE_FORMAT(datetime_status_260, ' . $PROG_CONFIG['DATETIME_FORMAT'] . ') AS datetime_status_260, 
		DATE_FORMAT(datetime_status_270, ' . $PROG_CONFIG['DATETIME_FORMAT'] . ') AS datetime_status_270, 
		DATE_FORMAT(datetime_status_280, ' . $PROG_CONFIG['DATETIME_FORMAT'] . ') AS datetime_status_280, 
		DATE_FORMAT(datetime_status_290, ' . $PROG_CONFIG['DATETIME_FORMAT'] . ') AS datetime_status_290, 
		DATE_FORMAT(datetime_status_300, ' . $PROG_CONFIG['DATETIME_FORMAT'] . ') AS datetime_status_300, 
		DATE_FORMAT(datetime_status_999, ' . $PROG_CONFIG['DATETIME_FORMAT'] . ') AS datetime_status_999 
		FROM design_orders WHERE id = ?', [$_GET['id']])[0] ?? false;

	if ($tmpLayoutContentData['order'] === false) {
		redirectToIf(false, '', $PROG_CONFIG['HOST'] . '/design.php?action=orders_list&error_massage=ORDER ID ERROR');
	}

	$tmpLayoutContentData['designerList'] =
		dbSelectData($con, 'SELECT id, last_name, first_name FROM adm_users WHERE position = ? AND is_block = 0 AND is_deleted = 0',
			[$PROG_CONFIG['DESIGNER_POSITION_ID']]) ?? [];

	$tmpLayoutContentData['designer'] = dbSelectData($con,
			'SELECT id, last_name, first_name FROM adm_users WHERE id = ?',
			[$tmpLayoutContentData['order']['designer_id'] ?? 0])[0] ?? [];

	$tmpLayoutContentData['manager'] = dbSelectData($con,
			'SELECT id, last_name, first_name FROM adm_users WHERE id = ?',
			[$tmpLayoutContentData['order']['create_user_id']])[0] ?? [];

	$tmpLayoutData['content'] =
		renderTemplate($_SERVER['DOCUMENT_ROOT'] . '/src/templates/design/order_info_card.php',
			$tmpLayoutContentData);
}

///////////////////////////////////////////////////////////////////////////////////////////////

if (isset($_GET['action']) && $_GET['action'] == 'orders_list') {

	$_SESSION['navList']['designOrdersList']['isActive'] = true;
	$tmpLayoutData['title'] = 'Заявки на дизайн';

	$sqlQuerySelect = 'SELECT u.last_name, u.first_name, 
       d.id AS order_id, d.order_name_in, d.order_name_out, d.client_name, 
       d.current_status, d.order_priority, DATE_FORMAT(d.deadline_date, ' . $PROG_CONFIG['DATE_FORMAT'] . ') AS deadline_date 
       FROM design_orders d ';
	$sqlQueryJoin1 = 'LEFT JOIN adm_users u ON d.designer_id = u.id ';
	$sqlQueryWhere = '';
	$sqlParameters = [];
	$sqlSortBy = 'ORDER by d.id DESC ';

	$paginationData =
		getPagination($PROG_CONFIG, $PROG_CONFIG['HOST'] . '/design.php', $con, 'SELECT COUNT(*) as pgn FROM design_orders ' .
			$sqlQueryWhere, $sqlParameters);

	$tmpLayoutData['pagination'] = $paginationData['tmpPagination'];
	$sqlPagination = $paginationData['sqlPagination'];

	$tmpLayoutContentData['orders'] =
		dbSelectData($con, $sqlQuerySelect . $sqlQueryJoin1 . $sqlQueryWhere . $sqlSortBy . $sqlPagination, $sqlParameters) ?? [];

	$tmpLayoutData['content'] =
		renderTemplate($_SERVER['DOCUMENT_ROOT'] . '/src/templates/design/orders_list.php', $tmpLayoutContentData);
}

///////////////////////////////////////////////////////////////////////////////////////////////

if (isset($_POST['action']) && $_POST['action'] == 'new_order_data') {

	if (isValidNewDesignOrderData($PROG_CONFIG) === false) {
		redirectToIf(false, '',
			$PROG_CONFIG['HOST'] . '/design.php?action=new_order_card&error_massage=ошибка входных данных');
	}

	$newOrderData = [
		'create_user_id' => $_SESSION['user']['id'],
		'order_name_out' => correctFormatUpper($_POST['order_name_out']),////
		'order_priority' => 1,
		'client_name' => correctFormatUpper($_POST['client_name']),/////
		'mobile_phone' => correctFormat($_POST['mobile_phone']),////
		'email' => correctFormatLower($_POST['email']),////
		'task_text' => correctFormat($_POST['task_text']),/////
		'design_format' => $_POST['design_format'],////
		'deadline_date' => date('Y-m-d H:i:s', strtotime($_POST['deadline_date'])),////
		'current_status' => 0,
		'datetime_status_000' => date('Y-m-d H:i:s')
	];

	mysqli_query($con, 'START TRANSACTION');

	$newOrder = dbInsertData($con, 'design_orders', $newOrderData);

	$updateOrderNameIn = dbExecQuery($con, "UPDATE design_orders SET order_name_in = ? WHERE id = ?",
		[getOrderName($newOrder), $newOrder]);

	if ($newOrder && $updateOrderNameIn)
		mysqli_query($con, 'COMMIT');
	else
		mysqli_query($con, 'ROLLBACK');

	redirectToIf($newOrder && $updateOrderNameIn,
		$PROG_CONFIG['HOST'] . '/design.php?action=order_info_card&id='. $newOrder . '&alert_massage=сохранено',
		$PROG_CONFIG['HOST'] . '/design.php?action=new_order_card&error_massage=ошибка записи');
}


if (isset($_POST['action']) && isset($_POST['order_id']) && isset($_POST['designer_id']) &&
	$_POST['action'] == 'change_designer') {

	$userData = dbSelectData($con, 'SELECT position FROM adm_users WHERE id = ?', [$_POST['designer_id']])[0] ?? [];

	if (isset($userData['position']) === false || $userData['position'] !== $PROG_CONFIG['DESIGNER_POSITION_ID']) {
		redirectToIf(false, '',
			$PROG_CONFIG['HOST'] . '/design.php?action=order_info_card&id='. $_POST['order_id'] . '&error_massage=USER ID ERROR');
	}

	$changeDesignerIdQuery = 'UPDATE design_orders SET designer_id = ?, current_status = ?, datetime_status_100 = ? WHERE id = ?';
	$changeDesignerIdData = [$_POST['designer_id'], 100,  date('Y-m-d H:i:s'), $_POST['order_id']];
	$changeDesignerId = dbExecQuery($con, $changeDesignerIdQuery, $changeDesignerIdData);

	redirectToIf($changeDesignerId,
		$PROG_CONFIG['HOST'] . '/design.php?action=order_info_card&id='. $_POST['order_id'] . '&alert_massage=сохранено',
		$PROG_CONFIG['HOST'] . '/design.php?action=order_info_card&id='. $_POST['order_id'] . '&error_massage=ошибка записи');
}

if (isset($_POST['action']) && isset($_POST['order_id']) && isset($_POST['priority']) &&
	$_POST['action'] == 'change_priority') {

	if (array_key_exists($_POST['priority'], $PROG_DATA['PRIORITY_ORDERS']) === false) {
		redirectToIf(false, '',
			$PROG_CONFIG['HOST'] . '/design.php?action=order_info_card&id='. $_POST['order_id'] . '&error_massage=PRIORITY ID ERROR');
	}

	$changePriorityQuery = 'UPDATE design_orders SET order_priority = ? WHERE id = ?';
	$changePriorityData = [$_POST['priority'], $_POST['order_id']];
	$changePriority = dbExecQuery($con, $changePriorityQuery, $changePriorityData);

	redirectToIf($changePriority,
		$PROG_CONFIG['HOST'] . '/design.php?action=order_info_card&id='. $_POST['order_id'] . '&alert_massage=сохранено',
		$PROG_CONFIG['HOST'] . '/design.php?action=order_info_card&id='. $_POST['order_id'] . '&error_massage=ошибка записи');
}

echo renderTemplate($_SERVER['DOCUMENT_ROOT'] . '/src/templates/layout.php', $tmpLayoutData);
