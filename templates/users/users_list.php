<div class="card">
  <div class="card-header bg-transparent">
    <h2 class="mb-0">Пользователи</h2>
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
			<?php foreach ($data['users'] as $user): ?>
        <tr onclick="window.location.href='<?= $data['config']['host'] . '/users.php?action=user_info_card&id=' .
				$user['id']?>'; return false">
					<?php if ($user['is_block']): ?>
            <td><b class="text-danger" data-toggle="tooltip" data-placement="top" title="Пользователь заблокирован"><?= $user['login'] ?></b></td>
					<?php else: ?>
            <td><?= cutStr($user['login'], $data['config']['maxLenTabeCell']) ?></td>
					<?php endif; ?>
          <td><?= cutStr($user['last_name'], $data['config']['maxLenTabeCell']) . ' ' .
            cutStr($user['first_name'], $data['config']['maxLenTabeCell']) ?></td>
          <td><?= cutStr($user['position'], $data['config']['maxLenTabeCell']) ?></td>
          <td><?= cutStr($user['mobile_phone'], $data['config']['maxLenTabeCell']) ?></td>
          <td><?= cutStr($user['email'], $data['config']['maxLenTabeCell']) ?></td>
          <td><?= $user['reg_datetime'] ?></td>
        </tr>
			<?php endforeach ?>
      </tbody>
    </table>
  </div>
</div>