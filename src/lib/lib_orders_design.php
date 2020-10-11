<?php

// в каких видах дизайна пользователь может менять стадию заказа
function userAvailableDesignTypesArr($userData, $designTypes) {

	$availableDesignTypes = [];

	foreach ($designTypes as $dKey => $dVal) {
		if (isset($userData['auth_design_order_change_status_' . $dKey]) &&
			$userData['auth_design_order_change_status_' . $dKey])
			$availableDesignTypes[] = $dKey;
	}

	return empty($availableDesignTypes) ? false : $availableDesignTypes;
}


function getDesignersUserData($availableDesignTypesArr, $con, $addSql) {

	$designersUserQuery = 'SELECT * FROM adm_users WHERE ';

	foreach ($availableDesignTypesArr as $dKey => $dVal) {
		$designersUserQuery = $designersUserQuery . "auth_design_order_change_status_{$dKey} = 1 OR ";
	}

	$designersUserQuery = substr($designersUserQuery, 0, -3);
	$designersUserQuery =  $designersUserQuery . $addSql;

	return dbSelectData($con, $designersUserQuery, []);
}