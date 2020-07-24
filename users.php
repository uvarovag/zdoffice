<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/src/include.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/src/session_start.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/data/navigation_list_admin.php');

// preg_match

function errorIfDoubleClick($sesFormId, $postFormId, $url) {
	if ($sesFormId !== $postFormId)
	{
		header('Location:' . $url . '&error_massage=блокировка повторного клика');
		exit();
	}
	return true;
}

$tmpLayoutData = [
	'config' => $progConfig,
	'title' => $progConfig['progName'],
	'navList' => $navigationListAdmin,
	'content' => '',
	'pagination' => '',
	'alertMassage' => false,
	'errorMassage' => false
];

$tmpLayoutContentData = [
	'config' => $progConfig,
	'formId' => 'none'
];

require_once($_SERVER['DOCUMENT_ROOT'] . '/src/alert_massage.php');

///////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////

if (isset($_GET['action']) && $_GET['action'] === 'new_user_card')
{
	$_SESSION['formId'] = md5(time());
	$tmpLayoutContentData['formId'] = $_SESSION['formId'];

	$tmpLayoutData['navList']['newUserCard']['isActive'] = true;
	$tmpLayoutData['title'] = 'Добавить пользователя';

	$tmpLayoutData['content'] =
		renderTemplate($_SERVER['DOCUMENT_ROOT'] . '/templates/users/new_user_card.php', $tmpLayoutContentData);
}

///////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////

if (isset($_GET['action']) && $_GET['action'] === 'edit_user_card')
{
	$_SESSION['formId'] = md5(time());
	$tmpLayoutContentData['formId'] = $_SESSION['formId'];

	$tmpLayoutData['title'] = 'Редактировать данные пользователя';

	$tmpLayoutContentData['user'] =
		dbSelectData($con, 'SELECT * FROM users WHERE id = ?', [$_GET['id']])[0] ?? [];

	$tmpLayoutData['content'] =
		renderTemplate($_SERVER['DOCUMENT_ROOT'] . '/templates/users/edit_user_card.php', $tmpLayoutContentData);
}

///////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////

if (isset($_GET['action']) && $_GET['action'] === 'user_info_card')
{
	$tmpLayoutData['title'] = 'Карта пользователя';

	$tmpLayoutContentData['user'] =
		dbSelectData($con, 'SELECT * FROM users WHERE id = ?', [$_GET['id']])[0] ?? [];

	$tmpLayoutData['content'] =
		renderTemplate($_SERVER['DOCUMENT_ROOT'] . '/templates/users/user_info_card.php', $tmpLayoutContentData);
}

///////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////

if (isset($_GET['action']) && $_GET['action'] === 'users_list')
{
	$tmpLayoutData['navList']['usersList']['isActive'] = true;
	$tmpLayoutData['title'] = 'Пользователи';

	$sqlQuerySelect = 'SELECT * FROM users ';
	$sqlQueryWhere = '';
	$sqlParametrs = [];
	$sqlSortBy = 'ORDER by id DESC ';

	$paginationData =
		getPagination($progConfig, $sysConfig['host'] . '/users.php', $con, 'SELECT COUNT(*) as pgn FROM users ' .
			$sqlQueryWhere, $sqlParametrs);

	$tmpLayoutData['pagination'] = $paginationData['tmpPagination'];
	$sqlPagination = $paginationData['sqlPagination'];

	$tmpLayoutContentData['users'] =
		dbSelectData($con, $sqlQuerySelect . $sqlQueryWhere . $sqlSortBy . $sqlPagination, $sqlParametrs);

	$tmpLayoutData['content'] =
		renderTemplate($_SERVER['DOCUMENT_ROOT'] . '/templates/users/users_list.php', $tmpLayoutContentData);
}

///////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////

if (isset($_POST['action']) && $_POST['action'] == 'new_user_data')
{
	errorIfDoubleClick($_SESSION['formId'], $_POST['form_id'],
		$config['host'] . '/users.php?action=new_user_card');

	$newUserData = [
		'login' => $_POST['login'],
		'is_block' => 0,
		'need_logout' => 0,
		'password' => $_POST['password'],
		'last_name' => $_POST['last_name'],
		'first_name' => $_POST['first_name'],
		'position' => $_POST['position'],
		'mobile_phone' => $_POST['mobile_phone'],
		'email' => $_POST['email'],
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

	$newUser = dbInsertData($con, 'users', $newUserData);

	if ($newUser)
	{
		header('Location:' . $config['host'] . '/users.php?action=user_info_card' . '&id=' .
			$newUser . '&alert_massage=сохранено');
		exit();
	}
	else
	{
		header('Location:' . $config['host'] . '/users.php?action=new_user_card&error_massage=ошибка');
		exit();
	}
}

///////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////

if (isset($_POST['action']) && $_POST['action'] == 'edit_user_data')
{
	errorIfDoubleClick($_SESSION['formId'], $_POST['form_id'],
		$config['host'] . '/users.php?action=edit_user_card&id=' . $_POST['id']);

	$editUserData = [
		'need_logout' => 1,
		'password' => $_POST['password'],
		'last_name' => $_POST['last_name'],
		'first_name' => $_POST['first_name'],
		'position' => $_POST['position'],
		'mobile_phone' => $_POST['mobile_phone'],
		'email' => $_POST['email'],
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

	$editUserQuery = 'UPDATE users SET 
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

	if ($editUser)
	{
		header('Location:' . $config['host'] . '/users.php?action=user_info_card&id=' .
			$editUserData['id'] . '&alert_massage=сохранено');
		exit();
	}
	else
	{
		header('Location:' . $config['host'] . '/users.php?action=edit_user_card&id=' .
			$editUserData['id'] . '&error_massage=ошибка');
		exit();
	}
}

///////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////

if (isset($_GET['action']) && $_GET['action'] == 'block_user_data')
{
	$editUserData = [
		'is_block' => 1,
		'need_logout' => 1,
		'id' => $_GET['id']
	];

	$editUser = dbExecQuery($con, 'UPDATE users SET is_block = ?, need_logout = ? WHERE id = ?', $editUserData);

	if ($editUser)
	{
		header('Location:' . $config['host'] . '/users.php?action=user_info_card&id=' .
			$editUserData['id'] . '&alert_massage=сохранено');
		exit();
	}
	else
	{
		header('Location:' . $config['host'] . '/users.php?action=edit_user_card&id=' .
			$editUserData['id'] . '&error_massage=ошибка');
		exit();
	}
}

///////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////

if (isset($_GET['action']) && $_GET['action'] == 'unlock_user_data')
{
	$editUserData = [
		'is_block' => 0,
		'need_logout' => 1,
		'id' => $_GET['id']
	];

	$editUser = dbExecQuery($con, 'UPDATE users SET is_block = ?, need_logout = ? WHERE id = ?', $editUserData);

	if ($editUser)
	{
		header('Location:' . $config['host'] . '/users.php?action=user_info_card&id=' .
			$editUserData['id'] . '&alert_massage=сохранено');
		exit();
	}
	else
	{
		header('Location:' . $config['host'] . '/users.php?action=edit_user_card&id=' .
			$editUserData['id'] . '&error_massage=ошибка');
		exit();
	}
}

echo renderTemplate($_SERVER['DOCUMENT_ROOT'] . '/templates/layout.php', $tmpLayoutData);
