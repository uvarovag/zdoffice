<?php

function isValidLoginPassword($progConfig) {

	if (isset($_POST['login']) == false || isset($_POST['password']) == false)
		return false;

	if (isValidLen($_POST['login'], $progConfig['MIN_LEN_A'], $progConfig['MAX_LEN_A']) == false)
		return false;

	if (isValidLen($_POST['password'], $progConfig['MIN_LEN_A'], $progConfig['MAX_LEN_A']) == false)
		return false;

	return true;
}
