<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/src/include.php');

require_once($_SERVER['DOCUMENT_ROOT'] . '/src/data/navigation_list_admin.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/src/data/navigation_list_user.php');

require_once($_SERVER['DOCUMENT_ROOT'] . '/src/header_session_start.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/src/header_tmp_data.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/src/header_alert_massage.php');


///////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////


require_once($_SERVER['DOCUMENT_ROOT'] . '/src/data/user_admin_data.php');

$tmpLayoutData['title'] = 'Войти';

if (isset($_POST['action']) && $_POST['action'] == 'login') {
	// todo validation

	if ($_POST['login'] === $USER_ADMIN_DATA['login'] && $_POST['password'] === $USER_ADMIN_DATA['password']) {
		$_SESSION['user'] = $USER_ADMIN_DATA;
		$_SESSION['navList'] = $navigationListAdmin;

		redirectToIf(true,
			$PROG_CONFIG['HOST'] . '/adm_users.php?action=users_list&alert_massage=Привет ' . $_SESSION['user']['first_name'],
			'');
	}
	$userDataQuery = 'SELECT * FROM adm_users WHERE BINARY login = ? AND BINARY password = ?';
	$userData = dbSelectData($con, $userDataQuery, [$_POST['login'], $_POST['password']])[0] ?? false;

	if ($userData && $userData['is_deleted'] === 1) {
		redirectToIf(false, '', $PROG_CONFIG['HOST'] . '/login.php?error_massage=пользователь удален');
	}
	if ($userData && $userData['is_block'] === 1) {
		redirectToIf(false, '', $PROG_CONFIG['HOST'] . '/login.php?error_massage=пользователь заблокирован');
	}

	if ($userData) {
		$_SESSION['user'] = $userData;
		$_SESSION['navList'] = setNavListUser($navigationListUser, $_SESSION['user']);

		addUserLog($con, 'users_logs', $_SESSION['user']['id'], 'login');

		redirectToIf(true,
			$PROG_CONFIG['HOST'] . '/design.php?action=orders_list&alert_massage=Привет ' . $_SESSION['user']['first_name'],
			'');
	}
	else {
		redirectToIf(false, '', $PROG_CONFIG['HOST'] . '/login.php?error_massage=неверный имя пользователя или пароль');
	}
}

echo renderTemplate($_SERVER['DOCUMENT_ROOT'] . '/src/templates/login.php', $tmpLayoutData);