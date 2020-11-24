<?php

function setNavListUser($navList, $user, $PROG_DATA) {

	$navList['designOrdersListMy']['url'] =
		$navList['designOrdersListMy']['url'] . '&designer_id=' .
		$user['id'] . '&status=100,200,210,220,230,240,250,260,270,280,290';

	$navList['designOrdersList']['url'] =
		$navList['designOrdersList']['url'] . '&status=0,100,200,210,220,230,240,250,260,270,280,290';


	$navList['productionOrdersListManager']['url'] =
		"{$navList['productionOrdersListManager']['url']}
			&create_user_id={$_SESSION['user']['id']}
			&status=0,100,200,210,220,230,240,250,260,270,280,290,300";

	$navList['productionOrdersListMy']['url'] =
			$navList['productionOrdersListMy']['url'] . '&department=' .
			implode(',', $_SESSION['user']['availDepProd']) .
			'&status=100,200,210,220,230,240,250,260,270,280,290';

	$navList['productionOrdersList']['url'] =
		$navList['productionOrdersList']['url'] . '&status=0,100,200,210,220,230,240,250,260,270,280,290,300';


	if ($user['auth_design_order_new'] === 0 && $user['auth_design_order_view'] === 0)
		unset($navList['captionDesign']);

	if ($user['auth_design_order_view'] === 0 || userAvailableDesignTypesArr($user, $PROG_DATA['DESIGN_TYPES']) === false)
		unset($navList['designOrdersListMy']);

	if ($user['auth_design_order_view'] === 0)
		unset($navList['designOrdersList']);

	if ($user['auth_design_order_new'] === 0)
		unset($navList['designNewOrder']);


	if ($user['auth_production_order_new'] === 0 && $user['auth_production_order_view'] === 0)
		unset($navList['captionProduction']);

	if ($user['auth_production_order_new'] === 0 || $user['auth_production_order_view'] === 0)
		unset($navList['productionOrdersListManager']);

	if ($user['auth_production_order_view'] === 0 || $_SESSION['user']['availDepProd'] == false)
		unset($navList['productionOrdersListMy']);

	if ($user['auth_production_order_view'] === 0)
		unset($navList['productionOrdersList']);

	if ($user['auth_production_order_new'] === 0)
		unset($navList['productionNewOrder']);


	return $navList;
}
