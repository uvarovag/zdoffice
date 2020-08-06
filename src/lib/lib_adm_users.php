<?php

function createNewAdmUser($con, $tableName) {

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

	return dbInsertData($con, $tableName, $newUserData);
}


function editAdmUserData($con, $tableName) {

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

	$editUserQuery = 'UPDATE ' . $tableName . ' SET 
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

	return dbExecQuery($con, $editUserQuery, $editUserData);
}
