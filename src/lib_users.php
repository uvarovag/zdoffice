<?php

function setUserIsBlockVal($con, $progConfig, $userId, $isBlockVal)
{
	$editUserData = [
		'is_block' => $isBlockVal,
		'need_logout' => 1,
		'id' => $userId
	];

	$editUser = dbExecQuery($con, 'UPDATE users SET is_block = ?, need_logout = ? WHERE id = ?', $editUserData);

	if ($editUser)
	{
		header('Location:' . $progConfig['host'] . '/users.php?action=user_info_card&id=' .
			$editUserData['id'] . '&alert_massage=сохранено');
		exit();
	}
	else
	{
		header('Location:' . $progConfig['host'] . '/users.php?action=edit_user_card&id=' .
			$editUserData['id'] . '&error_massage=ошибка');
		exit();
	}
}
