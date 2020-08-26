<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/src/include.php');

require_once($_SERVER['DOCUMENT_ROOT'] . '/src/header_session_start.php');

require_once($_SERVER['DOCUMENT_ROOT'] . '/src/header_tmp_data.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/src/header_alert_massage.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/src/header_authorization_user.php');

date_default_timezone_set($PROG_CONFIG['TIMEZONE']);
$_SESSION['navList'] = cleanActiveTabs($_SESSION['navList']);

///////////////////////////////////////////////////////////////////////////////////////////////

//  права доступа

if (isset($_GET['action']) && $_GET['action'] == 'new_order_card') {

	errorIfAccessDenied($_SESSION['user']['auth_design_order_new'],
		$PROG_CONFIG['HOST'] . '/design.php?error_massage=' . $PROG_DATA['ERROR']['ACCESS_DENIED'] . ' ' . __LINE__);

	$_SESSION['formId'] = md5(time());
	$tmpLayoutContentData['formId'] = $_SESSION['formId'];

	if (isset($_SESSION['navList']['designNewOrder']['isActive']))
		$_SESSION['navList']['designNewOrder']['isActive'] = true;
	$tmpLayoutData['title'] = 'Новая заявка на дизайн';

	$tmpLayoutData['content'] = renderTemplate($_SERVER['DOCUMENT_ROOT'] .
		'/src/templates/design/new_order.php', $tmpLayoutContentData);
}


///////////////////////////////////////////////////////////////////////////////////////////////

//  права доступа

if (isset($_GET['action']) && isset($_GET['id']) && $_GET['action'] == 'order_info_card') {

	errorIfAccessDenied($_SESSION['user']['auth_design_order_view'],
		$PROG_CONFIG['HOST'] . '/design.php?error_massage=' . $PROG_DATA['ERROR']['ACCESS_DENIED'] . ' ' . __LINE__);

	$tmpLayoutData['title'] = 'Заявка на дизайн';

	$_SESSION['formId'] = md5(time());
	$tmpLayoutContentData['formId'] = $_SESSION['formId'];

	$tmpLayoutContentData['activeTab'] = 'notes';
	if (isset($_GET['active_tab']))
		$tmpLayoutContentData['activeTab'] = $_GET['active_tab'];

	$tmpLayoutContentData['order'] =
		dbSelectData($con, 'SELECT *, 
		DATE_FORMAT(deadline_date, ' . $PROG_CONFIG['DATE_FORMAT'] . ') AS deadline_date,
		' . addSuffixStatusList('datetime_status_', $PROG_DATA['STATUS_ID_DESIGN'], $PROG_CONFIG['DATETIME_FORMAT']) . ' 
		FROM design_orders WHERE id = ?', [$_GET['id']])[0] ?? [];

	if (empty($tmpLayoutContentData['order'])) {
		redirectToIf(false, '', $PROG_CONFIG['HOST'] .
			'/design.php?action=orders_list&error_massage=' . $PROG_DATA['ERROR']['ID']);
	}

	$tmpLayoutContentData['designerList'] =
		dbSelectData($con, 'SELECT id, last_name, first_name FROM adm_users WHERE position = ? AND is_block = 0 AND is_deleted = 0',
			[$PROG_DATA['USERS_POSITIONS_ID']['DESIGNER']]) ?? [];

	$tmpLayoutContentData['designer'] = dbSelectData($con,
			'SELECT id, last_name, first_name FROM adm_users WHERE id = ?',
			[$tmpLayoutContentData['order']['designer_id'] ?? 0])[0] ?? [];

	$tmpLayoutContentData['manager'] = dbSelectData($con,
			'SELECT id, last_name, first_name FROM adm_users WHERE id = ?',
			[$tmpLayoutContentData['order']['create_user_id']])[0] ?? [];

	$notesQuery = 'SELECT u.last_name, u.first_name, 
	n.id, n.user_id, n.order_id, n.order_type, 
	DATE_FORMAT(n.create_datetime, ' . $PROG_CONFIG['DATETIME_FORMAT'] . ') AS create_datetime, 
	n.priority, n.note 
	FROM notes n 
	LEFT JOIN adm_users u ON n.user_id = u.id 
	WHERE n.order_id = ? AND n.order_type = ? 
	ORDER by n.id DESC';

	$tmpLayoutContentData['notes'] =
		dbSelectData($con, $notesQuery, [$tmpLayoutContentData['order']['id'], $PROG_DATA['ORDER_TYPES']['DESIGN']]);

	$filesQuery = 'SELECT u.last_name AS last_name, u.first_name AS first_name, 
	f.id, f.is_deleted, f.user_id, f.note, f.name, f.path, 
	DATE_FORMAT(f.change_datetime, ' . $PROG_CONFIG['DATETIME_FORMAT'] . ') AS change_datetime 
	FROM files f 
	LEFT JOIN adm_users u ON f.user_id = u.id 
	WHERE f.order_id = ? AND f.order_type = ? 
	ORDER by f.id DESC';

	$tmpLayoutContentData['files'] =
		dbSelectData($con, $filesQuery, [$tmpLayoutContentData['order']['id'], $PROG_DATA['ORDER_TYPES']['DESIGN']]);

	$tmpLayoutModalData = [
		'config' => &$PROG_CONFIG,
		'progData' => $PROG_DATA,
		'formId' => $_SESSION['formId'],
		'orderId' => $tmpLayoutContentData['order']['id'],
		'orderType' => $PROG_DATA['ORDER_TYPES']['DESIGN'],
		'redirectSuccess' => $PROG_CONFIG['HOST'] . '/design.php?action=order_info_card&active_tab=notes&id=' .
			$tmpLayoutContentData['order']['id'],
		'redirectError' => $PROG_CONFIG['HOST'] . '/design.php?action=order_info_card&active_tab=notes&id=' .
			$tmpLayoutContentData['order']['id']
	];

	$tmpLayoutData['modal'] =
		renderTemplate($_SERVER['DOCUMENT_ROOT'] . '/src/templates/notes/modal_new_note.php',
			$tmpLayoutModalData);

	$tmpLayoutData['content'] =
		renderTemplate($_SERVER['DOCUMENT_ROOT'] . '/src/templates/design/order_info_card.php',
			$tmpLayoutContentData);
}


///////////////////////////////////////////////////////////////////////////////////////////////

//  права доступа

if (isset($_GET['action']) && $_GET['action'] == 'orders_list') {

	errorIfAccessDenied($_SESSION['user']['auth_design_order_view'],
		$PROG_CONFIG['HOST'] . '/design.php?error_massage=' . $PROG_DATA['ERROR']['ACCESS_DENIED'] . ' ' . __LINE__);


	if (isset($_SESSION['navList']['designOrdersListMy']['isActive']) &&
		isset($_GET['designer_id']) && $_SESSION['user']['id'] == $_GET['designer_id'])
		$_SESSION['navList']['designOrdersListMy']['isActive'] = true;
	else if (isset($_SESSION['navList']['designOrdersList']['isActive']))
		$_SESSION['navList']['designOrdersList']['isActive'] = true;
	$tmpLayoutData['title'] = 'Заявки на дизайн';

	$tmpLayoutContentData['formData']['createUserId'] = $_GET['create_user_id'] ?? '';
	$tmpLayoutContentData['formData']['designerId'] = $_GET['designer_id'] ?? '';
	$tmpLayoutContentData['formData']['priority'] = $_GET['priority'] ?? '';
	$tmpLayoutContentData['formData']['status'] = $_GET['status'] ?? '';
	$tmpLayoutContentData['formData']['deadline'] = $_GET['deadline'] ?? '';
	$tmpLayoutContentData['formData']['search'] = $_GET['search'] ?? '';
	$tmpLayoutContentData['formData']['dateFrom'] = $_GET['date_from'] ?? '';
	$tmpLayoutContentData['formData']['dateTo'] = $_GET['date_to'] ?? '';

	$sqlQuerySelectPagination = 'SELECT COUNT(*) as pgn FROM design_orders o ';

	$sqlQuerySelect = 'SELECT 
	ud.last_name AS ud_last_name, ud.first_name AS ud_first_name, 
	uc.last_name AS uc_last_name, uc.first_name AS uc_first_name, 
	o.id, o.order_name_in, o.order_name_out, o.client_name, o.designer_id, o.create_user_id, 
	o.current_status, o.order_priority, o.error_priority, DATE_FORMAT(o.deadline_date, ' . $PROG_CONFIG['DATE_FORMAT'] . ') AS deadline_date 
       FROM design_orders o ';

	$sqlQueryJoin1 = 'LEFT JOIN adm_users ud ON o.designer_id = ud.id ';
	$sqlQueryJoin2 = 'LEFT JOIN adm_users uc ON o.create_user_id = uc.id ';
	$sqlQueryWhere = 'WHERE o.id > 0 ';
	$sqlParameters = [];
	$sqlSortBy = 'ORDER BY o.id * o.order_priority * o.sort_priority * o.error_priority DESC ';


	$dateFilter = isset($_GET['date_from']) && isset($_GET['date_to']) && $_GET['date_from'] && $_GET['date_to'];


	if (isset($_GET['create_user_id']) && $_GET['create_user_id'] != 'all') {
		$sqlQueryWhere = $sqlQueryWhere . 'AND create_user_id = ? ';
		$sqlParameters['create_user_id'] = $_GET['create_user_id'];
	}

	if (isset($_GET['designer_id']) && $_GET['designer_id'] != 'all') {
		if ($_GET['designer_id'] == 'null') {
			$sqlQueryWhere = $sqlQueryWhere . 'AND designer_id IS NULL ';
		} else {
			$sqlQueryWhere = $sqlQueryWhere . 'AND designer_id = ? ';
			$sqlParameters['designer_id'] = $_GET['designer_id'];
		}
	}

	if (isset($_GET['priority']) && $_GET['priority'] != 'all') {
		$sqlQueryWhere = $sqlQueryWhere . 'AND order_priority = ? ';
		$sqlParameters['priority'] = $_GET['priority'];
	}

	if (isset($_GET['status']) && $_GET['status'] != 'all' && $dateFilter == false) {
		if ($_GET['status'] >= $PROG_DATA['STATUS_ID_DESIGN']['START'] &&
			$_GET['status'] <= $PROG_DATA['STATUS_ID_DESIGN']['READY_90']) {

			$sqlQueryWhere = $sqlQueryWhere . 'AND current_status >= ? AND current_status <= ? ';
			$sqlParameters['status_start'] = $PROG_DATA['STATUS_ID_DESIGN']['START'];
			$sqlParameters['status_ready_90'] = $PROG_DATA['STATUS_ID_DESIGN']['READY_90'];
		} else {
			$sqlQueryWhere = $sqlQueryWhere . 'AND current_status = ? ';
			$sqlParameters['status'] = $_GET['status'];
		}
	}

	if (isset($_GET['deadline']) && ($_GET['deadline'] || $_GET['deadline'] == '0')) {
		$sqlQueryWhere = $sqlQueryWhere . 'AND deadline_date <= NOW() + INTERVAL ? DAY ';
		$sqlParameters['deadline'] = $_GET['deadline'];
	}

	if (isset($_GET['search']) && $_GET['search']) {
		$sqlQueryWhere = $sqlQueryWhere . 'AND (order_name_in LIKE ? OR order_name_out LIKE ? OR client_name LIKE ?) ';
		$sqlParameters['search_order_name_in'] = '%' . $_GET['search'] . '%';
		$sqlParameters['search_order_name_out'] = '%' . $_GET['search'] . '%';
		$sqlParameters['search_client_name'] = '%' . $_GET['search'] . '%';
	}

	if ($dateFilter) {
		if (isset($_GET['status']) && $_GET['status'] == $PROG_DATA['STATUS_ID_DESIGN']['WAIT']) {
			$sqlQueryWhere = $sqlQueryWhere . 'AND (datetime_status_0 BETWEEN ? AND DATE_ADD(?, INTERVAL 1 DAY)) ';
			$sqlParameters['datetime_status_0_from'] = date('Y-m-d H:i:s', strtotime($_GET['date_from']));
			$sqlParameters['datetime_status_0_to'] = date('Y-m-d H:i:s', strtotime($_GET['date_to']));
		} elseif (isset($_GET['status']) && $_GET['status'] == $PROG_DATA['STATUS_ID_DESIGN']['RECEIVED']) {
			$sqlQueryWhere = $sqlQueryWhere . 'AND (datetime_status_100 BETWEEN ? AND DATE_ADD(?, INTERVAL 1 DAY)) ';
			$sqlParameters['datetime_status_100_from'] = date('Y-m-d H:i:s', strtotime($_GET['date_from']));
			$sqlParameters['datetime_status_100_to'] = date('Y-m-d H:i:s', strtotime($_GET['date_to']));
		} elseif (isset($_GET['status']) && $_GET['status'] >= $PROG_DATA['STATUS_ID_DESIGN']['START'] &&
			$_GET['status'] <= $PROG_DATA['STATUS_ID_DESIGN']['READY_90']) {
			$sqlQueryWhere = $sqlQueryWhere . 'AND (
			(datetime_status_200 BETWEEN ? AND DATE_ADD(?, INTERVAL 1 DAY)) OR
			(datetime_status_210 BETWEEN ? AND DATE_ADD(?, INTERVAL 1 DAY)) OR
			(datetime_status_220 BETWEEN ? AND DATE_ADD(?, INTERVAL 1 DAY)) OR
			(datetime_status_230 BETWEEN ? AND DATE_ADD(?, INTERVAL 1 DAY)) OR
			(datetime_status_240 BETWEEN ? AND DATE_ADD(?, INTERVAL 1 DAY)) OR
			(datetime_status_250 BETWEEN ? AND DATE_ADD(?, INTERVAL 1 DAY)) OR
			(datetime_status_260 BETWEEN ? AND DATE_ADD(?, INTERVAL 1 DAY)) OR
			(datetime_status_270 BETWEEN ? AND DATE_ADD(?, INTERVAL 1 DAY)) OR
			(datetime_status_280 BETWEEN ? AND DATE_ADD(?, INTERVAL 1 DAY)) OR
			(datetime_status_290 BETWEEN ? AND DATE_ADD(?, INTERVAL 1 DAY))
			) ';

			$sqlParameters['datetime_status_200_from'] = date('Y-m-d H:i:s', strtotime($_GET['date_from']));
			$sqlParameters['datetime_status_200_to'] = date('Y-m-d H:i:s', strtotime($_GET['date_to']));
			$sqlParameters['datetime_status_210_from'] = date('Y-m-d H:i:s', strtotime($_GET['date_from']));
			$sqlParameters['datetime_status_210_to'] = date('Y-m-d H:i:s', strtotime($_GET['date_to']));
			$sqlParameters['datetime_status_220_from'] = date('Y-m-d H:i:s', strtotime($_GET['date_from']));
			$sqlParameters['datetime_status_220_to'] = date('Y-m-d H:i:s', strtotime($_GET['date_to']));
			$sqlParameters['datetime_status_230_from'] = date('Y-m-d H:i:s', strtotime($_GET['date_from']));
			$sqlParameters['datetime_status_230_to'] = date('Y-m-d H:i:s', strtotime($_GET['date_to']));
			$sqlParameters['datetime_status_240_from'] = date('Y-m-d H:i:s', strtotime($_GET['date_from']));
			$sqlParameters['datetime_status_240_to'] = date('Y-m-d H:i:s', strtotime($_GET['date_to']));
			$sqlParameters['datetime_status_250_from'] = date('Y-m-d H:i:s', strtotime($_GET['date_from']));
			$sqlParameters['datetime_status_250_to'] = date('Y-m-d H:i:s', strtotime($_GET['date_to']));
			$sqlParameters['datetime_status_260_from'] = date('Y-m-d H:i:s', strtotime($_GET['date_from']));
			$sqlParameters['datetime_status_260_to'] = date('Y-m-d H:i:s', strtotime($_GET['date_to']));
			$sqlParameters['datetime_status_270_from'] = date('Y-m-d H:i:s', strtotime($_GET['date_from']));
			$sqlParameters['datetime_status_270_to'] = date('Y-m-d H:i:s', strtotime($_GET['date_to']));
			$sqlParameters['datetime_status_280_from'] = date('Y-m-d H:i:s', strtotime($_GET['date_from']));
			$sqlParameters['datetime_status_280_to'] = date('Y-m-d H:i:s', strtotime($_GET['date_to']));
			$sqlParameters['datetime_status_290_from'] = date('Y-m-d H:i:s', strtotime($_GET['date_from']));
			$sqlParameters['datetime_status_290_to'] = date('Y-m-d H:i:s', strtotime($_GET['date_to']));
		} elseif (isset($_GET['status']) && $_GET['status'] == $PROG_DATA['STATUS_ID_DESIGN']['DONE']) {
			$sqlQueryWhere = $sqlQueryWhere . 'AND (datetime_status_300 BETWEEN ? AND DATE_ADD(?, INTERVAL 1 DAY)) ';
			$sqlParameters['datetime_status_300_from'] = date('Y-m-d H:i:s', strtotime($_GET['date_from']));
			$sqlParameters['datetime_status_300_to'] = date('Y-m-d H:i:s', strtotime($_GET['date_to']));
		} elseif (isset($_GET['status']) && $_GET['status'] == $PROG_DATA['STATUS_ID_DESIGN']['CANCEL']) {
			$sqlQueryWhere = $sqlQueryWhere . 'AND (datetime_status_999 BETWEEN ? AND DATE_ADD(?, INTERVAL 1 DAY)) ';
			$sqlParameters['datetime_status_999_from'] = date('Y-m-d H:i:s', strtotime($_GET['date_from']));
			$sqlParameters['datetime_status_999_to'] = date('Y-m-d H:i:s', strtotime($_GET['date_to']));
		} else {
			$sqlQueryWhere = $sqlQueryWhere . 'AND (
			(datetime_status_0 BETWEEN ? AND DATE_ADD(?, INTERVAL 1 DAY)) OR
			(datetime_status_100 BETWEEN ? AND DATE_ADD(?, INTERVAL 1 DAY)) OR
			(datetime_status_200 BETWEEN ? AND DATE_ADD(?, INTERVAL 1 DAY)) OR
			(datetime_status_210 BETWEEN ? AND DATE_ADD(?, INTERVAL 1 DAY)) OR
			(datetime_status_220 BETWEEN ? AND DATE_ADD(?, INTERVAL 1 DAY)) OR
			(datetime_status_230 BETWEEN ? AND DATE_ADD(?, INTERVAL 1 DAY)) OR
			(datetime_status_240 BETWEEN ? AND DATE_ADD(?, INTERVAL 1 DAY)) OR
			(datetime_status_250 BETWEEN ? AND DATE_ADD(?, INTERVAL 1 DAY)) OR
			(datetime_status_260 BETWEEN ? AND DATE_ADD(?, INTERVAL 1 DAY)) OR
			(datetime_status_270 BETWEEN ? AND DATE_ADD(?, INTERVAL 1 DAY)) OR
			(datetime_status_280 BETWEEN ? AND DATE_ADD(?, INTERVAL 1 DAY)) OR
			(datetime_status_290 BETWEEN ? AND DATE_ADD(?, INTERVAL 1 DAY)) OR
			(datetime_status_300 BETWEEN ? AND DATE_ADD(?, INTERVAL 1 DAY)) OR
			(datetime_status_999 BETWEEN ? AND DATE_ADD(?, INTERVAL 1 DAY))
			) ';

			$sqlParameters['datetime_status_0_from'] = date('Y-m-d H:i:s', strtotime($_GET['date_from']));
			$sqlParameters['datetime_status_0_to'] = date('Y-m-d H:i:s', strtotime($_GET['date_to']));
			$sqlParameters['datetime_status_100_from'] = date('Y-m-d H:i:s', strtotime($_GET['date_from']));
			$sqlParameters['datetime_status_100_to'] = date('Y-m-d H:i:s', strtotime($_GET['date_to']));
			$sqlParameters['datetime_status_200_from'] = date('Y-m-d H:i:s', strtotime($_GET['date_from']));
			$sqlParameters['datetime_status_200_to'] = date('Y-m-d H:i:s', strtotime($_GET['date_to']));
			$sqlParameters['datetime_status_210_from'] = date('Y-m-d H:i:s', strtotime($_GET['date_from']));
			$sqlParameters['datetime_status_210_to'] = date('Y-m-d H:i:s', strtotime($_GET['date_to']));
			$sqlParameters['datetime_status_220_from'] = date('Y-m-d H:i:s', strtotime($_GET['date_from']));
			$sqlParameters['datetime_status_220_to'] = date('Y-m-d H:i:s', strtotime($_GET['date_to']));
			$sqlParameters['datetime_status_230_from'] = date('Y-m-d H:i:s', strtotime($_GET['date_from']));
			$sqlParameters['datetime_status_230_to'] = date('Y-m-d H:i:s', strtotime($_GET['date_to']));
			$sqlParameters['datetime_status_240_from'] = date('Y-m-d H:i:s', strtotime($_GET['date_from']));
			$sqlParameters['datetime_status_240_to'] = date('Y-m-d H:i:s', strtotime($_GET['date_to']));
			$sqlParameters['datetime_status_250_from'] = date('Y-m-d H:i:s', strtotime($_GET['date_from']));
			$sqlParameters['datetime_status_250_to'] = date('Y-m-d H:i:s', strtotime($_GET['date_to']));
			$sqlParameters['datetime_status_260_from'] = date('Y-m-d H:i:s', strtotime($_GET['date_from']));
			$sqlParameters['datetime_status_260_to'] = date('Y-m-d H:i:s', strtotime($_GET['date_to']));
			$sqlParameters['datetime_status_270_from'] = date('Y-m-d H:i:s', strtotime($_GET['date_from']));
			$sqlParameters['datetime_status_270_to'] = date('Y-m-d H:i:s', strtotime($_GET['date_to']));
			$sqlParameters['datetime_status_280_from'] = date('Y-m-d H:i:s', strtotime($_GET['date_from']));
			$sqlParameters['datetime_status_280_to'] = date('Y-m-d H:i:s', strtotime($_GET['date_to']));
			$sqlParameters['datetime_status_290_from'] = date('Y-m-d H:i:s', strtotime($_GET['date_from']));
			$sqlParameters['datetime_status_290_to'] = date('Y-m-d H:i:s', strtotime($_GET['date_to']));
			$sqlParameters['datetime_status_300_from'] = date('Y-m-d H:i:s', strtotime($_GET['date_from']));
			$sqlParameters['datetime_status_300_to'] = date('Y-m-d H:i:s', strtotime($_GET['date_to']));
			$sqlParameters['datetime_status_999_from'] = date('Y-m-d H:i:s', strtotime($_GET['date_from']));
			$sqlParameters['datetime_status_999_to'] = date('Y-m-d H:i:s', strtotime($_GET['date_to']));
		}
	}

	$paginationData =
		getPagination($PROG_CONFIG, $PROG_CONFIG['HOST'] . '/design.php', $con, $sqlQuerySelectPagination .
			$sqlQueryWhere, $sqlParameters);

	$tmpLayoutData['pagination'] = $paginationData['tmpPagination'];
	$sqlPagination = $paginationData['sqlPagination'];

	$tmpLayoutContentData['create_users'] =
		dbSelectData($con, 'SELECT * FROM adm_users WHERE auth_design_order_new = 1', []);
	$tmpLayoutContentData['designers'] =
		dbSelectData($con, 'SELECT * FROM adm_users WHERE position = ?', [$PROG_DATA['USERS_POSITIONS_ID']['DESIGNER']]);

	$tmpLayoutContentData['orders'] =
		dbSelectData($con, $sqlQuerySelect . $sqlQueryJoin1 . $sqlQueryJoin2 . $sqlQueryWhere . $sqlSortBy . $sqlPagination, $sqlParameters) ?? [];

	$tmpLayoutData['content'] =
		renderTemplate($_SERVER['DOCUMENT_ROOT'] . '/src/templates/design/orders_list.php', $tmpLayoutContentData);
}


///////////////////////////////////////////////////////////////////////////////////////////////

//  права доступа

if (isset($_POST['action']) && isset($_POST['form_id']) && $_POST['action'] == 'new_order_data') {

	errorIfAccessDenied($_SESSION['user']['auth_design_order_new'],
		$PROG_CONFIG['HOST'] . '/design.php?error_massage=' . $PROG_DATA['ERROR']['ACCESS_DENIED'] . ' ' . __LINE__);

	errorIfDoubleClick($_SESSION['formId'], $_POST['form_id'],
		$PROG_CONFIG['HOST'] . '/design.php?action=new_order_card&error_massage=' . $PROG_DATA['ERROR']['DOUBLE_CLICK']);

	$_SESSION['formId'] = 'none';

	if (isValidNewDesignOrderData($PROG_CONFIG) === false) {
		redirectToIf(false, '',
			$PROG_CONFIG['HOST'] . '/design.php?action=new_order_card&error_massage=' . $PROG_DATA['ERROR']['INPUT_DATA']);
	}

	$newOrderData = [
		'create_user_id' => $_SESSION['user']['id'],
		'order_name_out' => correctFormatUpper($_POST['order_name_out']),////
		'order_priority' => $PROG_DATA['PRIORITY_ID']['NORM'],
		'client_name' => correctFormatUpper($_POST['client_name']),/////
		'mobile_phone' => correctFormat($_POST['mobile_phone']),////
		'email' => correctFormatLower($_POST['email']),////
		'task_text' => correctFormat($_POST['task_text']),/////
		'design_format' => $_POST['design_format'],////
		'deadline_date' => date('Y-m-d H:i:s', strtotime($_POST['deadline_date'])),////
		'current_status' => $PROG_DATA['STATUS_ID_DESIGN']['WAIT'],
		'datetime_status_0' => date('Y-m-d H:i:s')
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
		$PROG_CONFIG['HOST'] . '/design.php?action=order_info_card&id=' . $newOrder . '&alert_massage=' . $PROG_DATA['ALERT']['OK'],
		$PROG_CONFIG['HOST'] . '/design.php?action=new_order_card&error_massage=' . $PROG_DATA['ERROR']['BD_WRITE']);
}


///////////////////////////////////////////////////////////////////////////////////////////////

//  права доступа

if (isset($_POST['action']) && isset($_POST['order_id']) && isset($_POST['designer_id']) &&
	$_POST['action'] == 'change_designer') {

	errorIfAccessDenied($_SESSION['user']['auth_design_order_select_designer'],
		$PROG_CONFIG['HOST'] . '/design.php?error_massage=' . $PROG_DATA['ERROR']['ACCESS_DENIED'] . ' ' . __LINE__);

	$userData = dbSelectData($con, 'SELECT position FROM adm_users WHERE id = ?', [$_POST['designer_id']])[0] ?? [];

	if (isset($userData['position']) === false || $userData['position'] !== $PROG_DATA['USERS_POSITIONS_ID']['DESIGNER']) {
		redirectToIf(false, '',
			$PROG_CONFIG['HOST'] .
			'/design.php?action=order_info_card&id=' . $_POST['order_id'] . '&error_massage=' . $PROG_DATA['ERROR']['ID']);
	}

	$changeDesignerIdQuery = 'UPDATE design_orders SET designer_id = ?, current_status = ?, datetime_status_100 = ? WHERE id = ?';
	$changeDesignerIdData = [$_POST['designer_id'],
		$PROG_DATA['STATUS_ID_DESIGN']['RECEIVED'],
		date('Y-m-d H:i:s'), $_POST['order_id']];
	$changeDesignerId = dbExecQuery($con, $changeDesignerIdQuery, $changeDesignerIdData);

	redirectToIf($changeDesignerId,
		$PROG_CONFIG['HOST'] .
		'/design.php?action=order_info_card&id=' . $_POST['order_id'] . '&alert_massage=' . $PROG_DATA['ALERT']['OK'],
		$PROG_CONFIG['HOST'] .
		'/design.php?action=order_info_card&id=' . $_POST['order_id'] . '&error_massage=' . $PROG_DATA['ERROR']['BD_WRITE']);
}


///////////////////////////////////////////////////////////////////////////////////////////////

//  права доступа

if (isset($_POST['action']) && isset($_POST['order_id']) && isset($_POST['priority']) &&
	$_POST['action'] == 'change_priority') {

	errorIfAccessDenied($_SESSION['user']['auth_design_order_change_priority'],
		$PROG_CONFIG['HOST'] . '/design.php?error_massage=' . $PROG_DATA['ERROR']['ACCESS_DENIED'] . ' ' . __LINE__);

	if (array_key_exists($_POST['priority'], $PROG_DATA['PRIORITY_ORDERS']) === false) {
		redirectToIf(false, '',
			$PROG_CONFIG['HOST'] .
			'/design.php?action=order_info_card&id=' . $_POST['order_id'] . '&error_massage=ACCESS DENIED' . __LINE__);
	}

	$changePriorityQuery = 'UPDATE design_orders SET order_priority = ? WHERE id = ?';
	$changePriority = dbExecQuery($con, $changePriorityQuery, [$_POST['priority'], $_POST['order_id']]);

	redirectToIf($changePriority,
		$PROG_CONFIG['HOST'] .
		'/design.php?action=order_info_card&id=' . $_POST['order_id'] . '&alert_massage=' . $PROG_DATA['ALERT']['OK'],
		$PROG_CONFIG['HOST'] .
		'/design.php?action=order_info_card&id=' . $_POST['order_id'] . '&error_massage=' . $PROG_DATA['ERROR']['BD_WRITE']);
}


///////////////////////////////////////////////////////////////////////////////////////////////

if (isset($_GET['action']) && isset($_GET['order_id']) &&
	isset($_GET['redirect_success']) && isset($_GET['redirect_error']) &&
	($_GET['action'] == 'add_error' || $_GET['action'] == 'cancel_error')) {

	$errorPriority = $_GET['action'] == 'cancel_error' ? 1 : 2;

	redirectToIf(dbExecQuery($con, 'UPDATE design_orders SET error_priority = ? WHERE id = ?', [$errorPriority, $_GET['order_id']]),
		$_GET['redirect_success'] . '&alert_massage=' . $PROG_DATA['ALERT']['OK'],
		$_GET['redirect_error'] . '&error_massage=' . $PROG_DATA['ERROR']['BD_WRITE']);
}


///////////////////////////////////////////////////////////////////////////////////////////////

// права доступа на стадии от RECEIVED до CANCEL
// статус существует && меняется в большую сторону
// нельзя отменять после выполнения
// отменить только кто создал
// менять статус только назначенный дизайнер

if (isset($_POST['action']) && isset($_POST['order_id']) && isset($_POST['status']) &&
	$_POST['action'] == 'change_status') {

	// права доступа на стадии от RECEIVED до CANCEL
	if ($_POST['status'] > $PROG_DATA['STATUS_ID_DESIGN']['RECEIVED'] &&
		$_POST['status'] < $PROG_DATA['STATUS_ID_DESIGN']['CANCEL']) {

		errorIfAccessDenied($_SESSION['user']['auth_design_order_change_status'],
			$PROG_CONFIG['HOST'] . '/design.php?error_massage=' . $PROG_DATA['ERROR']['ACCESS_DENIED'] . ' ' . __LINE__);
	}

	$orderData = dbSelectData($con, 'SELECT * FROM design_orders WHERE id = ?', [$_POST['order_id']])[0] ?? [];

	// заказ существует
	if (isset($orderData['id']) == false)
		redirectToIf(false, '',
			$PROG_CONFIG['HOST'] . '/design.php?action=order_info_card&id=' .
			$_POST['order_id'] . '&error_massage=' . $PROG_DATA['ERROR']['ACCESS_DENIED'] . ' ' . __LINE__);

	// статус существует && меняется в большую сторону
	if (array_key_exists($_POST['status'], $PROG_DATA['STATUS_LIST_DESIGN']) === false ||
		$_POST['status'] <= $orderData['current_status']) {

		redirectToIf(false, '',
			$PROG_CONFIG['HOST'] . '/design.php?action=order_info_card&id=' .
			$_POST['order_id'] . '&error_massage=' . $PROG_DATA['ERROR']['ACCESS_DENIED'] . ' ' . __LINE__);
	}

	// нельзя отменять после выполнения
	if ($orderData['current_status'] == $PROG_DATA['STATUS_ID_DESIGN']['DONE'] &&
		$_POST['status'] == $PROG_DATA['STATUS_ID_DESIGN']['CANCEL']) {

		redirectToIf(false, '',
			$PROG_CONFIG['HOST'] . '/design.php?action=order_info_card&id=' .
			$_POST['order_id'] . '&error_massage=' . $PROG_DATA['ERROR']['ACCESS_DENIED'] . __LINE__);
	}

	// отменить только кто создал
	if ($_POST['status'] == $PROG_DATA['STATUS_ID_DESIGN']['CANCEL'] &&
		$orderData['create_user_id'] != $_SESSION['user']['id']) {

		redirectToIf(false, '',
			$PROG_CONFIG['HOST'] . '/design.php?action=order_info_card&id=' .
			$_POST['order_id'] . '&error_massage=' . $PROG_DATA['ERROR']['ACCESS_DENIED'] . __LINE__);
	}

	// менять статус только назначенный дизайнер
	if ($_POST['status'] > $PROG_DATA['STATUS_ID_DESIGN']['RECEIVED'] &&
		$_POST['status'] < $PROG_DATA['STATUS_ID_DESIGN']['CANCEL'] &&
		$orderData['designer_id'] != $_SESSION['user']['id']) {

		redirectToIf(false, '',
			$PROG_CONFIG['HOST'] . '/design.php?action=order_info_card&id=' .
			$_POST['order_id'] . '&error_massage=' . $PROG_DATA['ERROR']['ACCESS_DENIED'] . __LINE__);
	}

	mysqli_query($con, 'START TRANSACTION');

	$sortPriority = true;

	if ($_POST['status'] >= $PROG_DATA['STATUS_ID_DESIGN']['DONE'])
		$sortPriority = dbExecQuery($con,
			'UPDATE design_orders SET order_priority = ?, sort_priority = 1, error_priority = 1 WHERE id = ?',
			[$PROG_DATA['PRIORITY_ID']['NORM'], $_POST['order_id']]);

	$orderStatus = changeOrderStatusAndSetDatetime($con, 'design_orders', 'current_status',
		'datetime_status_', $_POST['status'], $_POST['order_id']);

	if ($sortPriority && $orderStatus)
		mysqli_query($con, 'COMMIT');
	else
		mysqli_query($con, 'ROLLBACK');

	redirectToIf($sortPriority && $orderStatus,
		$PROG_CONFIG['HOST'] . '/design.php?action=order_info_card&id=' .
		$_POST['order_id'] . '&alert_massage=' . $PROG_DATA['ALERT']['OK'],
		$PROG_CONFIG['HOST'] . '/design.php?action=order_info_card&id=' .
		$_POST['order_id'] . '&error_massage=' . $PROG_DATA['ERROR']['BD_WRITE']);
}


echo renderTemplate($_SERVER['DOCUMENT_ROOT'] . '/src/templates/layout.php', $tmpLayoutData);
