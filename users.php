<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/src/include.php');

require_once($_SERVER['DOCUMENT_ROOT'] . '/src/header_session_start.php');

require_once($_SERVER['DOCUMENT_ROOT'] . '/src/header_tmp_data.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/src/header_alert_massage.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/src/header_authorization_user.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/src/header_notify.php');

date_default_timezone_set($PROG_CONFIG['TIMEZONE']);
$_SESSION['navList'] = cleanActiveTabs($_SESSION['navList']);

///////////////////////////////////////////////////////////////////////////////////////////////

if (isset($_GET['action']) && isset($_GET['id']) && $_GET['action'] === 'user_info_card') {

	$tmpLayoutData['title'] = 'Карта пользователя';

	$tmpLayoutContentData['user'] =
		dbSelectData($con, 'SELECT * FROM adm_users WHERE id = ?', [$_GET['id']])[0] ?? false;

	if ($tmpLayoutContentData['user'] === false) {
		redirectToIf(false, '',
			$PROG_CONFIG['HOST'] . '/users.php?action=users_list&error_massage=USER ID ERROR');
	}

	$tmpLayoutData['content'] =
		renderTemplate($_SERVER['DOCUMENT_ROOT'] . '/src/templates/users/user_info_card.php', $tmpLayoutContentData);
}

echo renderTemplate($_SERVER['DOCUMENT_ROOT'] . '/src/templates/layout.php', $tmpLayoutData);
