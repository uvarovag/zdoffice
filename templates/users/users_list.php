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
        <tr onclick="window.location.href='<?= $data['config']['host'] . '?action=user_info_card&id=' .
        $user['id']?>'; return false" class="<?= ($user['is_block']) ? 'table-danger' : ''?>">
          <td><?= $user['login'] ?></td>
          <td><?= $user['last_name'] . ' ' . $user['first_name'] ?></td>
          <td><?= $user['position'] ?></td>
          <td><?= $user['mobile_phone'] ?></td>
          <td><?= $user['email'] ?></td>
          <td><?= $user['reg_datetime'] ?></td>
        </tr>
      <?php endforeach ?>

      </tbody>
    </table>

  </div>
</div>