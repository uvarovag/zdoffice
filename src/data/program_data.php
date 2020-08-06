<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/src/data/users_positions_list.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/src/data/status_list_design.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/src/data/priority_orders.php');

$progData = [
	'USERS_POSITIONS_LIST' => $USERS_POSITIONS_LIST,
	'STATUS_LIST_DESIGN' => $STATUS_LIST_DESIGN,
	'PRIORITY_ORDERS' => $PRIORITY_ORDERS
];
