<div class="card">
	<?php if ($data['user']['is_block']): ?>
    <div class="card-header bg-danger">
      <h2 class="mb-0 text-white">Пользователь заблокирован</h2>
    </div>
	<?php else: ?>
    <div class="card-header bg-transparent">
      <h2 class="mb-0"><?= $data['title'] ?></h2>
    </div>
	<?php endif; ?>
  <div class="card-body">
    <div class="row mb-4">
      <div class="col-12 col-md-6">
        <h3 class="mb-4">Данные</h3>
        <table class="table">
          <tr>
            <th class="px-0">Фамилия</th>
            <th class="px-0"><?= $data['user']['last_name'] ?></th>
          </tr>
          <tr>
            <th class="px-0">Имя</th>
            <th class="px-0"><?= $data['user']['first_name'] ?></th>
          </tr>
          <tr>
            <th class="px-0">Должность</th>
            <th class="px-0"><?= $data['progData']['USERS_POSITIONS_LIST'][$data['user']['position']] ?? '???' ?></th>
          </tr>
          <tr>
            <th class="px-0">Телефон</th>
            <th class="px-0"><?= $data['config']['PHONE_PREFIX'] ?>
              </span> <span><?= $data['user']['mobile_phone'] ?></th>
          </tr>
          <tr>
            <th class="px-0">Почта</th>
            <th class="px-0"><?= $data['user']['email'] ?></th>
          </tr>
        </table>
      </div>
    </div>
  </div>
</div>