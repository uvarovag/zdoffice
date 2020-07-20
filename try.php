<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/include.php');


$sql_table_users = "create table users(
id INT AUTO_INCREMENT PRIMARY KEY,
login CHAR(32),
password CHAR(32),
last_name CHAR(32),
first_name CHAR(32),
position CHAR(32),
mobile_phone CHAR(32),
email CHAR(64),

auth_main_new_req_design TINYINT,
auth_main_new_req_production TINYINT,
auth_main_req_start TINYINT,
auth_main_req_cancel TINYINT,

auth_design_req_select_designer TINYINT,
auth_design_req_view TINYINT,
auth_design_req_change_status TINYINT,
auth_design_req_change_priority TINYINT,

auth_const_req_view TINYINT,
auth_const_req_change_status TINYINT,
auth_const_req_change_priority TINYINT,

auth_adv_req_view TINYINT,
auth_adv_req_change_status TINYINT,
auth_adv_req_change_priority TINYINT,

auth_furn_req_view TINYINT,
auth_furn_req_change_status TINYINT,
auth_furn_req_change_priority TINYINT,

auth_steel_req_view TINYINT,
auth_steel_req_change_status TINYINT,
auth_steel_req_change_priority TINYINT,

auth_install_req_view TINYINT,
auth_install_req_change_status TINYINT,
auth_install_req_change_priority TINYINT,

auth_supply_req_view TINYINT,
auth_supply_req_change_status TINYINT,
auth_supply_req_change_priority TINYINT
)";





$res = mysqli_query($con, $sql_table_users);

var_dump($res);



