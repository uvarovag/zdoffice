<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/src/include.php');

require_once($_SERVER['DOCUMENT_ROOT'] . '/src/header_session_start.php');

require_once($_SERVER['DOCUMENT_ROOT'] . '/src/header_tmp_data.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/src/header_alert_massage.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/src/header_authorization_user.php');

date_default_timezone_set($PROG_CONFIG['TIMEZONE']);
$_SESSION['navList'] = cleanActiveTabs($_SESSION['navList']);

///////////////////////////////////////////////////////////////////////////////////////////////

if (!file_exists($_SERVER['DOCUMENT_ROOT'] . $SYS_CONFIG['DOWNLOAD_DIR'])) {
	mkdir($_SERVER['DOCUMENT_ROOT'] . $SYS_CONFIG['DOWNLOAD_DIR'], $SYS_CONFIG['CHMOD_DWL_DIR']);
	sleep(1);
}

if (!file_exists($_SERVER['DOCUMENT_ROOT'] . $SYS_CONFIG['DOWNLOAD_DIR'] . '/' .
	date('Y'))) {
	mkdir($_SERVER['DOCUMENT_ROOT'] . $SYS_CONFIG['DOWNLOAD_DIR'] . '/' .
		date('Y'), $SYS_CONFIG['CHMOD_DWL_DIR']);
	sleep(1);
}

if (!file_exists($_SERVER['DOCUMENT_ROOT'] . $SYS_CONFIG['DOWNLOAD_DIR'] . '/' .
	date('Y') . '/' . date('m'))) {
	mkdir($_SERVER['DOCUMENT_ROOT'] . $SYS_CONFIG['DOWNLOAD_DIR'] . '/' .
		date('Y') . '/' . date('m'), $SYS_CONFIG['CHMOD_DWL_DIR']);
	sleep(1);
}

if (!file_exists($_SERVER['DOCUMENT_ROOT'] . $SYS_CONFIG['DOWNLOAD_DIR'] . '/' .
	date('Y') . '/' . date('m') . '/' . date('d'))) {
	mkdir($_SERVER['DOCUMENT_ROOT'] . $SYS_CONFIG['DOWNLOAD_DIR'] . '/' .
		date('Y') . '/' . date('m') . '/' . date('d'), $SYS_CONFIG['CHMOD_DWL_DIR']);
	sleep(1);
}

///////////////////////////////////////////////////////////////////////////////////////////////

if (isset($_POST['action']) && isset($_POST['form_id']) && $_POST['action'] == 'upl_file' &&
	isset($_FILES['file']) && $_FILES['file']['size']) {

	errorIfDoubleClick($_SESSION['formId'], $_POST['form_id'],
		$_POST['redirect_error'] . '&error_massage=' . $PROG_DATA['ERROR']['DOUBLE_CLICK']);

	if (isValidFormFile($PROG_CONFIG) === false)
		redirectToIf(false, '', $_POST['redirect_error'] . '&error_massage=' . $PROG_DATA['ERROR']['INPUT_DATA']);

	$_SESSION['formId'] = 'none';

	if ($_FILES['file']['error'] !== 0)
		redirectToIf(false, '', $_POST['redirect_error'] . '&error_massage=ошибка загрузки ' . __LINE__);

	if ($_FILES['file']['size'] > $SYS_CONFIG['MAX_UPL_FILE_SIZE'])
		redirectToIf(false, '', $_POST['redirect_error'] . '&error_massage=слишком большой размер файла ' . __LINE__);

	if (in_array(mime_content_type($_FILES['file']['tmp_name']), $SYS_CONFIG['FORBIDDEN_MIMI_TYPES']))
		redirectToIf(false, '', $_POST['redirect_error'] . '&error_massage=недопустимый формат файла ' . __LINE__);

	$pathDir = $SYS_CONFIG['DOWNLOAD_DIR'] . '/' . date('Y') . '/' . date('m') . '/' . date('d');
//	$pathFile = $pathDir . '/' . substr(md5(time()), 5, 15) . '.' . pathinfo($_FILES['file']['name'])['extension'];
	$pathFile = $pathDir . '/' . date('H-i-s') . '_' . correctFormatLower($_FILES['file']['name']);

	mysqli_query($con, 'START TRANSACTION');

	$fileData = [
		'user_id' => $_SESSION['user']['id'],
		'change_datetime' => date('Y-m-d H:i:s'),
		'order_id' => $_POST['order_id'],
		'order_type' => $_POST['order_type'],
		'size' => $_FILES['file']['size'],
		'note' => correctFormat($_POST['note']),
		'name' => correctFormatLower($_FILES['file']['name']),
		'path' => $pathFile
	];

	$dbFile = dbInsertData($con, 'files', $fileData);
	$moveFile = move_uploaded_file($_FILES['file']['tmp_name'], $_SERVER['DOCUMENT_ROOT'] . '/' . $pathFile);
	chmod($_SERVER['DOCUMENT_ROOT'] . $pathFile, $SYS_CONFIG['CHMOD_DWL_FILE']);

	if ($dbFile && $moveFile)
		mysqli_query($con, 'COMMIT');
	else
		mysqli_query($con, 'ROLLBACK');

	redirectToIf($dbFile && $moveFile,
		$_POST['redirect_success'],
		$_POST['redirect_error'] . '&error_massage=' . $PROG_DATA['ERROR']['BD_WRITE']);
}


///////////////////////////////////////////////////////////////////////////////////////////////

// права доступа
// удалить файл только кто добавил

if (isset($_GET['action']) && isset($_GET['id']) &&
	isset($_GET['redirect_success']) && isset($_GET['redirect_error']) &&
	$_GET['action'] == 'del_file') {

	$file = dbSelectData($con, 'SELECT * FROM files WHERE id = ?', [$_GET['id']])[0] ?? [];

	if (isset($file['id']) == false)
		redirectToIf(false, '', $_GET['redirect_error'] . '&error_massage=' . $PROG_DATA['ERROR']['ID']);

	// удалить файл только кто добавил
	if ($file['user_id'] !== $_SESSION['user']['id'])
		redirectToIf(false, '', $_GET['redirect_error'] . '&error_massage=' . $PROG_DATA['ERROR']['ACCESS_DENIED'] . ' ' . __LINE__);

	mysqli_query($con, 'START TRANSACTION');

	$dbFile = dbExecQuery($con, 'UPDATE files SET is_deleted = 1, change_datetime = ?, user_id = ? WHERE id = ?', [
		date('Y-m-d H:i:s'), $_SESSION['user']['id'], $_GET['id']]);

	$delFile = unlink($_SERVER['DOCUMENT_ROOT'] . $file['path']);

	if ($dbFile && $delFile)
		mysqli_query($con, 'COMMIT');
	else
		mysqli_query($con, 'ROLLBACK');

	redirectToIf($dbFile && $delFile,
		$_GET['redirect_success'],
		$_GET['redirect_error'] . '&error_massage=' . $PROG_DATA['ERROR']['BD_WRITE']);
}


if (isset($_SERVER['HTTP_REFERER']))
	header('Location:' . $_SERVER['HTTP_REFERER']);
