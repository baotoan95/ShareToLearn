<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?php echo base_url() . 'assets/admin/dist/img/user2-160x160.jpg' ?>" class="img-circle" alt="User Image" />
            </div>
            <div class="pull-left info">
                <p>Alexander Pierce</p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION</li>
            <li class="active treeview">
                <a href="#">
                    <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                </a>
            </li>
            <li>
                <a href="<?php echo base_url() . 'adminredirect/menus'?>">
                    <i class="fa fa-book"></i> <span>Quản lý thực đơn</span>
                </a>
            </li>
            <li class="treeview">
                <a href="<?php echo base_url() . 'category/categories'?>">
                    <i class="fa fa-folder"></i>
                    <span>Quản lý thể loại</span>
                </a>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-files-o"></i>
                    <span>Quản lý trang</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?php echo base_url() . 'post/posts?status=all'?>"><i class="fa fa-circle-o"></i> Tất cả bài viết</a></li>
                    <li><a href="<?php echo base_url() . 'post/newpost'?>"><i class="fa fa-circle-o"></i> Thêm bài viết</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-files-o"></i>
                    <span>Quản lý bài viết</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?php echo base_url() . 'post/posts?status=all'?>"><i class="fa fa-circle-o"></i> Tất cả bài viết</a></li>
                    <li class="active"><a href="<?php echo base_url() . 'post/newpost'?>"><i class="fa fa-circle-o"></i> Thêm bài viết</a></li>
                    <li><a href="<?php echo base_url() . 'tag/tags'?>"><i class="fa fa-circle-o"></i> Tags</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="<?php echo base_url() . 'adminredirect/comments'?>">
                    <i class="fa fa-edit"></i> <span>Quản lý bình luận</span>
                    <small class="label pull-right bg-yellow">12</small>
                </a>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-users"></i>
                    <span>Quản lý người dùng</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?php echo base_url() . 'user/users?role=all'?>"><i class="fa fa-circle-o"></i> Tất cả người dùng</a></li>
                    <li><a href="<?php echo base_url() . 'user/newuser'?>"><i class="fa fa-circle-o"></i> Thêm người dùng</a></li>
                    <li><a href="<?php echo base_url() . 'adminredirect/profile'?>"><i class="fa fa-circle-o"></i> Hồ sơ của bạn</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-cog"></i>
                    <span>Cấu Hình</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?php echo base_url() . 'adminredirect/posts'?>"><i class="fa fa-circle-o"></i> General</a></li>
                    <li><a href="<?php echo base_url() . 'adminredirect/newpost'?>"><i class="fa fa-circle-o"></i> Thảo luận</a></li>
                    <li><a href="<?php echo base_url() . 'adminredirect/tags'?>"><i class="fa fa-circle-o"></i> Email</a></li>
                </ul>
            </li>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>