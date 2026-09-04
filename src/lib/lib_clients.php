<?php

function createNewClient($con, $userId) {

	$newClientData = [
		'is_deleted' => 0,
		'name' => correctFormatUpper($_POST['name']),
		'mobile_phone' => correctFormat($_POST['mobile_phone']),
		'email' => correctFormatLower($_POST['email']),
		'note' => correctFormat($_POST['note']),
		'create_user_id' => $userId,
		'create_datetime' => date('Y-m-d H:i:s'),
		'last_modify_datetime' => date('Y-m-d H:i:s')
	];

	return dbInsertData($con, 'clients', $newClientData);
}

function editClientData($con) {

	$editClientData = [
		'name' => correctFormatUpper($_POST['name']),
		'mobile_phone' => correctFormat($_POST['mobile_phone']),
		'email' => correctFormatLower($_POST['email']),
		'note' => correctFormat($_POST['note']),
		'last_modify_datetime' => date('Y-m-d H:i:s'),
		'id' => $_POST['id']
	];

	return dbExecQuery($con, 'UPDATE clients SET
		name = ?,
		mobile_phone = ?,
		email = ?,
		note = ?,
		last_modify_datetime = ?
		WHERE id = ?', $editClientData);
}

function setClientIsDeletedVal($con, $clientId, $isDeletedVal) {

	$data = [
		'is_deleted' => $isDeletedVal,
		'id' => $clientId
	];

	return dbExecQuery($con, 'UPDATE clients SET is_deleted = ? WHERE id = ?', $data);
}
