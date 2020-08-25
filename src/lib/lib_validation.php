<?php

function isValidLen($str, $minLen, $maxLen) {
	if (mb_strlen($str) < $minLen || mb_strlen($str) > $maxLen)
		return false;

	return true;
}
