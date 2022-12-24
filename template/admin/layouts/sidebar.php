<?php
  $userId = isLogin()['user_id'];
  $userDetail = getUserInfo($userId);
?>

<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?php echo _WEB_HOST_ROOT_ADMIN ?>" class="brand-link">
        <img src="<?php echo _WEB_HOST_ADMIN_TEMPLATE ?>/assets/img/AdminLTELogo.png" alt="AdminLTE Logo"
            class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light text-uppercase">Radix Admin</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="<?php echo _WEB_HOST_ADMIN_TEMPLATE ?>/assets/img/user2-160x160.jpg"
                    class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="<?php echo getLinkAdmin('users','profile')  ?>" class="d-block">

                    <?php echo $userDetail['fullname'] ?>
                </a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                <li class="nav-item has-treeview <?php echo getActiveSidebar('')?'menu-open':false ?>">
                    <a href="#" class="nav-link <?php echo getActiveSidebar('')?'active':false ?>">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Tổng quan
                        </p>
                    </a>
                </li>

                <li class="nav-item has-treeview <?php echo getActiveSidebar('users')?'menu-open':false ?>">
                    <a href="#" class="nav-link <?php echo getActiveSidebar('users')?'active':false ?>">
                        <i class="nav-icon fas fa-user"></i>
                        <p>
                            Quản lý người dùng
                            <i class="fas fa-angle-left right"></i>

                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?php echo _WEB_HOST_ROOT_ADMIN.'/?module=users' ?>" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Danh sách</p>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a href="<?php echo _WEB_HOST_ROOT_ADMIN.'/?module=users&action=add' ?>" class="nav-link ">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Thêm mới</p>
                            </a>
                        </li>

                    </ul>
                </li>


                <li class="nav-item has-treeview <?php echo getActiveSidebar('groups')?'menu-open':false ?>">
                    <a href="#" class="nav-link <?php echo getActiveSidebar('groups')?'active':false ?>">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            Nhóm người dùng
                            <i class="fas fa-angle-left right"></i>

                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?php echo _WEB_HOST_ROOT_ADMIN.'/?module=groups' ?>" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Danh sách</p>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a href="<?php echo _WEB_HOST_ROOT_ADMIN.'/?module=groups&action=add' ?>" class="nav-link ">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Thêm mới</p>
                            </a>
                        </li>

                    </ul>
                </li>


                <li class="nav-item has-treeview <?php echo getActiveSidebar('services')?'menu-open':false ?>">
                    <a href="#" class="nav-link <?php echo getActiveSidebar('services')?'active':false ?>">
                        <i class="nav-icon fab fa-servicestack"></i>
                        <p>
                            Quản lý dịch vụ
                            <i class="fas fa-angle-left right"></i>

                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?php echo _WEB_HOST_ROOT_ADMIN.'/?module=services' ?>" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Danh sách</p>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a href="<?php echo _WEB_HOST_ROOT_ADMIN.'/?module=services&action=add' ?>"
                                class="nav-link ">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Thêm mới</p>
                            </a>
                        </li>

                    </ul>
                </li>

                <li class="nav-item has-treeview <?php echo getActiveSidebar('pages')?'menu-open':false ?>">
                    <a href="#" class="nav-link <?php echo getActiveSidebar('pages')?'active':false ?>">
                        <i class="nav-icon fas fa-file"></i>
                        <p>
                            Quản lý trang
                            <i class="fas fa-angle-left right"></i>

                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?php echo _WEB_HOST_ROOT_ADMIN.'/?module=pages' ?>" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Danh sách</p>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a href="<?php echo _WEB_HOST_ROOT_ADMIN.'/?module=pages&action=add' ?>" class="nav-link ">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Thêm mới</p>
                            </a>
                        </li>

                    </ul>
                </li>

                <li
                    class="nav-item has-treeview <?php echo getActiveSidebar('portfolio_categories') || getActiveSidebar('portfolios')?'menu-open':false ?>">
                    <a href="#"
                        class="nav-link <?php echo getActiveSidebar('portfolio_categories') || getActiveSidebar('portfolios')?'active':false ?>">
                        <i class="nav-icon fas fa-project-diagram"></i>
                        <p>
                            Quản lý dự án
                            <i class="fas fa-angle-left right"></i>

                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?php echo _WEB_HOST_ROOT_ADMIN.'/?module=portfolio_categories' ?>"
                                class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Danh sách dự án</p>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a href="<?php echo _WEB_HOST_ROOT_ADMIN.'/?module=portfolio_categories&action=add' ?>"
                                class="nav-link ">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Thêm mới dự án</p>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a href="<?php echo _WEB_HOST_ROOT_ADMIN.'/?module=portfolios' ?>" class="nav-link ">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Danh mục dự án</p>
                            </a>
                        </li>

                    </ul>
                </li>

                <li
                    class="nav-item has-treeview <?php echo getActiveSidebar('blog_categories') || getActiveSidebar('blog')?'menu-open':false ?>">
                    <a href="#"
                        class="nav-link <?php echo getActiveSidebar('blog_categories') || getActiveSidebar('blog')?'active':false ?>">
                        <i class="nav-icon fas fa-blog"></i>
                        <p>
                            Quản lý blog
                            <i class="fas fa-angle-left right"></i>

                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?php echo _WEB_HOST_ROOT_ADMIN.'/?module=blog_categories' ?>" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Danh sách blog</p>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a href="<?php echo _WEB_HOST_ROOT_ADMIN.'/?module=blog_categories&action=add' ?>"
                                class="nav-link ">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Thêm mới blog</p>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a href="<?php echo _WEB_HOST_ROOT_ADMIN.'/?module=blog' ?>" class="nav-link ">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Danh mục blog</p>
                            </a>
                        </li>

                    </ul>
                </li>

                <li class="nav-item has-treeview <?php echo getActiveSidebar('options')?'menu-open':false ?>">
                    <a href="#" class="nav-link <?php echo getActiveSidebar('options')?'active':false ?>">
                        <i class="nav-icon fas fa-cog"></i>
                        <p>
                            Thiết lập trang
                            <i class="fas fa-angle-left right"></i>

                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?php echo _WEB_HOST_ROOT_ADMIN.'/?module=options&action=general' ?>"
                                class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Thiết lập chung</p>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a href="<?php echo _WEB_HOST_ROOT_ADMIN.'/?module=options&action=footer' ?>"
                                class="nav-link ">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Thiết lập Footer</p>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a href="<?php echo _WEB_HOST_ROOT_ADMIN.'/?module=options&action=home' ?>"
                                class="nav-link ">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Thiết lập Slide</p>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a href="<?php echo _WEB_HOST_ROOT_ADMIN.'/?module=options&action=about' ?>"
                                class="nav-link ">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Thiết lập thông tin</p>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a href="<?php echo _WEB_HOST_ROOT_ADMIN.'/?module=options&action=our-team' ?>"
                                class="nav-link ">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Danh sách thành viên</p>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a href="<?php echo _WEB_HOST_ROOT_ADMIN.'/?module=options&action=service' ?>"
                                class="nav-link ">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Thiết lập dịch vụ</p>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a href="<?php echo _WEB_HOST_ROOT_ADMIN.'/?module=options&action=fact' ?>"
                                class="nav-link ">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Thiết lập Thành tích</p>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a href="<?php echo _WEB_HOST_ROOT_ADMIN.'/?module=options&action=portfolio' ?>"
                                class="nav-link ">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Thiết lập dự án</p>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a href="<?php echo _WEB_HOST_ROOT_ADMIN.'/?module=options&action=action' ?>"
                                class="nav-link ">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Thiết lập Action</p>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a href="<?php echo _WEB_HOST_ROOT_ADMIN.'/?module=options&action=blog' ?>"
                                class="nav-link ">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Thiết lập Blog</p>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a href="<?php echo _WEB_HOST_ROOT_ADMIN.'/?module=options&action=contact' ?>"
                                class="nav-link ">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Thiết lập Contact</p>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a href="<?php echo _WEB_HOST_ROOT_ADMIN.'/?module=options&action=partner' ?>"
                                class="nav-link ">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Thiết lập Partner</p>
                            </a>
                        </li>

                    </ul>
                </li>


                <?php 
          $countContact = getRows("select * from contacts");
          ?>
                <li class="nav-item has-treeview <?php echo getActiveSidebar('contacts')?'menu-open':false ?>">
                    <a href="#" class="nav-link <?php echo getActiveSidebar('contacts')?'active':false ?>">
                        <i class="nav-icon fas fa-phone-alt"></i>
                        <p>
                            <p>Quản lý liên hệ <span class="badge badge-danger"></span></p>
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?php echo _WEB_HOST_ROOT_ADMIN.'/?module=contacts' ?>" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Danh sách <span class="badge badge-danger"><?php echo $countContact ?></span></p>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a href="<?php echo _WEB_HOST_ROOT_ADMIN.'/?module=contact_type' ?>" class="nav-link ">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Liên hệ phòng ban</p>
                            </a>
                        </li>

                    </ul>
                </li>
                <?php 
                $countComment = getRows("select * from comments");
                ?>
                <li class="nav-item has-treeview <?php echo getActiveSidebar('comments')?'menu-open':false ?>">
                    <a href="#" class="nav-link <?php echo getActiveSidebar('comments')?'active':false ?>">
                        <i class="nav-icon fas fa-comments"></i>
                        <p>
                            <p>Quản lý bình luận <span class="badge badge-danger"></span></p>
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?php echo _WEB_HOST_ROOT_ADMIN.'/?module=comments' ?>" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Danh sách <span class="badge badge-danger"><?php echo $countComment ?></span></p>
                            </a>
                        </li>


                    </ul>
                </li>



            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>