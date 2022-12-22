<?php
if(isLogin()){
  $userId = isLogin()['user_id'];
  $userDetail = getUserInfo($userId);
}else {
  redirect(getLinkAdmin('auth','login'));
}

saveActivity();
autoRemoveTokenLogin();

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo $data['pageTitle']; ?> - Quản trị website</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Font Awesome -->

    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bbootstrap 4 -->
    <link rel="stylesheet"
        href="<?php echo _WEB_HOST_ADMIN_TEMPLATE; ?>/assets/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- iCheck -->
    <link rel="stylesheet"
        href="<?php echo _WEB_HOST_ADMIN_TEMPLATE; ?>/assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- JQVMap -->
    <link rel="stylesheet" href="<?php echo _WEB_HOST_ADMIN_TEMPLATE; ?>/assets/plugins/jqvmap/jqvmap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo _WEB_HOST_ADMIN_TEMPLATE; ?>/assets/css/adminlte.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet"
        href="<?php echo _WEB_HOST_ADMIN_TEMPLATE; ?>/assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet"
        href="<?php echo _WEB_HOST_ADMIN_TEMPLATE; ?>/assets/plugins/daterangepicker/daterangepicker.css">
    <!-- summernote -->
    <link rel="stylesheet" href="<?php echo _WEB_HOST_ADMIN_TEMPLATE; ?>/assets/plugins/summernote/summernote-bs4.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

    <link rel="stylesheet"
        href="<?php echo _WEB_HOST_ADMIN_TEMPLATE; ?>/assets/plugins/ion-rangeslider/css/ion.rangeSlider.min.css">
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css"> -->

    <!-- <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/fontawesome.min.css?ver=<?php echo rand(); ?>" /> -->
    <!-- <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css?ver=<?php echo rand(); ?>" /> -->

    <link rel="stylesheet"
        href="<?php echo _WEB_HOST_ADMIN_TEMPLATE; ?>/assets/plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="<?php echo _WEB_HOST_TEMPLATE ?>/css/font-awesome.min.css">

    <link rel="stylesheet"
        href="<?php echo _WEB_HOST_ADMIN_TEMPLATE; ?>/assets/css/style.css?ver=<?php echo rand(); ?>">

    <script type="text/javascript" src="<?php echo _WEB_HOST_ADMIN_TEMPLATE; ?>/assets/ckeditor/ckeditor.js"></script>

    <script type="text/javascript" src="<?php echo _WEB_HOST_ADMIN_TEMPLATE; ?>/assets/ckfinder/ckfinder.js"></script>

</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">



            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">

                <!-- Notifications Dropdown Menu -->
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="far fa-bell"></i>
                        <span class="badge badge-warning navbar-badge">15</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <span class="dropdown-item dropdown-header">15 Notifications</span>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-envelope mr-2"></i> 4 new messages
                            <span class="float-right text-muted text-sm">3 mins</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-users mr-2"></i> 8 friend requests
                            <span class="float-right text-muted text-sm">12 hours</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-file mr-2"></i> 3 new reports
                            <span class="float-right text-muted text-sm">2 days</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
                    </div>
                </li>

                <!-- user -->
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="far fa-user"></i>
                        Hi, <?php echo $userDetail['fullname'] ?>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <a href="<?php echo getLinkAdmin('users','profile') ?>" class="dropdown-item">
                            <i class="fas fa-angle-right mr-2"></i>
                            Thông tin cá nhân
                        </a>
                        <a href="<?php echo getLinkAdmin('users','change_password') ?>" class="dropdown-item">
                            <i class="fas fa-angle-right mr-2"></i>
                            Đổi mật khẩu
                        </a>
                        <a href="<?php echo getLinkAdmin('auth','logout') ?>" class="dropdown-item">
                            <i class="fas fa-angle-right mr-2"></i>
                            Đăng xuất
                        </a>
                    </div>
                </li>

            </ul>
        </nav>
        <div class="content-wrapper" style="min-height: 458px;">
            <!-- /.navbar -->