// <?php
//
// require_once($_SERVER['DOCUMENT_ROOT'] . '/src/include.php');
//
// if (mysqli_query($con, 'ALTER TABLE adm_users CHANGE auth_production_order_change_status_const auth_production_order_change_status_softfurn TINYINT;'))
// 	echo '<p>1 OK - rename production_order_change_status_const</p>';
// if (mysqli_query($con, 'UPDATE adm_users SET auth_production_order_change_status_softfurn = 0'))
// 	echo '<p>2 OK - clean production_order_change_status_const</p>';
//
//
// if (mysqli_query($con, 'ALTER TABLE production_orders CHANGE const_deadline_date softfurn_deadline_date DATETIME;'))
// 	echo '<p>3 OK - rename deadline_date</p>';
// if (mysqli_query($con, 'ALTER TABLE production_orders CHANGE const_current_status softfurn_current_status INT;'))
// 	echo '<p>4 OK - rename current_status</p>';
// if (mysqli_query($con, 'ALTER TABLE production_orders CHANGE const_status_before_wait_cancel softfurn_status_before_wait_cancel INT;'))
// 	echo '<p>5 OK - rename status_before_wait_cancel</p>';
//
//
// if (mysqli_query($con, 'ALTER TABLE production_orders CHANGE const_datetime_status_0 softfurn_datetime_status_0 DATETIME;'))
// 	echo '<p>6 OK - rename status 0</p>';
// if (mysqli_query($con, 'ALTER TABLE production_orders CHANGE const_datetime_status_100 softfurn_datetime_status_100 DATETIME;'))
// 	echo '<p>7 OK - rename status 100</p>';
// if (mysqli_query($con, 'ALTER TABLE production_orders CHANGE const_datetime_status_200 softfurn_datetime_status_200 DATETIME;'))
// 	echo '<p>8 OK - rename status 200</p>';
// if (mysqli_query($con, 'ALTER TABLE production_orders CHANGE const_datetime_status_210 softfurn_datetime_status_210 DATETIME;'))
// 	echo '<p>9 OK - rename status 210</p>';
// if (mysqli_query($con, 'ALTER TABLE production_orders CHANGE const_datetime_status_220 softfurn_datetime_status_220 DATETIME;'))
// 	echo '<p>10 OK - rename status 220</p>';
// if (mysqli_query($con, 'ALTER TABLE production_orders CHANGE const_datetime_status_230 softfurn_datetime_status_230 DATETIME;'))
// 	echo '<p>11 OK - rename status 230</p>';
// if (mysqli_query($con, 'ALTER TABLE production_orders CHANGE const_datetime_status_240 softfurn_datetime_status_240 DATETIME;'))
// 	echo '<p>12 OK - rename status 240</p>';
// if (mysqli_query($con, 'ALTER TABLE production_orders CHANGE const_datetime_status_250 softfurn_datetime_status_250 DATETIME;'))
// 	echo '<p>13 OK - rename status 250</p>';
// if (mysqli_query($con, 'ALTER TABLE production_orders CHANGE const_datetime_status_260 softfurn_datetime_status_260 DATETIME;'))
// 	echo '<p>14 OK - rename status 260</p>';
// if (mysqli_query($con, 'ALTER TABLE production_orders CHANGE const_datetime_status_270 softfurn_datetime_status_270 DATETIME;'))
// 	echo '<p>15 OK - rename status 270</p>';
// if (mysqli_query($con, 'ALTER TABLE production_orders CHANGE const_datetime_status_280 softfurn_datetime_status_280 DATETIME;'))
// 	echo '<p>16 OK - rename status 280</p>';
// if (mysqli_query($con, 'ALTER TABLE production_orders CHANGE const_datetime_status_290 softfurn_datetime_status_290 DATETIME;'))
// 	echo '<p>17 OK - rename status 290</p>';
// if (mysqli_query($con, 'ALTER TABLE production_orders CHANGE const_datetime_status_300 softfurn_datetime_status_300 DATETIME;'))
// 	echo '<p>18 OK - rename status 300</p>';
// if (mysqli_query($con, 'ALTER TABLE production_orders CHANGE const_datetime_status_400 softfurn_datetime_status_400 DATETIME;'))
// 	echo '<p>19 OK - rename status 400</p>';
// if (mysqli_query($con, 'ALTER TABLE production_orders CHANGE const_datetime_status_998 softfurn_datetime_status_998 DATETIME;'))
// 	echo '<p>20 OK - rename status 998</p>';
// if (mysqli_query($con, 'ALTER TABLE production_orders CHANGE const_datetime_status_999 softfurn_datetime_status_999 DATETIME;'))
// 	echo '<p>21 OK - rename status 999</p>';
//
//
// if (mysqli_query($con, 'UPDATE production_orders SET
// 		softfurn_deadline_date = NULL,
// 		softfurn_current_status = NULL,
// 		softfurn_status_before_wait_cancel = NULL,
// 		softfurn_datetime_status_0 = NULL,
// 		softfurn_datetime_status_100 = NULL,
// 		softfurn_datetime_status_200 = NULL,
// 		softfurn_datetime_status_210 = NULL,
// 		softfurn_datetime_status_220 = NULL,
// 		softfurn_datetime_status_230 = NULL,
// 		softfurn_datetime_status_240 = NULL,
// 		softfurn_datetime_status_250 = NULL,
// 		softfurn_datetime_status_260 = NULL,
// 		softfurn_datetime_status_270 = NULL,
// 		softfurn_datetime_status_280 = NULL,
// 		softfurn_datetime_status_290 = NULL,
// 		softfurn_datetime_status_300 = NULL,
// 		softfurn_datetime_status_400 = NULL,
// 		softfurn_datetime_status_998 = NULL,
// 		softfurn_datetime_status_999 = NULL'))
// 	echo '<p>22 OK - clean status</p>';
//
//
// if (mysqli_query($con, 'ALTER TABLE production_orders ADD general_deadline DATETIME AFTER task_quantity'))
// 	echo '<p>23 OK - add general_deadline</p>';
//
// if (mysqli_query($con, 'UPDATE production_orders SET general_deadline = NOW()'))
// 	echo '<p>24 OK - update general_deadline</p>';
//
// if (mysqli_query($con, 'ALTER TABLE production_orders ADD create_datetime DATETIME AFTER general_deadline'))
// 	echo '<p>25 OK - add create_datetime</p>';
//
// if (mysqli_query($con, 'UPDATE production_orders SET create_datetime = NOW()'))
// 	echo '<p>26 OK - update create_datetime</p>';
//
//
// if (mysqli_query($con, 'ALTER TABLE adm_users ADD auth_design_order_change_status_2d TINYINT AFTER auth_design_order_change_status'))
// 	echo '<p>27 OK - add auth_design_order_change_status_2d</p>';
//
// if (mysqli_query($con, 'ALTER TABLE adm_users ADD auth_design_order_change_status_3d TINYINT AFTER auth_design_order_change_status'))
// 	echo '<p>28 OK - add auth_design_order_change_status_3d</p>';
//
// if (mysqli_query($con, 'ALTER TABLE adm_users ADD auth_design_order_change_status_const_furn TINYINT AFTER auth_design_order_change_status'))
// 	echo '<p>29 OK - add auth_design_order_change_status_const_furn</p>';
//
// if (mysqli_query($con, 'ALTER TABLE adm_users ADD auth_design_order_change_status_const_steel TINYINT AFTER auth_design_order_change_status'))
// 	echo '<p>30 OK - add auth_design_order_change_status_const_steel</p>';
//
//
// if (mysqli_query($con, 'UPDATE adm_users SET auth_design_order_change_status_2d = 1, auth_design_order_change_status_3d = 1 WHERE auth_design_order_change_status = 1')) {
// 	echo '<p>31 OK - UPDATE auth_design_order_change_status_2d && auth_design_order_change_status_3d</p>';
// 	if (mysqli_query($con, 'ALTER TABLE adm_users DROP auth_design_order_change_status'))
// 		echo '<p>32 OK - drop auth_design_order_change_status</p>';
// }
//
// if (mysqli_query($con, 'UPDATE design_orders SET design_format = \'3d\''))
// 	echo '<p>33 OK - UPDATE design_orders</p>';





//if (mysqli_query($con, 'alter table production_orders
//    drop softfurn_deadline_date,
//    drop softfurn_current_status,
//    drop softfurn_status_before_wait_cancel,
//    drop softfurn_datetime_status_0,
//    drop softfurn_datetime_status_100,
//    drop softfurn_datetime_status_200,
//    drop softfurn_datetime_status_210,
//    drop softfurn_datetime_status_220,
//    drop softfurn_datetime_status_230,
//    drop softfurn_datetime_status_240,
//    drop softfurn_datetime_status_250,
//    drop softfurn_datetime_status_260,
//    drop softfurn_datetime_status_270,
//    drop softfurn_datetime_status_280,
//    drop softfurn_datetime_status_290,
//    drop softfurn_datetime_status_300,
//    drop softfurn_datetime_status_400,
//    drop softfurn_datetime_status_998,
//    drop softfurn_datetime_status_999'))
//	echo '<p>drop OK</p>';


//if (mysqli_query($con, 'ALTER TABLE production_orders ADD const_datetime_status_999 DATETIME AFTER furn_datetime_status_999'))
//	echo '<p>1 add OK</p>';
//if (mysqli_query($con, 'ALTER TABLE production_orders ADD const_datetime_status_998 DATETIME AFTER furn_datetime_status_999'))
//	echo '<p>2 add OK</p>';
//if (mysqli_query($con, 'ALTER TABLE production_orders ADD const_datetime_status_400 DATETIME AFTER furn_datetime_status_999'))
//	echo '<p>add OK</p>';
//if (mysqli_query($con, 'ALTER TABLE production_orders ADD const_datetime_status_300 DATETIME AFTER furn_datetime_status_999'))
//	echo '<p>add OK</p>';
//if (mysqli_query($con, 'ALTER TABLE production_orders ADD const_datetime_status_290 DATETIME AFTER furn_datetime_status_999'))
//	echo '<p>add OK</p>';
//if (mysqli_query($con, 'ALTER TABLE production_orders ADD const_datetime_status_280 DATETIME AFTER furn_datetime_status_999'))
//	echo '<p>add OK</p>';
//if (mysqli_query($con, 'ALTER TABLE production_orders ADD const_datetime_status_270 DATETIME AFTER furn_datetime_status_999'))
//	echo '<p>add OK</p>';
//if (mysqli_query($con, 'ALTER TABLE production_orders ADD const_datetime_status_260 DATETIME AFTER furn_datetime_status_999'))
//	echo '<p>add OK</p>';
//if (mysqli_query($con, 'ALTER TABLE production_orders ADD const_datetime_status_250 DATETIME AFTER furn_datetime_status_999'))
//	echo '<p>add OK</p>';
//if (mysqli_query($con, 'ALTER TABLE production_orders ADD const_datetime_status_240 DATETIME AFTER furn_datetime_status_999'))
//	echo '<p>add OK</p>';
//if (mysqli_query($con, 'ALTER TABLE production_orders ADD const_datetime_status_230 DATETIME AFTER furn_datetime_status_999'))
//	echo '<p>add OK</p>';
//if (mysqli_query($con, 'ALTER TABLE production_orders ADD const_datetime_status_220 DATETIME AFTER furn_datetime_status_999'))
//	echo '<p>add OK</p>';
//if (mysqli_query($con, 'ALTER TABLE production_orders ADD const_datetime_status_210 DATETIME AFTER furn_datetime_status_999'))
//	echo '<p>add OK</p>';
//if (mysqli_query($con, 'ALTER TABLE production_orders ADD const_datetime_status_200 DATETIME AFTER furn_datetime_status_999'))
//	echo '<p>add OK</p>';
//if (mysqli_query($con, 'ALTER TABLE production_orders ADD const_datetime_status_100 DATETIME AFTER furn_datetime_status_999'))
//	echo '<p>add OK</p>';
//if (mysqli_query($con, 'ALTER TABLE production_orders ADD const_datetime_status_0 DATETIME AFTER furn_datetime_status_999'))
//	echo '<p>add OK</p>';
//
//if (mysqli_query($con, 'ALTER TABLE production_orders ADD const_status_before_wait_cancel INT AFTER furn_datetime_status_999'))
//	echo '<p>add OK</p>';
//if (mysqli_query($con, 'ALTER TABLE production_orders ADD const_current_status INT AFTER furn_datetime_status_999'))
//	echo '<p>add OK</p>';
//if (mysqli_query($con, 'ALTER TABLE production_orders ADD const_deadline_date DATETIME AFTER furn_datetime_status_999'))
//	echo '<p>add OK</p>';





















