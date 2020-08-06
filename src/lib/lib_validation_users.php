<?php

function isValidNewUserData($progConfig, $progData) {
	if (isset($_POST['login']) == false || isset($_POST['last_name']) == false || isset($_POST['first_name']) == false ||
		isset($_POST['position']) == false || isset($_POST['mobile_phone']) == false || isset($_POST['email']) == false)
		return false;

	if (isValidLen($_POST['login'], $progConfig['MIN_LEN_A'], $progConfig['MAX_LEN_A']) == false ||
		isValidLen($_POST['last_name'], $progConfig['MIN_LEN_A'], $progConfig['MAX_LEN_A']) == false ||
		isValidLen($_POST['first_name'], $progConfig['MIN_LEN_A'], $progConfig['MAX_LEN_A']) == false ||
		array_key_exists($_POST['position'], $progData['USERS_POSITIONS_LIST']) == false ||
		filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) == false)
		return false;

	return true;
}

function isValidNewUserPassword($progConfig) {
	if (isset($_POST['password']) == false)
		return false;

	if (isValidLen($_POST['password'], $progConfig['MIN_LEN_A'], $progConfig['MAX_LEN_A']) == false)
		return false;

	return true;
}
