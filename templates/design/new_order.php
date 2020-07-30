<div class="card">
	<div class="card-header bg-transparent">
		<h2 class="mb-0">Новая заявка на дизайн</h2>
	</div>
	<div class="card-body">
		<form action="<?= $data['config']['host'] . '/design.php' ?>" method="POST">
			<input type="hidden" name="action" value="new_order">
			<input type="hidden" name="form_id" value="<?= $data['formId'] ?>">
			<fieldset>
				<h3>Данные контрагента</h3>
				<div class="form-row">
					<div class="form-group col-12 col-md-6 mb-4">
						<small class="text-gray">id заказа (<?= 'en ' . $data['config']['minLenA'] . '-' . $data['config']['maxLenA']?>)</small>
						<input type="text" name="login" class="form-control" required
									 pattern="<?= $data['config']['regexpA'] ?>{<?= $data['config']['minLenA'] ?>,<?= $data['config']['maxLenA'] ?>}">
					</div>

					<div class="form-group col-12 col-md-6 mb-4">
						<small class="text-gray">контагент (<?= 'en ' . $data['config']['minLenA'] . '-' . $data['config']['maxLenA']?>)</small>
						<input type="text" name="login" class="form-control" required
									 pattern="<?= $data['config']['regexpA'] ?>{<?= $data['config']['minLenA'] ?>,<?= $data['config']['maxLenA'] ?>}">
					</div>

					<div class="form-group col-12 col-md-6 mb-4">
						<small class="text-gray">телефон</small>
						<div class="input-group">
							<div class="input-group-prepend">
								<span class="input-group-text" id="basic-addon1"><?= $data['config']['phone_prefix']?></span>
							</div>
							<input type="tel" name="mobile_phone" class="form-control" required
										 pattern="<?= $data['config']['regexpC'] ?>"
										 placeholder="XX XXX XX XX"">
						</div>
					</div>
					<div class="form-group col-12 col-md-6 mb-4">
						<small class="text-gray">почта</small>
						<input type="email" name="email" class="form-control" required>
					</div>
				</div>
			</fieldset>

			<hr>
			<h3>Данные заказа</h3>

			<fieldset>

				<div class="mb-4">
					<small class="text-gray">описание (<?= $data['config']['minLenB'] . '-' . $data['config']['maxLenB']?>)</small>
					<textarea class="form-control" id="exampleFormControlTextarea1" rows="4" required
										minlength="<?= $data['config']['minLenB']?>"
										maxlength="<?= $data['config']['maxLenB']?>"></textarea>
				</div>

				<div class="form-row mb-4">

					<div class="form-group col-12 col-md-6 mb-4">
						<small class="text-gray">дата сдачи</small>
						<div class="">
							<div class="input-group">
								<div class="input-group-prepend">
									<span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
								</div>
								<input class="form-control datepicker" type="text" required placeholder="" value="">
							</div>
						</div>
					</div>

					<div class="form-group col-12 col-md-6 mb-4">
						<small class="text-gray">Формат</small>
						<div class="">
							<div class="mt-2">
								<div class="custom-control custom-radio custom-control-inline">
									<input type="radio" id="customRadioInline1" name="customRadioInline1" class="custom-control-input" required>
									<label class="custom-control-label" for="customRadioInline1">2D</label>
								</div>
								<div class="custom-control custom-radio custom-control-inline">
									<input type="radio" id="customRadioInline2" name="customRadioInline1" class="custom-control-input" required>
									<label class="custom-control-label" for="customRadioInline2">3D</label>
								</div>
							</div>
						</div>
					</div>


				</div>



			</fieldset>



			<input class="btn btn-primary" type="submit" value="Сохранить">
		</form>
	</div>
</div>