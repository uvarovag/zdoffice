<?php

function errorIfDoubleClick($sesFormId, $postFormId, $url) {
	if ($sesFormId !== $postFormId) {
		header('Location:' . $url . '&error_massage=DOUBLE CLICK ERROR');
		exit();
	}
	return true;
}

function isValidLen($str, $minLen, $maxLen) {
	if (mb_strlen($str) < $minLen || mb_strlen($str) > $maxLen)
		return false;
	return true;
}
