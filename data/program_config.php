<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/src/include.php');

$progConfig = [
	'host' => 'http://zdoffice',
  'progName' => 'office',
  'bgStyle' => 'bg-primary',
	'phone_prefix' => '+998',
	'maxTabeleRow' => 15,
	'maxLenTabeCell' => 12,
	// regexpA login, password
	'regexpA' => '[A-Za-z0-9 ]',
	// regexpB last_name, firs_name, position
	'regexpB' => '[А-Яа-яЁё0-9 ]',
	// regexpC mobile phone
	'regexpC' => '\d{2}\s\d{3}\s\d{2}\s\d{2}',
	// minLenA login, password, last_name, firs_name, position
	'minLenA' => 3,
	// !!!MAX 32!!! maxLenA login, password, last_name, firs_name, position
	'maxLenA' => 32,
	'minLenB' => 0,
	'maxLenB' => 0,
	'minLenC' => 0,
	'maxLenC' => 0,
];


