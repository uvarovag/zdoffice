<?php

function isValidNote($progConfig) {

	if (isset($_POST['order_id']) == false || isset($_POST['order_type']) == false ||
		isset($_POST['note']) == false || isset($_POST['priority']) == false ||
		isset($_POST['redirect_success']) == false || isset($_POST['redirect_error']) == false) {

		return false;
	}

	if (isValidLen($_POST['note'], $progConfig['MIN_LEN_C'], $progConfig['MAX_LEN_C']) == false)
		return false;

	return true;
}
