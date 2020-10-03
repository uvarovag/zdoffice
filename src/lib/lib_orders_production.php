<?php

function getActiveStatusArr($orderData, $departmentsList) {

	$status = [];

	foreach ($departmentsList as $depKey => $depVal) {
		if (isset($orderData[$depKey . '_datetime_status_0']) && $orderData[$depKey . '_datetime_status_0'])
			$status[$depKey] = $orderData[$depKey . '_current_status'];
	}

	return $status;
}

// общий текущий статус
function currentGeneralStatus($orderData, $departmentsList) {

	$status = getActiveStatusArr($orderData, $departmentsList);

	$last = false;

	foreach ($status as $st) {
		if ($last !== false && $last !== $st)
			return false;
		$last = $st;
	}

	return $last;
}

function currentMinStatus($orderData, $departmentsList) {

	$status = getActiveStatusArr($orderData, $departmentsList);

	$min = false;

	foreach ($status as $st) {
		if ($min > $st || $min == false)
			$min = $st;
	}

	return $min;
}

function currentMaxStatus($orderData, $departmentsList) {

	$status = getActiveStatusArr($orderData, $departmentsList);

	$max = false;

	foreach ($status as $st) {
		if ($max < $st || $max == false)
			$max = $st;
	}

	return $max;
}

// какие отделы учавствуют в заказе
function activeDepartments($orderData, $departmentsList) {

	$status = getActiveStatusArr($orderData, $departmentsList);

	$departments = [];

	foreach ($status as $stKey => $stval) {
		$departments[] = $stKey;
	}

	return empty($departments) ? false : $departments;
}

// в каких отделах производства пользователь может менять стадию заказа
function userAvailableDepartmentsArr($userData, $departmentsList) {

	$availableDepartments = [];

	foreach ($departmentsList as $depKey => $depVal) {
		if (isset($userData['auth_production_order_change_status_' . $depKey]) &&
			$userData['auth_production_order_change_status_' . $depKey])
			$availableDepartments[] = $depKey;
	}

	return empty($availableDepartments) ? false : $availableDepartments;
}


function orderAvailableForUser($userData, $orderData, $departmentsList, $statusIdProductions) {
	if (currentGeneralStatus($orderData, $departmentsList) === $statusIdProductions['WAIT_START'] &&
		$userData['auth_production_order_new'] == 0 &&
		$userData['auth_production_order_start'] == 0 &&
		$userData['auth_production_order_cancel'] == 0)
		return false;
	return true;
}
