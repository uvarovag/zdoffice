<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/src/include.php');

$con = mysqli_connect($sysConfig['bdHost'], $sysConfig['bdUser'],
  $sysConfig['bdPassword'], $sysConfig['bdName']);

if ($con) {
  mysqli_set_charset($con, "utf8");
} else {
  print('ошибка БД');
  exit();
}


