<?php

$navigationListUser = [
	'captionDesign' => [
		'title' => 				'Дизайн и проектирование',
		'url' => 					'#',
		'isCaption' => 		true,
		'isActive' => 		false,
		'isAvailable' =>	true
	],
	'designOrdersListMy' => [
		'title' => 				'<i class="ni ni-spaceship text-primary"></i><span class="nav-link-text">Мои заявки</span>',
		'url' => 					$PROG_CONFIG['HOST'] . '/design.php?action=orders_list',
		'isCaption' => 		false,
		'isActive' => 		false,
		'isAvailable' =>	true
	],
	'designOrdersList' => [
		'title' => 				'<i class="ni ni-bullet-list-67 text-primary"></i><span class="nav-link-text">Заявки</span>',
		'url' => 					$PROG_CONFIG['HOST'] . '/design.php?action=orders_list',
		'isCaption' => 		false,
		'isActive' => 		false,
		'isAvailable' =>	true
	],
	'designNewOrder' => [
		'title' => 				'<i class="ni ni-fat-add text-primary"></i><span class="nav-link-text">Создать</span>',
		'url' => 					$PROG_CONFIG['HOST'] . '/design.php?action=new_order_card',
		'isCaption' => 		false,
		'isActive' => 		false,
		'isAvailable' =>	true
	],
	'captionProduction' => [
		'title' => 				'Производство',
		'url' => 					'#',
		'isCaption' => 		true,
		'isActive' => 		false,
		'isAvailable' =>	true
	],
	'productionOrdersListManager' => [
		'title' => 				'<i class="ni ni-atom text-primary"></i><span class="nav-link-text">Мои заявки</span>',
		'url' => 					$PROG_CONFIG['HOST'] . '/production.php?action=orders_list',
		'isCaption' => 		false,
		'isActive' => 		false,
		'isAvailable' =>	true
	],
	'productionOrdersListMy' => [
		'title' => 				'<i class="ni ni-spaceship text-primary"></i><span class="nav-link-text">Мои заявки</span>',
		'url' => 					$PROG_CONFIG['HOST'] . '/production.php?action=orders_list',
		'isCaption' => 		false,
		'isActive' => 		false,
		'isAvailable' =>	true
	],
	'productionOrdersList' => [
		'title' => 				'<i class="ni ni-bullet-list-67 text-primary"></i><span class="nav-link-text">Заявки</span>',
		'url' => 					$PROG_CONFIG['HOST'] . '/production.php?action=orders_list',
		'isCaption' => 		false,
		'isActive' => 		false,
		'isAvailable' =>	true
	],
	'productionNewOrder' => [
		'title' => 				'<i class="ni ni-fat-add text-primary"></i><span class="nav-link-text">Создать</span>',
		'url' => 					$PROG_CONFIG['HOST'] . '/production.php?action=new_order_card',
		'isCaption' => 		false,
		'isActive' => 		false,
		'isAvailable' =>	true
	],
	'captionClients' => [
		'title' => 				'Клиенты',
		'url' => 					'#',
		'isCaption' => 		true,
		'isActive' => 		false,
		'isAvailable' =>	true
	],
	'clientsList' => [
		'title' => 				'<i class="ni ni-bullet-list-67 text-primary"></i><span class="nav-link-text">Клиенты</span>',
		'url' => 					$PROG_CONFIG['HOST'] . '/clients.php?action=clients_list',
		'isCaption' => 		false,
		'isActive' => 		false,
		'isAvailable' =>	true
	],
	'newClientCard' => [
		'title' => 				'<i class="ni ni-fat-add text-primary"></i><span class="nav-link-text">Добавить клиента</span>',
		'url' => 					$PROG_CONFIG['HOST'] . '/clients.php?action=new_client_card',
		'isCaption' => 		false,
		'isActive' => 		false,
		'isAvailable' =>	true
	],
	'captionMoney' => [
		'title' => 				'Деньги',
		'url' => 					'#',
		'isCaption' => 		true,
		'isActive' => 		false,
		'isAvailable' =>	true
	],
	'moneyJournal' => [
		'title' => 				'<i class="ni ni-money-coins text-primary"></i><span class="nav-link-text">Деньги</span>',
		'url' => 					$PROG_CONFIG['HOST'] . '/money.php?action=money_journal',
		'isCaption' => 		false,
		'isActive' => 		false,
		'isAvailable' =>	true
	]
];
