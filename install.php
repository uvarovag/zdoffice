<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/src/include.php');

//$sql_database = "CREATE DATABASE " + $sysConfig['BD_NAME'];
//
//var_dump(mysqli_query($con, $sql_database));


$sql_table_users = "CREATE TABLE adm_users (
	id 																					INT AUTO_INCREMENT PRIMARY KEY,
	is_deleted 																	TINYINT,
	is_block 																		TINYINT,
	need_logout 																TINYINT,
	login 																			CHAR(64) UNIQUE NOT NULL,
	password 																		CHAR(64) NOT NULL,
	last_name 																	CHAR(64) NOT NULL,
	first_name 																	CHAR(64) NOT NULL,
	position 																		INT,
	mobile_phone 																CHAR(32) NOT NULL,
	email 																			CHAR(64) NOT NULL,
	reg_datetime 																DATETIME,
	last_modify_datetime 												DATETIME,
	
	auth_design_order_new 											TINYINT,
	auth_design_order_view 											TINYINT,
	auth_design_order_change_status 						TINYINT,
	auth_design_order_select_designer 					TINYINT,
	auth_design_order_change_priority 					TINYINT,
	
	auth_production_order_new 									TINYINT,
	auth_production_order_view 									TINYINT,
	auth_production_order_change_status_const 	TINYINT,
	auth_production_order_change_status_adv 		TINYINT,
	auth_production_order_change_status_furn 		TINYINT,
	auth_production_order_change_status_steel		TINYINT,
	auth_production_order_change_status_install TINYINT,
	auth_production_order_change_status_supply 	TINYINT,
	auth_production_order_change_priority 			TINYINT,
	auth_production_order_start 								TINYINT,
	auth_production_order_cancel 								TINYINT
)";
//
//var_dump(mysqli_query($con, $sql_table_users));

$sql_table_design_orders = "CREATE TABLE design_orders (
	id 																					INT AUTO_INCREMENT PRIMARY KEY,
	designer_id 																INT,
	order_name_out															CHAR(32),
	order_name_in 															CHAR(32),
	order_priority 															TINYINT,
	client_name 																CHAR(64),
	mobile_phone 																CHAR(32),
	email 																			CHAR(64),
	task_text 																	TEXT(1000),
	design_format																CHAR(32),
	deadline_date 															DATETIME,
	current_status 															INT,
	datetime_status_000 												DATETIME,
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

//var_dump(mysqli_query($con, $sql_table_design_orders));

$sql_table_users_logs = "CREATE TABLE users_logs (
	id 																					INT AUTO_INCREMENT PRIMARY KEY,
	user_id																			INT NOT NULL,
	log_datetime																DATETIME,
	log_ip																			CHAR(32),
	log_info																		CHAR(32)
)";

var_dump(mysqli_query($con, $sql_table_users_logs));
