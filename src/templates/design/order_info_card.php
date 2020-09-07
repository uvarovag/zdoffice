<div class="card">
	<?php if ($data['order']['error_priority'] == 2): ?>
    <div class="card-header bg-danger">
      <h2 class="mb-0 text-white"><?= $data['title']; ?></h2>
    </div>
	<?php else: ?>
    <div class="card-header">
      <h2 class="mb-0"><?= $data['title']; ?></h2>
    </div>
	<?php endif; ?>
  <div class="card-body">
    <div class="row">
      <div class="col-12 col-md-6">
        <div class="mb-4">
          <h4 class="mb-4">Данные контрагента</h4>
          <table class="table">
            <tr>
              <td class="px-0" width="40%">Контрагент</td>
              <td class="px-0"><?= $data['order']['client_name']; ?></td>
            </tr>
            <tr>
              <td class="px-0">Телефон</td>
              <td class="px-0"><?= $data['CONFIG']['PHONE_PREFIX']; ?> <?= $data['order']['mobile_phone']; ?></td>
            </tr>
            <tr>
              <td class="px-0">Почта</td>
              <td class="px-0"><?= $data['order']['email']; ?></td>
            </tr>
          </table>
        </div>

        <div class="mb-4">
          <hr>
          <h4 class="mb-4">Данные заказа</h4>
          <table class="table">
            <tr>
              <td class="px-0">ID</td>
              <td class="px-0"><?= $data['order']['order_name_in']; ?></td>
            </tr>
            <tr>
              <td class="px-0" width="40%">Счет бонсенс</td>
              <td class="px-0"><?= $data['order']['order_name_out']; ?></td>
            </tr>
            <tr>
              <td class="px-0">Менеджер</td>
              <td class="px-0">
								<?php if (isset($data['createUser']['id'])): ?>
                <a href="<?= $data['CONFIG']['HOST'] . '/users.php?action=user_info_card&id=' . $data['createUser']['id']; ?>">
									<?= $data['createUser']['last_name'] . ' ' . $data['createUser']['first_name']; ?>
									<?php else: ?>
                    не назначен
									<?php endif; ?>
              </td>
            </tr>
            <tr>
              <td class="px-0">Дизайнер</td>
              <td class="px-0">
								<?php if (isset($data['designer']['id'])): ?>
                <a href="<?= $data['CONFIG']['HOST'] . '/users.php?action=user_info_card&id=' . $data['designer']['id']; ?>">
									<?= $data['designer']['last_name'] . ' ' . $data['designer']['first_name']; ?>
									<?php else: ?>
                    не назначен
									<?php endif; ?>
              </td>
            </tr>
            <tr>
              <td class="px-0">Приоритет</td>
              <td class="px-0"><?= $data['PROG_DATA']['PRIORITY_ORDERS'][$data['order']['order_priority']]['icon'] ?? '???'; ?></td>
            </tr>
            <tr>
              <td class="px-0">Стадия</td>
              <td class="px-0"><?= $data['PROG_DATA']['STATUS_LIST_DESIGN'][$data['order']['current_status']]['icon'] ?? '???'; ?></td>
            </tr>
            <tr>
              <td class="px-0">Дедлайн</td>
              <td class="px-0">
								<?= deadlineBadge($data['order']['deadline_date'], $data['CONFIG']['WARNING_DAYS_BEFORE_DEADLINE']); ?>
              </td>
            </tr>
            <tr>
              <td class="px-0">Формат</td>
              <td class="px-0"><?= $data['order']['design_format']; ?></td>
            </tr>
          </table>
        </div>

        <div class="mb-4">
          <hr>
          <h4 class="mb-4">Описание</h4>
          <p><?= $data['order']['task_text']; ?></p>
        </div>

				<?php if ($data['order']['current_status'] < $data['PROG_DATA']['STATUS_ID_DESIGN']['DONE'] &&
					$_SESSION['user']['auth_design_order_select_designer']): ?>
          <div class="mb-4">
            <hr>
            <form action="<?= $data['CONFIG']['HOST'] . '/design.php'; ?>" method="POST">
              <input type="hidden" name="action" value="change_designer">
              <input type="hidden" name="order_id" value="<?= $data['order']['id']; ?>">
              <small>Назначить дизайнера</small>
              <div class="form-row">
                <div class="m-0 form-group col-8">
                  <select name="designer_id" class="form-control" required>
                    <option></option>
										<?php foreach ($data['designers'] as $designer): ?>
											<?php if ($designer['id'] !== $data['order']['designer_id']): ?>
                        <option value="<?= $designer['id']; ?>"><?= $designer['last_name'] . ' ' . $designer['first_name']; ?></option>
											<?php endif; ?>
										<?php endforeach; ?>
                  </select>
                </div>
                <div class="m-0 form-group col-4">
                  <input class="btn btn-primary" type="submit" value="Сохранить">
                </div>
              </div>
            </form>
          </div>
				<?php endif; ?>

				<?php if ($data['order']['current_status'] < $data['PROG_DATA']['STATUS_ID_DESIGN']['DONE'] &&
					$_SESSION['user']['auth_design_order_change_priority']): ?>
          <div class="mb-4">
            <hr>
            <form action="<?= $data['CONFIG']['HOST'] . '/design.php'; ?>" method="POST">
              <input type="hidden" name="action" value="change_priority">
              <input type="hidden" name="order_id" value="<?= $data['order']['id']; ?>">
              <small>Изменить приоритет</small>
              <div class="form-row">
                <div class="m-0 form-group col-8">
                  <select name="priority" class="form-control" required>
                    <option></option>
										<?php foreach ($data['PROG_DATA']['PRIORITY_ORDERS'] as $priorityKey => $priorityVal): ?>
											<?php if ($priorityKey === $data['order']['order_priority']): ?>
                        <option value="<?= $priorityKey; ?>" selected><?= $priorityVal['name']; ?></option>
											<?php else: ?>
                        <option value="<?= $priorityKey; ?>"><?= $priorityVal['name']; ?></option>
											<?php endif; ?>
										<?php endforeach; ?>
                  </select>
                </div>
                <div class="form-group col-4">
                  <input class="btn btn-primary" type="submit" value="Сохранить">
                </div>
              </div>
            </form>
          </div>
				<?php endif; ?>

				<?php if ($data['order']['current_status'] < $data['PROG_DATA']['STATUS_ID_DESIGN']['DONE'] &&
					$_SESSION['user']['id'] == $data['order']['create_user_id']): ?>
          <div class="mb-4 d-inline-block">
            <form class="d-inline-block mr-2" action="<?= $data['CONFIG']['HOST'] . '/design.php'; ?>" method="POST">
              <input type="hidden" name="redirect_success" value="<?= $data['CONFIG']['HOST'] .
              '/design.php?action=order_info_card&id=' . $data['order']['id']; ?>">
              <input type="hidden" name="redirect_error" value="<?= $data['CONFIG']['HOST'] .
              '/design.php?action=order_info_card&id=' . $data['order']['id']; ?>">
              <input type="hidden" name="action" value="change_status">
              <input type="hidden" name="status" value="999">
              <input type="hidden" name="order_id" value="<?= $data['order']['id']; ?>">
              <input class="btn btn-danger" type="submit" value="Отменить">
            </form>
          </div>
				<?php endif; ?>
				<?php if ($data['order']['current_status'] < $data['PROG_DATA']['STATUS_ID_DESIGN']['DONE'] &&
					$data['order']['error_priority'] == 2): ?>
          <a href="<?= $data['CONFIG']['HOST'] . '/design.php?' . http_build_query([
						'action' => 'cancel_error',
						'order_id' => $data['order']['id'],
						'redirect_success' => $data['CONFIG']['HOST'] . '/design.php?action=order_info_card&id=' .
							$data['order']['id'],
						'redirect_error' => $data['CONFIG']['HOST'] . '/design.php?action=order_info_card&id=' .
							$data['order']['id']
					]); ?>"
             class="btn btn-primary" role="button" aria-pressed="true">Снять ошибку</a>
				<?php elseif ($data['order']['current_status'] < $data['PROG_DATA']['STATUS_ID_DESIGN']['DONE']): ?>
          <a href="<?= $data['CONFIG']['HOST'] . '/design.php?' . http_build_query([
						'action' => 'add_error',
						'order_id' => $data['order']['id'],
						'redirect_success' => $data['CONFIG']['HOST'] . '/design.php?action=order_info_card&id=' .
							$data['order']['id'],
						'redirect_error' => $data['CONFIG']['HOST'] . '/design.php?action=order_info_card&id=' .
							$data['order']['id']
					]); ?>"
             class="btn btn-primary" role="button" aria-pressed="true">Добавить ошибку</a>
				<?php endif; ?>
      </div>
      <div class="col-12 col-md-6">
        <div class="nav-wrapper">
          <ul class="nav nav-pills nav-fill flex-column flex-md-row" id="tabs-icons-text" role="tablist">
            <li class="nav-item">
              <a class="mb-3 nav-link mb-sm-3 mb-md-0 <?= $data['activeTab'] == 'notes' ? 'active' : ''; ?>" id="tabs-icons-text-notes-tab" data-toggle="tab"
                 href="#tabs-icons-text-notes" role="tab"
                 aria-controls="tabs-icons-text-notes" aria-selected="true">Заметки</a>
            </li>
            <li class="nav-item">
              <a class="mb-3 nav-link mb-sm-3 mb-md-0 <?= $data['activeTab'] == 'files' ? 'active' : ''; ?>" id="tabs-icons-text-files-tab" data-toggle="tab"
                 href="#tabs-icons-text-files" role="tab"
                 aria-controls="tabs-icons-text-files" aria-selected="false">Файлы</a>
            </li>
            <li class="mb-3 nav-item">
              <a class="nav-link mb-sm-3 mb-md-0 <?= $data['activeTab'] == 'designer' ? 'active' : ''; ?>" id="tabs-icons-text-designer-tab" data-toggle="tab"
                 href="#tabs-icons-text-designer" role="tab"
                 aria-controls="tabs-icons-text-designer" aria-selected="false">Дизайнер</a>
            </li>
          </ul>
        </div>
        <div class="card shadow">
          <div class="card-body">
            <div class="tab-content" id="">

              <div class="tab-pane fade <?= $data['activeTab'] == 'notes' ? 'show active' : ''; ?>" id="tabs-icons-text-notes" role="tabpanel"
                   aria-labelledby="tabs-icons-text-notes-tab">
								<?php foreach ($data['notes'] as $note): ?>
                  <div class="mb-4">
                    <p class="m-0"><?= $note['note']; ?></p>
                    <h6 class="text-gray m-0 p-0">
											<?= $data['PROG_DATA']['PRIORITY_ORDERS'][$note['priority']]['icon'] ?? '???'; ?>
                      <a class="text-primary" href="<?= $data['CONFIG']['HOST'] . '/users.php?action=user_info_card&id=' . $note['user_id']; ?>">
												<?= $note['last_name'] . ' ' . $note['first_name']; ?> </a> <span><?= $note['create_datetime']; ?></span>
                    </h6>
                  </div>
								<?php endforeach; ?>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                  Написать
                </button>
              </div>

              <div class="tab-pane fade <?= $data['activeTab'] == 'files' ? 'show active' : ''; ?>" id="tabs-icons-text-files" role="tabpanel"
                   aria-labelledby="tabs-icons-text-files-tab">
                <ul class="navbar-nav mb-4">
									<?php foreach ($data['files'] as $file): ?>
                    <li class="nav-item dropdown mb-3">
                      <p class="m-0"><?= $file['note']; ?></p>
											<?php if ($file['is_deleted']): ?>
                        <span class=""><?= $file['name']; ?></span>
                        <h6>
                          <span class="badge badge-pill badge-danger">удалено</span>
                          <a class="text-primary" href="<?= $data['CONFIG']['HOST'] . '/users.php?action=user_info_card&id=' .
													$file['user_id']; ?>">
														<?= $file['last_name'] . ' ' . $file['first_name']; ?> </a> <span><?= $file['change_datetime']; ?></span>
                        </h6>
											<?php else: ?>
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true"
                           aria-expanded="false">
													<?= $file['name']; ?>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                          <a class="dropdown-item" target="_blank" href="<?= $data['CONFIG']['HOST'] . $file['path']; ?>">Загрузить</a>
													<?php if ($_SESSION['user']['id'] == $file['user_id']): ?>
                            <a class="dropdown-item text-danger" href="<?= $data['CONFIG']['HOST'] . '/files.php?' .
														http_build_query(['action' => 'del_file', 'id' => $file['id'],
															'redirect_success' => $data['CONFIG']['HOST'] . '/design.php?action=order_info_card&active_tab=files&id=' .
																$data['order']['id'],
															'redirect_error' => $data['CONFIG']['HOST'] . '/design.php?action=order_info_card&active_tab=files&id=' .
																$data['order']['id']]); ?>">Удалить</a>
													<?php endif; ?>
                        </div>
                        <h6>
                          <a class="text-primary" href="<?= $data['CONFIG']['HOST'] . '/users.php?action=user_info_card&id=' .
													$file['user_id']; ?>">
														<?= $file['last_name'] . ' ' . $file['first_name']; ?> </a> <span><?= $file['change_datetime']; ?></span>
                        </h6>
											<?php endif; ?>
                    </li>
									<?php endforeach; ?>
                </ul>
                <form action="<?= $data['CONFIG']['HOST'] . '/files.php'; ?>" enctype="multipart/form-data" method="POST">
                  <input type="hidden" name="action" value="upl_file">
                  <input type="hidden" name="form_id" value="<?= $data['formId']; ?>">
                  <input type="hidden" name="order_id" value="<?= $data['order']['id']; ?>">
                  <input type="hidden" name="order_type" value="<?= $data['PROG_DATA']['ORDER_TYPES']['DESIGN']; ?>">
                  <input type="hidden" name="redirect_success"
                         value="<?= $data['CONFIG']['HOST'] . '/design.php?action=order_info_card&active_tab=files&id=' .
												 $data['order']['id']; ?>">
                  <input type="hidden" name="redirect_error"
                         value="<?= $data['CONFIG']['HOST'] . '/design.php?action=order_info_card&active_tab=files&id=' .
												 $data['order']['id']; ?>">
                  <div class="form-group">
                    <small class="">Комментарий к файлу</small>
                    <input class="form-control" type="text" name="note"
                           maxlength="<?= $data['CONFIG']['MAX_LEN_A']; ?>">
                  </div>
                  <div class="form-group">
                    <input type="file" name="file">
                  </div>
                  <div class="form-group">
                    <input type="submit" class="btn btn-primary" value="Загрузить">
                  </div>
                </form>
              </div>

              <div class="tab-pane fade <?= $data['activeTab'] == 'designer' ? 'show active' : ''; ?>" id="tabs-icons-text-designer" role="tabpanel" aria-labelledby="tabs-icons-text-designer-tab">

                <table class="table table-sm table-borderless mb-4">
                  <tr>
                    <td class="px-0" width="50%">Стадия</td>
                    <td class="px-0"><?= $data['PROG_DATA']['STATUS_LIST_DESIGN'][$data['order']['current_status']]['icon'] ?? '???'; ?></td>
                  </tr>
                  <tr>
                    <td class="px-0">Дедлайн</td>
                    <td class="px-0">
                      <?= deadlineBadge($data['order']['deadline_date'], $data['CONFIG']['WARNING_DAYS_BEFORE_DEADLINE']); ?>
                    </td>
                  </tr>
                </table>

								<?php if ($data['order']['current_status'] >= $data['PROG_DATA']['STATUS_ID_DESIGN']['RECEIVED'] &&
									$data['order']['current_status'] < $data['PROG_DATA']['STATUS_ID_DESIGN']['DONE'] &&
									$_SESSION['user']['auth_design_order_change_status'] &&
									$data['order']['designer_id'] == $_SESSION['user']['id']): ?>
                <hr>
                  <div class="mb-4">
                    <form action="<?= $data['CONFIG']['HOST'] . '/design.php'; ?>" method="POST">
                      <input type="hidden" name="action" value="change_status">
                      <input type="hidden" name="order_id" value="<?= $data['order']['id']; ?>">
                      <input type="hidden" name="redirect_success"
                             value="<?= $data['CONFIG']['HOST'] . '/design.php?' .
														 http_build_query(['action' => 'order_info_card',
															 'active_tab' => 'designer',
															 'id' => $data['order']['id']]); ?>">
                      <input type="hidden" name="redirect_error"
                             value="<?= $data['CONFIG']['HOST'] . '/design.php?' .
														 http_build_query(['action' => 'order_info_card',
															 'active_tab' => 'designer',
															 'id' => $data['order']['id']]); ?>">
                      <small class="text-gray">Изменить стадию</small>
                      <div class="form-row">
                        <div class="form-group col-8">
                          <select name="status" class="form-control" required>
                            <option></option>
														<?php foreach ($data['PROG_DATA']['STATUS_LIST_DESIGN'] as $statusKey => $statusVal): ?>
															<?php if ($statusKey < $data['PROG_DATA']['STATUS_ID_DESIGN']['START'] ||
																$statusKey > $data['PROG_DATA']['STATUS_ID_DESIGN']['DONE']): continue; ?>
															<?php endif; ?>
															<?php if ($statusKey > $data['order']['current_status']): ?>
                                <option value="<?= $statusKey; ?>"><?= $statusVal['name']; ?></option>
															<?php endif; ?>
														<?php endforeach; ?>
                          </select>
                        </div>
                        <div class="m-0 form-group col-4">
                          <input class="btn btn-primary" type="submit" value="Сохранить">
                        </div>
                      </div>
                    </form>
                  </div>
								<?php endif; ?>

                <table class="table table-sm">
									<?php foreach ($data['PROG_DATA']['STATUS_LIST_DESIGN'] as $statusKey => $statusVal): ?>
                  <?php if ($data['order']['datetime_status_' . $statusKey]): ?>
                    <tr>
                      <td class="px-0" width="50%"><?= $statusVal['name'] ?? '???'; ?></td>
                      <td class="px-0"><?= $data['order']['datetime_status_' . $statusKey]; ?></td>
                    </tr>
                  <?php endif; ?>
									<?php endforeach; ?>
                </table>
              </div>

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>