<?php

function isValidNewUserData($progConfig, $PROG_DATA) {
	if (isset($_POST['login']) == false || isset($_POST['last_name']) == false || isset($_POST['first_name']) == false ||
		isset($_POST['position']) == false || isset($_POST['mobile_phone']) == false || isset($_POST['email']) == false)
		return false;

	if (isValidLen($_POST['login'], $progConfig['MIN_LEN_A'], $progConfig['MAX_LEN_A']) == false ||
		isValidLen($_POST['last_name'], $progConfig['MIN_LEN_A'], $progConfig['MAX_LEN_A']) == false ||
		isValidLen($_POST['first_name'], $progConfig['MIN_LEN_A'], $progConfig['MAX_LEN_A']) == false ||
		array_key_exists($_POST['position'], $PROG_DATA['USERS_POSITIONS_LIST']) == false ||
		filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) == false)
		return false;

	return true;
}

function isSimplePassword($password) {
	$lower = mb_strtolower($password);

	$commonPasswords = [
		'123456', '1234567', '12345678', '123456789', '1234567890', '0123456789',
		'password', 'passw0rd', 'qwerty', 'qwerty123', 'qwertyuiop', 'asdfghjkl', 'zxcvbnm',
		'admin', 'admin123', 'administrator', 'letmein', 'welcome', 'iloveyou', 'monkey',
		'dragon', 'football', 'master', 'login', 'princess', 'sunshine', 'trustno1', 'baseball',
		'111111', '222222', '333333', '444444', '555555', '666666', '777777', '888888', '999999', '000000',
		'123123', '123321', '1q2w3e4r', 'qazwsx', 'zaq12wsx'
	];

	if (in_array($lower, $commonPasswords, true))
		return true;

	// все символы одинаковые, например "aaaaaa" или "111111"
	if (preg_match('/^(.)\1*$/', $password))
		return true;

	// строго последовательные символы по коду, например "abcdef" или "654321"
	$isSequential = true;
	$len = mb_strlen($password);
	for ($i = 1; $i < $len; $i++) {
		$diff = ord($password[$i]) - ord($password[$i - 1]);
		if ($diff !== 1 && $diff !== -1) {
			$isSequential = false;
			break;
		}
	}

	return $isSequential && $len >= 4;
}

function isValidNewUserPassword($progConfig) {
	if (isset($_POST['password']) == false)
		return false;

	if (isValidLen($_POST['password'], $progConfig['MIN_LEN_PASSWORD'], $progConfig['MAX_LEN_A']) == false)
		return false;

	if (preg_match('/[a-zA-Z]/', $_POST['password']) === 0 || preg_match('/[0-9]/', $_POST['password']) === 0)
		return false;

	if (isSimplePassword($_POST['password']))
		return false;

	return true;
}
