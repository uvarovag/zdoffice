<?php

function setNavListUser($navList, $user) {
	if ($user['auth_design_order_new'] === 0)
		unset($navList['designNewOrder']);
	if ($user['auth_design_order_view'] === 0)
		unset($navList['designOrdersList']);
	if ($user['auth_design_order_new'] === 0 && $user['auth_design_order_view'] === 0)
		unset($navList['captionDesign']);

	if ($user['auth_production_order_new'] === 0)
		unset($navList['productionNewOrder']);
	if ($user['auth_production_order_view'] === 0)
		unset($navList['productionOrdersList']);
	if ($user['auth_production_order_new'] === 0 && $user['auth_production_order_view'] === 0)
		unset($navList['captionProduction']);

	return $navList;
}

//$USER_ADMIN_DATA = [
//	'is_superuser' => 1,
//	'is_deleted' => 0,
//	'is_block' => 0,
//	'need_logout' => 0,
//	'login' => 'black',
//	'password' => 'mimimi',
//	'last_name' => 'admin',
//	'first_name' => 'admin',
//	'position' => 999,
//	'mobile_phone' => '00 000 00 00',
//	'email' => 'dd@ddd.ru',
//	'reg_datetime' => NULL,
//	'last_modify_datetime' => NULL,
//
//	'auth_design_order_new' => 1,
//	'auth_design_order_view' => 1,
//	'auth_design_order_change_status' => 1,
//	'auth_design_order_select_designer' => 1,
//	'auth_design_order_change_priority' => 1,
//
//	'auth_production_order_new' => 1,
//	'auth_production_order_view' => 1,
//	'auth_production_order_change_status_const' => 1,
//	'auth_production_order_change_status_adv' => 1,
//	'auth_production_order_change_status_furn' => 1,
//	'auth_production_order_change_status_steel' => 1,
//	'auth_production_order_change_status_install' => 1,
//	'auth_production_order_change_priority' => 1,
//	'auth_production_order_start' => 1,
//	'auth_production_order_cancel' => 1
//];

//$navigationListUser = [
//	'captionDesign' => [
//		'title' => 'Дизайн',
//		'url' => '#',
//		'isCaption' => true,
//		'isActive' => false,
//		'isAvailable' => true
//	],
//	'designOrdersList' => [
//		'title' => '<i class="ni ni-bullet-list-67 text-primary"></i><span class="nav-link-text">Заявки</span>',
//		'url' => $PROG_CONFIG['HOST'] . '/design.php?action=orders_list',
//		'isCaption' => false,
//		'isActive' => false,
//		'isAvailable' => true
//	],
//	'designNewOrder' => [
//		'title' => '<i class="ni ni-fat-add text-primary"></i><span class="nav-link-text">Создать</span>',
//		'url' => $PROG_CONFIG['HOST'] . '/design.php?action=new_order',
//		'isCaption' => false,
//		'isActive' => false,
//		'isAvailable' => true
//	],
//	'captionProduction' => [
//		'title' => 'Производство',
//		'url' => '#',
//		'isCaption' => true,
//		'isActive' => false,
//		'isAvailable' => true
//	],
//	'productionOrdersList' => [
//		'title' => '<i class="ni ni-bullet-list-67 text-primary"></i><span class="nav-link-text">Заявки</span>',
//		'url' => $PROG_CONFIG['HOST'] . '/production.php?action=orders_list',
//		'isCaption' => false,
//		'isActive' => false,
//		'isAvailable' => true
//	],
//	'productionNewOrder' => [
//		'title' => '<i class="ni ni-fat-add text-primary"></i><span class="nav-link-text">Создать</span>',
//		'url' => $PROG_CONFIG['HOST'] . '/production.php?action=new_order',
//		'isCaption' => false,
//		'isActive' => false,
//		'isAvailable' => true
//	]
//];
