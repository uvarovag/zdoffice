<?php

function setNavListUser($navList, $user, $PROG_DATA) {

	$navList['designOrdersListMy']['url'] =
		$navList['designOrdersListMy']['url'] . '&designer_id=' .
		$user['id'] . '&status=100,200,210,220,230,240,250,260,270,280,290';

	if ($_SESSION['user']['availDepProd'])
		$navList['productionOrdersListMy']['url'] =
			$navList['productionOrdersListMy']['url'] . '&department=' .
			implode(',', $_SESSION['user']['availDepProd']) .
			'&status=100,200,210,220,230,240,250,260,270,280,290';

	if ($user['auth_design_order_new'] === 0)
		unset($navList['designNewOrder']);
	if ($user['auth_design_order_view'] === 0)
		unset($navList['designOrdersList']);
	if ($user['auth_design_order_new'] === 0 && $user['auth_design_order_view'] === 0)
		unset($navList['captionDesign']);

	if ($user['auth_design_order_view'] === 0 ||
		userAvailableDesignTypesArr($user, $PROG_DATA['DESIGN_TYPES']) === false)
		unset($navList['designOrdersListMy']);

	if ($user['auth_production_order_new'] === 0)
		unset($navList['productionNewOrder']);
	if ($user['auth_production_order_view'] === 0)
		unset($navList['productionOrdersList']);
	if ($user['auth_production_order_new'] === 0 && $user['auth_production_order_view'] === 0)
		unset($navList['captionProduction']);

	if ($user['auth_production_order_view'] === 0 ||
		$_SESSION['user']['availDepProd'] == false)
		unset($navList['productionOrdersListMy']);

	return $navList;
}
