<?php

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

function paramSqlFilterArrKey($separator, $str, $arr) {

	if (mb_strlen($str) === 0)
		return false;

	$filter = explode($separator, $str);

	foreach ($filter as $arrVal) {
		if (array_key_exists($arrVal, $arr) === false)
			return false;
	}
	return $filter;
}

function paramSqlFilterArrVal($separator, $str, $arr) {

	if (mb_strlen($str) === 0)
		return false;

	$filter = explode($separator, $str);

	foreach ($filter as $filterVal) {
		$inArr = false;
		foreach ($arr as $arrVal) {
			if (strval($filterVal) === strval($arrVal)) {
				$inArr = true;
				break;
			}
		}
		if ($inArr === false)
			return false;
	}
	return $filter;
}