<?php

function isValidNewUserData($progConfig, $progData)
{
	if (isset($_POST['login']) == false || isset($_POST['last_name']) == false || isset($_POST['first_name']) == false ||
		isset($_POST['position']) == false || isset($_POST['mobile_phone']) == false || isset($_POST['email']) == false)
		return false;

	if (isValidLen($_POST['login'], $progConfig['minLenA'], $progConfig['maxLenA']) == false ||
		isValidLen($_POST['last_name'], $progConfig['minLenA'], $progConfig['maxLenA']) == false ||
		isValidLen($_POST['first_name'], $progConfig['minLenA'], $progConfig['maxLenA']) == false ||
		array_key_exists($_POST['position'], $progData['usersPositionsList']) == false ||
		filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) == false)
		return false;
	return true;
}

function isValidNewUserPassword($progConfig)
{
	if (isset($_POST['password']) == false)
		return false;

	if (isValidLen($_POST['password'], $progConfig['minLenA'], $progConfig['maxLenA']) == false)
		return false;
	return true;
}
