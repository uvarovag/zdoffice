<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/src/include.php');

$sql_table_users = "CREATE TABLE adm_users (
	id 																							INT AUTO_INCREMENT PRIMARY KEY,
	is_deleted 																			TINYINT,
	is_block 																				TINYINT,
	need_logout 																		TINYINT,
	login 																					CHAR(64) UNIQUE NOT NULL,
	password 																				CHAR(255) NOT NULL,
	last_name 																			CHAR(64) NOT NULL,
	first_name 																			CHAR(64) NOT NULL,
	position 																				INT,
	mobile_phone 																		CHAR(32) NOT NULL,
	email 																					CHAR(64) NOT NULL,
	reg_datetime 																		DATETIME,
	last_modify_datetime 														DATETIME,
	
	auth_design_order_new 													TINYINT,
	auth_design_order_view 													TINYINT,
	auth_design_order_change_status 								TINYINT,
	auth_design_order_select_designer 							TINYINT,
	auth_design_order_change_priority 							TINYINT,
	
	auth_production_order_new 											TINYINT,
	auth_production_order_view 											TINYINT,
	auth_production_order_change_status_adv 				TINYINT,
	auth_production_order_change_status_furn 				TINYINT,
	auth_production_order_change_status_softfurn		TINYINT,
	auth_production_order_change_status_steel				TINYINT,
	auth_production_order_change_status_install 		TINYINT,
	auth_production_order_change_status_supply 			TINYINT,
	auth_production_order_change_priority 					TINYINT,
	auth_production_order_start 										TINYINT,
	auth_production_order_cancel 										TINYINT
)";

if (mysqli_query($con, $sql_table_users))
	echo '<p>OK sql_table_users</p>';
else
	echo '<p>ERROR sql_table_users</p>';


$sql_table_design_orders = "CREATE TABLE design_orders (
	id 																					INT AUTO_INCREMENT PRIMARY KEY,
	designer_id 																INT,
	create_user_id 															INT,
	order_name_out															CHAR(64),
	order_name_in 															CHAR(64),
	order_priority 															TINYINT,
	sort_priority 															TINYINT DEFAULT 2,
	error_priority 															TINYINT DEFAULT 1,
	client_name 																CHAR(64),
	mobile_phone 																CHAR(32),
	email 																			CHAR(64),
	task_text 																	TEXT(1000),
	design_format																CHAR(64),
	deadline_date 															DATETIME,
	current_status 															INT,
	datetime_status_0 													DATETIME,
	datetime_status_100 												DATETIME,
	datetime_status_200 												DATETIME,
	datetime_status_210 												DATETIME,
	datetime_status_220 												DATETIME,
	datetime_status_230 												DATETIME,
	datetime_status_240 												DATETIME,
	datetime_status_250 												DATETIME,
	datetime_status_260 												DATETIME,
	datetime_status_270 												DATETIME,
	datetime_status_280 												DATETIME,
	datetime_status_290 												DATETIME,
	datetime_status_300 												DATETIME,
	datetime_status_999 												DATETIME
)";

if (mysqli_query($con, $sql_table_design_orders))
	echo '<p>OK sql_table_design_orders</p>';
else
	echo '<p>ERROR sql_table_design_order</p>';


$sql_table_production_orders = "CREATE TABLE production_orders (
	id 																					INT AUTO_INCREMENT PRIMARY KEY,
	designer_id 																INT,
	create_user_id 															INT,
	
	confirm_start_user_id 											INT,
	confirm_cancel_user_id 											INT,
	
	order_name_out															CHAR(64),
	order_name_in 															CHAR(64),
	
	order_priority 															TINYINT,
	sort_priority 															TINYINT DEFAULT 2,
	error_priority 															TINYINT DEFAULT 1,
	
	client_name 																CHAR(64),
	mobile_phone 																CHAR(32),
	email 																			CHAR(64),
	
	task_text 																	TEXT(1000),
	task_quantity 															INT,
	
	install_task																TEXT(1000),
	install_address															CHAR(150),	
	
	adv_deadline_date 													DATETIME,
	adv_current_status 													INT,
	adv_status_before_wait_cancel								INT,
	
	adv_datetime_status_0   										DATETIME,
	adv_datetime_status_100 										DATETIME,
	adv_datetime_status_200 										DATETIME,
	adv_datetime_status_210 										DATETIME,
	adv_datetime_status_220 										DATETIME,
	adv_datetime_status_230 										DATETIME,
	adv_datetime_status_240 										DATETIME,
	adv_datetime_status_250 										DATETIME,
	adv_datetime_status_260 										DATETIME,
	adv_datetime_status_270 										DATETIME,
	adv_datetime_status_280 										DATETIME,
	adv_datetime_status_290 										DATETIME,
	adv_datetime_status_300 										DATETIME,
	adv_datetime_status_400 										DATETIME,
	adv_datetime_status_998 										DATETIME,
	adv_datetime_status_999 										DATETIME,
	
	furn_deadline_date 													DATETIME,
	furn_current_status 												INT,
	furn_status_before_wait_cancel							INT,
	
	furn_datetime_status_0   										DATETIME,
	furn_datetime_status_100 										DATETIME,
	furn_datetime_status_200 										DATETIME,
	furn_datetime_status_210 										DATETIME,
	furn_datetime_status_220 										DATETIME,
	furn_datetime_status_230 										DATETIME,
	furn_datetime_status_240 										DATETIME,
	furn_datetime_status_250 										DATETIME,
	furn_datetime_status_260 										DATETIME,
	furn_datetime_status_270 										DATETIME,
	furn_datetime_status_280 										DATETIME,
	furn_datetime_status_290 										DATETIME,
	furn_datetime_status_300 										DATETIME,
	furn_datetime_status_400 										DATETIME,
	furn_datetime_status_998 										DATETIME,
	furn_datetime_status_999 										DATETIME,
	
	softfurn_deadline_date 											DATETIME,
	softfurn_current_status 										INT,
	softfurn_status_before_wait_cancel					INT,
	
	softfurn_datetime_status_0   								DATETIME,
	softfurn_datetime_status_100 								DATETIME,
	softfurn_datetime_status_200 								DATETIME,
	softfurn_datetime_status_210 								DATETIME,
	softfurn_datetime_status_220 								DATETIME,
	softfurn_datetime_status_230 								DATETIME,
	softfurn_datetime_status_240 								DATETIME,
	softfurn_datetime_status_250 								DATETIME,
	softfurn_datetime_status_260 								DATETIME,
	softfurn_datetime_status_270 								DATETIME,
	softfurn_datetime_status_280 								DATETIME,
	softfurn_datetime_status_290 								DATETIME,
	softfurn_datetime_status_300 								DATETIME,
	softfurn_datetime_status_400 								DATETIME,
	softfurn_datetime_status_998 								DATETIME,
	softfurn_datetime_status_999 								DATETIME,
	
	steel_deadline_date 												DATETIME,
	steel_current_status 												INT,
	steel_status_before_wait_cancel							INT,
	
	steel_datetime_status_0   									DATETIME,
	steel_datetime_status_100 									DATETIME,
	steel_datetime_status_200 									DATETIME,
	steel_datetime_status_210 									DATETIME,
	steel_datetime_status_220 									DATETIME,
	steel_datetime_status_230 									DATETIME,
	steel_datetime_status_240 									DATETIME,
	steel_datetime_status_250 									DATETIME,
	steel_datetime_status_260 									DATETIME,
	steel_datetime_status_270 									DATETIME,
	steel_datetime_status_280 									DATETIME,
	steel_datetime_status_290 									DATETIME,
	steel_datetime_status_300 									DATETIME,
	steel_datetime_status_400 									DATETIME,
	steel_datetime_status_998 									DATETIME,
	steel_datetime_status_999 									DATETIME,
	
	install_deadline_date 											DATETIME,
	install_current_status 											INT,
	install_status_before_wait_cancel						INT,
	
	install_datetime_status_0   								DATETIME,
	install_datetime_status_100 								DATETIME,
	install_datetime_status_200 								DATETIME,
	install_datetime_status_210 								DATETIME,
	install_datetime_status_220 								DATETIME,
	install_datetime_status_230 								DATETIME,
	install_datetime_status_240 								DATETIME,
	install_datetime_status_250 								DATETIME,
	install_datetime_status_260 								DATETIME,
	install_datetime_status_270 								DATETIME,
	install_datetime_status_280 								DATETIME,
	install_datetime_status_290 								DATETIME,
	install_datetime_status_300 								DATETIME,
	install_datetime_status_400 								DATETIME,
	install_datetime_status_998 								DATETIME,
	install_datetime_status_999 								DATETIME,
	
	supply_deadline_date 												DATETIME,
	supply_current_status 											INT,
	supply_status_before_wait_cancel						INT,
	
	supply_datetime_status_0   									DATETIME,
	supply_datetime_status_100 									DATETIME,
	supply_datetime_status_200 									DATETIME,
	supply_datetime_status_210 									DATETIME,
	supply_datetime_status_220 									DATETIME,
	supply_datetime_status_230 									DATETIME,
	supply_datetime_status_240 									DATETIME,
	supply_datetime_status_250 									DATETIME,
	supply_datetime_status_260 									DATETIME,
	supply_datetime_status_270 									DATETIME,
	supply_datetime_status_280 									DATETIME,
	supply_datetime_status_290 									DATETIME,
	supply_datetime_status_300 									DATETIME,
	supply_datetime_status_400 									DATETIME,
	supply_datetime_status_998 									DATETIME,
	supply_datetime_status_999 									DATETIME
)";

if (mysqli_query($con, $sql_table_production_orders))
	echo '<p>OK sql_table_production_orders</p>';
else
	echo '<p>ERROR sql_table_production_orders</p>';


$sql_table_users_logs = "CREATE TABLE users_logs (
	id 																					INT AUTO_INCREMENT PRIMARY KEY,
	user_id																			INT NOT NULL,
	log_datetime																DATETIME,
	log_ip																			CHAR(32),
	log_info																		CHAR(64)
)";

if (mysqli_query($con, $sql_table_users_logs))
	echo '<p>OK sql_table_users_logs</p>';
else
	echo '<p>ERROR sql_table_users_logs</p>';


$sql_table_notes = "CREATE TABLE notes (
	id 																					INT AUTO_INCREMENT PRIMARY KEY,
	user_id																			INT NOT NULL,
	order_id																		INT NOT NULL,
	order_type																	INT NOT NULL,
	create_datetime															DATETIME,
	priority																		INT,
	note																				CHAR(150)
)";

if (mysqli_query($con, $sql_table_notes))
	echo '<p>OK sql_table_notes</p>';
else
	echo '<p>ERROR sql_table_notes</p>';

$sql_table_files = "CREATE TABLE files (
	id 																					INT AUTO_INCREMENT PRIMARY KEY,
	is_deleted																	TINYINT,
	user_id																			INT NOT NULL,
	change_datetime															DATETIME,
	order_id																		INT NOT NULL,
	order_type																	INT NOT NULL,
	size																				INT,
	note																				CHAR(64),
	name																				CHAR(64),
	path																				CHAR(128)
)";

if (mysqli_query($con, $sql_table_files))
	echo '<p>OK sql_table_files</p>';
else
	echo '<p>ERROR sql_table_files</p>';
