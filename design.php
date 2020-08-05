<?php


require_once($_SERVER['DOCUMENT_ROOT'] . '/src/include.php');

require_once($_SERVER['DOCUMENT_ROOT'] . '/src/header_session_start.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/src/data/navigation_list_admin.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/src/data/navigation_list_user.php');

require_once($_SERVER['DOCUMENT_ROOT'] . '/src/header_tmp_data.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/src/header_alert_massage.php');

///////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////

$tmpLayoutData['navList'] = $navigationListUser;

if (isset($_GET['action']) && $_GET['action'] == 'new_order') {

	$tmpLayoutData['navList']['designNewOrder']['isActive'] = true;
	$tmpLayoutData['title'] = 'Новая заявка на дизайн';

	$tmpLayoutData['content'] = renderTemplate($_SERVER['DOCUMENT_ROOT'] . '/src/templates/design/new_order.php', $tmpLayoutContentData);

}

if (isset($_GET['action']) && isset($_GET['id']) && $_GET['action'] == 'order_info_card') {
	$tmpLayoutData['title'] = 'Заявка на дизайн';

	$tmpLayoutContentData['order'] =
		dbSelectData($con, 'SELECT * FROM design_orders WHERE id = ?', [$_GET['id']])[0] ?? [];

	if (empty($tmpLayoutContentData['order'])) {
		header('Location:' . $PROG_CONFIG['HOST'] . '/design.php?action=orders_list&error_massage=ORDER ID ERROR');
		exit();
	}

	$tmpLayoutContentData['usersPositionDesigner'] =
		dbSelectData($con, 'SELECT id, last_name, first_name FROM adm_users WHERE position = ? AND is_block = 0 AND is_deleted = 0', [$DESIGNER_POSITION_ID]);

	$tmpLayoutContentData['designerData'] = dbSelectData($con,
			'SELECT last_name, first_name FROM adm_users WHERE id = ?',
			[(int)$tmpLayoutContentData['order']['designer_id']])[0] ?? false;
	
	$tmpLayoutData['content'] =
		renderTemplate($_SERVER['DOCUMENT_ROOT'] . '/src/templates/design/order_info_card.php',
			$tmpLayoutContentData);
}

if (isset($_GET['action']) && $_GET['action'] == 'orders_list') {
	$tmpLayoutData['navList']['designOrdersList']['isActive'] = true;
	$tmpLayoutData['title'] = 'Заявки на дизайн';

	$sqlQuerySelect = 'SELECT u.last_name, u.first_name, 
       d.id AS order_id, d.order_name_in, d.order_name_out, d.client_name, 
       d.current_status, d.order_priority 
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
		dbSelectData($con, $sqlQuerySelect . $sqlQueryJoin1 . $sqlQueryWhere . $sqlSortBy . $sqlPagination, $sqlParameters);

	$tmpLayoutData['content'] =
		renderTemplate($_SERVER['DOCUMENT_ROOT'] . '/src/templates/design/orders_list.php', $tmpLayoutContentData);

}

if (isset($_GET['action']) && $_GET['action'] == 'change_designer') {

	$updateDesignerIdQuery = 'UPDATE design_orders SET designer_id = ?, current_status = ?, datetime_status_100 = ? WHERE id = ?';
	$updateDesignerIdData = [$_GET['designer_id'], 100,  date('Y-m-d H:i:s'), $_GET['order_id']];
	$updateDesignerId = dbExecQuery($con, $updateDesignerIdQuery, $updateDesignerIdData);

	if (empty($tmpLayoutContentData['order'])) {
		header('Location:' . $PROG_CONFIG['HOST'] . '/design.php?action=order_info_card&id='. $_GET['order_id'] . '&alert_massage=сохранено');
		exit();
	}

}

if (isset($_GET['action']) && $_GET['action'] == 'change_priority') {

	$updateDesignerIdQuery = 'UPDATE design_orders SET order_priority = ? WHERE id = ?';
	$updateDesignerIdData = [$_GET['priority'], $_GET['order_id']];
	$updateDesignerId = dbExecQuery($con, $updateDesignerIdQuery, $updateDesignerIdData);

	if (empty($tmpLayoutContentData['order'])) {
		header('Location:' . $PROG_CONFIG['HOST'] . '/design.php?action=order_info_card&id='. $_GET['order_id'] . '&alert_massage=сохранено');
		exit();
	}

}


if (isset($_POST['action']) && $_POST['action'] == 'new_order') {


	$newOrderData = [
		'order_name_out' => correctFormatUpper($_POST['order_name_out']),
		'order_priority' => 1,
		'client_name' => correctFormatUpper($_POST['client_name']),
		'mobile_phone' => correctFormat($_POST['mobile_phone']),
		'email' => correctFormatLower($_POST['email']),
		'task_text' => correctFormat($_POST['task_text']),
		'design_format' => $_POST['design_format'],
		'deadline_date' => date('Y-m-d H:i:s', strtotime($_POST['deadline_date'])),
		'current_status' => 0,
		'datetime_status_000' => date('Y-m-d H:i:s')
	];


	mysqli_query($con, 'START TRANSACTION');

	$newOrder = dbInsertData($con, 'design_orders', $newOrderData);

	$updateOrderNameIn = dbExecQuery($con, "UPDATE design_orders SET order_name_in = ? WHERE id = ?",
		[getOrderName($newOrder), $newOrder]);

	mysqli_query($con, 'COMMIT');

}


echo renderTemplate($_SERVER['DOCUMENT_ROOT'] . '/src/templates/layout.php', $tmpLayoutData);
