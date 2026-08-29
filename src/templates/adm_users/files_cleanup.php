<div class="card">
  <div class="card-header bg-transparent">
    <h2 class="mb-0"><?= $data['title']; ?></h2>
  </div>
  <div class="card-body table-responsive m-0 p-0">
    <table class="table table-hover">
      <thead>
      <tr>
        <th scope="col">Месяц</th>
        <th scope="col">Кол-во файлов</th>
        <th scope="col">Общий размер</th>
        <th scope="col"></th>
      </tr>
      </thead>
      <tbody>
			<?php if (empty($data['filesByMonth'])): ?>
        <tr>
          <td colspan="4">Загруженных файлов нет</td>
        </tr>
			<?php endif; ?>
			<?php foreach ($data['filesByMonth'] as $month): ?>
        <tr>
          <td><?= $month['monthLabel']; ?></td>
          <td><?= $month['filesCount']; ?></td>
          <td><?= round($month['totalSize'] / 1000000, 2); ?> мб</td>
          <td class="text-right">
            <a class="btn btn-sm btn-danger"
               href="<?= $data['CONFIG']['HOST'] . '/adm_users.php?action=files_cleanup_delete&month=' . $month['month']; ?>"
               onclick="return confirm('Удалить все файлы за <?= $month['monthLabel']; ?> (<?= $month['filesCount']; ?> шт.)? Это действие необратимо.');">
              Удалить
            </a>
          </td>
        </tr>
			<?php endforeach; ?>
      </tbody>
    </table>
  </div>
</div>
