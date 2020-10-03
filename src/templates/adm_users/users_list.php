<div class="card">
  <form class="card-body" action="<?= $data['CONFIG']['HOST'] . '/adm_users.php'; ?>" method="GET">
    <input type="hidden" name="action" value="users_list">
    <div class="form-row">
      <div class="form-group col mb-0">
        <input type="text" class="form-control form-control-sm" name="search"
               value="<?= $data['formData']['search']; ?>" placeholder="фамилия / имя / логин">
      </div>
      <div class="form-group col-3 mb-0">
        <select class="form-control form-control-sm" name="position">
          <option value="any" selected disabled>должность</option>
          <option <?= $data['formData']['position'] == 'any' ? 'selected' : ''; ?>
                  value="any">любая
          </option>
					<?php foreach ($data['PROG_DATA']['USERS_POSITIONS_LIST'] as $positionKey => $positionVal): ?>
            <option <?= $data['formData']['position'] == $positionKey ? 'selected' : ''; ?>
                    value="<?= $positionKey; ?>"><?= $positionVal; ?></option>
					<?php endforeach; ?>
        </select>
      </div>
      <div class="form-group col-2 mb-0">
        <button type="submit" class="btn btn-sm btn-primary btn-block">Найти</button>
      </div>
    </div>
  </form>
</div>
<div class="card">
  <div class="card-header bg-transparent">
    <h2 class="mb-0"><?= $data['title']; ?></h2>
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
        <tr onclick="window.location.href='<?= $data['CONFIG']['HOST'] . '/adm_users.php?action=user_info_card&id=' .
				$user['id']; ?>'; return false">
          <td>
						<?php if ($user['is_block']): ?>
              <b class="text-danger" data-toggle="tooltip" data-placement="top" title="Пользователь заблокирован"><?= $user['login']; ?></b>
						<?php else: ?>
							<?= shortStr($user['login'], $data['CONFIG']['MAX_SYMBOLS_TABLE_CELL']); ?>
						<?php endif; ?>
          </td>
          <td><?= shortStr($user['last_name'] . ' ' . $user['first_name'], $data['CONFIG']['MAX_SYMBOLS_TABLE_CELL']); ?></td>
          <td><?= shortStr($data['PROG_DATA']['USERS_POSITIONS_LIST'][$user['position']] ?? '???', $data['CONFIG']['MAX_SYMBOLS_TABLE_CELL']); ?></td>
          <td><?= $data['CONFIG']['PHONE_PREFIX'] . ' ' . $user['mobile_phone']; ?></td>
          <td><?= shortStr($user['email'], $data['CONFIG']['MAX_SYMBOLS_TABLE_CELL']); ?></td>
          <td><?= $user['reg_datetime']; ?></td>
        </tr>
			<?php endforeach; ?>
      </tbody>
    </table>
  </div>
</div>