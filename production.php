<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/src/include.php');

require_once($_SERVER['DOCUMENT_ROOT'] . '/src/session_start.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/data/navigation_list_admin.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/data/navigation_list_user.php');

require_once($_SERVER['DOCUMENT_ROOT'] . '/src/tmp_data.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/src/alert_massage.php');

///////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////

$tmpLayoutData['navList'] = $navigationListUser;

if (isset($_GET['action']) && $_GET['action'] == 'new_order')
{
	$tmpLayoutData['content'] = renderTemplate($_SERVER['DOCUMENT_ROOT'] . '/templates/production/new_order.php', $tmpLayoutContentData);


}
















echo renderTemplate($_SERVER['DOCUMENT_ROOT'] . '/templates/layout.php', $tmpLayoutData);
