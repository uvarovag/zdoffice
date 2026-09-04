<?php

function isValidTransaction($progConfig, $moneyTypesId) {

	if (isset($_POST['type']) == false ||
		isset($_POST['amount']) == false ||
		isset($_POST['category']) == false ||
		isset($_POST['comment']) == false ||
		isset($_POST['redirect_success']) == false ||
		isset($_POST['redirect_error']) == false)
		return false;

	// вручную через форму можно создать только приход/расход;
	// тип "списание за заявку" заводит только автоматический хук в change_status
	if ($_POST['type'] != $moneyTypesId['INCOME'] && $_POST['type'] != $moneyTypesId['EXPENSE'])
		return false;

	if (is_numeric($_POST['amount']) == false || (float)$_POST['amount'] <= 0)
		return false;

	if (isValidLen($_POST['category'], 0, 64) == false)
		return false;

	if (isValidLen($_POST['comment'], 0, 255) == false)
		return false;

	return true;
}
