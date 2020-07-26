<?php

function renderTemplate($template, $data) {
  $string = '';
  if (file_exists($template)) {
    ob_start();
    require_once($template);
    $string = ob_get_clean();
    return $string;
  } else {
    return $string;
  }
}


function getStringFromGetQuery($getArr) {

	unset($getArr['page']);
	unset($getArr['error_massage']);
	unset($getArr['alert_massage']);

	$getQueryString = '?';
	foreach ($getArr as $key => $value) {
		$getQueryString = $getQueryString . $key . '=' . $value . '&';
	}
	return $getQueryString;
}


function getPagination($config, $url, $con, $sqlQuery, $sqlParametrs) {

	$sqlPagination = ' ';
	$tmpPagination = '';

	$tmpPaginationData = [
		'config' => $config,
		'url' => $url . getStringFromGetQuery($_GET),
		'pagesQuantity' => 0,
		'currentPage' => 0
	];

	$paginationCount = dbSelectData($con, $sqlQuery, $sqlParametrs)[0]['pgn'];

	if ($paginationCount > $config['maxTabeleRow']) {

		$sqlPaginationItem = $config['maxTabeleRow'];
		$sqlPaginationStart = 0;

		$tmpPaginationData['pagesQuantity'] = ceil($paginationCount / $config['maxTabeleRow']);
		$tmpPaginationData['currentPage'] = 1;

		if (isset($_GET['page']) && $_GET['page'] > 1) {
			$sqlPaginationStart = floor($config['maxTabeleRow'] * (floor($_GET['page']) - 1));
			$tmpPaginationData['currentPage'] = floor($_GET['page']);
		}

		$sqlPagination = 'LIMIT ' . $sqlPaginationItem . ' OFFSET ' . $sqlPaginationStart . ' ';
		$tmpPagination = renderTemplate($_SERVER['DOCUMENT_ROOT'] . '/templates/pagination.php', $tmpPaginationData);
	}

	return [
		'sqlPagination' => $sqlPagination,
		'tmpPagination' => $tmpPagination
	];
}

//function get_order_name($orderId) {
//	$maxOrderNameBodyLenght = 4;
//	$orderIdLength = mb_strlen($orderId);
//	if ($orderIdLength > $maxOrderNameBodyLenght) {
//		return substr($orderId, $orderIdLength - $maxOrderNameBodyLenght, $orderIdLength) . '-' . date('y-m');
//	} else {
//		return $orderId . '-' . date('m-y');
//	}
//}

function cutStr($str, $maxLength) {
	if (iconv_strlen($str) > $maxLength) {
		return mb_strimwidth($str, 0, $maxLength) . '...';
	} else {
		return $str;
	}
}

