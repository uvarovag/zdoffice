<div class="card">
  <form class="card-body" action="<?= $data['CONFIG']['HOST'] . '/clients.php'; ?>" method="GET">
    <input type="hidden" name="action" value="clients_list">
    <div class="form-row">
      <div class="form-group col mb-0">
        <input type="text" class="form-control form-control-sm" name="search"
               value="<?= $data['formData']['search']; ?>" placeholder="имя / телефон">
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
        <th scope="col">Имя</th>
        <th scope="col">Телефон</th>
        <th scope="col">Почта</th>
      </tr>
      </thead>
      <tbody>
			<?php foreach ($data['clients'] as $client): ?>
        <tr onclick="window.location.href='<?= $data['CONFIG']['HOST'] . '/clients.php?action=client_info_card&id=' .
					$client['id']; ?>'; return false">
          <td><?= shortStr($client['name'], $data['CONFIG']['MAX_SYMBOLS_TABLE_CELL']); ?></td>
          <td><?= $data['CONFIG']['PHONE_PREFIX'] . ' ' . $client['mobile_phone']; ?></td>
          <td><?= shortStr($client['email'], $data['CONFIG']['MAX_SYMBOLS_TABLE_CELL']); ?></td>
        </tr>
			<?php endforeach; ?>
      </tbody>
    </table>
  </div>
</div>
