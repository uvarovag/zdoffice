<?php

$con = mysqli_connect($SYS_CONFIG['BD_HOST'], $SYS_CONFIG['BD_USER'],
	$SYS_CONFIG['BD_PASSWORD'], $SYS_CONFIG['BD_NAME']);

if ($con) {
	mysqli_set_charset($con, "utf8");
} else {
	print('ошибка БД');
	exit();
}
