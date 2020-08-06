<?php

function getOrderName($orderId) {
	$maxOrderNameBodyLength = 4;
	$orderIdLength = mb_strlen($orderId);

	if ($orderIdLength > $maxOrderNameBodyLength) {
		return substr($orderId, $orderIdLength - $maxOrderNameBodyLength,
				$orderIdLength) . '-' . date('y-m');
	} else {
		return str_repeat('0',
				$maxOrderNameBodyLength - $orderIdLength) . $orderId . '-' . date('m-y');
	}
}
