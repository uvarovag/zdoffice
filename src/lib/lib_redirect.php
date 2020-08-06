<?php

function redirectToIf($val, $ifTrue, $ifFalse) {
	if ($val) {
		header('Location:' . $ifTrue);
		exit();
	} else {
		header('Location:' . $ifFalse);
		exit();
	}
}
