<?php
//Kiểm tra trạng thái đăng nhập
if (!isLogin()) {
  redirect('?module=auth&action=login');
} else {
  $userID = isLogin()['user_id'];
  $userDetail = userDetail($userID);
  // echo "<pre>";
  // print_r($userDetail);
  // echo "</pre>";
}

saveActivity();

autoRomoveTokenLogin();
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo $data['pageTitle'] = !empty($data) ? $data['pageTitle'] . ' - ' . 'Quản trị website'  : null; ?></title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo _WEB_HOST_TEMPLATE_ADMIN ?>/assets/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="<?php echo _WEB_HOST_TEMPLATE_ADMIN ?>/assets/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?php echo _WEB_HOST_TEMPLATE_ADMIN ?>/assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="<?php echo _WEB_HOST_TEMPLATE_ADMIN ?>/assets/plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo _WEB_HOST_TEMPLATE_ADMIN ?>/assets/css/adminlte.min.css">
  <!-- lib range -->
  <link rel="stylesheet" href="<?php echo _WEB_HOST_TEMPLATE_ADMIN ?>/assets/plugins/ion-rangeslider/css/ion.rangeSlider.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="<?php echo _WEB_HOST_TEMPLATE_ADMIN ?>/assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="<?php echo _WEB_HOST_TEMPLATE_ADMIN ?>/assets/plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="<?php echo _WEB_HOST_TEMPLATE_ADMIN ?>/assets/plugins/summernote/summernote-bs4.css">
  <!-- Link css style -->
  <link rel="stylesheet" href="<?php echo _WEB_HOST_TEMPLATE_ADMIN ?>/assets/css/style.css">
  <script type="text/javascript" src="<?php echo _WEB_HOST_TEMPLATE_ADMIN ?>/assets/ckeditor/ckeditor.js"></script>
  <script type="text/javascript" src="<?php echo _WEB_HOST_TEMPLATE_ADMIN ?>/assets/ckfinder/ckfinder.js"></script>

  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>

<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
      </ul>

      <!-- SEARCH FORM -->
      <!-- <form class="form-inline ml-3">
        <div class="input-group input-group-sm">
          <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-navbar" type="submit">
              <i class="fas fa-search"></i>
            </button>
          </div>
        </div>
      </form> -->

      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">
        <!-- Notifications Dropdown Menu -->
        <li class="nav-item dropdown">
          <a class="nav-link" data-toggle="dropdown" href="#">
            <i class="far fa-bell"></i>
            <span class="badge badge-warning navbar-badge number-status-comment"><?php echo getCommentCountStatus(); ?></span>
          </a>
          <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <span class="dropdown-item dropdown-header">Thông báo</span>
            <div class="dropdown-divider"></div>
            <a href="<?php echo getLinkAdmin('comments') ?>" class="dropdown-item">
              <i class="fas fa-envelope mr-2"></i>Có <span class="number-status-comment"><?php echo getCommentCountStatus(); ?></span> bình luận mới
            </a>
          </div>
        </li>

        <li class="nav-item dropdown">
          <a class="nav-link" data-toggle="dropdown" href="#">
            <i class="far fa-user"></i>
            <span>Hi. <?php echo $userDetail['fullname'] ?></span>
          </a>
          <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <div class="dropdown-divider"></div>
            <a href="<?php echo getLinkAdmin('users', 'profile') ?>" class="dropdown-item">
              <i class="fas fa-info mr-2"></i> Thông tin tài khoản
            </a>
            <div class="dropdown-divider"></div>
            <a href="<?php echo getLinkAdmin('users', 'change_password') ?>" class="dropdown-item">
              <i class="fas fa-key mr-2"></i> Đổi mật khẩu
            </a>
            <div class="dropdown-divider"></div>
            <a href="?module=auth&action=logout" class="dropdown-item">
              <i class="fas fa-sign-out-alt"></i> Đăng xuất
            </a>
          </div>
        </li>
      </ul>
    </nav>
    <!-- /.navbar -->