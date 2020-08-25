<?php

$navigationListAdmin = [
	'info' => [
		'title' => '<i class="ni ni-air-baloon text-primary"></i><span class="nav-link-text">Инфо</span>',
		'url' => $PROG_CONFIG['HOST'] . '/adm_users.php?action=info',
		'isCaption' => false,
		'isActive' => false,
		'isAvailable' => true
	],
	'usersList' => [
		'title' => '<i class="ni ni-bullet-list-67 text-primary"></i><span class="nav-link-text">Пользователи</span>',
		'url' => $PROG_CONFIG['HOST'] . '/adm_users.php?action=users_list',
		'isCaption' => false,
		'isActive' => false,
		'isAvailable' => true
	],
	'newUserCard' => [
		'title' => '<i class="ni ni-fat-add text-primary"></i><span class="nav-link-text">Создать</span>',
		'url' => $PROG_CONFIG['HOST'] . '/adm_users.php?action=new_user_card',
		'isCaption' => false,
		'isActive' => false,
		'isAvailable' => true
	]
];
