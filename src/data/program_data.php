<?php

function setProgData() {

	require_once($_SERVER['DOCUMENT_ROOT'] . '/src/data/program_data_users_positions_list.php');
	require_once($_SERVER['DOCUMENT_ROOT'] . '/src/data/program_data_status_list_design.php');
	require_once($_SERVER['DOCUMENT_ROOT'] . '/src/data/program_data_status_list_production.php');
	require_once($_SERVER['DOCUMENT_ROOT'] . '/src/data/program_data_priority_orders.php');
	require_once($_SERVER['DOCUMENT_ROOT'] . '/src/data/program_data_order_types.php');
	require_once($_SERVER['DOCUMENT_ROOT'] . '/src/data/program_data_massages.php');
	require_once($_SERVER['DOCUMENT_ROOT'] . '/src/data/program_data_departments_list.php');

	$PROG_DATA = [
		'USERS_POSITIONS_LIST' => $USERS_POSITIONS_LIST,
		'USERS_POSITIONS_ID' => $USERS_POSITIONS_ID,

		'STATUS_LIST_DESIGN' => $STATUS_LIST_DESIGN,
		'STATUS_ID_DESIGN' => $STATUS_ID_DESIGN,

		'STATUS_LIST_PRODUCTION' => $STATUS_LIST_PRODUCTION,
		'STATUS_ID_PRODUCTION' => $STATUS_ID_PRODUCTION,

		'DEPARTMENTS_LIST' => $DEPARTMENTS_LIST,

		'PRIORITY_ORDERS' => $PRIORITY_ORDERS,
		'PRIORITY_ID' => $PRIORITY_ID,

		'ORDER_TYPES' => $ORDER_TYPES,

		'ERROR' => $ERROR,
		'ALERT' => $ALERT
	];

	return $PROG_DATA;
}

$PROG_DATA = setProgData();
