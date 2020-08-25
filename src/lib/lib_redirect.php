<?php

function errorIfDoubleClick($sesFormId, $postFormId, $redirectTo) {
	if ($sesFormId !== $postFormId) {
		header('Location:' . $redirectTo);
		exit();
	}

	return true;
}

function errorIfAccessDenied($access, $redirectTo) {
	if ($access === 0) {
		header('Location:' . $redirectTo);
		exit();
	}

	return true;
}

function redirectToIf($val, $ifTrue, $ifFalse) {
	if ($val) {
		header('Location:' . $ifTrue);
		exit();
	} else {
		header('Location:' . $ifFalse);
		exit();
	}
}
