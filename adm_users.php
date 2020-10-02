<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/src/include.php');

require_once($_SERVER['DOCUMENT_ROOT'] . '/src/header_session_start.php');

require_once($_SERVER['DOCUMENT_ROOT'] . '/src/header_tmp_data.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/src/header_alert_massage.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/src/header_authorization_admin.php');

date_default_timezone_set($PROG_CONFIG['TIMEZONE']);
$_SESSION['navList'] = cleanActiveTabs($_SESSION['navList']);

$PASSWORD_EMPTY_VALUE = 'none';

///////////////////////////////////////////////////////////////////////////////////////////////

if (isset($_GET['action']) && $_GET['action'] == 'info') {

	$_SESSION['navList']['info']['isActive'] = true;
	$tmpLayoutData['title'] = 'Информация';

	$tmpLayoutData['content'] =
		renderTemplate($_SERVER['DOCUMENT_ROOT'] . '/src/templates/adm_users/info.php', $tmpLayoutContentData);
}


///////////////////////////////////////////////////////////////////////////////////////////////

if (isset($_GET['action']) && $_GET['action'] === 'new_user_card') {

	$_SESSION['formId'] = md5(time());
	$tmpLayoutContentData['formId'] = $_SESSION['formId'];

	$_SESSION['navList']['newUserCard']['isActive'] = true;
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
		dbSelectData($con, 'SELECT * FROM adm_users WHERE id = ?', [$_GET['id']])[0] ?? [];

	if (empty($tmpLayoutContentData['user'])) {
		redirectToIf(false, '',
			$PROG_CONFIG['HOST'] . '/adm_users.php?action=users_list&error_massage=' . $PROG_DATA['ERROR']['ID'] . ' ' . __LINE__);
	}

	$tmpLayoutContentData['user']['password'] = $PASSWORD_EMPTY_VALUE;

	$tmpLayoutData['content'] =
		renderTemplate($_SERVER['DOCUMENT_ROOT'] . '/src/templates/adm_users/edit_user_card.php', $tmpLayoutContentData);
}


///////////////////////////////////////////////////////////////////////////////////////////////

if (isset($_GET['action']) && isset($_GET['id']) && $_GET['action'] === 'user_info_card') {

	$tmpLayoutData['title'] = 'Карта пользователя';

	$tmpLayoutContentData['user'] =
		dbSelectData($con, 'SELECT *, 
	DATE_FORMAT(reg_datetime, ' . $PROG_CONFIG['DATETIME_FORMAT'] . ') AS reg_datetime, 
	DATE_FORMAT(last_modify_datetime, ' . $PROG_CONFIG['DATETIME_FORMAT'] . ') AS last_modify_datetime 
	FROM adm_users WHERE id = ?', [$_GET['id']])[0] ?? [];

	$tmpLayoutContentData['userLogs'] =
		dbSelectData($con, 'SELECT *, 
	DATE_FORMAT(log_datetime, ' . $PROG_CONFIG['DATETIME_FORMAT'] . ') AS log_datetime  
	FROM users_logs WHERE user_id = ? ORDER BY id DESC LIMIT ' .
			$PROG_CONFIG['MAX_ADM_USERS_LOGS'], [$_GET['id']]) ?? [];

	if (empty($tmpLayoutContentData['user'])) {
		redirectToIf(false, '',
			$PROG_CONFIG['HOST'] . '/adm_users.php?action=users_list&error_massage=' . $PROG_DATA['ERROR']['ID'] . ' ' . __LINE__);
	}

	$tmpLayoutData['content'] =
		renderTemplate($_SERVER['DOCUMENT_ROOT'] . '/src/templates/adm_users/user_info_card.php', $tmpLayoutContentData);
}


///////////////////////////////////////////////////////////////////////////////////////////////

if (isset($_GET['action']) && $_GET['action'] === 'users_list') {

	$_SESSION['navList']['usersList']['isActive'] = true;
	$tmpLayoutData['title'] = 'Пользователи';

	$sqlQuerySelect = 'SELECT *, 
	DATE_FORMAT(reg_datetime, ' . $PROG_CONFIG['DATETIME_FORMAT'] . ') AS reg_datetime, 
	DATE_FORMAT(last_modify_datetime, ' . $PROG_CONFIG['DATETIME_FORMAT'] . ') AS last_modify_datetime 
	FROM adm_users ';
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

if (isset($_POST['action']) && isset($_POST['form_id']) && $_POST['action'] === 'new_user_data') {

	errorIfDoubleClick($_SESSION['formId'], $_POST['form_id'],
		$PROG_CONFIG['HOST'] . '/adm_users.php?action=new_user_card&error_massage=' .
		$PROG_DATA['ERROR']['DOUBLE_CLICK'] . ' ' . __LINE__);

	$_SESSION['formId'] = 'none';

	if (isValidNewUserData($PROG_CONFIG, $PROG_DATA) === false || isValidNewUserPassword($PROG_CONFIG) === false) {
		redirectToIf(false, '',
			$PROG_CONFIG['HOST'] . '/adm_users.php?action=new_user_card&error_massage=' . $PROG_DATA['ERROR']['INPUT_DATA']);
	}

	$user = dbSelectData($con, 'SELECT * FROM adm_users WHERE login = ?', [$_POST['login']])[0] ?? [];

	if (isset($user['id'])) {
		redirectToIf(false, '',
			$PROG_CONFIG['HOST'] . '/adm_users.php?action=new_user_card&error_massage=пользователь с таким логином уже существует');
	}

	$user = dbSelectData($con, 'SELECT * FROM adm_users WHERE last_name = ? AND first_name = ?',
			[correctFormatUpper($_POST['last_name']), correctFormatUpper($_POST['first_name'])])[0] ?? [];

	if (isset($user['id'])) {
		redirectToIf(false, '',
			$PROG_CONFIG['HOST'] . '/adm_users.php?action=new_user_card&error_massage=пользователь с таким имнем и фамилией уже существует');
	}

	$newUserId = createNewAdmUser($con, $PROG_DATA['DEPARTMENTS_LIST'], 'adm_users');

	redirectToIf($newUserId,
		$PROG_CONFIG['HOST'] .
		'/adm_users.php?action=user_info_card' . '&id=' . $newUserId . '&alert_massage=' . $PROG_DATA['ALERT']['OK'],
		$PROG_CONFIG['HOST'] .
		'/adm_users.php?action=new_user_card&error_massage=' . $PROG_DATA['ERROR']['BD_WRITE']);
}


///////////////////////////////////////////////////////////////////////////////////////////////

if (isset($_POST['action']) && isset($_POST['form_id']) && isset($_POST['id']) && $_POST['action'] == 'edit_user_data') {

	errorIfDoubleClick($_SESSION['formId'], $_POST['form_id'],
		$PROG_CONFIG['HOST'] . '/adm_users.php?action=edit_user_card&id=' .
		$_POST['id'] . '&error_massage=' . $PROG_DATA['ERROR']['DOUBLE_CLICK'] . ' ' . __LINE__);

	$_SESSION['formId'] = 'none';

	if (isValidNewUserData($PROG_CONFIG, $PROG_DATA) === false) {
		redirectToIf(false, '',
			$PROG_CONFIG['HOST'] . '/adm_users.php?action=edit_user_card&id=' .
			$_POST['id'] . '&error_massage=' . $PROG_DATA['ERROR']['INPUT_DATA']);
	}

	$user = dbSelectData($con, 'SELECT * FROM adm_users WHERE login = ? AND id != ?', [$_POST['login'], $_POST['id']])[0] ?? [];

	if (isset($user['id'])) {
		redirectToIf(false, '',
			$PROG_CONFIG['HOST'] . '/adm_users.php?action=edit_user_card&id=' .
			$_POST['id'] . '&error_massage=пользователь с таким логином уже существует');
	}

	$user = dbSelectData($con, 'SELECT * FROM adm_users WHERE last_name = ? AND first_name = ? AND id != ?',
			[correctFormatUpper($_POST['last_name']), correctFormatUpper($_POST['first_name']), $_POST['id']])[0] ?? [];

	if (isset($user['id'])) {
		redirectToIf(false, '',
			$PROG_CONFIG['HOST'] . '/adm_users.php?action=edit_user_card&id=' .
			$_POST['id'] . '&error_massage=пользователь с таким имнем и фамилией уже существует');
	}

	mysqli_query($con, 'START TRANSACTION');

	$editUserPassword = true;

	if ($_POST['password'] !== $PASSWORD_EMPTY_VALUE) {

		$editUserPasswordData = [
			'password' => password_hash(correctFormat($_POST['password']), PASSWORD_BCRYPT),
			'id' => $_POST['id']
		];

		$editUserPasswordQuery = 'UPDATE adm_users SET password = ? WHERE id = ?';

		$editUserPassword = dbExecQuery($con, $editUserPasswordQuery, $editUserPasswordData);
	}

	$editUser = editAdmUserData($con, $PROG_DATA['DEPARTMENTS_LIST'], 'adm_users');

	setUserNeedLogoutVal($con, 'adm_users', $_POST['id'], 1);

	if ($editUserPassword && $editUser)
		mysqli_query($con, 'COMMIT');
	else
		mysqli_query($con, 'ROLLBACK');

	redirectToIf($editUserPassword && $editUser,
		$PROG_CONFIG['HOST'] .
		'/adm_users.php?action=user_info_card&id=' . $_POST['id'] . '&alert_massage=' . $PROG_DATA['ALERT']['OK'],
		$PROG_CONFIG['HOST'] .
		'/adm_users.php?action=edit_user_card&id=' . $_POST['id'] . '&error_massage=' . $PROG_DATA['ERROR']['BD_WRITE']);
}


///////////////////////////////////////////////////////////////////////////////////////////////

if (isset($_GET['action']) && isset($_GET['id']) && $_GET['action'] == 'block_user_data') {

	setUserNeedLogoutVal($con, 'adm_users', $_GET['id'], 1);

	$unlockUser = setUserIsBlockVal($con, 'adm_users', $_GET['id'], 1);

	redirectToIf($unlockUser,
		$PROG_CONFIG['HOST'] .
		'/adm_users.php?action=user_info_card&id=' . $_GET['id'] . '&alert_massage=' . $PROG_DATA['ALERT']['OK'],
		$PROG_CONFIG['HOST'] .
		'/adm_users.php?action=edit_user_card&id=' . $_GET['id'] . '&error_massage=' . $PROG_DATA['ERROR']['BD_WRITE']);
}


///////////////////////////////////////////////////////////////////////////////////////////////

if (isset($_GET['action']) && isset($_GET['id']) && $_GET['action'] == 'unlock_user_data') {

	setUserNeedLogoutVal($con, 'adm_users', $_GET['id'], 1);

	$unlockUser = setUserIsBlockVal($con, 'adm_users', $_GET['id'], 0);

	redirectToIf($unlockUser,
		$PROG_CONFIG['HOST'] .
		'/adm_users.php?action=user_info_card&id=' . $_GET['id'] . '&alert_massage=' . $PROG_DATA['ALERT']['OK'],
		$PROG_CONFIG['HOST'] .
		'/adm_users.php?action=edit_user_card&id=' . $_GET['id'] . '&error_massage=' . $PROG_DATA['ERROR']['BD_WRITE']);
}


echo renderTemplate($_SERVER['DOCUMENT_ROOT'] . '/src/templates/layout.php', $tmpLayoutData);
