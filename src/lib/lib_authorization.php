<?php

function setNavListUser($navList, $user, $PROG_DATA) {

	$navList['designOrdersListMy']['url'] = $navList['designOrdersListMy']['url'] . '&designer_id=' . $user['id'];
	$navList['productionOrdersListMy']['url'] = $navList['productionOrdersListMy']['url'] . '&department=' .
		(userAvailableDepartmentsArr($user, $PROG_DATA['DEPARTMENTS_LIST'])[0] ?? 'all');

	if ($user['auth_design_order_new'] === 0)
		unset($navList['designNewOrder']);
	if ($user['auth_design_order_view'] === 0)
		unset($navList['designOrdersList']);
	if ($user['auth_design_order_new'] === 0 && $user['auth_design_order_view'] === 0)
		unset($navList['captionDesign']);

	if ($user['auth_design_order_view'] === 0 ||
		$user['auth_design_order_change_status'] === 0)
		unset($navList['designOrdersListMy']);

	if ($user['auth_production_order_new'] === 0)
		unset($navList['productionNewOrder']);
	if ($user['auth_production_order_view'] === 0)
		unset($navList['productionOrdersList']);
	if ($user['auth_production_order_new'] === 0 && $user['auth_production_order_view'] === 0)
		unset($navList['captionProduction']);

	if ($user['auth_production_order_view'] === 0 ||
		userAvailableDepartmentsArr($user, $PROG_DATA['DEPARTMENTS_LIST']) == false)
		unset($navList['productionOrdersListMy']);

	return $navList;
}
