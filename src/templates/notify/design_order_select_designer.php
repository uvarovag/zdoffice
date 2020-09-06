<div class="px-3 py-3">
  <h4 class="m-0 <?= $data['CONFIG']['TEXT_STYLE']; ?>">Ожидает назначения дизайнера: (<span class=""><?= $data['notifyQuantity']; ?>)</span></h4>
</div>
<?php foreach ($data['notifys'] as $notity): ?>
  <div class="list-group list-group-flush">
    <a href="<?= $data['CONFIG']['HOST'] . '/design.php?action=order_info_card&active_tab=' . $data['active_tab'] . '&id=' . $notity['id']?>" class="list-group-item list-group-item-action">
      <div class="row align-items-center">
        <div class="col">
          <div class="">
            <small>
              Дедлайн:
							<?= deadlineBadge($notity['deadline_date'], $data['CONFIG']['WARNING_DAYS_BEFORE_DEADLINE']); ?>
            </small>
            |
            <small>
              Приоритет:
							<?= $data['PROG_DATA']['PRIORITY_ORDERS'][$notity['order_priority']]['icon'] ?? '???'; ?>
            </small>
          </div>
          <p class="text-sm mb-0"><?= shortStr($notity['task_text'], 50); ?></p>
        </div>
      </div>
    </a>
  </div>
<?php endforeach; ?>