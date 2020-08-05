<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/src/include.php');



require_once($_SERVER['DOCUMENT_ROOT'] . '/src/header_session_start.php');

require_once($_SERVER['DOCUMENT_ROOT'] . '/src/data/navigation_list_admin.php');

require_once($_SERVER['DOCUMENT_ROOT'] . '/src/header_tmp_data.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/src/header_alert_massage.php');

///////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////

if (isset($_GET['action']) && $_GET['action'] === 'new_user_card') {
	$_SESSION['formId'] = md5(time());
	$tmpLayoutContentData['formId'] = $_SESSION['formId'];

	$tmpLayoutData['navList']['newUserCard']['isActive'] = true;
	$tmpLayoutData['title'] = 'Добавить пользователя';

	$tmpLayoutData['content'] =
		renderTemplate($_SERVER['DOCUMENT_ROOT'] . '/src/templates/adm_users/new_user_card.php', $tmpLayoutContentData);
}

///////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////

if (isset($_GET['action']) && isset($_GET['id']) && $_GET['action'] === 'edit_user_card') {
	$_SESSION['formId'] = md5(time());
	$tmpLayoutContentData['formId'] = $_SESSION['formId'];

	$tmpLayoutData['title'] = 'Редактировать данные пользователя';

	$tmpLayoutContentData['user'] =
		dbSelectData($con, 'SELECT * FROM adm_users WHERE id = ?', [$_GET['id']])[0] ?? [];

	if (empty($tmpLayoutContentData['user'])) {
		header('Location:' . $PROG_CONFIG['HOST'] . '/adm_users.php?action=users_list&error_massage=USER ID ERROR');
		exit();
	}

	$tmpLayoutData['content'] =
		renderTemplate($_SERVER['DOCUMENT_ROOT'] . '/src/templates/adm_users/edit_user_card.php', $tmpLayoutContentData);
}

///////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////

if (isset($_GET['action']) && isset($_GET['id']) && $_GET['action'] === 'user_info_card') {
	$tmpLayoutData['title'] = 'Карта пользователя';

	$tmpLayoutContentData['user'] =
		dbSelectData($con, 'SELECT * FROM adm_users WHERE id = ?', [$_GET['id']])[0] ?? [];

	if (empty($tmpLayoutContentData['user'])) {
		header('Location:' . $PROG_CONFIG['HOST'] . '/adm_users.php?action=users_list&error_massage=USER ID ERROR');
		exit();
	}

	$tmpLayoutData['content'] =
		renderTemplate($_SERVER['DOCUMENT_ROOT'] . '/src/templates/adm_users/user_info_card.php', $tmpLayoutContentData);
}

///////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////

if (isset($_GET['action']) && $_GET['action'] === 'users_list') {
	$tmpLayoutData['navList']['usersList']['isActive'] = true;
	$tmpLayoutData['title'] = 'Пользователи';

	$sqlQuerySelect = 'SELECT * FROM adm_users ';
	$sqlQueryWhere = '';
	$sqlParameters = [];
	$sqlSortBy = 'ORDER by id DESC ';

	$paginationData =
		getPagination($PROG_CONFIG, $PROG_CONFIG['HOST'] . '/adm_users.php', $con, 'SELECT COUNT(*) as pgn FROM adm_users ' .
			$sqlQueryWhere, $sqlParameters);

	$tmpLayoutData['pagination'] = $paginationData['tmpPagination'];
	$sqlPagination = $paginationData['sqlPagination'];

	$tmpLayoutContentData['adm_users'] =
		dbSelectData($con, $sqlQuerySelect . $sqlQueryWhere . $sqlSortBy . $sqlPagination, $sqlParameters);

	$tmpLayoutData['content'] =
		renderTemplate($_SERVER['DOCUMENT_ROOT'] . '/src/templates/adm_users/users_list.php', $tmpLayoutContentData);
}

///////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////

if (isset($_POST['action']) && $_POST['action'] == 'new_user_data') {
	errorIfDoubleClick($_SESSION['formId'], $_POST['form_id'],
		$PROG_CONFIG['HOST'] . '/adm_users.php?action=new_user_card');

	if (isValidNewUserData($PROG_CONFIG, $progData) === false || isValidNewUserPassword($PROG_CONFIG) === false) {
		header('Location:' . $PROG_CONFIG['HOST'] . '/adm_users.php?action=new_user_card&error_massage=ошибка входных данных');
		exit();
	}

	if (dbSelectData($con, 'SELECT COUNT(*) as count FROM adm_users WHERE login = ?', [$_POST['login']])[0]['count'] > 0) {
		header('Location:' . $PROG_CONFIG['HOST'] .
			'/adm_users.php?action=new_user_card&error_massage=пользователь с таким логином уже существует');
		exit();
	}

	if (dbSelectData($con, 'SELECT COUNT(*) as count FROM adm_users WHERE last_name = ? AND first_name = ?',
		[correctFormatUpper($_POST['last_name']), correctFormatUpper($_POST['first_name'])])[0]['count']) {
		header('Location:' . $PROG_CONFIG['HOST'] .
			'/adm_users.php?action=new_user_card&error_massage=пользователь с таким имнем и фамилией уже существует');
		exit();
	}

	$newUserData = [
		'login' => correctFormat($_POST['login']),
		'is_deleted' => 0,
		'is_block' => 0,
		'need_logout' => 0,
		'password' => correctFormat($_POST['password']),
		'last_name' => correctFormatUpper($_POST['last_name']),
		'first_name' => correctFormatUpper($_POST['first_name']),
		'position' => (int)$_POST['position'],
		'mobile_phone' => $_POST['mobile_phone'],
		'email' => correctFormatLower($_POST['email']),
		'reg_datetime' => date('Y-m-d H:i:s'),
		'last_modify_datetime' => date('Y-m-d H:i:s'),

		'auth_design_order_new' =>
			(isset($_POST['design_order_new']) && $_POST['design_order_new'] == 'on') ? 1 : 0,
		'auth_design_order_view' =>
			(isset($_POST['design_order_view']) && $_POST['design_order_view'] == 'on') ? 1 : 0,
		'auth_design_order_change_status' =>
			(isset($_POST['design_order_change_status']) && $_POST['design_order_change_status'] == 'on') ? 1 : 0,
		'auth_design_order_select_designer' =>
			(isset($_POST['design_order_select_designer']) && $_POST['design_order_select_designer'] == 'on') ? 1 : 0,
		'auth_design_order_change_priority' =>
			(isset($_POST['design_order_change_priority']) && $_POST['design_order_change_priority'] == 'on') ? 1 : 0,

		'auth_production_order_new' =>
			(isset($_POST['production_order_new']) &&
				$_POST['production_order_new'] == 'on') ? 1 : 0,
		'auth_production_order_view' =>
			(isset($_POST['production_order_view']) &&
				$_POST['production_order_view'] == 'on') ? 1 : 0,
		'auth_production_order_change_status_const' =>
			(isset($_POST['production_order_change_status_const']) &&
				$_POST['production_order_change_status_const'] == 'on') ? 1 : 0,
		'auth_production_order_change_status_adv' =>
			(isset($_POST['production_order_change_status_adv']) &&
				$_POST['production_order_change_status_adv'] == 'on') ? 1 : 0,
		'auth_production_order_change_status_furn' =>
			(isset($_POST['production_order_change_status_furn']) &&
				$_POST['production_order_change_status_furn'] == 'on') ? 1 : 0,
		'auth_production_order_change_status_steel' =>
			(isset($_POST['production_order_change_status_steel']) &&
				$_POST['production_order_change_status_steel'] == 'on') ? 1 : 0,
		'auth_production_order_change_status_install' =>
			(isset($_POST['production_order_change_status_install']) &&
				$_POST['production_order_change_status_install'] == 'on') ? 1 : 0,
		'auth_production_order_change_status_supply' =>
			(isset($_POST['production_order_change_status_supply']) &&
				$_POST['production_order_change_status_supply'] == 'on') ? 1 : 0,
		'auth_production_order_change_priority' =>
			(isset($_POST['production_order_change_priority']) &&
				$_POST['production_order_change_priority'] == 'on') ? 1 : 0,
		'auth_production_order_start' =>
			(isset($_POST['production_order_start']) &&
				$_POST['production_order_start'] == 'on') ? 1 : 0,
		'auth_production_order_cancel' =>
			(isset($_POST['production_order_cancel']) &&
				$_POST['production_order_cancel'] == 'on') ? 1 : 0
	];

	$newUser = dbInsertData($con, 'adm_users', $newUserData);

	if ($newUser) {
		header('Location:' . $PROG_CONFIG['HOST'] . '/adm_users.php?action=user_info_card' . '&id=' .
			$newUser . '&alert_massage=сохранено');
		exit();
	} else {
		header('Location:' . $PROG_CONFIG['HOST'] . '/adm_users.php?action=new_user_card&error_massage=ошибка');
		exit();
	}
}

///////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////

if (isset($_POST['action']) && isset($_POST['id']) && $_POST['action'] == 'edit_user_data') {
	errorIfDoubleClick($_SESSION['formId'], $_POST['form_id'],
		$PROG_CONFIG['HOST'] . '/adm_users.php?action=edit_user_card&id=' . $_POST['id']);

	if (isValidNewUserData($PROG_CONFIG, $progData) === false) {
		header('Location:' . $PROG_CONFIG['HOST'] . '/adm_users.php?action=edit_user_card&id=' .
			$_POST['id'] . '&error_massage=ошибка входных данных');
		exit();
	}

	if (dbSelectData($con, 'SELECT COUNT(*) as count FROM adm_users WHERE login = ? AND id != ?', [$_POST['login'], $_POST['id']])[0]['count'] > 0) {
		header('Location:' . $PROG_CONFIG['HOST'] . '/adm_users.php?action=edit_user_card&id=' .
			$_POST['id'] . '&error_massage=пользователь с таким логином уже существует');
		exit();
	}

	if (dbSelectData($con, 'SELECT COUNT(*) as count FROM adm_users WHERE last_name = ? AND first_name = ? AND id != ?',
		[correctFormatUpper($_POST['last_name']), correctFormatUpper($_POST['first_name']), $_POST['id']])[0]['count']) {
		header('Location:' . $PROG_CONFIG['HOST'] . '/adm_users.php?action=edit_user_card&id=' .
			$_POST['id'] . '&error_massage=пользователь с таким имнем и фамилией уже существует');
		exit();
	}

	$editUserData = [
		'need_logout' => 1,
		'password' => correctFormat($_POST['password']),
		'last_name' => correctFormatUpper($_POST['last_name']),
		'first_name' => correctFormatUpper($_POST['first_name']),
		'position' => (int)$_POST['position'],
		'mobile_phone' => $_POST['mobile_phone'],
		'email' => correctFormatLower($_POST['email']),
		'last_modify_datetime' => date('Y-m-d H:i:s'),

		'auth_design_order_new' =>
			(isset($_POST['design_order_new']) && $_POST['design_order_new'] == 'on') ? 1 : 0,
		'auth_design_order_view' =>
			(isset($_POST['design_order_view']) && $_POST['design_order_view'] == 'on') ? 1 : 0,
		'auth_design_order_change_status' =>
			(isset($_POST['design_order_change_status']) && $_POST['design_order_change_status'] == 'on') ? 1 : 0,
		'auth_design_order_select_designer' =>
			(isset($_POST['design_order_select_designer']) && $_POST['design_order_select_designer'] == 'on') ? 1 : 0,
		'auth_design_order_change_priority' =>
			(isset($_POST['design_order_change_priority']) && $_POST['design_order_change_priority'] == 'on') ? 1 : 0,

		'auth_production_order_new' =>
			(isset($_POST['production_order_new']) &&
				$_POST['production_order_new'] == 'on') ? 1 : 0,
		'auth_production_order_view' =>
			(isset($_POST['production_order_view']) &&
				$_POST['production_order_view'] == 'on') ? 1 : 0,
		'auth_production_order_change_status_const' =>
			(isset($_POST['production_order_change_status_const']) &&
				$_POST['production_order_change_status_const'] == 'on') ? 1 : 0,
		'auth_production_order_change_status_adv' =>
			(isset($_POST['production_order_change_status_adv']) &&
				$_POST['production_order_change_status_adv'] == 'on') ? 1 : 0,
		'auth_production_order_change_status_furn' =>
			(isset($_POST['production_order_change_status_furn']) &&
				$_POST['production_order_change_status_furn'] == 'on') ? 1 : 0,
		'auth_production_order_change_status_steel' =>
			(isset($_POST['production_order_change_status_steel']) &&
				$_POST['production_order_change_status_steel'] == 'on') ? 1 : 0,
		'auth_production_order_change_status_install' =>
			(isset($_POST['production_order_change_status_install']) &&
				$_POST['production_order_change_status_install'] == 'on') ? 1 : 0,
		'auth_production_order_change_status_supply' =>
			(isset($_POST['production_order_change_status_supply']) &&
				$_POST['production_order_change_status_supply'] == 'on') ? 1 : 0,
		'auth_production_order_change_priority' =>
			(isset($_POST['production_order_change_priority']) &&
				$_POST['production_order_change_priority'] == 'on') ? 1 : 0,
		'auth_production_order_start' =>
			(isset($_POST['production_order_start']) &&
				$_POST['production_order_start'] == 'on') ? 1 : 0,
		'auth_production_order_cancel' =>
			(isset($_POST['production_order_cancel']) &&
				$_POST['production_order_cancel'] == 'on') ? 1 : 0,
		'id' => $_POST['id']
	];

	$editUserQuery = 'UPDATE adm_users SET 
		need_logout = ?, 
		password = ?, 
		last_name = ?, 
		first_name = ?, 
		position = ?, 
		mobile_phone = ?, 
		email = ?, 
		last_modify_datetime = ?, 
		auth_design_order_new = ?, 
		auth_design_order_view = ?, 
		auth_design_order_change_status = ?, 
		auth_design_order_select_designer = ?, 
		auth_design_order_change_priority = ?, 
		auth_production_order_new = ?, 
		auth_production_order_view = ?, 
		auth_production_order_change_status_const = ?, 
		auth_production_order_change_status_adv = ?, 
		auth_production_order_change_status_furn = ?, 
		auth_production_order_change_status_steel = ?, 
		auth_production_order_change_status_install = ?, 
		auth_production_order_change_status_supply = ?, 
		auth_production_order_change_priority = ?, 
		auth_production_order_start = ?, 
		auth_production_order_cancel = ? 
		WHERE id = ?';

	$editUser = dbExecQuery($con, $editUserQuery, $editUserData);

	if ($editUser) {
		header('Location:' . $PROG_CONFIG['HOST'] . '/adm_users.php?action=user_info_card&id=' .
			$editUserData['id'] . '&alert_massage=сохранено');
		exit();
	} else {
		header('Location:' . $PROG_CONFIG['HOST'] . '/adm_users.php?action=edit_user_card&id=' .
			$editUserData['id'] . '&error_massage=ошибка');
		exit();
	}
}

///////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////

if (isset($_GET['action']) && isset($_GET['id']) && $_GET['action'] == 'block_user_data') {
	setUserIsBlockVal($con, $PROG_CONFIG, $_GET['id'], 1);
}

///////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////

if (isset($_GET['action']) && $_GET['action'] == 'unlock_user_data') {
	setUserIsBlockVal($con, $PROG_CONFIG, $_GET['id'], 0);
}

echo renderTemplate($_SERVER['DOCUMENT_ROOT'] . '/src/templates/layout.php', $tmpLayoutData);


