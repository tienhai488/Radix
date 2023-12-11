<!DOCTYPE html>
<html class="no-js" lang="zxx">

<head>
    <!-- Meta tag -->
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="Radix" content="Responsive Multipurpose Business Template">
    <meta name='copyright' content='Radix'>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Title Tag -->
    <title><?php echo empty($data['pageTitle']) ? "Radix" : $data['pageTitle']?> </title>

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="<?php echo _WEB_HOST_TEMPLATE ?>/images/favicon.png">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,400i,600,700,800" rel="stylesheet">

    <!-- Bootstrap Css -->
    <link rel="stylesheet" href="<?php echo _WEB_HOST_TEMPLATE ?>/css/bootstrap.min.css">

    <!-- Slick Nav CSS -->
    <link rel="stylesheet" href="<?php echo _WEB_HOST_TEMPLATE ?>/css/slicknav.min.css">
    <!-- Cube Portfolio CSS -->
    <link rel="stylesheet" href="<?php echo _WEB_HOST_TEMPLATE ?>/css/cubeportfolio.min.css">
    <!-- Magnific Popup CSS -->
    <link rel="stylesheet" href="<?php echo _WEB_HOST_TEMPLATE ?>/css/magnific-popup.min.css">
    <!-- Fancy Box CSS -->
    <link rel="stylesheet" href="<?php echo _WEB_HOST_TEMPLATE ?>/css/jquery.fancybox.min.css">
    <!-- Nice Select CSS -->
    <link rel="stylesheet" href="<?php echo _WEB_HOST_TEMPLATE ?>/css/niceselect.css">
    <!-- Owl Carousel CSS -->
    <link rel="stylesheet" href="<?php echo _WEB_HOST_TEMPLATE ?>/css/owl.theme.default.css">
    <link rel="stylesheet" href="<?php echo _WEB_HOST_TEMPLATE ?>/css/owl.carousel.min.css">
    <!-- Slick Slider CSS -->
    <link rel="stylesheet" href="<?php echo _WEB_HOST_TEMPLATE ?>/css/slickslider.min.css">
    <!-- Animate CSS -->
    <link rel="stylesheet" href="<?php echo _WEB_HOST_TEMPLATE ?>/css/animate.min.css">


    <!-- Font Awesome CSS -->


    <link rel="stylesheet"
        href="<?php echo _WEB_HOST_ADMIN_TEMPLATE; ?>/assets/plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="<?php echo _WEB_HOST_TEMPLATE ?>/css/font-awesome.min.css">

    <link rel="stylesheet" href="<?php echo _WEB_HOST_TEMPLATE ?>/css/reset.css">
    <link rel="stylesheet" href="<?php echo _WEB_HOST_TEMPLATE ?>/css/style.css?ver=<?php echo rand() ?>">
    <link rel="stylesheet" href="<?php echo _WEB_HOST_TEMPLATE ?>/css/responsive.css">

    <!-- Radix Color CSS -->
    <link rel="stylesheet" href="<?php echo _WEB_HOST_TEMPLATE ?>/css/color/color1.css">
</head>

<body>

    <!-- Preloader -->
    <div class="preloader">
        <div class="preloader-inner">
            <div class="single-loader one"></div>
            <div class="single-loader two"></div>
            <div class="single-loader three"></div>
            <div class="single-loader four"></div>
            <div class="single-loader five"></div>
            <div class="single-loader six"></div>
            <div class="single-loader seven"></div>
            <div class="single-loader eight"></div>
            <div class="single-loader nine"></div>
        </div>
    </div>

    <!-- End Preloader -->

    <!-- Get Pro Button -->
    <!-- <ul class="pro-features">
			<a class="get-pro" href="#">Get Pro</a>
			<li class="title">Pro Version Some Features</li>
			<li>Multipage & Onepage Homepage</li>
			<li>26+ HTML5 pages</li>
			<li>All Premium Features</li>
			<li>Documentation Included</li>
			<li>6+ Month Dedicated Support!</li>
			<div class="button">
				<a href="https://www.codeglim.com/downloads/radix-multipurpose-business-consulting-template/" target="_blank" class="btn">Buy Pro Version</a>
				<a href="https://www.codeglim.com/downloads/radix-multipurpose-business-consulting-template/" target="_blank" class="btn">View Details</a>
			</div>
		</ul> -->

    <?php 
		$dataHeader = getRaw("select * from options");
		// echo "<pre>";
		// print_r($dataHeader);
		// echo "</pre>";
		?>
    <!-- Start Header -->
    <header id="header" class="header">
        <!-- Topbar -->
        <div class="topbar">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-12">
                        <!-- Contact -->
                        <ul class="contact">
                            <li><i class="fa fa-headphones"></i><?php echo getValueOptions("general_hotline") ?></li>
                            <li><i class="fa fa-envelope"></i> <a
                                    href="mailto:<?php echo getValueOptions("general_email") ?>"><?php echo getValueOptions("general_email") ?></a>
                            </li>
                            <li><i class="fa fa-clock-o"></i><?php echo getValueOptions("general_time") ?></li>
                        </ul>
                        <!--/ End Contact -->
                    </div>
                    <div class="col-lg-6 col-12">
                        <div class="topbar-right">
                            <!-- Search Form -->
                            <div class="search-form active">
                                <a class="icon" href="#"><i class="fa fa-search"></i></a>
                                <form class="form" action="#">
                                    <input placeholder="Tìm kiếm blog..." type="search">
                                </form>
                            </div>
                            <!--/ End Search Form -->
                            <!-- Social -->
                            <ul class="social">
                                <li><a target="_blank" href="<?php echo getValueOptions("general_twitter") ?>"><i
                                            class="fa fa-twitter"></i></a></li>
                                <li><a target="_blank" href="<?php echo getValueOptions("general_facebook") ?>"><i
                                            class="fa fa-facebook"></i></a></li>
                                <li><a target="_blank" href="<?php echo getValueOptions("general_linkedin") ?>"><i
                                            class="fa fa-linkedin"></i></a></li>
                                <li><a target="_blank" href="<?php echo getValueOptions("general_github") ?>"><i
                                            class="fa fa-github"></i></a></li>
                                <li><a target="_blank" href="<?php echo getValueOptions("general_youtube") ?>"><i
                                            class="fa fa-youtube"></i></a></li>
                            </ul>
                            <!--/ End Social -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--/ End Topbar -->
        <!-- Middle Bar -->
        <div class="middle-bar">
            <div class="container">
                <div class="row">
                    <div class="col-lg-2 col-12">
                        <!-- Logo -->
                        <div class="logo">
                            <a href="<?php echo _WEB_HOST_ROOT ?>"><img
                                    src="<?php echo _WEB_HOST_TEMPLATE ?>/images/logo.png" alt="logo"></a>
                        </div>
                        <div class="link"><a href="index.html"><span>R</span>adix</a></div>
                        <!--/ End Logo -->
                        <button class="mobile-arrow"><i class="fa fa-bars"></i></button>
                        <div class="mobile-menu"></div>
                    </div>
                    <div class="col-lg-10 col-12">
                        <!-- Main Menu -->
                        <div class="mainmenu">
                            <nav class="navigation">
                                <ul class="nav menu">
                                    <li class="<?php echo empty(getBody()['module']) ? "active" : false ?>"><a
                                            href="<?php echo _WEB_HOST_ROOT ?>">Home</a></li>
                                    <li
                                        class="<?php echo !empty(getBody()['module'])&&getBody()['module'] =='page-template' ? "active" : false ?>">
                                        <a href="#">Pages<i class="fa fa-caret-down"></i></a>
                                        <ul class="dropdown">
                                            <li><a
                                                    href="<?php echo _WEB_HOST_ROOT.'?module=page-template&action=about-us' ?>">About
                                                    Us</a></li>
                                            <li><a
                                                    href="<?php echo _WEB_HOST_ROOT.'?module=page-template&action=our-team' ?>">Our
                                                    Team</a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li
                                        class="<?php echo !empty(getBody()['module'])&&getBody()['module'] =='service' ? "active" : false ?>">
                                        <a href="<?php echo _WEB_HOST_ROOT.'?module=service' ?>">Services</a>
                                    </li>
                                    <li
                                        class="<?php echo !empty(getBody()['module'])&&getBody()['module'] =='portfolio' ? "active" : false ?>">
                                        <a href="<?php echo _WEB_HOST_ROOT.'?module=portfolio' ?>">Portfolio</a>
                                    </li>
                                    <li
                                        class="<?php echo !empty(getBody()['module'])&&getBody()['module'] =='blog' ? "active" : false ?>">
                                        <a href="#">Blogs<i class="fa fa-caret-down"></i></a>
                                        <ul class="dropdown">
                                            <li><a href="<?php echo _WEB_HOST_ROOT.'?module=blog' ?>">Blog layout</a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li
                                        class="<?php echo !empty(getBody()['module'])&&getBody()['module'] =='contact' ? "active" : false ?>">
                                        <a href="<?php echo _WEB_HOST_ROOT.'?module=contact' ?>">Contact</a>
                                    </li>
                                </ul>
                            </nav>
                            <!-- Button -->
                            <div class="button">
                                <a href="<?php echo _WEB_HOST_ROOT ?>/?module=contact" class="btn">Nhận Báo Giá</a>
                            </div>
                            <!--/ End Button -->
                        </div>
                        <!--/ End Main Menu -->
                    </div>
                </div>
            </div>
        </div>
        <!--/ End Middle Bar -->
    </header>
    <!--/ End Header -->