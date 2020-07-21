<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/src/include.php');

$con = mysqli_connect($sys_config['bd_host'], $sys_config['bd_user'],
  $sys_config['bd_password'], $sys_config['bd_name']);

if ($con) {
  mysqli_set_charset($con, "utf8");
} else {
  print('ошибка БД');
  exit();
}


