<div class="card">
  <div class="card-header bg-transparent">
    <h2 class="mb-0"><?= $data['title'] ?></h2>
  </div>
  <div class="card-body table-responsive m-0 p-0">
    <table class="table table-hover">
      <thead>
      <tr>
        <th scope="col">Логин</th>
        <th scope="col">Фамилия Имя</th>
        <th scope="col">Должность</th>
        <th scope="col">Телефон</th>
        <th scope="col">Почта</th>
        <th scope="col">Дата регистрации</th>
      </tr>
      </thead>
      <tbody>
			<?php foreach ($data['adm_users'] as $user): ?>
        <tr onclick="window.location.href='<?= $data['config']['HOST'] . '/adm_users.php?action=user_info_card&id=' .
				$user['id'] ?>'; return false">
					<?php if ($user['is_block']): ?>
            <td><b class="text-danger" data-toggle="tooltip" data-placement="top" title="Пользователь заблокирован"><?= $user['login'] ?></b></td>
					<?php else: ?>
            <td><?= sortStr($user['login'], $data['config']['MAX_SYMBOLS_TABLE_CELL']) ?></td>
					<?php endif; ?>
          <td><?= sortStr($user['last_name'] . ' ' . $user['first_name'], $data['config']['MAX_SYMBOLS_TABLE_CELL']) ?></td>
          <td><?= sortStr($data['progData']['USERS_POSITIONS_LIST'][$user['position']] ?? '???', $data['config']['MAX_SYMBOLS_TABLE_CELL']) ?></td>
          <td><?= $data['config']['PHONE_PREFIX'] . ' ' . $user['mobile_phone'] ?></td>
          <td><?= sortStr($user['email'], $data['config']['MAX_SYMBOLS_TABLE_CELL']) ?></td>
          <td><?= $user['reg_datetime'] ?></td>
        </tr>
			<?php endforeach ?>
      </tbody>
    </table>
  </div>
</div>