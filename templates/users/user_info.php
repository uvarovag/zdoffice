<div class="card">
	<div class="card-header bg-transparent">
		<h2 class="mb-0">Карта пользователя: <?= $data['user']['login']?></h2>
	</div>
	<div class="card-body">

		<div class="row">
			<div class="col-12 col-md mb-4">
				<span class="h3">Логин:</span> <span><?= $data['user']['login']?></span>
			</div>

			<div class="col-12 col-md mb-4">
				<span class="h3">Пароль:</span> <span>************</span>
			</div>
		</div>
		<div class="row">



			<div class="col-12 col-md mb-4">
				<span class="h3">Фамилия:</span> <span><?= $data['user']['first_name']?></span>
			</div>

			<div class="col-12 col-md mb-4">
				<span class="h3">Имя:</span> <span><?= $data['user']['last_name']?></span>
			</div>

		</div>
	</div>
</div>