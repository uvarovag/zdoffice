<?php

function correctFormatUpper($str) {
	return mb_strtoupper(trim(htmlspecialchars(strip_tags($str))));
}

function correctFormatLower($str) {
	return mb_strtolower(trim(htmlspecialchars(strip_tags($str))));
}

function correctFormat($str) {
	return trim(htmlspecialchars(strip_tags($str)));
}

function mb_ucfirst($str) {
	$fc = mb_strtoupper(mb_substr($str, 0, 1));
	return $fc.mb_substr($str, 1);
}
