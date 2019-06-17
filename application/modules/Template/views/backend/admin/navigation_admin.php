<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!-- Navigation -->
<nav class="my-admin-navbar navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <div class="div-logo">
            <a class="navbar-brand" href="<?php echo my_base_url('admin/'); ?>">
                <img class="img-logo" alt="ci301hmvcmx" src="<?php echo assets_url('logo.png'); ?>" />
            </a>
        </div>
    </div>
    <!-- /.navbar-header -->

    <ul class="nav navbar-top-links navbar-right">
        <li class="li_admin_details">
            <?php
                echo $admin_login_details->admin_name;
            ?>
        </li>
        <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                <i class="fa fa-user fa-fw"></i><i class="fa fa-caret-down"></i>
            </a>
            <ul class="dropdown-menu dropdown-user">
                <li>
                    <a href="<?php echo my_base_url('admin/admin_profile/'); ?>"><i class="fa fa-user fa-fw"></i>Admin Profile</a>
                </li>
                <!-- <li>
                    <a href="#"><i class="fa fa-gear fa-fw"></i>Settings</a>
                </li> -->
                <li class="divider"></li>
                <li>
                    <a href="<?php echo my_base_url('admin/logout_process'); ?>"><i class="fa fa-sign-out fa-fw"></i>Logout</a>
                </li>
            </ul>
            <!-- /.dropdown-user -->
        </li>
        <!-- /.dropdown -->
    </ul>
    <!-- /.navbar-top-links -->

    <div class="navbar-default sidebar" role="navigation">
        <div class="sidebar-nav navbar-collapse">
            <ul class="nav" id="side-menu">
                <li class="sidebar-search">
                    <div class="input-group custom-search-form">
                        <input type="text" class="form-control" placeholder="Search...">
                        <span class="input-group-btn">
                        <button class="btn btn-default" type="button">
                            <i class="fa fa-search"></i>
                        </button>
                    </span>
                    </div>
                    <!-- /input-group -->
                </li>

                <li>
                    <a href="<?php echo my_base_url('admin/'); ?>"><i class="fa fa-dashboard fa-fw"></i><span>Dashboard</span></a>
                </li>

                <li>
                    <a href="#"><i class="fa fa-file-text-o fa-fw"></i>Pages<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="<?php echo my_base_url('admin/pages/homepage'); ?>">Home</a>
                        </li>
                        <li>
                            <a href="<?php echo my_base_url('admin'); ?>">Applications</a>
                        </li>
                    </ul>
                    <!-- /.nav-second-level -->
                </li>

                <?php /* ?>
                <li>
                    <a href="#"><i class="fa fa-sitemap fa-fw"></i>Multi-Level Dropdown<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="#">Second Level Item</a>
                        </li>
                        <li>
                            <a href="#">Second Level Item</a>
                        </li>
                        <li>
                            <a href="#">Third Level <span class="fa arrow"></span></a>
                            <ul class="nav nav-third-level">
                                <li>
                                    <a href="#">Third Level Item</a>
                                </li>
                                <li>
                                    <a href="#">Third Level Item</a>
                                </li>
                                <li>
                                    <a href="#">Third Level Item</a>
                                </li>
                                <li>
                                    <a href="#">Third Level Item</a>
                                </li>
                            </ul>
                            <!-- /.nav-third-level -->
                        </li>
                    </ul>
                    <!-- /.nav-second-level -->
                </li>
                <?php */ ?>
            </ul>
        </div>
        <!-- /.sidebar-collapse -->
    </div>
    <!-- /.navbar-static-side -->
</nav>
<!-- /.navbar -->
<!-- /Navigation -->
