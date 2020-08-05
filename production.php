<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/src/include.php');

require_once($_SERVER['DOCUMENT_ROOT'] . '/src/header_session_start.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/data/navigation_list_admin.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/data/navigation_list_user.php');

require_once($_SERVER['DOCUMENT_ROOT'] . '/src/header_tmp_data.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/src/header_alert_massage.php');

///////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////

$tmpLayoutData['navList'] = $navigationListUser;

if (isset($_GET['action']) && $_GET['action'] == 'new_order') {
	$tmpLayoutData['navList']['productionNewOrder']['isActive'] = true;
	$tmpLayoutData['title'] = 'Новая заявка на производство';

	$tmpLayoutData['content'] = renderTemplate($_SERVER['DOCUMENT_ROOT'] . '/templates/production/new_order.php', $tmpLayoutContentData);


}


echo renderTemplate($_SERVER['DOCUMENT_ROOT'] . '/templates/layout.php', $tmpLayoutData);
