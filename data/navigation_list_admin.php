<?php

$navigationListAdmin = [
  'usersList' => [
    'title' => '<i class="ni ni-bullet-list-67 text-primary"></i><span class="nav-link-text">Пользователи</span>',
    'url' => $progConfig['host'] . '/users.php?action=users_list',
    'isCaption' => false,
    'isActive' => false,
    'isAvailable' => true
  ],
  'newUserCard' => [
    'title' => '<i class="ni ni-fat-add text-primary"></i><span class="nav-link-text">Создать</span>',
    'url' => $progConfig['host'] . '/users.php?action=new_user_card',
    'isCaption' => false,
    'isActive' => false,
    'isAvailable' => true
  ]
];
