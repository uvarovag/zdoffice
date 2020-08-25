<?php

$SYS_CONFIG = [
	'HOST' => 'http://zdoffice.ru',
	'BD_HOST' => 'localhost',
	'BD_USER' => 'root-zdoffice',
	'BD_PASSWORD' => 'T8a9D9n36T6a1E3a',
	'BD_NAME' => 'zdoffice_r9g5k7y6',
	'DOWNLOAD_DIR' => '/uploaded_files',
	'CHMOD_DWL_DIR' => 0777,
	'CHMOD_DWL_FILE' => 0444,
	'MAX_UPL_FILE_SIZE' => 50000000,
	'FORBIDDEN_MIMI_TYPES' => [
		'text/x-php'
	]
];

if ($_SERVER['REMOTE_ADDR'] == '::1') {
	$SYS_CONFIG['HOST'] = 'http://zdoffice';
	$SYS_CONFIG['BD_USER'] = 'root';
	$SYS_CONFIG['BD_PASSWORD'] = 'root';
	$SYS_CONFIG['BD_NAME'] = 'zdoffice';
}
