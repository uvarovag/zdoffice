<?php

function getActiveStatusArr($orderData) {

	$status = [];

	if ($orderData['const_datetime_status_0'])
		$status['const'] = $orderData['const_current_status'];
	if ($orderData['adv_datetime_status_0'])
		$status['adv'] = $orderData['adv_current_status'];
	if ($orderData['furn_datetime_status_0'])
		$status['furn'] = $orderData['furn_current_status'];
	if ($orderData['steel_datetime_status_0'])
		$status['steel'] = $orderData['steel_current_status'];
	if ($orderData['install_datetime_status_0'])
		$status['install'] = $orderData['install_current_status'];
	if ($orderData['supply_datetime_status_0'])
		$status['supply'] = $orderData['supply_current_status'];

	return $status;
}

function currentGeneralStatus($orderData) {

	$status = getActiveStatusArr($orderData);

	$last = false;

	foreach ($status as $st) {
		if ($last !== false && $last !== $st)
			return false;
		$last = $st;
	}

	return $last;
}

function currentMinStatus($orderData) {

	$status = getActiveStatusArr($orderData);

	$min = false;

	foreach ($status as $st) {
		if ($min > $st || $min == false)
			$min = $st;
	}

	return $min;
}

function currentMaxStatus($orderData) {

	$status = getActiveStatusArr($orderData);

	$max = false;

	foreach ($status as $st) {
		if ($max < $st || $max == false)
			$max = $st;
	}

	return $max;
}
