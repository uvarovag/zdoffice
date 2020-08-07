<?php

function setProgData() {

	require_once($_SERVER['DOCUMENT_ROOT'] . '/src/data/program_data_users_positions_list.php');
	require_once($_SERVER['DOCUMENT_ROOT'] . '/src/data/program_data_status_list_design.php');
	require_once($_SERVER['DOCUMENT_ROOT'] . '/src/data/program_data_priority_orders.php');

	$PROG_DATA = [
		'USERS_POSITIONS_LIST' => $USERS_POSITIONS_LIST,
		'STATUS_LIST_DESIGN' => $STATUS_LIST_DESIGN,
		'PRIORITY_ORDERS' => $PRIORITY_ORDERS
	];

	return $PROG_DATA;
}

$PROG_DATA = setProgData();
