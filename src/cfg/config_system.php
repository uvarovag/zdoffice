<?php

$SYS_CONFIG = [
	'HOST' => 'http://zdoffice.ru',
	'BD_HOST' => 'localhost',
	'BD_USER' => 'root-zdoffice',
	'BD_PASSWORD' => '9R6z2G9pH2j5V2r8',
	'BD_NAME' => 'zdoffice_1t4u9e6p',
	'DOWNLOAD_DIR' => '/uploaded_files',
	'CHMOD_DWL_DIR' => 0766,
	'CHMOD_DWL_FILE' => 0444,
	'MAX_UPL_FILE_SIZE' => 10000000,
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
