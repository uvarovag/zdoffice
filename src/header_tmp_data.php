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
	'errorMassage' => false
];

$tmpLayoutContentData = [
	'CONFIG' => &$PROG_CONFIG,
	'PROG_DATA' => &$PROG_DATA,
	'title' => &$tmpLayoutData['title'],
	'formId' => 'none'
];
