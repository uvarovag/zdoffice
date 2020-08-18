<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/src/include.php');

require_once($_SERVER['DOCUMENT_ROOT'] . '/src/header_session_start.php');

require_once($_SERVER['DOCUMENT_ROOT'] . '/src/header_tmp_data.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/src/header_alert_massage.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/src/header_authorization_user.php');

date_default_timezone_set($PROG_CONFIG['TIMEZONE']);
$_SESSION['navList'] = cleanActiveTabs($_SESSION['navList']);


if (isset($_POST['action']) && $_POST['action'] == 'new_note') {

	errorIfDoubleClick($_SESSION['formId'], $_POST['form_id'] ?? '???',
		$_POST['redirect_error'] . '&error_massage=DOUBLE CLICK ERROR');

	$_SESSION['formId'] = 'none';

	if (isValidNote($PROG_CONFIG) === false)
		redirectToIf(false, '', $_POST['redirect_error'] . '&error_massage=' . $PROG_DATA['ERROR']['INPUT_DATA']);

	$noteData = [
		'user_id' => $_SESSION['user']['id'],
		'order_id' => $_POST['order_id'],
		'order_type' => $_POST['order_type'],
		'create_datetime' => date('Y-m-d H:i:s'),
		'priority' => $_POST['priority'],
		'note' => correctFormat($_POST['note'])
	];

	redirectToIf(dbInsertData($con, 'notes', $noteData),
		$_POST['redirect_success'],
		$_POST['redirect_error'] . '&error_massage=' . $PROG_DATA['ERROR']['BD_WRITE']);
}

if (isset($_SERVER['HTTP_REFERER']))
	header('Location:' . $_SERVER['HTTP_REFERER']);

