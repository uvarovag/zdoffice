<?php

if (isset($_SESSION['user']) == false) {
	header('Location:' . $PROG_CONFIG['HOST'] . '/logout.php');
	exit();
}

if (($_SESSION['user']['is_superuser'] ?? false) === 1) {
	header('Location:' . $PROG_CONFIG['HOST'] . '/logout.php');
	exit();
}