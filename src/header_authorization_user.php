<?php

if (isPaidPeriodExpired($PROG_CONFIG)) {
	unset($_SESSION['user']);
	unset($_SESSION['navList']);
	header('Location:' . $PROG_CONFIG['HOST'] . '/login.php?error_massage=оплаченный период закончился');
	exit();
}

if (isset($_SESSION['user']) == false) {
	header('Location:' . $PROG_CONFIG['HOST'] . '/logout.php');
	exit();
}

if (($_SESSION['user']['is_superuser'] ?? false) === 1) {
	header('Location:' . $PROG_CONFIG['HOST'] . '/logout.php');
	exit();
}

if (getUserNeedLogoutVal($con, 'adm_users', $_SESSION['user']['id']) === 1) {
	header('Location:' . $PROG_CONFIG['HOST'] . '/logout.php');
	exit();
}
