<?php

$tmpLayoutData = [
	'CONFIG' => &$PROG_CONFIG,
	'PROG_DATA' => &$PROG_DATA,
	'title' => $PROG_CONFIG['PROG_NAME'],
	'reloadEveryMin' => 5,
	'content' => '',
	'modal' => '',
	'notifyQuantity' => 0,
	'notify' => '',
	'pagination' => '',
	'alertMassage' => false,
	'errorMassage' => false
];

$tmpLayoutContentData = [
	'CONFIG' => &$PROG_CONFIG,
	'PROG_DATA' => &$PROG_DATA,
	'title' => &$tmpLayoutData['title'],
	'formId' => 'none'
];
