<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/include.php');

$con = mysqli_connect($system_config['bd_host'], $system_config['bd_user'], $system_config['bd_password'], $system_config['bd_name']);

if ($con) {
  mysqli_set_charset($con, "utf8");
} else {
  print('ошибка БД');
  exit();
}


