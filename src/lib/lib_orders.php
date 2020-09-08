<?php

function changeOrderStatusAndSetDatetime($con, $tableName, $statusColName, $dateTimeColPrefix, $status, $orderId) {

	return dbExecQuery($con, 'UPDATE ' . $tableName . ' SET ' .
		$statusColName . ' = ?, ' . $dateTimeColPrefix . ((int)$status) . ' = ? WHERE id = ?',
		[$status, date('Y-m-d H:i:s'), $orderId]);
}
