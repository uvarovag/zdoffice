<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/src/include.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/src/header_session_start.php');

unset($_SESSION['user']);
unset($_SESSION['navList']);

header('Location:' . $PROG_CONFIG['HOST'] . '/login.php');
exit();
