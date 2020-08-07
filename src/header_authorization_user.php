<?php

if (isset($_SESSION['user']) == false) {
	header('Location:' . $PROG_CONFIG['HOST'] . '/logout.php');
	exit();
}

if (($_SESSION['user']['is_superuser'] ?? false) === 1) {
	header('Location:' . $PROG_CONFIG['HOST'] . '/logout.php');
	exit();
}

if (getUserNeedLogoutVal($con, 'adm_users', $_SESSION['user']['id']) === 1) {
	setUserNeedLogoutVal($con, 'adm_users', $_SESSION['user']['id'], 0);
	header('Location:' . $PROG_CONFIG['HOST'] . '/logout.php');
	exit();
}
