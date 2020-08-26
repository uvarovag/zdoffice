<div class="card">
	<?php if ($data['order']['error_priority'] == 2): ?>
    <div class="card-header bg-danger">
      <h2 class="mb-0 text-white"><?= $data['title'] ?></h2>
    </div>
	<?php else: ?>
    <div class="card-header">
      <h2 class="mb-0"><?= $data['title'] ?></h2>
    </div>
	<?php endif; ?>
  <div class="card-body">
    <div class="row">
      <div class="col-12 col-md-6">
        <div class="mb-4">
          <h3 class="mb-4">Данные контрагента</h3>
          <table class="table">
            <tr>
              <td class="px-0" width="40%">Контрагент</td>
              <td class="px-0"><?= $data['order']['client_name'] ?></td>
            </tr>
            <tr>
              <td class="px-0">Телефон</td>
              <td class="px-0"><?= $data['config']['PHONE_PREFIX']; ?> <?= $data['order']['mobile_phone'] ?></td>
            </tr>
            <tr>
              <td class="px-0">Почта</td>
              <td class="px-0"><?= $data['order']['email'] ?></td>
            </tr>
          </table>
        </div>

        <div class="mb-4">
          <hr>
          <h3 class="mb-4">Данные заказа</h3>
          <table class="table">
            <tr>
              <td class="px-0" width="40%">Внешний ID</td>
              <td class="px-0"><?= $data['order']['order_name_out'] ?></td>
            </tr>
            <tr>
              <td class="px-0">Внутренний ID</td>
              <td class="px-0"><?= $data['order']['order_name_in'] ?></td>
            </tr>
            <tr>
              <td class="px-0">Менеджер</td>
              <td class="px-0">
								<?php if (isset($data['manager']['id'])): ?>
                <a href="<?= $data['config']['HOST'] . '/users.php?action=user_info_card&id=' . $data['manager']['id']; ?>">
									<?= $data['manager']['last_name'] . ' ' . $data['manager']['first_name']; ?>
									<?php else: ?>
                    не назначен
									<?php endif; ?>
              </td>
            </tr>
            <tr>
              <td class="px-0">Дизайнер</td>
              <td class="px-0">
								<?php if (isset($data['designer']['id'])): ?>
                <a href="<?= $data['config']['HOST'] . '/users.php?action=user_info_card&id=' . $data['designer']['id']; ?>">
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
                  <a href="<?= $data['config']['HOST'] . '/users.php?action=user_info_card&id=' . $data['confirmStartUser']['id']; ?>">
										<?= $data['confirmStartUser']['last_name'] . ' ' . $data['confirmStartUser']['first_name']; ?>
                </td>
              </tr>
						<?php endif; ?>

						<?php if (isset($data['confirmCancelUser']['id'])): ?>
              <tr>
                <td class="px-0">Подтвердил отмену</td>
                <td class="px-0">
                  <a href="<?= $data['config']['HOST'] . '/users.php?action=user_info_card&id=' . $data['confirmCancelUser']['id']; ?>">
										<?= $data['confirmCancelUser']['last_name'] . ' ' . $data['confirmCancelUser']['first_name']; ?>
                </td>
              </tr>
						<?php endif; ?>

            <tr>
              <td class="px-0">Приоритет</td>
              <td class="px-0"><?= $data['progData']['PRIORITY_ORDERS'][$data['order']['order_priority']]['icon'] ?? '???' ?></td>
            </tr>

						<?php if (currentGeneralStatus($data['order']) !== false): ?>
              <tr>
                <td class="px-0">Стадия</td>
                <td class="px-0">
									<?= $data['progData']['STATUS_LIST_PRODUCTION'][currentGeneralStatus($data['order'])]['icon'] ?? '???' ?>
                </td>
              </tr>
						<?php endif; ?>

            <tr>
              <td class="px-0">Кол-во</td>
              <td class="px-0"><?= $data['order']['task_quantity'] ?></td>
            </tr>
          </table>
        </div>

        <div class="mb-4">
          <hr>
          <h3 class="mb-4">Описание</h3>
          <p><?= $data['order']['task_text'] ?></p>
        </div>

				<?php if ($_SESSION['user']['auth_production_order_change_priority'] &&
					currentGeneralStatus($data['order']) !== false &&
					currentGeneralStatus($data['order']) < $data['progData']['STATUS_ID_PRODUCTION']['DONE']): ?>
          <div class="mb-4">
            <hr>
            <form action="<?= $data['config']['HOST'] . '/production.php' ?>" method="POST">
              <input type="hidden" name="action" value="change_priority">
              <input type="hidden" name="order_id" value="<?= $data['order']['id'] ?>">
              <h3>Изменить приоритет</h3>
              <div class="form-row">
                <div class="m-0 form-group col-8">
                  <select name="priority" class="form-control" required>
                    <option></option>
										<?php foreach ($data['progData']['PRIORITY_ORDERS'] as $priorityKey => $priorityVal): ?>
											<?php if ($priorityKey === $data['order']['order_priority']): ?>
                        <option value="<?= $priorityKey ?>" selected><?= $priorityVal['name'] ?></option>
											<?php else: ?>
                        <option value="<?= $priorityKey ?>"><?= $priorityVal['name'] ?></option>
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
					currentGeneralStatus($data['order']) !== false &&
					currentGeneralStatus($data['order']) < $data['progData']['STATUS_ID_PRODUCTION']['DONE']): ?>
          <div class="mb-4 d-inline-block">
            <form class="d-inline-block mr-2" action="<?= $data['config']['HOST'] . '/production.php' ?>" method="POST">
              <input type="hidden" name="action" value="change_status">
              <input type="hidden" name="status" value="<?= $data['progData']['STATUS_ID_PRODUCTION']['WAIT_CANCEL']; ?>">
              <input type="hidden" name="order_id" value="<?= $data['order']['id'] ?>">
              <input type="hidden" name="department" value="all">
              <input type="hidden" name="redirect_success"
                     value="<?= $data['config']['HOST'] . '/production.php?action=order_info_card&id=' .
										 $data['order']['id']; ?>">
              <input type="hidden" name="redirect_error"
                     value="<?= $data['config']['HOST'] . '/production.php?action=order_info_card&id=' .
										 $data['order']['id']; ?>">
              <input class="btn btn-danger" type="submit" value="Запросить отмену">
            </form>
          </div>
				<?php endif; ?>

				<?php if ($_SESSION['user']['auth_production_order_cancel'] &&
					currentGeneralStatus($data['order']) === $data['progData']['STATUS_ID_PRODUCTION']['WAIT_CANCEL']): ?>
          <div class="mb-4 d-inline-block">
            <form class="d-inline-block mr-2" action="<?= $data['config']['HOST'] . '/production.php' ?>" method="POST">
              <input type="hidden" name="action" value="change_status">
              <input type="hidden" name="status" value="<?= $data['progData']['STATUS_ID_PRODUCTION']['CANCEL']; ?>">
              <input type="hidden" name="order_id" value="<?= $data['order']['id'] ?>">
              <input type="hidden" name="department" value="all">
              <input type="hidden" name="redirect_success"
                     value="<?= $data['config']['HOST'] . '/production.php?action=order_info_card&id=' .
										 $data['order']['id']; ?>">
              <input type="hidden" name="redirect_error"
                     value="<?= $data['config']['HOST'] . '/production.php?action=order_info_card&id=' .
										 $data['order']['id']; ?>">
              <input class="btn btn-danger" type="submit" value="Подтвердить отмену">
            </form>
          </div>
				<?php endif; ?>

				<?php if ($_SESSION['user']['auth_production_order_start'] &&
					currentGeneralStatus($data['order']) === $data['progData']['STATUS_ID_PRODUCTION']['WAIT_START']): ?>
          <div class="mb-4 d-inline-block">
            <form class="d-inline-block mr-2" action="<?= $data['config']['HOST'] . '/production.php' ?>" method="POST">
              <input type="hidden" name="action" value="change_status">
              <input type="hidden" name="status" value="<?= $data['progData']['STATUS_ID_PRODUCTION']['RECEIVED']; ?>">
              <input type="hidden" name="order_id" value="<?= $data['order']['id'] ?>">
              <input type="hidden" name="department" value="all">
              <input type="hidden" name="redirect_success"
                     value="<?= $data['config']['HOST'] . '/production.php?action=order_info_card&id=' .
										 $data['order']['id']; ?>">
              <input type="hidden" name="redirect_error"
                     value="<?= $data['config']['HOST'] . '/production.php?action=order_info_card&id=' .
										 $data['order']['id']; ?>">
              <input class="btn btn-primary" type="submit" value="Запустить в работу">
            </form>
          </div>
				<?php endif; ?>


				<?php if ($data['order']['error_priority'] == 2 &&
					currentGeneralStatus($data['order']) !== false &&
					currentGeneralStatus($data['order']) < $data['progData']['STATUS_ID_PRODUCTION']['DONE']): ?>
          <a href="<?= $data['config']['HOST'] . '/production.php?' . http_build_query([
						'action' => 'cancel_error',
						'order_id' => $data['order']['id'],
						'redirect_success' => $data['config']['HOST'] . '/production.php?action=order_info_card&id=' .
							$data['order']['id'],
						'redirect_error' => $data['config']['HOST'] . '/production.php?action=order_info_card&id=' .
							$data['order']['id']
					]) ?>"
             class="btn btn-primary" role="button" aria-pressed="true">Снять ошибку</a>
				<?php elseif (currentGeneralStatus($data['order']) !== false &&
					currentGeneralStatus($data['order']) < $data['progData']['STATUS_ID_PRODUCTION']['DONE']): ?>
          <a href="<?= $data['config']['HOST'] . '/production.php?' . http_build_query([
						'action' => 'add_error',
						'order_id' => $data['order']['id'],
						'redirect_success' => $data['config']['HOST'] . '/production.php?action=order_info_card&id=' .
							$data['order']['id'],
						'redirect_error' => $data['config']['HOST'] . '/production.php?action=order_info_card&id=' .
							$data['order']['id']
					]) ?>"
             class="btn btn-primary" role="button" aria-pressed="true">Добавить ошибку</a>
				<?php endif; ?>
      </div>
      <div class="col-12 col-md-6">
        <div class="nav-wrapper">

          <div>
            <ul class="nav nav-pills nav-fill d-flex" id="tabs-icons-text" role="tablist">
              <li class="nav-item">
                <a class="mb-3 nav-link <?= $data['activeTab'] == 'notes' ? 'active' : '' ?>" id="tabs-icons-text-1-tab" data-toggle="tab"
                   href="#tabs-icons-text-1" role="tab"
                   aria-controls="tabs-icons-text-1" aria-selected="true">Заметки</a>
              </li>
              <li class="nav-item">
                <a class="mb-3 nav-link <?= $data['activeTab'] == 'files' ? 'active' : '' ?>" id="tabs-icons-text-2-tab" data-toggle="tab"
                   href="#tabs-icons-text-2" role="tab"
                   aria-controls="tabs-icons-text-2" aria-selected="false">Файлы</a>
              </li>

							<?php if ($data['order']['const_datetime_status_0']): ?>
                <li class="nav-item">
                  <a class="mb-3 nav-link <?= $data['activeTab'] == 'const' ? 'active' : '' ?>" id="tabs-icons-text-3-tab" data-toggle="tab"
                     href="#tabs-icons-text-3" role="tab"
                     aria-controls="tabs-icons-text-3" aria-selected="false">Конструктор</a>
                </li>
							<?php endif; ?>

							<?php if ($data['order']['adv_datetime_status_0']): ?>
                <li class="nav-item">
                  <a class="mb-3 nav-link <?= $data['activeTab'] == 'adv' ? 'active' : '' ?>" id="tabs-icons-text-4-tab" data-toggle="tab"
                     href="#tabs-icons-text-4" role="tab"
                     aria-controls="tabs-icons-text-4" aria-selected="false">Реклама</a>
                </li>
							<?php endif; ?>

							<?php if ($data['order']['furn_datetime_status_0']): ?>
                <li class="nav-item">
                  <a class="mb-3 nav-link <?= $data['activeTab'] == 'furn' ? 'active' : '' ?>" id="tabs-icons-text-5-tab" data-toggle="tab"
                     href="#tabs-icons-text-5" role="tab"
                     aria-controls="tabs-icons-text-5" aria-selected="false">Мебель</a>
                </li>
							<?php endif; ?>

							<?php if ($data['order']['steel_datetime_status_0']): ?>
                <li class="nav-item">
                  <a class="mb-3 nav-link <?= $data['activeTab'] == 'steel' ? 'active' : '' ?>" id="tabs-icons-text-6-tab" data-toggle="tab"
                     href="#tabs-icons-text-6" role="tab"
                     aria-controls="tabs-icons-text-6" aria-selected="false">Металл</a>
                </li>
							<?php endif; ?>

							<?php if ($data['order']['install_datetime_status_0']): ?>
                <li class="nav-item">
                  <a class="mb-3 nav-link <?= $data['activeTab'] == 'install' ? 'active' : '' ?>" id="tabs-icons-text-7-tab" data-toggle="tab"
                     href="#tabs-icons-text-7" role="tab"
                     aria-controls="tabs-icons-text-7" aria-selected="false">Монтаж</a>
                </li>
							<?php endif; ?>

							<?php if ($data['order']['supply_datetime_status_0']): ?>
                <li class="nav-item <?= $data['activeTab'] == 'supply' ? 'active' : '' ?>">
                  <a class="mb-3 nav-link" id="tabs-icons-text-8-tab" data-toggle="tab" href="#tabs-icons-text-8" role="tab"
                     aria-controls="tabs-icons-text-8" aria-selected="false">Склад</a>
                </li>
							<?php endif; ?>
            </ul>
          </div>

        </div>
        <div class="card shadow">
          <div class="card-body">
            <div class="tab-content" id="">

              <div class="tab-pane fade <?= $data['activeTab'] == 'notes' ? 'show active' : '' ?>" id="tabs-icons-text-1" role="tabpanel"
                   aria-labelledby="tabs-icons-text-1-tab">
								<?php foreach ($data['notes'] as $note): ?>
                  <div class="mb-4">
                    <p class="m-0"><?= $note['note']; ?></p>
                    <h6 class="text-gray m-0 p-0">
											<?= $data['progData']['PRIORITY_ORDERS'][$note['priority']]['icon'] ?? '???' ?>
                      <a class="text-primary" href="<?= $data['config']['HOST'] . '/users.php?action=user_info_card&id=' . $note['user_id']; ?>">
												<?= $note['last_name'] . ' ' . $note['first_name']; ?> </a> <span><?= $note['create_datetime']; ?></span>
                    </h6>
                  </div>
								<?php endforeach; ?>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                  Написать
                </button>
              </div>

              <div class="tab-pane fade <?= $data['activeTab'] == 'files' ? 'show active' : '' ?>" id="tabs-icons-text-2" role="tabpanel"
                   aria-labelledby="tabs-icons-text-2-tab">
                <ul class="navbar-nav mb-4">
									<?php foreach ($data['files'] as $file): ?>
                    <li class="nav-item dropdown mb-3">
                      <p class="m-0"><?= $file['note']; ?></p>
											<?php if ($file['is_deleted']): ?>
                        <span class=""><?= $file['name']; ?></span>
                        <h6>
                          <span class="badge badge-pill badge-danger">удалено</span>
                          <a class="text-primary" href="<?= $data['config']['HOST'] . '/users.php?action=user_info_card&id=' .
													$file['user_id']; ?>">
														<?= $file['last_name'] . ' ' . $file['first_name']; ?> </a> <span><?= $file['change_datetime']; ?></span>
                        </h6>
											<?php else: ?>
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true"
                           aria-expanded="false">
													<?= $file['name']; ?>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                          <a class="dropdown-item" href="<?= $data['config']['HOST'] . $file['path']; ?>">Скачать</a>
													<?php if ($_SESSION['user']['id'] == $file['user_id']): ?>
                            <a class="dropdown-item text-danger" href="<?= $data['config']['HOST'] . '/files.php?' .
														http_build_query(['action' => 'del_file', 'id' => $file['id'],
															'redirect_success' => $data['config']['HOST'] . '/production.php?action=order_info_card&active_tab=files&id=' .
																$data['order']['id'],
															'redirect_error' => $data['config']['HOST'] . '/production.php?action=order_info_card&active_tab=files&id=' .
																$data['order']['id']]); ?>">Удалить</a>
													<?php endif; ?>
                        </div>
                        <h6>
                          <a class="text-primary" href="<?= $data['config']['HOST'] . '/users.php?action=user_info_card&id=' .
													$file['user_id']; ?>">
														<?= $file['last_name'] . ' ' . $file['first_name']; ?> </a> <span><?= $file['change_datetime']; ?></span>
                        </h6>
											<?php endif; ?>
                    </li>
									<?php endforeach; ?>
                </ul>
                <form action="<?= $data['config']['HOST'] . '/files.php' ?>" enctype="multipart/form-data" method="POST">
                  <input type="hidden" name="action" value="upl_file">
                  <input type="hidden" name="form_id" value="<?= $data['formId']; ?>">
                  <input type="hidden" name="order_id" value="<?= $data['order']['id']; ?>">
                  <input type="hidden" name="order_type" value="<?= $data['progData']['ORDER_TYPES']['PRODUCTION'] ?>">
                  <input type="hidden" name="redirect_success"
                         value="<?= $data['config']['HOST'] . '/production.php?action=order_info_card&active_tab=files&id=' .
												 $data['order']['id']; ?>">
                  <input type="hidden" name="redirect_error"
                         value="<?= $data['config']['HOST'] . '/production.php?action=order_info_card&active_tab=files&id=' .
												 $data['order']['id']; ?>">
                  <div class="form-group">
                    <small class="">Комментарий к файлу</small>
                    <input class="form-control" type="text" name="note"
                           maxlength="<?= $data['config']['MAX_LEN_A']; ?>">
                  </div>
                  <div class="form-group">
                    <input type="file" name="file">
                  </div>
                  <div class="form-group">
                    <input type="submit" class="btn btn-primary" value="Загрузить">
                  </div>
                </form>
              </div>

							<?php if ($data['order']['const_datetime_status_0']): ?>
                <div class="tab-pane fade <?= $data['activeTab'] == 'const' ? 'show active' : '' ?>" id="tabs-icons-text-3" role="tabpanel"
                     aria-labelledby="tabs-icons-text-3-tab">

                  <table class="table table-sm table-borderless mb-4">
                    <tr>
                      <td class="px-0" width="50%">Стадия</td>
                      <td class="px-0"><?= $data['progData']['STATUS_LIST_PRODUCTION'][$data['order']['const_current_status']]['icon'] ?? '???' ?></td>
                    </tr>
                    <tr>
                      <td class="px-0">Дедлайн</td>
                      <td class="px-0">
												<?= deadlineBadge($data['order']['const_deadline_date'], $data['config']['WARNING_DAYS_BEFORE_DEADLINE']) ?>
                      </td>
                    </tr>
                  </table>

									<?php if ($_SESSION['user']['auth_production_order_change_status_const'] &&
										$data['order']['const_current_status'] > $data['progData']['STATUS_ID_PRODUCTION']['WAIT_START'] &&
										$data['order']['const_current_status'] < $data['progData']['STATUS_ID_PRODUCTION']['ISSUED']): ?>
                    <hr>
                    <div class="mb-4">
                      <form action="<?= $data['config']['HOST'] . '/production.php' ?>" method="POST">
                        <input type="hidden" name="action" value="change_status">
                        <input type="hidden" name="order_id" value="<?= $data['order']['id'] ?>">
                        <input type="hidden" name="department" value="const">
                        <input type="hidden" name="redirect_success"
                               value="<?= $data['config']['HOST'] . '/production.php?action=order_info_card&active_tab=const&id=' .
															 $data['order']['id']; ?>">
                        <input type="hidden" name="redirect_error"
                               value="<?= $data['config']['HOST'] . '/production.php?action=order_info_card&active_tab=const&id=' .
															 $data['order']['id']; ?>">
                        <small class="text-gray">Изменить стадию</small>
                        <div class="form-row">
                          <div class="form-group col-8">
                            <select name="status" class="form-control" required>
                              <option></option>
															<?php foreach ($data['progData']['STATUS_LIST_PRODUCTION'] as $statusKey => $statusVal): ?>
																<?php if ($statusKey < $data['progData']['STATUS_ID_PRODUCTION']['START'] ||
																	$statusKey > $data['progData']['STATUS_ID_PRODUCTION']['ISSUED']): continue ?>
																<?php endif; ?>
																<?php if ($statusKey > $data['order']['const_current_status']): ?>
                                  <option value="<?= $statusKey ?>"><?= $statusVal['name'] ?></option>
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
										<?php foreach ($data['progData']['STATUS_LIST_PRODUCTION'] as $statusKey => $statusVal): ?>
                      <tr>
                        <td class="px-0" width="50%"><?= $statusVal['name'] ?? '???' ?></td>
                        <td class="px-0"><?= $data['order']['const_datetime_status_' . $statusKey] ?></td>
                      </tr>
										<?php endforeach; ?>
                  </table>
                </div>
							<?php endif; ?>


							<?php if ($data['order']['adv_datetime_status_0']): ?>
                <div class="tab-pane fade <?= $data['activeTab'] == 'adv' ? 'show active' : '' ?>" id="tabs-icons-text-4" role="tabpanel"
                     aria-labelledby="tabs-icons-text-4-tab">

                  <table class="table table-sm table-borderless mb-4">
                    <tr>
                      <td class="px-0" width="50%">Стадия</td>
                      <td class="px-0"><?= $data['progData']['STATUS_LIST_PRODUCTION'][$data['order']['adv_current_status']]['icon'] ?? '???' ?></td>
                    </tr>
                    <tr>
                      <td class="px-0">Дедлайн</td>
                      <td class="px-0">
												<?= deadlineBadge($data['order']['adv_deadline_date'], $data['config']['WARNING_DAYS_BEFORE_DEADLINE']) ?>
                      </td>
                    </tr>
                  </table>

									<?php if ($_SESSION['user']['auth_production_order_change_status_adv'] &&
										$data['order']['adv_current_status'] > $data['progData']['STATUS_ID_PRODUCTION']['WAIT_START'] &&
										$data['order']['adv_current_status'] < $data['progData']['STATUS_ID_PRODUCTION']['ISSUED']): ?>
                    <hr>
                    <div class="mb-4">
                      <form action="<?= $data['config']['HOST'] . '/production.php' ?>" method="POST">
                        <input type="hidden" name="action" value="change_status">
                        <input type="hidden" name="order_id" value="<?= $data['order']['id'] ?>">
                        <input type="hidden" name="department" value="adv">
                        <input type="hidden" name="redirect_success"
                               value="<?= $data['config']['HOST'] . '/production.php?action=order_info_card&active_tab=adv&id=' .
															 $data['order']['id']; ?>">
                        <input type="hidden" name="redirect_error"
                               value="<?= $data['config']['HOST'] . '/production.php?action=order_info_card&active_tab=adv&id=' .
															 $data['order']['id']; ?>">
                        <small class="text-gray">Изменить стадию</small>
                        <div class="form-row">
                          <div class="form-group col-8">
                            <select name="status" class="form-control" required>
                              <option></option>
															<?php foreach ($data['progData']['STATUS_LIST_PRODUCTION'] as $statusKey => $statusVal): ?>
																<?php if ($statusKey < $data['progData']['STATUS_ID_PRODUCTION']['START'] ||
																	$statusKey > $data['progData']['STATUS_ID_PRODUCTION']['ISSUED']): continue ?>
																<?php endif; ?>
																<?php if ($statusKey > $data['order']['adv_current_status']): ?>
                                  <option value="<?= $statusKey ?>"><?= $statusVal['name'] ?></option>
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
										<?php foreach ($data['progData']['STATUS_LIST_PRODUCTION'] as $statusKey => $statusVal): ?>
                      <tr>
                        <td class="px-0" width="50%"><?= $statusVal['name'] ?? '???' ?></td>
                        <td class="px-0"><?= $data['order']['adv_datetime_status_' . $statusKey] ?></td>
                      </tr>
										<?php endforeach; ?>
                  </table>
                </div>
							<?php endif; ?>

							<?php if ($data['order']['furn_datetime_status_0']): ?>
                <div class="tab-pane fade <?= $data['activeTab'] == 'furn' ? 'show active' : '' ?>" id="tabs-icons-text-5" role="tabpanel"
                     aria-labelledby="tabs-icons-text-5-tab">

                  <table class="table table-sm table-borderless mb-4">
                    <tr>
                      <td class="px-0" width="50%">Стадия</td>
                      <td class="px-0"><?= $data['progData']['STATUS_LIST_PRODUCTION'][$data['order']['furn_current_status']]['icon'] ?? '???' ?></td>
                    </tr>
                    <tr>
                      <td class="px-0">Дедлайн</td>
                      <td class="px-0">
												<?= deadlineBadge($data['order']['furn_deadline_date'], $data['config']['WARNING_DAYS_BEFORE_DEADLINE']) ?>
                      </td>
                    </tr>
                  </table>

									<?php if ($_SESSION['user']['auth_production_order_change_status_furn'] &&
										$data['order']['furn_current_status'] > $data['progData']['STATUS_ID_PRODUCTION']['WAIT_START'] &&
										$data['order']['furn_current_status'] < $data['progData']['STATUS_ID_PRODUCTION']['ISSUED']): ?>
                    <hr>
                    <div class="mb-4">
                      <form action="<?= $data['config']['HOST'] . '/production.php' ?>" method="POST">
                        <input type="hidden" name="action" value="change_status">
                        <input type="hidden" name="order_id" value="<?= $data['order']['id'] ?>">
                        <input type="hidden" name="department" value="furn">
                        <input type="hidden" name="redirect_success"
                               value="<?= $data['config']['HOST'] . '/production.php?action=order_info_card&active_tab=furn&id=' .
															 $data['order']['id']; ?>">
                        <input type="hidden" name="redirect_error"
                               value="<?= $data['config']['HOST'] . '/production.php?action=order_info_card&active_tab=furn&id=' .
															 $data['order']['id']; ?>">
                        <small class="text-gray">Изменить стадию</small>
                        <div class="form-row">
                          <div class="form-group col-8">
                            <select name="status" class="form-control" required>
                              <option></option>
															<?php foreach ($data['progData']['STATUS_LIST_PRODUCTION'] as $statusKey => $statusVal): ?>
																<?php if ($statusKey < $data['progData']['STATUS_ID_PRODUCTION']['START'] ||
																	$statusKey > $data['progData']['STATUS_ID_PRODUCTION']['ISSUED']): continue ?>
																<?php endif; ?>
																<?php if ($statusKey > $data['order']['furn_current_status']): ?>
                                  <option value="<?= $statusKey ?>"><?= $statusVal['name'] ?></option>
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
										<?php foreach ($data['progData']['STATUS_LIST_PRODUCTION'] as $statusKey => $statusVal): ?>
                      <tr>
                        <td class="px-0" width="50%"><?= $statusVal['name'] ?? '???' ?></td>
                        <td class="px-0"><?= $data['order']['furn_datetime_status_' . $statusKey] ?></td>
                      </tr>
										<?php endforeach; ?>
                  </table>
                </div>
							<?php endif; ?>


							<?php if ($data['order']['steel_datetime_status_0']): ?>
                <div class="tab-pane fade <?= $data['activeTab'] == 'steel' ? 'show active' : '' ?>" id="tabs-icons-text-6" role="tabpanel"
                     aria-labelledby="tabs-icons-text-6-tab">

                  <table class="table table-sm table-borderless mb-4">
                    <tr>
                      <td class="px-0" width="50%">Стадия</td>
                      <td class="px-0"><?= $data['progData']['STATUS_LIST_PRODUCTION'][$data['order']['steel_current_status']]['icon'] ?? '???' ?></td>
                    </tr>
                    <tr>
                      <td class="px-0">Дедлайн</td>
                      <td class="px-0">
												<?= deadlineBadge($data['order']['steel_deadline_date'], $data['config']['WARNING_DAYS_BEFORE_DEADLINE']) ?>
                      </td>
                    </tr>
                  </table>

									<?php if ($_SESSION['user']['auth_production_order_change_status_steel'] &&
										$data['order']['steel_current_status'] > $data['progData']['STATUS_ID_PRODUCTION']['WAIT_START'] &&
										$data['order']['steel_current_status'] < $data['progData']['STATUS_ID_PRODUCTION']['ISSUED']): ?>
                    <hr>
                    <div class="mb-4">
                      <form action="<?= $data['config']['HOST'] . '/production.php' ?>" method="POST">
                        <input type="hidden" name="action" value="change_status">
                        <input type="hidden" name="order_id" value="<?= $data['order']['id'] ?>">
                        <input type="hidden" name="department" value="steel">
                        <input type="hidden" name="redirect_success"
                               value="<?= $data['config']['HOST'] . '/production.php?action=order_info_card&active_tab=steel&id=' .
															 $data['order']['id']; ?>">
                        <input type="hidden" name="redirect_error"
                               value="<?= $data['config']['HOST'] . '/production.php?action=order_info_card&active_tab=steel&id=' .
															 $data['order']['id']; ?>">
                        <small class="text-gray">Изменить стадию</small>
                        <div class="form-row">
                          <div class="form-group col-8">
                            <select name="status" class="form-control" required>
                              <option></option>
															<?php foreach ($data['progData']['STATUS_LIST_PRODUCTION'] as $statusKey => $statusVal): ?>
																<?php if ($statusKey < $data['progData']['STATUS_ID_PRODUCTION']['START'] ||
																	$statusKey > $data['progData']['STATUS_ID_PRODUCTION']['ISSUED']): continue ?>
																<?php endif; ?>
																<?php if ($statusKey > $data['order']['steel_current_status']): ?>
                                  <option value="<?= $statusKey ?>"><?= $statusVal['name'] ?></option>
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
										<?php foreach ($data['progData']['STATUS_LIST_PRODUCTION'] as $statusKey => $statusVal): ?>
                      <tr>
                        <td class="px-0" width="50%"><?= $statusVal['name'] ?? '???' ?></td>
                        <td class="px-0"><?= $data['order']['steel_datetime_status_' . $statusKey] ?></td>
                      </tr>
										<?php endforeach; ?>
                  </table>
                </div>
							<?php endif; ?>

							<?php if ($data['order']['install_datetime_status_0']): ?>
                <div class="tab-pane fade <?= $data['activeTab'] == 'install' ? 'show active' : '' ?>" id="tabs-icons-text-7" role="tabpanel"
                     aria-labelledby="tabs-icons-text-7-tab">

                  <table class="table table-sm table-borderless mb-4">
                    <tr>
                      <td class="px-0" width="50%">Стадия</td>
                      <td class="px-0"><?= $data['progData']['STATUS_LIST_PRODUCTION'][$data['order']['install_current_status']]['icon'] ?? '???' ?></td>
                    </tr>
                    <tr>
                      <td class="px-0">Дедлайн</td>
                      <td class="px-0">
												<?= deadlineBadge($data['order']['install_deadline_date'], $data['config']['WARNING_DAYS_BEFORE_DEADLINE']) ?>
                      </td>
                    </tr>
                  </table>

									<?php if ($_SESSION['user']['auth_production_order_change_status_install'] &&
										$data['order']['install_current_status'] > $data['progData']['STATUS_ID_PRODUCTION']['WAIT_START'] &&
										$data['order']['install_current_status'] < $data['progData']['STATUS_ID_PRODUCTION']['ISSUED']): ?>
                    <hr>
                    <div class="mb-4">
                      <form action="<?= $data['config']['HOST'] . '/production.php' ?>" method="POST">
                        <input type="hidden" name="action" value="change_status">
                        <input type="hidden" name="order_id" value="<?= $data['order']['id'] ?>">
                        <input type="hidden" name="department" value="install">
                        <input type="hidden" name="redirect_success"
                               value="<?= $data['config']['HOST'] . '/production.php?action=order_info_card&active_tab=install&id=' .
															 $data['order']['id']; ?>">
                        <input type="hidden" name="redirect_error"
                               value="<?= $data['config']['HOST'] . '/production.php?action=order_info_card&active_tab=install&id=' .
															 $data['order']['id']; ?>">
                        <small class="text-gray">Изменить стадию</small>
                        <div class="form-row">
                          <div class="form-group col-8">
                            <select name="status" class="form-control" required>
                              <option></option>
															<?php foreach ($data['progData']['STATUS_LIST_PRODUCTION'] as $statusKey => $statusVal): ?>
																<?php if ($statusKey < $data['progData']['STATUS_ID_PRODUCTION']['START'] ||
																	$statusKey > $data['progData']['STATUS_ID_PRODUCTION']['ISSUED']): continue ?>
																<?php endif; ?>
																<?php if ($statusKey > $data['order']['install_current_status']): ?>
                                  <option value="<?= $statusKey ?>"><?= $statusVal['name'] ?></option>
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

                  <div class="mb-4">
                    <hr>
                    <h3 class="mb-4">Описание монтажа</h3>
                    <p><?= $data['order']['install_task'] ?></p>
                  </div>

                  <div class="mb-5">
                    <hr>
                    <h3 class="mb-4">Адрес монтажа</h3>
                    <p><?= $data['order']['install_address'] ?></p>
                  </div>

                  <table class="table table-sm">
										<?php foreach ($data['progData']['STATUS_LIST_PRODUCTION'] as $statusKey => $statusVal): ?>
                      <tr>
                        <td class="px-0" width="50%"><?= $statusVal['name'] ?? '???' ?></td>
                        <td class="px-0"><?= $data['order']['install_datetime_status_' . $statusKey] ?></td>
                      </tr>
										<?php endforeach; ?>
                  </table>
                </div>
							<?php endif; ?>

							<?php if ($data['order']['supply_datetime_status_0']): ?>
                <div class="tab-pane fade <?= $data['activeTab'] == 'supply' ? 'show active' : '' ?>" id="tabs-icons-text-8" role="tabpanel"
                     aria-labelledby="tabs-icons-text-8-tab">

                  <table class="table table-sm table-borderless mb-4">
                    <tr>
                      <td class="px-0" width="50%">Стадия</td>
                      <td class="px-0"><?= $data['progData']['STATUS_LIST_PRODUCTION'][$data['order']['supply_current_status']]['icon'] ?? '???' ?></td>
                    </tr>
                    <tr>
                      <td class="px-0">Дедлайн</td>
                      <td class="px-0">
												<?= deadlineBadge($data['order']['supply_deadline_date'], $data['config']['WARNING_DAYS_BEFORE_DEADLINE']) ?>
                      </td>
                    </tr>
                  </table>

									<?php if ($_SESSION['user']['auth_production_order_change_status_supply'] &&
										$data['order']['supply_current_status'] > $data['progData']['STATUS_ID_PRODUCTION']['WAIT_START'] &&
										$data['order']['supply_current_status'] < $data['progData']['STATUS_ID_PRODUCTION']['ISSUED']): ?>
                    <hr>
                    <div class="mb-4">
                      <form action="<?= $data['config']['HOST'] . '/production.php' ?>" method="POST">
                        <input type="hidden" name="action" value="change_status">
                        <input type="hidden" name="order_id" value="<?= $data['order']['id'] ?>">
                        <input type="hidden" name="department" value="supply">
                        <input type="hidden" name="redirect_success"
                               value="<?= $data['config']['HOST'] . '/production.php?action=order_info_card&active_tab=supply&id=' .
															 $data['order']['id']; ?>">
                        <input type="hidden" name="redirect_error"
                               value="<?= $data['config']['HOST'] . '/production.php?action=order_info_card&active_tab=supply&id=' .
															 $data['order']['id']; ?>">
                        <small class="text-gray">Изменить стадию</small>
                        <div class="form-row">
                          <div class="form-group col-8">
                            <select name="status" class="form-control" required>
                              <option></option>
															<?php foreach ($data['progData']['STATUS_LIST_PRODUCTION'] as $statusKey => $statusVal): ?>
																<?php if ($statusKey < $data['progData']['STATUS_ID_PRODUCTION']['START'] ||
																	$statusKey > $data['progData']['STATUS_ID_PRODUCTION']['ISSUED']): continue ?>
																<?php endif; ?>
																<?php if ($statusKey > $data['order']['supply_current_status']): ?>
                                  <option value="<?= $statusKey ?>"><?= $statusVal['name'] ?></option>
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
										<?php foreach ($data['progData']['STATUS_LIST_PRODUCTION'] as $statusKey => $statusVal): ?>
                      <tr>
                        <td class="px-0" width="50%"><?= $statusVal['name'] ?? '???' ?></td>
                        <td class="px-0"><?= $data['order']['supply_datetime_status_' . $statusKey] ?></td>
                      </tr>
										<?php endforeach; ?>
                  </table>
                </div>
							<?php endif; ?>

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
