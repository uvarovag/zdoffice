<?php

//design_order_change_status - Новых заявок на дизайн
//design_order_select_designer - Ожидает назначения дизайнера
//production_order_change_status_* - Новых заявок на производство
//production_order_start - Ожидает запуска в работу
//production_order_cancel - Ожидает подтверждения отмены

$tmpLayoutNotifyData['CONFIG'] = $tmpLayoutData['CONFIG'];
$tmpLayoutNotifyData['PROG_DATA'] = $tmpLayoutData['PROG_DATA'];
$tmpLayoutNotifyData['active_tab'] = '';

if ($_SESSION['user']['auth_design_order_change_status']) {

	$tmpLayoutNotifyData['active_tab'] = 'designer';

	$tmpLayoutNotifyData['notifys'] = dbSelectData($con,
		'SELECT *, DATE_FORMAT(deadline_date, ' . $PROG_CONFIG['DATE_FORMAT'] . ') AS deadline_date
		 FROM design_orders WHERE designer_id = ? AND current_status = ? 
		 ORDER BY id * order_priority * sort_priority * error_priority DESC',
		[$_SESSION['user']['id'], $PROG_DATA['STATUS_ID_DESIGN']['RECEIVED']]);

	$tmpLayoutNotifyData['notifyQuantity'] = count($tmpLayoutNotifyData['notifys']);

	if ($tmpLayoutNotifyData['notifyQuantity'] > 0) {
		$tmpLayoutData['notifyQuantity'] += $tmpLayoutNotifyData['notifyQuantity'];
		$tmpLayoutData['notify'] = $tmpLayoutData['notify'] .
			renderTemplate($_SERVER['DOCUMENT_ROOT'] . '/src/templates/notify/design_order_change_status.php', $tmpLayoutNotifyData);
	}
}

if ($_SESSION['user']['auth_design_order_select_designer']) {

	$tmpLayoutNotifyData['active_tab'] = 'designer';

	$tmpLayoutNotifyData['notifys'] = dbSelectData($con,
		'SELECT *, DATE_FORMAT(deadline_date, ' . $PROG_CONFIG['DATE_FORMAT'] . ') AS deadline_date
		 FROM design_orders WHERE current_status = ? 
		 ORDER BY id * order_priority * sort_priority * error_priority DESC',
		[$PROG_DATA['STATUS_ID_DESIGN']['WAIT']]);

	$tmpLayoutNotifyData['notifyQuantity'] = count($tmpLayoutNotifyData['notifys']);

	if ($tmpLayoutNotifyData['notifyQuantity'] > 0) {
		$tmpLayoutData['notifyQuantity'] += $tmpLayoutNotifyData['notifyQuantity'];
		$tmpLayoutData['notify'] = $tmpLayoutData['notify'] .
			renderTemplate($_SERVER['DOCUMENT_ROOT'] . '/src/templates/notify/design_order_select_designer.php', $tmpLayoutNotifyData);
	}
}

if ($_SESSION['user']['availDepProd']) {

	$tmpLayoutNotifyData['active_tab'] = 'notes';

	$sqlSelect = 'SELECT * FROM production_orders WHERE ';
	$sqlParameters = [];

	foreach ($_SESSION['user']['availDepProd'] as $key => $val) {
		$sqlSelect = $sqlSelect . $val . '_current_status = ? OR ';
		$sqlParameters[] = $PROG_DATA['STATUS_ID_PRODUCTION']['RECEIVED'];
	}
	$sqlSelect = substr($sqlSelect, 0, -3);
	$sqlSelect = $sqlSelect . 'ORDER BY id * order_priority * sort_priority * error_priority DESC';

	$tmpLayoutNotifyData['notifys'] = dbSelectData($con, $sqlSelect, $sqlParameters);

	$tmpLayoutNotifyData['notifyQuantity'] = count($tmpLayoutNotifyData['notifys']);

	if ($tmpLayoutNotifyData['notifyQuantity'] > 0) {
		$tmpLayoutData['notifyQuantity'] += $tmpLayoutNotifyData['notifyQuantity'];
		$tmpLayoutData['notify'] = $tmpLayoutData['notify'] .
			renderTemplate($_SERVER['DOCUMENT_ROOT'] . '/src/templates/notify/production_order_change_status.php', $tmpLayoutNotifyData);
	}
}

if ($_SESSION['user']['auth_production_order_start']) {

	$tmpLayoutNotifyData['active_tab'] = 'notes';

	$tmpLayoutNotifyData['notifys'] = dbSelectData($con,
		'SELECT * 
		 FROM production_orders 
		 WHERE 
		 const_current_status = ? OR 
		 adv_current_status = ? OR 
		 furn_current_status = ? OR 
		 steel_current_status = ? OR 
		 install_current_status = ? OR 
		 supply_current_status = ? 
		 ORDER BY id * order_priority * sort_priority * error_priority DESC',
		[$PROG_DATA['STATUS_ID_PRODUCTION']['WAIT_START'], $PROG_DATA['STATUS_ID_PRODUCTION']['WAIT_START'],
			$PROG_DATA['STATUS_ID_PRODUCTION']['WAIT_START'], $PROG_DATA['STATUS_ID_PRODUCTION']['WAIT_START'],
			$PROG_DATA['STATUS_ID_PRODUCTION']['WAIT_START'], $PROG_DATA['STATUS_ID_PRODUCTION']['WAIT_START']]);

	$tmpLayoutNotifyData['notifyQuantity'] = count($tmpLayoutNotifyData['notifys']);

	if ($tmpLayoutNotifyData['notifyQuantity'] > 0) {
		$tmpLayoutData['notifyQuantity'] += $tmpLayoutNotifyData['notifyQuantity'];
		$tmpLayoutData['notify'] = $tmpLayoutData['notify'] .
			renderTemplate($_SERVER['DOCUMENT_ROOT'] . '/src/templates/notify/production_order_start.php', $tmpLayoutNotifyData);
	}
}

if ($_SESSION['user']['auth_production_order_cancel']) {

	$tmpLayoutNotifyData['active_tab'] = 'notes';

	$tmpLayoutNotifyData['notifys'] = dbSelectData($con,
		'SELECT * 
		 FROM production_orders 
		 WHERE 
		 const_current_status = ? OR 
		 adv_current_status = ? OR 
		 furn_current_status = ? OR 
		 steel_current_status = ? OR 
		 install_current_status = ? OR 
		 supply_current_status = ? 
		 ORDER BY id * order_priority * sort_priority * error_priority DESC',
		[$PROG_DATA['STATUS_ID_PRODUCTION']['WAIT_CANCEL'], $PROG_DATA['STATUS_ID_PRODUCTION']['WAIT_CANCEL'],
			$PROG_DATA['STATUS_ID_PRODUCTION']['WAIT_CANCEL'], $PROG_DATA['STATUS_ID_PRODUCTION']['WAIT_CANCEL'],
			$PROG_DATA['STATUS_ID_PRODUCTION']['WAIT_CANCEL'], $PROG_DATA['STATUS_ID_PRODUCTION']['WAIT_CANCEL']]);

	$tmpLayoutNotifyData['notifyQuantity'] = count($tmpLayoutNotifyData['notifys']);

	if ($tmpLayoutNotifyData['notifyQuantity'] > 0) {
		$tmpLayoutData['notifyQuantity'] += $tmpLayoutNotifyData['notifyQuantity'];
		$tmpLayoutData['notify'] = $tmpLayoutData['notify'] .
			renderTemplate($_SERVER['DOCUMENT_ROOT'] . '/src/templates/notify/production_order_cancel.php', $tmpLayoutNotifyData);
	}
}