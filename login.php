<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/src/include.php');

require_once($_SERVER['DOCUMENT_ROOT'] . '/src/header_session_start.php');

require_once($_SERVER['DOCUMENT_ROOT'] . '/src/header_tmp_data.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/src/header_alert_massage.php');

date_default_timezone_set($PROG_CONFIG['TIMEZONE']);

///////////////////////////////////////////////////////////////////////////////////////////////

require_once($_SERVER['DOCUMENT_ROOT'] . '/src/data/navigation_list_admin.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/src/data/navigation_list_user.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/src/data/user_admin_data.php');

$tmpLayoutData['title'] = 'Войти';

if (isset($_POST['action']) && $_POST['action'] === 'login') {

	if (isValidLoginPassword($PROG_CONFIG) === false)
		redirectToIf(false, '', $PROG_CONFIG['HOST'] . '/login.php?error_massage=ошибка входных данных');

	if ($_POST['login'] === $USER_ADMIN_DATA['login'] && password_verify($_POST['password'], $USER_ADMIN_DATA['password'])) {
		$_SESSION['user'] = $USER_ADMIN_DATA;
		$_SESSION['navList'] = $navigationListAdmin;
		$_SESSION['formId'] = 'none';

		redirectToIf(true,
			$PROG_CONFIG['HOST'] . '/adm_users.php?action=info&alert_massage=Привет ' . $_SESSION['user']['first_name'],
			'');
	}

	$userDataQuery = 'SELECT * FROM adm_users WHERE BINARY login = ?';
	$userData = dbSelectData($con, $userDataQuery, [$_POST['login']])[0] ?? false;

	if ($userData && $userData['is_deleted'] === 1) {
		redirectToIf(false, '', $PROG_CONFIG['HOST'] . '/login.php?error_massage=пользователь удален');
	}
	if ($userData && $userData['is_block'] === 1) {
		redirectToIf(false, '', $PROG_CONFIG['HOST'] . '/login.php?error_massage=пользователь заблокирован');
	}

	if ($userData && password_verify($_POST['password'], $userData['password'])) {

		setUserNeedLogoutVal($con, 'adm_users', $userData['id'], 0);
		$_SESSION['user'] = $userData;
		$_SESSION['navList'] = setNavListUser($navigationListUser, $_SESSION['user'], $PROG_DATA);
		$_SESSION['formId'] = 'none';

		addUserLog($con, 'users_logs', $_SESSION['user']['id'], 'login');

		redirectToIf(true,
			$PROG_CONFIG['HOST'] . '/index.php?alert_massage=Привет ' . $_SESSION['user']['first_name'],
			'');
	} else {
		redirectToIf(false, '', $PROG_CONFIG['HOST'] . '/login.php?error_massage=неверные имя пользователя или пароль');
	}
}

echo renderTemplate($_SERVER['DOCUMENT_ROOT'] . '/src/templates/login.php', $tmpLayoutData);
