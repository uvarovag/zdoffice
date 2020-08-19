<?php

function isValidNewDesignOrderData($progConfig) {
	if (isset($_POST['order_name_out']) == false || isset($_POST['client_name']) == false || isset($_POST['mobile_phone']) == false ||
		isset($_POST['email']) == false || isset($_POST['task_text']) == false || isset($_POST['design_format']) == false ||
		isset($_POST['deadline_date']) == false)
		return false;

	if (isValidLen($_POST['order_name_out'], $progConfig['MIN_LEN_A'], $progConfig['MAX_LEN_A']) == false ||
		isValidLen($_POST['client_name'], $progConfig['MIN_LEN_A'], $progConfig['MAX_LEN_A']) == false ||
		isValidLen($_POST['task_text'], $progConfig['MIN_LEN_B'], $progConfig['MAX_LEN_B']) == false ||
		filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) == false)
		return false;

	return true;
}
