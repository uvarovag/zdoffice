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

						<?php if (isset($data['confirmStartUser']['id'])): ?>
              <tr>
                <td class="px-0">Запустил в работу</td>
                <td class="px-0">
                  <a href="<?= $data['CONFIG']['HOST'] . '/users.php?action=user_info_card&id=' . $data['confirmStartUser']['id']; ?>">
										<?= $data['confirmStartUser']['last_name'] . ' ' . $data['confirmStartUser']['first_name']; ?>
                </td>
              </tr>
						<?php endif; ?>

						<?php if (isset($data['confirmCancelUser']['id'])): ?>
              <tr>
                <td class="px-0">Подтвердил отмену</td>
                <td class="px-0">
                  <a href="<?= $data['CONFIG']['HOST'] . '/users.php?action=user_info_card&id=' . $data['confirmCancelUser']['id']; ?>">
										<?= $data['confirmCancelUser']['last_name'] . ' ' . $data['confirmCancelUser']['first_name']; ?>
                </td>
              </tr>
						<?php endif; ?>

            <tr>
              <td class="px-0">Приоритет</td>
              <td class="px-0"><?= $data['PROG_DATA']['PRIORITY_ORDERS'][$data['order']['order_priority']]['icon'] ?? '???'; ?></td>
            </tr>

						<?php if (($generalStatus = currentGeneralStatus($data['order'], $data['PROG_DATA']['DEPARTAMENTS_LIST'])) !== false): ?>
              <tr>
                <td class="px-0">Стадия</td>
                <td class="px-0"><?= $data['PROG_DATA']['STATUS_LIST_PRODUCTION'][$generalStatus]['icon'] ?? '???'; ?></td>
              </tr>
						<?php endif; ?>

            <tr>
              <td class="px-0">Кол-во</td>
              <td class="px-0"><?= $data['order']['task_quantity']; ?></td>
            </tr>
          </table>
        </div>

        <div class="mb-4">
          <hr>
          <h4 class="mb-4">Описание</h4>
          <p><?= $data['order']['task_text']; ?></p>
        </div>

				<?php if ($data['order']['install_task']): ?>
          <div class="mb-4">
            <hr>
            <h4 class="mb-4">Описание монтажа</h4>
            <p><?= $data['order']['install_task']; ?></p>
          </div>
				<?php endif; ?>

				<?php if ($data['order']['install_address']): ?>
          <div class="mb-4">
            <hr>
            <h4 class="mb-4">Адрес монтажа</h4>
            <p><?= $data['order']['install_address']; ?></p>
          </div>
				<?php endif; ?>

				<?php if ($_SESSION['user']['auth_production_order_change_priority'] &&
					currentMinStatus($data['order'], $data['PROG_DATA']['DEPARTAMENTS_LIST']) !== false &&
					currentMinStatus($data['order'], $data['PROG_DATA']['DEPARTAMENTS_LIST']) < $data['PROG_DATA']['STATUS_ID_PRODUCTION']['DONE']): ?>
          <div class="mb-4">
            <hr>
            <form action="<?= $data['CONFIG']['HOST'] . '/production.php'; ?>" method="POST">
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

				<?php if ($_SESSION['user']['id'] == $data['order']['create_user_id'] &&
					currentMinStatus($data['order'], $data['PROG_DATA']['DEPARTAMENTS_LIST']) !== false &&
					currentMinStatus($data['order'], $data['PROG_DATA']['DEPARTAMENTS_LIST']) < $data['PROG_DATA']['STATUS_ID_PRODUCTION']['DONE']): ?>
          <div class="mb-4 d-inline-block">
            <form class="d-inline-block mr-2" action="<?= $data['CONFIG']['HOST'] . '/production.php'; ?>" method="POST">
              <input type="hidden" name="action" value="change_status">
              <input type="hidden" name="status" value="<?= $data['PROG_DATA']['STATUS_ID_PRODUCTION']['WAIT_CANCEL']; ?>">
              <input type="hidden" name="order_id" value="<?= $data['order']['id']; ?>">
              <input type="hidden" name="department" value="all">
              <input type="hidden" name="redirect_success"
                     value="<?= $data['CONFIG']['HOST'] . '/production.php?action=order_info_card&id=' .
										 $data['order']['id']; ?>">
              <input type="hidden" name="redirect_error"
                     value="<?= $data['CONFIG']['HOST'] . '/production.php?action=order_info_card&id=' .
										 $data['order']['id']; ?>">
              <input class="btn btn-danger" type="submit" value="Запросить отмену">
            </form>
          </div>
				<?php endif; ?>

				<?php if ($_SESSION['user']['auth_production_order_cancel'] &&
					currentGeneralStatus($data['order'], $data['PROG_DATA']['DEPARTAMENTS_LIST']) === $data['PROG_DATA']['STATUS_ID_PRODUCTION']['WAIT_CANCEL']): ?>
          <div class="mb-4 d-inline-block">
            <form class="d-inline-block mr-2" action="<?= $data['CONFIG']['HOST'] . '/production.php'; ?>" method="POST">
              <input type="hidden" name="action" value="change_status">
              <input type="hidden" name="status" value="<?= $data['PROG_DATA']['STATUS_ID_PRODUCTION']['CANCEL']; ?>">
              <input type="hidden" name="order_id" value="<?= $data['order']['id']; ?>">
              <input type="hidden" name="department" value="all">
              <input type="hidden" name="redirect_success"
                     value="<?= $data['CONFIG']['HOST'] . '/production.php?action=order_info_card&id=' .
										 $data['order']['id']; ?>">
              <input type="hidden" name="redirect_error"
                     value="<?= $data['CONFIG']['HOST'] . '/production.php?action=order_info_card&id=' .
										 $data['order']['id']; ?>">
              <input class="btn btn-danger" type="submit" value="Подтвердить отмену">
            </form>
          </div>
				<?php endif; ?>

				<?php if ($_SESSION['user']['auth_production_order_start'] &&
					currentGeneralStatus($data['order'], $data['PROG_DATA']['DEPARTAMENTS_LIST']) === $data['PROG_DATA']['STATUS_ID_PRODUCTION']['WAIT_START']): ?>
          <div class="mb-4 d-inline-block">
            <form class="d-inline-block mr-2" action="<?= $data['CONFIG']['HOST'] . '/production.php'; ?>" method="POST">
              <input type="hidden" name="action" value="change_status">
              <input type="hidden" name="status" value="<?= $data['PROG_DATA']['STATUS_ID_PRODUCTION']['RECEIVED']; ?>">
              <input type="hidden" name="order_id" value="<?= $data['order']['id']; ?>">
              <input type="hidden" name="department" value="all">
              <input type="hidden" name="redirect_success"
                     value="<?= $data['CONFIG']['HOST'] . '/production.php?action=order_info_card&id=' .
										 $data['order']['id']; ?>">
              <input type="hidden" name="redirect_error"
                     value="<?= $data['CONFIG']['HOST'] . '/production.php?action=order_info_card&id=' .
										 $data['order']['id']; ?>">
              <input class="btn btn-primary" type="submit" value="Запустить в работу">
            </form>
          </div>
				<?php endif; ?>


				<?php if ($data['order']['error_priority'] == 2 &&
					currentGeneralStatus($data['order'], $data['PROG_DATA']['DEPARTAMENTS_LIST']) !== false &&
					currentGeneralStatus($data['order'], $data['PROG_DATA']['DEPARTAMENTS_LIST']) < $data['PROG_DATA']['STATUS_ID_PRODUCTION']['DONE']): ?>
          <a href="<?= $data['CONFIG']['HOST'] . '/production.php?' . http_build_query([
						'action' => 'cancel_error',
						'order_id' => $data['order']['id'],
						'redirect_success' => $data['CONFIG']['HOST'] . '/production.php?action=order_info_card&id=' .
							$data['order']['id'],
						'redirect_error' => $data['CONFIG']['HOST'] . '/production.php?action=order_info_card&id=' .
							$data['order']['id']
					]); ?>"
             class="btn btn-primary" role="button" aria-pressed="true">Снять ошибку</a>
				<?php elseif (currentGeneralStatus($data['order'], $data['PROG_DATA']['DEPARTAMENTS_LIST']) !== false &&
					currentGeneralStatus($data['order'], $data['PROG_DATA']['DEPARTAMENTS_LIST']) < $data['PROG_DATA']['STATUS_ID_PRODUCTION']['DONE']): ?>
          <a href="<?= $data['CONFIG']['HOST'] . '/production.php?' . http_build_query([
						'action' => 'add_error',
						'order_id' => $data['order']['id'],
						'redirect_success' => $data['CONFIG']['HOST'] . '/production.php?action=order_info_card&id=' .
							$data['order']['id'],
						'redirect_error' => $data['CONFIG']['HOST'] . '/production.php?action=order_info_card&id=' .
							$data['order']['id']
					]); ?>"
             class="btn btn-primary" role="button" aria-pressed="true">Добавить ошибку</a>
				<?php endif; ?>
      </div>
      <div class="col-12 col-md-6">
        <div class="nav-wrapper">

          <div>
            <ul class="nav nav-pills nav-fill d-flex" id="tabs-icons-text" role="tablist">
              <li class="nav-item">
                <a class="mb-3 nav-link <?= $data['activeTab'] == 'notes' ? 'active' : ''; ?>" id="tabs-icons-text-nots-tab" data-toggle="tab"
                   href="#tabs-icons-text-notes" role="tab"
                   aria-controls="tabs-icons-text-notes" aria-selected="true">Заметки</a>
              </li>
              <li class="nav-item">
                <a class="mb-3 nav-link <?= $data['activeTab'] == 'files' ? 'active' : ''; ?>" id="tabs-icons-text-files-tab" data-toggle="tab"
                   href="#tabs-icons-text-files" role="tab"
                   aria-controls="tabs-icons-text-files" aria-selected="false">Файлы</a>
              </li>

							<?php foreach ($data['PROG_DATA']['DEPARTAMENTS_LIST'] as $depKey => $depVal): ?>
								<?php if ($data['order'][$depKey . '_datetime_status_0']): ?>
                  <li class="nav-item">
                    <a class="mb-3 nav-link <?= $data['activeTab'] == $depKey ? 'active' : ''; ?>" id="tabs-icons-text-<?= $depKey; ?>-tab"
                       data-toggle="tab"
                       href="#tabs-icons-text-<?= $depKey; ?>" role="tab"
                       aria-controls="tabs-icons-text-<?= $depKey; ?>" aria-selected="false"><?= mb_ucfirst($depVal); ?></a>
                  </li>
								<?php endif; ?>
							<?php endforeach; ?>

            </ul>
          </div>

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
															'redirect_success' => $data['CONFIG']['HOST'] . '/production.php?action=order_info_card&active_tab=files&id=' .
																$data['order']['id'],
															'redirect_error' => $data['CONFIG']['HOST'] . '/production.php?action=order_info_card&active_tab=files&id=' .
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
                  <input type="hidden" name="order_type" value="<?= $data['PROG_DATA']['ORDER_TYPES']['PRODUCTION']; ?>">
                  <input type="hidden" name="redirect_success"
                         value="<?= $data['CONFIG']['HOST'] . '/production.php?action=order_info_card&active_tab=files&id=' .
												 $data['order']['id']; ?>">
                  <input type="hidden" name="redirect_error"
                         value="<?= $data['CONFIG']['HOST'] . '/production.php?action=order_info_card&active_tab=files&id=' .
												 $data['order']['id']; ?>">
                  <div class="form-group">
                    <small class="">Комментарий к файлу</small>
                    <input class="form-control" type="text" name="note"
                           maxlength="<?= $data['CONFIG']['MAX_LEN_A']; ?>">
                  </div>
                  <div class="form-group">
                    <input class="file_input" type="file" name="file">
                  </div>
                  <div class="form-group">
                    <input type="submit" class="btn btn-primary file_button" value="Загрузить">
                  </div>
                </form>
              </div>


							<?php foreach ($data['PROG_DATA']['DEPARTAMENTS_LIST'] as $depKey => $depVal): ?>

								<?php if ($data['order'][$depKey . '_datetime_status_0']): ?>
                  <div class="tab-pane fade <?= $data['activeTab'] == $depKey ? 'show active' : ''; ?>" id="tabs-icons-text-<?= $depKey; ?>"
                       role="tabpanel"
                       aria-labelledby="tabs-icons-text-<?= $depKey; ?>-tab">

                    <table class="table table-sm table-borderless mb-4">
                      <tr>
                        <td class="px-0" width="50%">Стадия</td>
                        <td class="px-0"><?= $data['PROG_DATA']['STATUS_LIST_PRODUCTION'][$data['order'][$depKey . '_current_status']]['icon'] ?? '???'; ?></td>
                      </tr>
                      <tr>
                        <td class="px-0">Дедлайн</td>
                        <td class="px-0">
                          <?= deadlineBadge($data['order'][$depKey .'_deadline_date'], $data['CONFIG']['WARNING_DAYS_BEFORE_DEADLINE']); ?>
                        </td>
                      </tr>
                    </table>

										<?php if ($_SESSION['user']['auth_production_order_change_status_' . $depKey] &&
											$data['order'][$depKey . '_current_status'] > $data['PROG_DATA']['STATUS_ID_PRODUCTION']['WAIT_START'] &&
											$data['order'][$depKey . '_current_status'] < $data['PROG_DATA']['STATUS_ID_PRODUCTION']['ISSUED']): ?>
                      <hr>
                      <div class="mb-4">
                        <form action="<?= $data['CONFIG']['HOST'] . '/production.php'; ?>" method="POST">
                          <input type="hidden" name="action" value="change_status">
                          <input type="hidden" name="order_id" value="<?= $data['order']['id']; ?>">
                          <input type="hidden" name="department" value="<?= $depKey; ?>">
                          <input type="hidden" name="redirect_success"
                                 value="<?= $data['CONFIG']['HOST'] . '/production.php?' .
																 http_build_query(['action' => 'order_info_card',
																	 'active_tab' => $depKey,
																	 'id' => $data['order']['id']]); ?>">
                          <input type="hidden" name="redirect_error"
                                 value="<?= $data['CONFIG']['HOST'] . '/production.php?' .
																 http_build_query(['action' => 'order_info_card',
																	 'active_tab' => $depKey,
																	 'id' => $data['order']['id']]); ?>">
                          <small class="text-gray">Изменить стадию</small>
                          <div class="form-row">
                            <div class="form-group col-8">
                              <select name="status" class="form-control" required>
                                <option></option>
																<?php foreach ($data['PROG_DATA']['STATUS_LIST_PRODUCTION'] as $statusKey => $statusVal): ?>
																	<?php if ($statusKey < $data['PROG_DATA']['STATUS_ID_PRODUCTION']['START'] ||
																		$statusKey > $data['PROG_DATA']['STATUS_ID_PRODUCTION']['ISSUED']): continue; ?>
																	<?php endif; ?>
																	<?php if ($statusKey > $data['order'][$depKey . '_current_status']): ?>
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
											<?php foreach ($data['PROG_DATA']['STATUS_LIST_PRODUCTION'] as $statusKey => $statusVal): ?>
												<?php if ($data['order'][$depKey . '_datetime_status_' . $statusKey]): ?>
                          <tr>
                            <td class="px-0" width="50%"><?= $statusVal['name'] ?? '???'; ?></td>
                            <td class="px-0"><?= $data['order'][$depKey . '_datetime_status_' . $statusKey]; ?></td>
                          </tr>
												<?php endif; ?>
											<?php endforeach; ?>
                    </table>
                  </div>
								<?php endif; ?>

							<?php endforeach; ?>

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
