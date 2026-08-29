<?php

$PROG_CONFIG = [
	'HOST' => $SYS_CONFIG['HOST'], // DONT TOUCH!!!
	'DEBUG_MODE_USER_ID' => $SYS_CONFIG['DEBUG_MODE_USER_ID'], // DONT TOUCH!!!
	'MAX_UPL_FILE_SIZE' => $SYS_CONFIG['MAX_UPL_FILE_SIZE'], // DONT TOUCH!!!
	'RELOAD_EVERY_MIN' => 5,
	'TIMEZONE' => 'Asia/Tashkent',
	'PROG_NAME' => 'ALI PRINT',
	'BG_STYLE' => 'bg-primary',
	'TEXT_STYLE' => 'text-primary',
	'PHONE_PREFIX' => '+998',
	'MAX_TABLE_ROWS' => 50,
	'MAX_SYMBOLS_TABLE_CELL' => 9,
	'MAX_ADM_USERS_LOGS' => 50,
	'MIN_LEN_A' => 3,
	'MAX_LEN_A' => 64,    // !!! MAX 64
	'MIN_LEN_B' => 10,
	'MAX_LEN_B' => 1000,  // !!! MAX 1000
	'MIN_LEN_C' => 10,
	'MAX_LEN_C' => 150,  // !!! MAX 150
	'DATE_FORMAT' => '\'%d.%m.%Y\'',
	'DATETIME_FORMAT' => '\'%d.%m.%Y %H:%i\'',
	'WARNING_DAYS_BEFORE_DEADLINE' => 3,
	'PAID_UNTIL' => '2026-09-30',        // дата окончания оплаченного периода (Y-m-d)
	'PAID_WARNING_DAYS_BEFORE' => 7      // за сколько дней до окончания показывать предупреждение
];
