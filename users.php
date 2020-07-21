<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/src/include.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/data/navigation_list_admin.php');

$tmp_layout_data = [
	'prog_config' => $prog_config,
	'title' => 'Пользователи',
	'nav_list' => $navigation_list_admin,
	'content' => '',
	'pagination' => '',
	'alert_massage' => false,
	'error_massage' => false
];

if ($_GET['alert_massage'])
{
	$tmp_layout_data['alert_massage'] = $_GET['alert_massage'];
}
else if ($_GET['error_massage'])
{
	$tmp_layout_data['error_massage'] = $_GET['error_massage'];
}


if ($_GET['action'] && $_GET['action'] === 'add_user')
{
	$tmp_layout_data['content'] =
		render_template($_SERVER['DOCUMENT_ROOT'] . '/templates/users/user_new.php', []);
}
if ($_GET['action'] && $_GET['action'] === 'show_list')
{
	$tmp_layout_data['content'] =
		render_template($_SERVER['DOCUMENT_ROOT'] . '/templates/users/users_list.php', []);
}

if ($_POST['action'] && $_POST['action'] == 'add_user')
{
	$new_user_data = [
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

	var_dump(db_insert_data($con, 'users', $new_user_data));



}

echo render_template($_SERVER['DOCUMENT_ROOT'] . '/templates/layout.php', $tmp_layout_data);

