<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/src/include.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/data/navigation_list_admin.php');

$tmpLayoutData = [
	'progConfig' => $progConfig,
	'title' => 'Пользователи',
	'navList' => $navigationListAdmin,
	'content' => '',
	'pagination' => '',
	'alertMassage' => false,
	'errorMassage' => false
];

if (isset($_GET['alert_massage']))
{
	$tmpLayoutData['alertMassage'] = $_GET['alert_massage'];
}
else if (isset($_GET['error_massage']))
{
	$tmpLayoutData['errorMassage'] = $_GET['error_massage'];
}


if (isset($_GET['action']) && $_GET['action'] === 'add_new_user')
{
	$tmpLayoutData['content'] =
		renderTemplate($_SERVER['DOCUMENT_ROOT'] . '/templates/users/new_user.php', []);
}



if (isset($_GET['action']) && $_GET['action'] === 'show_user_card')
{

	$tmpLayoutContentData = [
		'config' => $progConfig,
		'user' => []
	];

	$tmpLayoutContentData['user'] =
		dbSelectData($con, 'SELECT * FROM users WHERE id = ?', [$_GET['id']])[0] ?? [];

	$tmpLayoutData['content'] =
		renderTemplate($_SERVER['DOCUMENT_ROOT'] . '/templates/users/user_info.php', $tmpLayoutContentData);

}





if (isset($_GET['action']) && $_GET['action'] === 'show_users_list')
{
	$tmpLayoutContentData = [
		'users' => []
	];

	$sqlQuerySelect = 'SELECT * FROM users ';
	$sqlQueryWhere = '';
	$sqlParametrs = [];
	$sqlSortBy = '';


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





if (isset($_POST['action']) && $_POST['action'] == 'add_user')
{
	$newUserData = [
		'login' => $_POST['login'],
		'password' => $_POST['password'],
		'last_name' => $_POST['last_name'],
		'first_name' => $_POST['first_name'],
		'position' => $_POST['position'],
		'mobile_phone' => $_POST['mobile_phone'],
		'email' => $_POST['email'],
		'reg_datetime' => date('Y-m-d H:i:s'),
		'last_modify_datetime' => date('Y-m-d H:i:s'),

		'auth_design_order_new' => 0,
		'auth_design_order_view' => 0,
		'auth_design_order_change_status' => 0,
		'auth_design_order_select_designer' => 0,
		'auth_design_order_change_priority' => 0,

		'auth_production_order_new' => 0,
		'auth_production_order_view' => 0,
		'auth_production_order_change_status_const' => 0,
		'auth_production_order_change_status_adv' => 0,
		'auth_production_order_change_status_furn' => 0,
		'auth_production_order_change_status_steel' => 0,
		'auth_production_order_change_status_install' => 0,
		'auth_production_order_change_status_supply' => 0,
		'auth_production_order_change_priority' => 0,
		'auth_production_order_start' => 0,
		'auth_production_order_cancel' => 0
	];

	var_dump(dbInsertData($con, 'users', $newUserData));



}

echo renderTemplate($_SERVER['DOCUMENT_ROOT'] . '/templates/layout.php', $tmpLayoutData);

