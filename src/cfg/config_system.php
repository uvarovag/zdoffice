<?php

$SYS_CONFIG = [
	'HOST' => 'http://zdoffice.ru',
	'BD_HOST' => 'localhost',
	'BD_USER' => 'root-zdoffice',
	'BD_PASSWORD' => '9R6z2G9pH2j5V2r8',
	'BD_NAME' => 'zdoffice_1t4u9e6p',
	'DEBUG_MODE_USER_ID' => false,
	'DOWNLOAD_DIR' => '/uploaded_files',
	'CHMOD_DWL_DIR' => 0755,
	'CHMOD_DWL_FILE' => 0444,
	'MAX_UPL_FILE_SIZE' => 1000000 * 10,
	'FORBIDDEN_MIMI_TYPES' => [
		'text/x-php'
	]
];

if ($_SERVER['REMOTE_ADDR'] == '::1') {
	$SYS_CONFIG['HOST'] = 'http://zdoffice.loc';
	$SYS_CONFIG['BD_USER'] = 'root';
	$SYS_CONFIG['BD_PASSWORD'] = 'root';
	$SYS_CONFIG['BD_NAME'] = 'zdoffice';
}
