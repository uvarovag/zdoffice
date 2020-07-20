<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/include.php');

$sql_table_users = "create table users(
id INT AUTO_INCREMENT PRIMARY KEY,
login CHAR(32) NOT NULL,
password CHAR(32) NOT NULL,
last_name CHAR(32) NOT NULL,
first_name CHAR(32) NOT NULL,
position CHAR(32) NOT NULL,
mobile_phone CHAR(32) NOT NULL,
email CHAR(64) NOT NULL,
reg_datetime DATETIME,
last_modify_datetime DATETIME,

auth_design_order_new TINYINT,
auth_design_order_view TINYINT,
auth_design_order_change_status TINYINT,
auth_design_order_select_designer TINYINT,
auth_design_order_change_priority TINYINT,

auth_production_order_new TINYINT,
auth_production_order_view TINYINT,
auth_production_order_change_status_const TINYINT,
auth_production_order_change_status_adv TINYINT,
auth_production_order_change_status_furn TINYINT,
auth_production_order_change_status_steel TINYINT,
auth_production_order_change_status_install TINYINT,
auth_production_order_change_status_supply TINYINT,
auth_production_order_change_priority TINYINT,
auth_production_order_start TINYINT,
auth_production_order_cancel TINYINT
)";

var_dump(mysqli_query($con, $sql_table_users));
