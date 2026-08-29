<?php

$SYS_CONFIG = [
	'HOST' => 'http://88.218.62.16',
	'BD_HOST' => 'localhost',
	'BD_USER' => '88_218_62_16',
	'BD_PASSWORD' => 'a/Q3q,O=6A|(;Z,S3`.u?Ml+*X8-Gk:o',
	'BD_NAME' => '88_218_62_16',
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
	$SYS_CONFIG['HOST'] = 'http://mamp';
	$SYS_CONFIG['BD_USER'] = 'root';
	$SYS_CONFIG['BD_PASSWORD'] = 'root';
	$SYS_CONFIG['BD_NAME'] = 'test';
}
