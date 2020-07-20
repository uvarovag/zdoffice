<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/include.php');

/**
 * Создает подготовленное выражение на основе готового SQL запроса и переданных данных
 *
 * @param $link mysqli Ресурс соединения
 * @param $sql string SQL запрос с плейсхолдерами вместо значений
 * @param array $data Данные для вставки на место плейсхолдеров
 *
 * @return mysqli_stmt Подготовленное выражение
 */
function dbGetPrepareStmt($link, $sql, $data = []) {
  $stmt = mysqli_prepare($link, $sql);

  if ($data) {
    $types = '';
    $stmt_data = [];

    foreach ($data as $value) {
      $type = null;

      if (is_int($value)) {
        $type = 'i';
      } else if (is_string($value)) {
        $type = 's';
      } else if (is_double($value)) {
        $type = 'd';
      }

      if ($type) {
        $types .= $type;
        $stmt_data[] = $value;
      }
    }

    $values = array_merge([$stmt, $types], $stmt_data);

    $func = 'mysqli_stmt_bind_param';
    $func(...$values);
  }

  return $stmt;
}


function dbSelectData($con, $sql, $data) {
  $rows = [];

  $stmt = dbGetPrepareStmt($con, $sql, $data);

  if ($stmt) {
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    if ($result) {
      $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
    }
  }

  return $rows;
}


function dbInsertData($con, $table, $data) {
  $last_insert_id = false;

  if (count($data) > 0) {
    $data_fields = [];
    $data_value = [];

    foreach ($data as $key => $value) {
      $data_fields[] = $key;
      $data_value[] = '?';
    }

    $sql = 'INSERT INTO ' . $table . ' (' . implode(', ', $data_fields) . ') VALUES (' . implode(', ', $data_value) . ')';

    $stmt = dbGetPrepareStmt($con, $sql, $data);

    if ($stmt) {
      mysqli_stmt_execute($stmt);
      $last_insert_id = mysqli_insert_id($con);
    }
  }

  return $last_insert_id;
}


function dbExecQuery($con, $sql, $data) {
  $rows = false;

  $stmt = dbGetPrepareStmt($con, $sql, $data);

  if ($stmt) {
    mysqli_stmt_execute($stmt);
    if (mysqli_affected_rows($con)) {
      $rows = true;
    }
  }

  return $rows;
}
