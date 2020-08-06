<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/src/include.php');

require_once($_SERVER['DOCUMENT_ROOT'] . '/src/header_session_start.php');


require_once($_SERVER['DOCUMENT_ROOT'] . '/src/header_tmp_data.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/src/header_alert_massage.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/src/header_authorization_admin.php');

///////////////////////////////////////////////////////////////////////////////////////////////

if (isset($_GET['action']) && $_GET['action'] === 'new_user_card') {

	$_SESSION['formId'] = md5(time());
	$tmpLayoutContentData['formId'] = $_SESSION['formId'];

	$_SESSION['navList'] = setActiveNavTab($_SESSION['navList'], 'newUserCard');
	$tmpLayoutData['title'] = 'Добавить пользователя';

	$tmpLayoutData['content'] =
		renderTemplate($_SERVER['DOCUMENT_ROOT'] . '/src/templates/adm_users/new_user_card.php', $tmpLayoutContentData);
}

///////////////////////////////////////////////////////////////////////////////////////////////

if (isset($_GET['action']) && isset($_GET['id']) && $_GET['action'] === 'edit_user_card') {

	$_SESSION['formId'] = md5(time());
	$tmpLayoutContentData['formId'] = $_SESSION['formId'];

	$tmpLayoutData['title'] = 'Редактировать данные пользователя';

	$tmpLayoutContentData['user'] =
		dbSelectData($con, 'SELECT * FROM adm_users WHERE id = ?', [$_GET['id']])[0] ?? false;

	if ($tmpLayoutContentData['user'] === false) {
		redirectToIf(false, '',
			$PROG_CONFIG['HOST'] . '/adm_users.php?action=users_list&error_massage=USER ID ERROR');
	}

	$tmpLayoutData['content'] =
		renderTemplate($_SERVER['DOCUMENT_ROOT'] . '/src/templates/adm_users/edit_user_card.php', $tmpLayoutContentData);
}

///////////////////////////////////////////////////////////////////////////////////////////////

if (isset($_GET['action']) && isset($_GET['id']) && $_GET['action'] === 'user_info_card') {

	$tmpLayoutData['title'] = 'Карта пользователя';

	$tmpLayoutContentData['user'] =
		dbSelectData($con, 'SELECT * FROM adm_users WHERE id = ?', [$_GET['id']])[0] ?? false;

	$tmpLayoutContentData['userLogs'] =
		dbSelectData($con, 'SELECT * FROM users_logs WHERE user_id = ? ORDER BY id DESC LIMIT ' .
			$PROG_CONFIG['MAX_ADM_USERS_LOGS'], [$_GET['id']]) ?? [];


	if ($tmpLayoutContentData['user'] === false) {
		redirectToIf(false, '',
			$PROG_CONFIG['HOST'] . '/adm_users.php?action=users_list&error_massage=USER ID ERROR');
	}

	$tmpLayoutData['content'] =
		renderTemplate($_SERVER['DOCUMENT_ROOT'] . '/src/templates/adm_users/user_info_card.php', $tmpLayoutContentData);
}

///////////////////////////////////////////////////////////////////////////////////////////////

if (isset($_GET['action']) && $_GET['action'] === 'users_list') {

	$_SESSION['navList'] = setActiveNavTab($_SESSION['navList'], 'usersList');
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

if (isset($_POST['action']) && $_POST['action'] === 'new_user_data') {

	errorIfDoubleClick($_SESSION['formId'], $_POST['form_id'],
		$PROG_CONFIG['HOST'] . '/adm_users.php?action=new_user_card');

	if (isValidNewUserData($PROG_CONFIG, $progData) === false || isValidNewUserPassword($PROG_CONFIG) === false) {
		redirectToIf(false, '',
			$PROG_CONFIG['HOST'] . '/adm_users.php?action=new_user_card&error_massage=ошибка входных данных');
	}

	if (dbSelectData($con, 'SELECT COUNT(*) as count FROM adm_users WHERE login = ?', [$_POST['login']])[0]['count'] > 0) {
		redirectToIf(false, '',
			$PROG_CONFIG['HOST'] .
			'/adm_users.php?action=new_user_card&error_massage=пользователь с таким логином уже существует');
	}

	if (dbSelectData($con, 'SELECT COUNT(*) as count FROM adm_users WHERE last_name = ? AND first_name = ?',
		[correctFormatUpper($_POST['last_name']), correctFormatUpper($_POST['first_name'])])[0]['count']) {
		header('Location:' . $PROG_CONFIG['HOST'] .
			'/adm_users.php?action=new_user_card&error_massage=пользователь с таким имнем и фамилией уже существует');
		exit();
	}

	$newUserId = createNewAdmUser($con, 'adm_users');

	redirectToIf($newUserId,
		$PROG_CONFIG['HOST'] . '/adm_users.php?action=user_info_card' . '&id=' . $newUserId . '&alert_massage=сохранено',
		$PROG_CONFIG['HOST'] . '/adm_users.php?action=new_user_card&error_massage=ошибка записи');
}

///////////////////////////////////////////////////////////////////////////////////////////////

if (isset($_POST['action']) && isset($_POST['id']) && $_POST['action'] == 'edit_user_data') {

	errorIfDoubleClick($_SESSION['formId'], $_POST['form_id'],
		$PROG_CONFIG['HOST'] . '/adm_users.php?action=edit_user_card&id=' . $_POST['id']);

	if (isValidNewUserData($PROG_CONFIG, $progData) === false) {
		redirectToIf(false, '',
			$PROG_CONFIG['HOST'] . '/adm_users.php?action=edit_user_card&id=' .
			$_POST['id'] . '&error_massage=ошибка входных данных');
	}

	$usersCount = dbSelectData($con, 'SELECT COUNT(*) as count FROM adm_users WHERE login = ? AND id != ?',
		[$_POST['login'], $_POST['id']])[0]['count'];

	if ($usersCount > 0) {
		redirectToIf(false, '',
			$PROG_CONFIG['HOST'] . '/adm_users.php?action=edit_user_card&id=' .
			$_POST['id'] . '&error_massage=пользователь с таким логином уже существует');
	}

	$usersCount = dbSelectData($con, 'SELECT COUNT(*) as count FROM adm_users WHERE last_name = ? AND first_name = ? AND id != ?',
		[correctFormatUpper($_POST['last_name']), correctFormatUpper($_POST['first_name']), $_POST['id']])[0]['count'];

	if ($usersCount > 0) {
		redirectToIf(false, '',
			$PROG_CONFIG['HOST'] . '/adm_users.php?action=edit_user_card&id=' .
			$_POST['id'] . '&error_massage=пользователь с таким имнем и фамилией уже существует');
	}

	$editUser = editAdmUserData($con, 'adm_users');

	redirectToIf($editUser,
		$PROG_CONFIG['HOST'] . '/adm_users.php?action=user_info_card&id=' . $_POST['id'] . '&alert_massage=сохранено',
		$PROG_CONFIG['HOST'] . '/adm_users.php?action=edit_user_card&id=' . $_POST['id'] . '&error_massage=ошибка записи');
}

///////////////////////////////////////////////////////////////////////////////////////////////

if (isset($_GET['action']) && isset($_GET['id']) && $_GET['action'] == 'block_user_data') {
	setUserIsBlockVal($con, $PROG_CONFIG, $_GET['id'], 1);
}

///////////////////////////////////////////////////////////////////////////////////////////////

if (isset($_GET['action']) && $_GET['action'] == 'unlock_user_data') {
	setUserIsBlockVal($con, $PROG_CONFIG, $_GET['id'], 0);
}

echo renderTemplate($_SERVER['DOCUMENT_ROOT'] . '/src/templates/layout.php', $tmpLayoutData);
