<?php

function paidPeriodDaysLeft($progConfig) {
	$endOfDay = strtotime($progConfig['PAID_UNTIL'] . ' 23:59:59');
	return (int) floor(($endOfDay - time()) / 60 / 60 / 24);
}

function isPaidPeriodExpired($progConfig) {
	return paidPeriodDaysLeft($progConfig) < 0;
}

function daysDeclension($n) {
	$n = abs($n) % 100;
	$last = $n % 10;

	if ($n >= 11 && $n <= 14)
		return 'дней';
	if ($last === 1)
		return 'день';
	if ($last >= 2 && $last <= 4)
		return 'дня';

	return 'дней';
}

function paidPeriodWarningText($daysLeft) {
	if ($daysLeft === 0)
		return 'Оплаченный период заканчивается сегодня';

	return 'Оплаченный период заканчивается через ' . $daysLeft . ' ' . daysDeclension($daysLeft);
}
