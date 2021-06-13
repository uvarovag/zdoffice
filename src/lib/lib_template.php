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
		'CONFIG' => $config,
		'url' => $url . getStringFromGetQuery($_GET),
		'pagesQuantity' => 0,
		'currentPage' => 0
	];

	$paginationCount = dbSelectData($con, $sqlQuery, $sqlParametrs)[0]['pgn'];

	if ($paginationCount > $config['MAX_TABLE_ROWS']) {

		$sqlPaginationItem = $config['MAX_TABLE_ROWS'];
		$sqlPaginationStart = 0;

		$tmpPaginationData['pagesQuantity'] = ceil($paginationCount / $config['MAX_TABLE_ROWS']);
		$tmpPaginationData['currentPage'] = 1;

		if (isset($_GET['page']) && $_GET['page'] > 1) {
			$sqlPaginationStart = floor($config['MAX_TABLE_ROWS'] * (floor($_GET['page']) - 1));
			$tmpPaginationData['currentPage'] = floor($_GET['page']);
		}

		$sqlPagination = 'LIMIT ' . $sqlPaginationItem . ' OFFSET ' . $sqlPaginationStart . ' ';
		$tmpPagination = renderTemplate($_SERVER['DOCUMENT_ROOT'] . '/src/templates/pagination.php', $tmpPaginationData);
	}

	return [
		'sqlPagination' => $sqlPagination,
		'tmpPagination' => $tmpPagination
	];
}


function shortStr($str, $maxLength) {
	if (iconv_strlen($str) > $maxLength) {
		return '<span data-toggle="tooltip" data-placement="top" title="' . $str . '">' .
			mb_strimwidth($str, 0, $maxLength) . '...</span>';
	} else {
		return $str;
	}
}

function deadlineBadge($date, $ifDays) {

	$daysBefore = ceil((strtotime($date) - strtotime('now')) / 60 / 60 / 24);

	if ($daysBefore > $ifDays) {
		return '<span class="badge badge-pill bg-primary text-white" data-toggle="tooltip" data-placement="top" 
		title="осталось дней - ' . $daysBefore . '">' . $date . '</span>';
	}
	if ($daysBefore == 0) {
		return '<span class="badge badge-pill bg-warning text-dark" data-toggle="tooltip" data-placement="top" 
		title="сегодня">' . $date . '</span>';
	}
	if ($daysBefore > 0) {
		return '<span class="badge badge-pill bg-warning text-dark" data-toggle="tooltip" data-placement="top" 
		title="осталось дней - ' . abs($daysBefore) . '">' . $date . '</span>';
	}
	return '<span class="badge badge-pill bg-danger text-white" data-toggle="tooltip" data-placement="top" 
		title="просрочено дней - ' . abs($daysBefore) . '">' . $date . '</span>';
}

function cleanActiveTabs($navList) {

	foreach ($navList as $navKey => $navVal) {
		$navList[$navKey]['isActive'] = false;
	}

	return $navList;
}

