<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/src/include.php');

function render_template($template, $data) {
  $string = '';
  if (file_exists($template)) {
    ob_start();
    require_once($template);
    $string = ob_get_clean();
    return $string;
  } else {
    return $string;
  }
}
