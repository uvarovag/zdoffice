<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/src/include.php');

$progConfig = [
  'progName' => 'office',
  'bgStyle' => 'bg-primary',
	'phone_prefix' => '+998',
	'maxTabeleRow' => 5,
	// regexp_a login, password
	'regexp_a' => '[A-Za-z0-9 ]',
	// regexp_b last_name, firs_name, position
	'regexp_b' => '[А-Яа-яЁё0-9 ]',
	// min_len_a login, password, last_name, firs_name, position
	'min_len_a' => 3,
	// !!!MAX 32!!! max_len_a login, password, last_name, firs_name, position
	'max_len_a' => 32,
	'min_len_b' => 3,
	'max_len_b' => 5,
	'min_len_c' => 3,
	'max_len_c' => 5,
];


