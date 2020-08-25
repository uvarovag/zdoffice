<?php

function changeOrderStatusAndSetDatetime($con, $tableName, $statusColName, $dateTimeColPrefix, $status, $orderId) {

	return dbExecQuery($con, 'UPDATE ' . $tableName . ' SET ' .
		$statusColName . ' = ?, ' . $dateTimeColPrefix . ((int)$status) . ' = ? WHERE id = ?',
		[$status, date('Y-m-d H:i:s'), $orderId]);
}

function addSuffixStatusList($colPrefixes, $statusIdList, $datetimeFormat) {

	$sql = '';
	$i = 0;
	$statusIdListLen = count($statusIdList);

	foreach ($statusIdList as $status) {
		$i++;

		$sql = $sql . 'DATE_FORMAT(' . $colPrefixes . $status . ', ' . $datetimeFormat . ') AS ' .
			$colPrefixes . $status;

		if ($i === $statusIdListLen)
			$sql = $sql . ' ';
		else
			$sql = $sql . ', ';
	}
	return $sql;
}