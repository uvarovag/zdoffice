<?php

function addUserLog($con, $tableName, $userId, $logInfo) {
	$logData = [
		'user_id' => $userId,
		'log_datetime' => date('Y-m-d H:i:s'),
		'log_ip' => $_SERVER['REMOTE_ADDR'],
		'log_info' => $logInfo
	];

	return dbInsertData($con, $tableName, $logData);
}
