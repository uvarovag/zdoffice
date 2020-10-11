<?php

function createNewAdmUser($con, $departmentsList, $designTypes, $tableName) {

	$newUserData = [
		'is_deleted' => 0,
		'is_block' => 0,
		'need_logout' => 0,
		'login' => correctFormat($_POST['login']),
		'password' => password_hash($_POST['password'], PASSWORD_BCRYPT),
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

	foreach ($designTypes as $dKey => $dVal) {
		$newUserData['auth_design_order_change_status_' . $dKey] =
			(isset($_POST['design_order_change_status_' . $dKey]) &&
				$_POST['design_order_change_status_' . $dKey] == 'on') ? 1 : 0;
	}

	foreach ($departmentsList as $depKey => $depVal) {
		$newUserData['auth_production_order_change_status_' . $depKey] =
			(isset($_POST['production_order_change_status_' . $depKey]) &&
				$_POST['production_order_change_status_' . $depKey] == 'on') ? 1 : 0;
	}

	return dbInsertData($con, $tableName, $newUserData);
}


function editAdmUserData($con, $departmentsList, $designTypes, $tableName) {

	$editUserData = [
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

	$editUserQuery = 'UPDATE ' . $tableName . ' SET 
		last_name = ?, 
		first_name = ?, 
		position = ?, 
		mobile_phone = ?, 
		email = ?, 
		last_modify_datetime = ?, 
		auth_design_order_new = ?, 
		auth_design_order_view = ?, 
		auth_design_order_select_designer = ?, 
		auth_design_order_change_priority = ?, 
		
		auth_production_order_new = ?, 
		auth_production_order_view = ?, 
		auth_production_order_change_priority = ?, 
		auth_production_order_start = ?, 
		auth_production_order_cancel = ?, ';

	foreach ($designTypes as $dKey => $dVal) {

		$editUserData['auth_design_order_change_status_' . $dKey] =
			(isset($_POST['design_order_change_status_' . $dKey]) &&
				$_POST['design_order_change_status_' . $dKey] == 'on') ? 1 : 0;

		$editUserQuery = $editUserQuery . "auth_design_order_change_status_{$dKey} = ?, ";
	}


	foreach ($departmentsList as $depKey => $depVal) {

		$editUserData['auth_production_order_change_status_' . $depKey] =
			(isset($_POST['production_order_change_status_' . $depKey]) &&
				$_POST['production_order_change_status_' . $depKey] == 'on') ? 1 : 0;

		$editUserQuery = $editUserQuery . "auth_production_order_change_status_{$depKey} = ?, ";
	}

	$editUserData['id'] = $_POST['id'];

	$editUserQuery = substr($editUserQuery, 0, -2);
	$editUserQuery = $editUserQuery . ' WHERE id = ?';

	return dbExecQuery($con, $editUserQuery, $editUserData);
}

function setUserIsBlockVal($con, $tableName, $userId, $isBlockVal) {

	$editUserData = [
		'is_block' => $isBlockVal,
		'id' => $userId
	];

	return dbExecQuery($con, 'UPDATE ' . $tableName . ' SET is_block = ? WHERE id = ?', $editUserData);
}

function setUserNeedLogoutVal($con, $tableName, $userId, $needLogoutVal) {

	$editUserData = [
		'need_logout' => $needLogoutVal,
		'id' => $userId
	];

	return dbExecQuery($con, 'UPDATE ' . $tableName . ' SET need_logout = ? WHERE id = ?', $editUserData);
}

function getUserNeedLogoutVal($con, $tableName, $userId) {
	return dbSelectData($con, 'SELECT need_logout FROM ' . $tableName . ' WHERE id = ?', [$userId])[0]['need_logout'] ?? 1;
}
