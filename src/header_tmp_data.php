<?php

$tmpLayoutData = [
	'CONFIG' => 			&$PROG_CONFIG,
	'PROG_DATA' => 		&$PROG_DATA,
	'title' => 				$PROG_CONFIG['PROG_NAME'],
	'content' => 			'',
	'modal' =>				'',
	'pagination' => 	'',
	'alertMassage' => false,
	'errorMassage' => false
];

$tmpLayoutContentData = [
	'CONFIG' => 			&$PROG_CONFIG,
	'PROG_DATA' => 		&$PROG_DATA,
	'title' => 		    &$tmpLayoutData['title'],
	'formId' => 			'none'
];
