<?php

$tmpLayoutData = [
	'config' => 			&$PROG_CONFIG,
	'progData' => 		&$PROG_DATA,
	'title' => 				$PROG_CONFIG['PROG_NAME'],
	'content' => 			'',
	'modal' =>				'',
	'pagination' => 	'',
	'alertMassage' => false,
	'errorMassage' => false
];

$tmpLayoutContentData = [
	'config' => 			&$PROG_CONFIG,
	'progData' => 		&$PROG_DATA,
	'title' => 		    &$tmpLayoutData['title'],
	'formId' => 			'none'
];
