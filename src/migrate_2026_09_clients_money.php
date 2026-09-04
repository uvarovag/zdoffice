<?php

// Единый скрипт миграции для модулей «Клиенты» и «Деньги» (план,
// plan_clients_money.md). Три логических шага в одном файле:
//
//   1. Схема — создаёт таблицы clients/money_transactions, добавляет
//      client_id/order_amount в заказы и auth_clients_*/auth_money_* в
//      adm_users. Выполняется один раз (см. guard ниже), безопасно
//      посещать страницу повторно — просто ничего не сделает.
//   2. Бэкафилл — формирует clients из старых client_name/mobile_phone и
//      проставляет client_id в уже существующих заявках. Идемпотентен,
//      можно запускать сколько угодно раз (обрабатывает только строки
//      с client_id IS NULL).
//   3. Очистка (НЕОБРАТИМО) — удаляет ставшие ненужными колонки
//      client_name/mobile_phone/email из design_orders/production_orders.
//      НЕ выполняется по умолчанию — только явным заходом на
//      ?step=cleanup, и только после того, как обе проверки целостности
//      подтвердят, что все заявки привязаны к существующим клиентам.
//      Делать это стоит с выдержкой, когда форма заявки с выбором клиента
//      уже отработала в проде некоторое время без ошибок: после
//      DROP COLUMN откат возможен только из бэкапа БД.

require_once($_SERVER['DOCUMENT_ROOT'] . '/src/include.php');

///////////////////////////////////////////////////////////////////////////////////////////////
// ШАГ 1. СХЕМА

$tablesExistCheck = mysqli_query($con, "SHOW TABLES LIKE 'clients'");

if ($tablesExistCheck && mysqli_num_rows($tablesExistCheck) > 0) {
	echo '<p>Шаг 1 (схема): уже применена ранее, пропускаю.</p>';
} else {
	echo '<h3>Шаг 1: схема</h3>';

	$sql_table_clients = "CREATE TABLE clients (
		id                      INT AUTO_INCREMENT PRIMARY KEY,
		is_deleted              TINYINT DEFAULT 0,
		name                    CHAR(64) NOT NULL,
		mobile_phone            CHAR(32),
		email                   CHAR(64),
		note                    CHAR(255),
		create_user_id          INT,
		create_datetime         DATETIME,
		last_modify_datetime    DATETIME
	)";

	if (mysqli_query($con, $sql_table_clients))
		echo '<p>OK sql_table_clients</p>';
	else
		echo '<p>ERROR sql_table_clients: ' . mysqli_error($con) . '</p>';


	$sql_table_money_transactions = "CREATE TABLE money_transactions (
		id                INT AUTO_INCREMENT PRIMARY KEY,
		is_deleted        TINYINT DEFAULT 0,
		type              TINYINT NOT NULL,
		is_auto           TINYINT DEFAULT 0,
		client_id         INT NULL,
		order_id          INT NULL,
		order_type        INT NULL,
		amount            DECIMAL(14,2) NOT NULL,
		category          CHAR(64),
		comment           CHAR(255),
		user_id           INT NOT NULL,
		create_datetime   DATETIME
	)";

	if (mysqli_query($con, $sql_table_money_transactions))
		echo '<p>OK sql_table_money_transactions</p>';
	else
		echo '<p>ERROR sql_table_money_transactions: ' . mysqli_error($con) . '</p>';


	// связь заявок с клиентом и стоимость заявки — nullable, заполняются постепенно бэкафиллом (шаг 2)
	$alterOrdersStatements = [
		'design_orders add client_id'        => "ALTER TABLE design_orders ADD COLUMN client_id INT NULL",
		'design_orders add order_amount'     => "ALTER TABLE design_orders ADD COLUMN order_amount DECIMAL(14,2) NULL",
		'production_orders add client_id'    => "ALTER TABLE production_orders ADD COLUMN client_id INT NULL",
		'production_orders add order_amount' => "ALTER TABLE production_orders ADD COLUMN order_amount DECIMAL(14,2) NULL",
	];

	foreach ($alterOrdersStatements as $label => $sql) {
		if (mysqli_query($con, $sql))
			echo '<p>OK ' . $label . '</p>';
		else
			echo '<p>ERROR ' . $label . ': ' . mysqli_error($con) . '</p>';
	}


	// права доступа: колонки без DEFAULT, поэтому у уже существующих пользователей они
	// станут NULL — а errorIfAccessDenied() проверяет строго "=== 0", так что NULL == доступ
	// разрешён. Явно проставляем 0 всем существующим пользователям сразу после ALTER, чтобы
	// по умолчанию доступа не было ни у кого.
	$authColumns = [
		'auth_clients_view',
		'auth_clients_new',
		'auth_clients_edit',
		'auth_money_view',
		'auth_money_new',
		'auth_money_delete',
	];

	foreach ($authColumns as $column) {
		if (mysqli_query($con, "ALTER TABLE adm_users ADD COLUMN {$column} TINYINT"))
			echo '<p>OK adm_users add ' . $column . '</p>';
		else
			echo '<p>ERROR adm_users add ' . $column . ': ' . mysqli_error($con) . '</p>';

		if (mysqli_query($con, "UPDATE adm_users SET {$column} = 0 WHERE {$column} IS NULL"))
			echo '<p>OK backfill ' . $column . ' = 0 for existing users</p>';
		else
			echo '<p>ERROR backfill ' . $column . ': ' . mysqli_error($con) . '</p>';
	}
}


///////////////////////////////////////////////////////////////////////////////////////////////
// ШАГ 2. БЭКАФИЛЛ

echo '<h3>Шаг 2: бэкафилл клиентов из старых заявок</h3>';

function backfillClientsForTable($con, $tableName) {

	$rows = dbSelectData($con,
		"SELECT id, client_name, mobile_phone, email FROM {$tableName}
		WHERE client_id IS NULL AND client_name IS NOT NULL AND client_name != ''", []);

	$created = 0;
	$linked = 0;
	$skipped = 0;

	foreach ($rows as $row) {

		$client = dbSelectData($con,
			'SELECT id FROM clients WHERE name = ? AND mobile_phone = ? AND is_deleted = 0',
			[$row['client_name'], $row['mobile_phone']])[0] ?? [];

		$clientId = $client['id'] ?? false;

		if ($clientId === false) {
			$clientId = dbInsertData($con, 'clients', [
				'is_deleted' => 0,
				'name' => $row['client_name'],
				'mobile_phone' => $row['mobile_phone'],
				'email' => $row['email'] ?? '',
				'note' => 'создан автоматически при переносе заявок из ' . $tableName,
				'create_datetime' => date('Y-m-d H:i:s'),
				'last_modify_datetime' => date('Y-m-d H:i:s')
			]);

			if ($clientId === false) {
				$skipped++;
				continue;
			}

			$created++;
		}

		$linkOk = dbExecQuery($con, "UPDATE {$tableName} SET client_id = ? WHERE id = ?", [$clientId, $row['id']]);

		if ($linkOk)
			$linked++;
		else
			$skipped++;
	}

	echo "<p>{$tableName}: найдено без клиента - " . count($rows) .
		", создано новых клиентов - {$created}, привязано заявок - {$linked}, пропущено с ошибкой - {$skipped}</p>";
}

// если колонки client_name уже нет (шаг 3 уже выполнялся раньше) - бэкафиллить нечего,
// пропускаем, иначе запрос к несуществующей колонке уронёт скрипт
$legacyColumnExists = dbSelectData($con,
	"SELECT COUNT(*) as cnt FROM information_schema.COLUMNS
	WHERE TABLE_SCHEMA = DATABASE() AND TABLE_NAME = 'design_orders' AND COLUMN_NAME = 'client_name'", [])[0]['cnt'] ?? 0;

if ($legacyColumnExists) {
	backfillClientsForTable($con, 'design_orders');
	backfillClientsForTable($con, 'production_orders');

	$stillEmptyDesign = dbSelectData($con, "SELECT COUNT(*) as cnt FROM design_orders WHERE client_id IS NULL", [])[0]['cnt'] ?? 0;
	$stillEmptyProduction = dbSelectData($con, "SELECT COUNT(*) as cnt FROM production_orders WHERE client_id IS NULL", [])[0]['cnt'] ?? 0;

	echo "<p>Осталось заявок без client_id: design_orders - {$stillEmptyDesign}, production_orders - {$stillEmptyProduction}</p>";

	if ($stillEmptyDesign > 0 || $stillEmptyProduction > 0) {
		echo '<p><b>Внимание:</b> есть заявки без client_name (пустое поле) — их нужно разобрать вручную, ' .
			'проставив client_id напрямую в БД, до шага очистки (шаг 3).</p>';
	}
} else {
	echo '<p>Колонка client_name уже удалена (шаг 3 уже выполнялся) — бэкафиллить нечего, пропускаю.</p>';
}


///////////////////////////////////////////////////////////////////////////////////////////////
// ШАГ 3. ОЧИСТКА (НЕОБРАТИМО) — только по явному ?step=cleanup

echo '<h3>Шаг 3: очистка legacy-колонок</h3>';

if (isset($_GET['step']) && $_GET['step'] === 'cleanup') {

	if (!$legacyColumnExists) {
		echo '<p>Колонка client_name уже удалена — шаг 3 уже выполнялся, пропускаю.</p>';
	} else {

		function findNotReadyOrders($con, $tableName) {

			$noClientId = dbSelectData($con, "SELECT id FROM {$tableName} WHERE client_id IS NULL", []);

			$brokenClientId = dbSelectData($con,
				"SELECT o.id FROM {$tableName} o LEFT JOIN clients c ON o.client_id = c.id WHERE c.id IS NULL", []);

			return [
				'noClientId' => array_column($noClientId, 'id'),
				'brokenClientId' => array_column($brokenClientId, 'id')
			];
		}

		$designProblems = findNotReadyOrders($con, 'design_orders');
		$productionProblems = findNotReadyOrders($con, 'production_orders');

		$hasProblems =
			count($designProblems['noClientId']) > 0 || count($designProblems['brokenClientId']) > 0 ||
			count($productionProblems['noClientId']) > 0 || count($productionProblems['brokenClientId']) > 0;

		if ($hasProblems) {
			echo '<p><b>Очистка прервана: не все заявки готовы.</b> Ни одна колонка не удалена, ни одна заявка не тронута.</p>';

			if (count($designProblems['noClientId']) > 0)
				echo '<p>design_orders без client_id (id): ' . implode(', ', $designProblems['noClientId']) . '</p>';
			if (count($designProblems['brokenClientId']) > 0)
				echo '<p>design_orders с client_id, ссылающимся на несуществующего клиента (id): ' .
					implode(', ', $designProblems['brokenClientId']) . '</p>';
			if (count($productionProblems['noClientId']) > 0)
				echo '<p>production_orders без client_id (id): ' . implode(', ', $productionProblems['noClientId']) . '</p>';
			if (count($productionProblems['brokenClientId']) > 0)
				echo '<p>production_orders с client_id, ссылающимся на несуществующего клиента (id): ' .
					implode(', ', $productionProblems['brokenClientId']) . '</p>';

			echo '<p>Разберите эти заявки вручную (проставьте им корректный client_id — например, перезапустив ' .
				'этот же скрипт без ?step=cleanup, чтобы досчитать бэкафилл, или отредактировав запись в БД напрямую) ' .
				'и запустите ?step=cleanup снова.</p>';
		} else {

			echo '<p>Обе проверки целостности пройдены — все заявки привязаны к существующим клиентам. Удаляю legacy-колонки.</p>';

			$alterStatements = [
				'design_orders: drop client_name/mobile_phone/email, client_id NOT NULL' =>
					"ALTER TABLE design_orders
						DROP COLUMN client_name, DROP COLUMN mobile_phone, DROP COLUMN email,
						MODIFY client_id INT NOT NULL",
				'production_orders: drop client_name/mobile_phone/email, client_id NOT NULL' =>
					"ALTER TABLE production_orders
						DROP COLUMN client_name, DROP COLUMN mobile_phone, DROP COLUMN email,
						MODIFY client_id INT NOT NULL",
			];

			foreach ($alterStatements as $label => $sql) {
				if (mysqli_query($con, $sql))
					echo '<p>OK ' . $label . '</p>';
				else
					echo '<p>ERROR ' . $label . ': ' . mysqli_error($con) . '</p>';
			}

			echo '<p>Готово.</p>';
		}
	}
} else {
	echo '<p>Не выполняется по умолчанию. Когда форма заявки с выбором клиента отработает в проде ' .
		'некоторое время без ошибок — зайдите на этот же скрипт с <code>?step=cleanup</code>, чтобы ' .
		'необратимо удалить ставшие ненужными колонки client_name/mobile_phone/email.</p>';
}
