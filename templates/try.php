<header class="bg-primary shadow fixed-top" style="z-index: 9999">
  <nav class="container px-3 px-md-0 navbar navbar-expand-md navbar-dark">
    <button class="navbar-toggler ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
            aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <?php foreach ($data['navigationList'] as $key => $value): ?>
          <?php if ($value['isActive']): ?>
            <li class="nav-item dropdown active">
          <?php else: ?>
            <li class="nav-item dropdown">
          <?php endif; ?>
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true"
             aria-expanded="false"><?= $value['title'] ?><?php if (isset($value['notification']) && $value['notification'] > 0): ?>
              <span class="badge badge-danger"><?= $value['notification'] ?></span><?php endif; ?></a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <?php foreach ($value['options'] as $key2 => $value2): ?>
              <?php if ($value2['title'] === 'divider'): ?>
                <div class="dropdown-divider"></div>
              <?php elseif ($value2['title'] !== 'divider' && $value2['isActive']): ?>
                <a class="dropdown-item active" href="<?= $value2['url'] ?>"><?= $value2['title'] ?></a>
              <?php else: ?>
                <a class="dropdown-item" href="<?= $value2['url'] ?>"><?= $value2['title'] ?></a>
              <?php endif; ?>
            <?php endforeach ?>
          </div>
          </li>
        <?php endforeach ?>
      </ul>
      <div class="nav-item mt-4 mt-md-0">
        <a href="<?= $data['config']['host'] . '/logout.php' ?>" class="d-inline-block text-light px-0 px-md-2" role="button" aria-pressed="true">
          <i class="material-icons align-bottom mr-1">exit_to_app</i><span class="d-md-none d-lg-inline-block">Выйти</span>
        </a>
      </div>
    </div>
  </nav>
</header>
<div class="body-wrapper mt-5">
  <div class="container px-0 mt-5">
    <div class="row mx-0 mx-xl-3">
      <div class="d-none col-2 d-xl-block">
        <div class="flex-column sticky-top" style="top:6rem">
          <?php foreach ($data['navigationList'] as $key3 => $value3): ?>
            <?php if ($value3['isActive']): ?>
              <?php foreach ($value3['options'] as $key4 => $value4): ?>
                <?php if ($value4['title'] === 'divider'): ?>
                  <hr>
                <?php elseif ($value4['isActive']): ?>
                  <a class="btn btn-link px-0" role="button" href="<?= $value4['url'] ?>"><?= $value4['title'] ?></a>
                  <br>
                <?php else: ?>
                  <a class="btn btn-link px-0 text-secondary" role="button" href="<?= $value4['url'] ?>"><?= $value4['title'] ?></a>
                  <br>
                <?php endif; ?>
              <?php endforeach ?>
            <?php endif; ?>
          <?php endforeach ?>
        </div>
      </div>
      <div class="col-12 col-xl-10">
        <?php if ($data['alertMassage']): ?>
          <div class="alert alert-info fade show mb-5" role="alert">
            <i class="material-icons align-bottom mr-1 text-info">notifications_none</i><?= $data['alertMassage'] ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
        <?php endif; ?>
        <?php if ($data['errorMassage']): ?>
          <div class="alert alert-danger fade show mb-5" role="alert">
            <i class="material-icons align-bottom mr-1 text-danger">warning</i><?= $data['errorMassage'] ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
        <?php endif; ?>
        <div>
          <?= $data['layoutContent'] ?>
          <?= $data['pagination'] ?? '' ?>
        </div>
      </div>
    </div>
  </div>
</div>
<footer class="border-top">
  <div class="container py-2">
    <img src="../img/rocket-logo-192.png" width="25" height="25" alt="Rocket Logo" class="mr-1">
    <a href="<?= $data['config']['host'] . '/main.php' ?>"><span class="mr-1">Rocket</span><span>©</span></a>
  </div>
</footer>