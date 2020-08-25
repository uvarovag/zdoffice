<?php

function isValidFormFile($progConfig) {
	if (isset($_POST['order_id']) == false || isset($_POST['order_type']) == false ||
		isset($_POST['note']) == false ||
		isset($_POST['redirect_success']) == false || isset($_POST['redirect_error']) == false) {

		return false;
	}

	if (isValidLen($_POST['note'], 0, $progConfig['MAX_LEN_A']) == false)
		return false;

	return true;
}