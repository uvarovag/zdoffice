<!--
=========================================================
* Argon Dashboard - v1.2.0
=========================================================
* Product Page: https://www.creative-tim.com/product/argon-dashboard

* Copyright  Creative Tim (http://www.creative-tim.com)
* Coded by www.creative-tim.com
=========================================================
* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
-->
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Start your development with a Dashboard for Bootstrap 4.">
  <meta name="author" content="Creative Tim">
  <title><?= $data['title']; ?></title>
  <!-- Favicon -->
  <link rel="icon" href="/img/zd-blue.png" type="image/png">
  <!-- Fonts -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">
  <!-- Icons -->
  <link rel="stylesheet" href="/argon-dashboard/assets/vendor/nucleo/css/nucleo.css" type="text/css">
  <link rel="stylesheet" href="/argon-dashboard/assets/vendor/@fortawesome/fontawesome-free/css/all.min.css" type="text/css">
  <!-- Argon CSS -->
  <link rel="stylesheet" href="/argon-dashboard/assets/css/argon.css?v=1.2.0" type="text/css">
</head>

<body class="bg-white">

<!-- Main content -->
<div class="main-content">
  <!-- Header -->
  <div class="header <?= $data['CONFIG']['BG_STYLE']; ?> py-7">
    <div class="container">
      <div class="header-body text-center mb-7">
        <div class="row justify-content-center">

        </div>
      </div>
    </div>

  </div>
  <!-- Page content -->
  <div class="container mt--8 pb-5">
    <div class="row justify-content-center">
      <div class="col-lg-5 col-md-7">
        <div class="card bg-secondary border-0 mb-0">
          <div class="card-body px-lg-5 py-lg-5">
            <div class="text-center text-muted mb-4">
							<?php if ($data['errorMassage']): ?>
                <p class="text-red"><?= $data['errorMassage']; ?></p>
							<?php else: ?>
                <p><?= $data['CONFIG']['PROG_NAME']; ?></p>
							<?php endif; ?>
            </div>
            <form action="<?= $data['CONFIG']['HOST'] . '/login.php'; ?>" method="post">
              <input type="hidden" name="action" value="login">
              <div class="form-group mb-3">
                <div class="input-group input-group-merge input-group-alternative">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="ni ni-single-02"></i></span>
                  </div>
                  <input class="form-control" placeholder="Логин" name="login" type="text" value=""
                         required pattern="^[a-zA-Z0-9]+$"
                         minlength="<?= $data['CONFIG']['MIN_LEN_A']; ?>" maxlength="<?= $data['CONFIG']['MAX_LEN_A']; ?>">
                </div>
              </div>
              <div class="form-group">
                <div class="input-group input-group-merge input-group-alternative">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                  </div>
                  <input class="form-control" placeholder="Пароль" name="password" type="password"
                         required pattern="^[a-zA-Z0-9]+$"
                         minlength="<?= $data['CONFIG']['MIN_LEN_A']; ?>" maxlength="<?= $data['CONFIG']['MAX_LEN_A']; ?>">
                </div>
              </div>
              <div class="text-center">
                <input class="btn btn-primary my-4" type="submit" value="Войти">
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Footer -->
<footer class="py-5" id="footer-main">
  <div class="container">
    <div class="row align-items-center justify-content-xl-between">

    </div>
  </div>
</footer>
<!-- Argon Scripts -->
<!-- Core -->
<script src="/argon-dashboard/assets/vendor/jquery/dist/jquery.min.js"></script>
<script src="/argon-dashboard/assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<script src="/argon-dashboard/assets/vendor/js-cookie/js.cookie.js"></script>
<script src="/argon-dashboard/assets/vendor/jquery.scrollbar/jquery.scrollbar.min.js"></script>
<script src="/argon-dashboard/assets/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js"></script>
<!-- Argon JS -->
<script src="/argon-dashboard/assets/js/argon.js?v=1.2.0"></script>
</body>
</html>