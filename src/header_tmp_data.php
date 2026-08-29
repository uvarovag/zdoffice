<?php

$tmpLayoutData = [
	'CONFIG' => &$PROG_CONFIG,
	'PROG_DATA' => &$PROG_DATA,
	'RELOAD_EVERY_MIN' => $PROG_CONFIG['RELOAD_EVERY_MIN'],
	'title' => $PROG_CONFIG['PROG_NAME'],
	'content' => '',
	'modal' => '',
	'notifyQuantity' => 0,
	'notify' => '',
	'pagination' => '',
	'alertMassage' => false,
	'errorMassage' => false,
	'paidPeriodWarningDays' => false
];

$tmpPaidPeriodDaysLeft = paidPeriodDaysLeft($PROG_CONFIG);
if ($tmpPaidPeriodDaysLeft >= 0 && $tmpPaidPeriodDaysLeft <= $PROG_CONFIG['PAID_WARNING_DAYS_BEFORE'])
	$tmpLayoutData['paidPeriodWarningDays'] = $tmpPaidPeriodDaysLeft;

$tmpLayoutContentData = [
	'CONFIG' => &$PROG_CONFIG,
	'PROG_DATA' => &$PROG_DATA,
	'title' => &$tmpLayoutData['title'],
	'formId' => 'none'
];
