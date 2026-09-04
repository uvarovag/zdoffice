<?php

function isValidNewClientData($progConfig) {

	if (isset($_POST['name']) == false ||
		isset($_POST['mobile_phone']) == false ||
		isset($_POST['email']) == false ||
		isset($_POST['note']) == false)
		return false;

	if (isValidLen($_POST['name'], $progConfig['MIN_LEN_A'], $progConfig['MAX_LEN_A']) == false)
		return false;

	if (isValidLen($_POST['note'], 0, 255) == false)
		return false;

	return true;
}
