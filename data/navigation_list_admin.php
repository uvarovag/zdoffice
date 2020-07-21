<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/src/include.php');

$navigation_list_admin = [
  [
    'title' => '<i class="ni ni-bullet-list-67 text-primary"></i><span class="nav-link-text">Пользователи</span>',
    'url' => $sys_config['host'] . '/users.php?action=show_list',
    'is_caption' => false,
    'is_active' => false,
    'is_available' => true
  ],
  [
    'title' => '<i class="ni ni-fat-add text-primary"></i><span class="nav-link-text">Добавить</span>',
    'url' => $sys_config['host'] . '/users.php?action=add_user',
    'is_caption' => false,
    'is_active' => false,
    'is_available' => true
  ]
];
