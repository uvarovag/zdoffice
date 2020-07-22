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

      <?php foreach ($data['users'] as $users): ?>
        <tr onclick="window.location.href='<?= $data['config']['host'] . '?action=show_user_card&id=' . $users['id']?>'; return false">
          <td><?= $users['login'] ?></td>
          <td><?= $users['last_name'] . ' ' . $users['first_name'] ?></td>
          <td><?= $users['position'] ?></td>
          <td><?= $users['mobile_phone'] ?></td>
          <td><?= $users['email'] ?></td>
          <td><?= $users['reg_datetime'] ?></td>
        </tr>
      <?php endforeach ?>

      </tbody>
    </table>

  </div>
</div>