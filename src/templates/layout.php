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
<!-- bg-gradient-red bg-gradient-orange bg-gradient-info bg-gradient-green bg-gradient-purple bg-gradient-yellow -->

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Start your development with a Dashboard for Bootstrap 4.">
  <meta name="author" content="Creative Tim">
  <title><?= $data['title']; ?></title>
  <!-- Favicon -->
  <link rel="icon" href="/argon-dashboard/assets/img/brand/zd-blue.png" type="image/png">
  <!-- Fonts -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">
  <!-- Icons -->
  <link rel="stylesheet" href="/argon-dashboard/assets/vendor/nucleo/css/nucleo.css" type="text/css">
  <link rel="stylesheet" href="/argon-dashboard/assets/vendor/@fortawesome/fontawesome-free/css/all.min.css" type="text/css">
  <!-- Page plugins -->
  <!-- Argon CSS -->
  <link rel="stylesheet" href="/argon-dashboard/assets/css/argon.min.css?v=1" type="text/css">
  <link rel="stylesheet" href="/argon-dashboard/assets/daterangepicker/daterangepicker-min.css?v=5" type="text/css">
</head>
<body>
<?= $data['modal']; ?>
<!-- Sidenav -->
<nav class="sidenav navbar navbar-vertical fixed-left navbar-expand-xs navbar-light bg-white" id="sidenav-main">
  <div class="scrollbar-inner">
    <!-- Brand -->
    <div class="sidenav-header  align-items-center mb-4">
      <a class="navbar-brand" href="<?= $data['CONFIG']['HOST'] . '/index.php'; ?>">
        <img src="/argon-dashboard/assets/img/brand/zd-blue.png" class="navbar-brand-img" alt="...">
        <h2 class="d-inline align-bottom <?= $data['CONFIG']['TEXT_STYLE']; ?>">ZIYNAT DESIGN</h2><br/>
        <p class="d-inline align-bottom <?= $data['CONFIG']['TEXT_STYLE']; ?>">online application</p>
      </a>
    </div>
    <div class="navbar-inner">
      <!-- Collapse -->
      <div class="collapse navbar-collapse" id="sidenav-collapse-main">
        <!-- Nav items -->
        <ul class="navbar-nav">
					<?php foreach ($_SESSION['navList'] as $nav): ?>
						<?php if ($nav['isAvailable'] && $nav['isCaption'] === false): ?>
              <li class="nav-item">
                <a class="nav-link <?php if ($nav['isActive']): ?> active<?php endif; ?>" href="<?= $nav['url']; ?>">
									<?= $nav['title']; ?>
                </a>
              </li>
						<?php elseif ($nav['isAvailable'] && $nav['isCaption']): ?>
              <li class="nav-item">
                <span class="h4 m-3 <?= $data['CONFIG']['TEXT_STYLE']; ?>"><?= $nav['title']; ?></span>
              </li>
						<?php endif; ?>
					<?php endforeach; ?>
        </ul>
      </div>
    </div>
  </div>
</nav>
<!-- Main content -->
<div class="main-content" id="panel">
  <!-- Topnav -->
  <nav class="navbar navbar-top navbar-expand navbar-dark border-bottom <?= $data['CONFIG']['BG_STYLE']; ?>">
    <div class="container-fluid">
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <!-- Search form -->
        <!--        <form class="navbar-search navbar-search-light form-inline mr-sm-3" id="navbar-search-main">-->
        <!--          <div class="form-group mb-0">-->
        <!--            <div class="input-group input-group-alternative input-group-merge">-->
        <!--              <div class="input-group-prepend">-->
        <!--                <span class="input-group-text"><i class="fas fa-search"></i></span>-->
        <!--              </div>-->
        <!--              <input class="form-control" placeholder="Search" type="text">-->
        <!--            </div>-->
        <!--          </div>-->
        <!--          <button type="button" class="close" data-action="search-close" data-target="#navbar-search-main" aria-label="Close">-->
        <!--            <span aria-hidden="true">×</span>-->
        <!--          </button>-->
        <!--        </form>-->
        <!-- Navbar links -->
        <ul class="navbar-nav align-items-center  ml-md-auto ">
          <li class="nav-item d-xl-none">
            <!-- Sidenav toggler -->
            <div class="pr-3 sidenav-toggler sidenav-toggler-dark" data-action="sidenav-pin" data-target="#sidenav-main">
              <div class="sidenav-toggler-inner">
                <i class="sidenav-toggler-line"></i>
                <i class="sidenav-toggler-line"></i>
                <i class="sidenav-toggler-line"></i>
              </div>
            </div>
          </li>




<!--          <li class="nav-item d-sm-none">-->
<!--            <a class="nav-link" href="#" data-action="search-show" data-target="#navbar-search-main">-->
<!--              <i class="ni ni-zoom-split-in"></i>-->
<!--            </a>-->
<!--          </li>-->


<!--          <li class="nav-item dropdown">-->
<!--            <a class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">-->
<!--              <i class="ni ni-bell-55"></i><sup>13</sup>-->
<!--            </a>-->
<!--            <div class="dropdown-menu dropdown-menu-xl  dropdown-menu-right  py-0 overflow-hidden">-->
<!---->
<!--              <div class="px-3 py-3">-->
<!--                <h6 class="text-sm text-muted m-0">You have <strong class="--><?//= $data['CONFIG']['TEXT_STYLE']; ?><!--">13</strong> notifications.</h6>-->
<!--              </div>-->
<!---->
<!--              <div class="list-group list-group-flush">-->
<!--                <a href="#!" class="list-group-item list-group-item-action">-->
<!--                  <div class="row align-items-center">-->
<!--                    <div class="col">-->
<!--                      <div class="d-flex justify-content-between align-items-center">-->
<!--                        <div>-->
<!--                          <h4 class="mb-0 text-sm">John Snow</h4>-->
<!--                        </div>-->
<!--                      </div>-->
<!--                      <p class="text-sm mb-0">Let's meet at Starbucks at 11:30. Wdyt?</p>-->
<!--                    </div>-->
<!--                  </div>-->
<!--                </a>-->
<!--              </div>-->
<!--            </div>-->
<!--          </li>-->





          <!--          <li class="nav-item dropdown">-->
          <!--            <a class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">-->
          <!--              <i class="ni ni-ungroup"></i>-->
          <!--            </a>-->
          <!--            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-dark bg-default  dropdown-menu-right ">-->
          <!--              <div class="row shortcuts px-4">-->
          <!--                <a href="#!" class="col-4 shortcut-item">-->
          <!--                    <span class="shortcut-media avatar rounded-circle bg-gradient-red">-->
          <!--                      <i class="ni ni-calendar-grid-58"></i>-->
          <!--                    </span>-->
          <!--                  <small class="text-gray">Calendar</small>-->
          <!--                </a>-->
          <!--              </div>-->
          <!--            </div>-->
          <!--          </li>-->
        </ul>
        <ul class="navbar-nav align-items-center  ml-auto ml-md-0 ">
          <li class="nav-item dropdown">
            <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <div class="media align-items-center">
                <!--                  <span class="avatar avatar-sm rounded-circle">-->
                <!--                    <img alt="Image placeholder" src="/argon-dashboard/assets/img/theme/team-4.jpg">-->
                <!--                  </span>-->
                <div class="media-body  ml-2">
                  <span class="mb-0 text-sm  font-weight-bold"><?= $_SESSION['user']['first_name']; ?></span>
                </div>
              </div>
            </a>
            <div class="dropdown-menu  dropdown-menu-right ">
              <!--                            <div class="dropdown-header noti-title">-->
              <!--                              <h6 class="text-overflow m-0">Welcome!</h6>-->
              <!--                            </div>-->
							<?php if (isset($_SESSION['user']['is_superuser']) === false): ?>
                <a href="<?= $data['CONFIG']['HOST'] . '/users.php?action=user_info_card&id=' . $_SESSION['user']['id']; ?>" class="dropdown-item">
                  <i class="ni ni-single-02 text-primary"></i>
                  <span>Мои данные</span>
                </a>
							<?php endif; ?>
              <a href="<?= $data['CONFIG']['HOST'] . '/logout.php'; ?>" class="dropdown-item">
                <i class="ni ni-button-power text-red"></i>
                <span>Выход</span>
              </a>
            </div>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <!-- Header -->
  <div class="header pb-6 <?= $data['CONFIG']['BG_STYLE']; ?>">
    <div class="container-fluid">
      <div class="header-body">
        <div class="row align-items-center py-4">
          <!--          <div class="col-lg-6 col-7">-->
          <!--            <h6 class="h2 text-white d-inline-block mb-0">Icons</h6>-->
          <!--            <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">-->
          <!--              <ol class="breadcrumb breadcrumb-links breadcrumb-dark">-->
          <!--                <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>-->
          <!--                <li class="breadcrumb-item"><a href="#">Components</a></li>-->
          <!--                <li class="breadcrumb-item active" aria-current="page">Icons</li>-->
          <!--              </ol>-->
          <!--            </nav>-->
          <!--          </div>-->
          <!--          <div class="col-lg-6 col-5 text-right">-->
          <!--            <a href="#" class="btn btn-sm btn-neutral">New</a>-->
          <!--            <a href="#" class="btn btn-sm btn-neutral">Filters</a>-->
          <!--          </div>-->
        </div>
      </div>
    </div>
  </div>
  <!-- Page content -->
  <div class="container-fluid mt--6">
    <div class="row justify-content-center">
      <div class="col">
				<?php if ($data['alertMassage']): ?>
          <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="ni ni-bell-55"></i>
						<?= $data['alertMassage']; ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
				<?php elseif ($data['errorMassage']): ?>
          <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="ni ni-bell-55"></i>
						<?= $data['errorMassage']; ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
				<?php endif; ?>

				<?= $data['content']; ?>

				<?= $data['pagination']; ?>

      </div>
    </div>
    <!-- Footer -->
    <footer class="footer pt-0">
      <!--      <div class="row align-items-center justify-content-lg-between">-->
      <!--        <div class="col-lg-6">-->
      <!--          <div class="copyright text-center  text-lg-left  text-muted">-->
      <!--            &copy; 2020 <a href="https://www.creative-tim.com" class="font-weight-bold ml-1" target="_blank">Creative Tim</a>-->
      <!--          </div>-->
      <!--        </div>-->
      <!--        <div class="col-lg-6">-->
      <!--          <ul class="nav nav-footer justify-content-center justify-content-lg-end">-->
      <!--            <li class="nav-item">-->
      <!--              <a href="https://www.creative-tim.com" class="nav-link" target="_blank">Creative Tim</a>-->
      <!--            </li>-->
      <!--            <li class="nav-item">-->
      <!--              <a href="https://www.creative-tim.com/presentation" class="nav-link" target="_blank">About Us</a>-->
      <!--            </li>-->
      <!--            <li class="nav-item">-->
      <!--              <a href="http://blog.creative-tim.com" class="nav-link" target="_blank">Blog</a>-->
      <!--            </li>-->
      <!--            <li class="nav-item">-->
      <!--              <a href="https://github.com/creativetimofficial//argon-dashboard/blob/master/LICENSE.md" class="nav-link" target="_blank">MIT License</a>-->
      <!--            </li>-->
      <!--          </ul>-->
      <!--        </div>-->
      <!--      </div>-->
    </footer>
  </div>
</div>
<!-- Argon Scripts -->
<!-- Core -->
<script src="/argon-dashboard/assets/vendor/jquery/dist/jquery.min.js"></script>
<script src="/argon-dashboard/assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<script src="/argon-dashboard/assets/vendor/js-cookie/js.cookie.js"></script>
<script src="/argon-dashboard/assets/vendor/jquery.scrollbar/jquery.scrollbar.min.js"></script>
<script src="/argon-dashboard/assets/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js"></script>
<!-- Optional JS -->
<script src="/argon-dashboard/assets/vendor/clipboard/dist/clipboard.min.js"></script>
<script src="/argon-dashboard/assets/vendor/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<script src="/argon-dashboard/assets/daterangepicker/moment-min.js"></script>
<script src="/argon-dashboard/assets/daterangepicker/daterangepicker.js"></script>
<script src="/argon-dashboard/assets/js/office-main.js"></script>
<script src="/js/forms.js?v=0309"></script>
<!-- Argon JS -->
<script src="/argon-dashboard/assets/js/argon.js?v=1.2.0"></script>
</body>
</html>