<?php

$PROG_CONFIG = [
	'HOST' =>										$SYS_CONFIG['HOST'],
	'PROG_NAME' => 							'office',
	'BG_STYLE' => 							'bg-primary',
	'TEXT_STYLE' => 						'text-primary',
	'PHONE_PREFIX' => 					'+998',
	'MAX_TABLE_ROWS' => 				15,
	'MAX_SYMBOLS_TABLE_CELL' => 15,
	'MAX_ADM_USERS_LOGS' => 		50,
	'MIN_LEN_A' => 							3, // login, password, last_name, firs_name, position
	'MAX_LEN_A' => 							64, // !!!MAX 64!!! login, password, last_name, firs_name, position
	'MIN_LEN_B' => 							10,
	'MAX_LEN_B' => 							1000,
	'MIN_LEN_C' => 							0,
	'MAX_LEN_C' => 							0,
	'DESIGNER_POSITION_ID' => 	2,
	'DATE_FORMAT' => 	'\'%d.%m.%Y\'',
	'DATETIME_FORMAT' => 	'\'%d.%m.%Y %H:%i\'',
	'WARNING_DAYS_BEFORE_DEADLINE' => 3
];
