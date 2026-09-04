<?php

function isValidNewProductionOrderData($progConfig, $con) {

	if (isset($_POST['designer_id']) == false ||
		isset($_POST['order_name_out']) == false ||
		isset($_POST['client_id']) == false ||
		isset($_POST['order_amount']) == false ||
		isset($_POST['task_text']) == false ||
		isset($_POST['task_quantity']) == false ||
		isset($_POST['general_deadline']) == false)
		return false;

	if ($_POST['order_name_out'] !== '' &&
		isValidLen($_POST['order_name_out'], $progConfig['MIN_LEN_A'], $progConfig['MAX_LEN_A']) == false)
		return false;

	if (isValidLen($_POST['task_text'], $progConfig['MIN_LEN_B'], $progConfig['MAX_LEN_B']) == false)
		return false;

	if (is_numeric($_POST['order_amount']) == false || (float)$_POST['order_amount'] <= 0)
		return false;

	$client = dbSelectData($con, 'SELECT id FROM clients WHERE id = ? AND is_deleted = 0', [$_POST['client_id']])[0] ?? [];
	if (isset($client['id']) == false)
		return false;

	return true;
}
