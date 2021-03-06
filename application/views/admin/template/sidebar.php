<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?php echo base_url() . 'assets/upload/images/avatars/' . $this->session->userdata('cur_user')['avatar']; ?>" class="img-circle" alt="User Image" />
            </div>
            <div class="pull-left info">
                <p><?php echo $this->session->userdata('cur_user')['fullName']; ?></p>
                <a><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION</li>
            <li class="active treeview">
                <a href="<?php echo base_url() . 'AdminRedirect/index'?>">
                    <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                </a>
            </li>
            <li>
                <a href="<?php echo base_url() . 'menu/menus'?>">
                    <i class="fa fa-book"></i> <span>Menu</span>
                </a>
            </li>
            <li class="treeview">
                <a href="<?php echo base_url() . 'category/categories'?>">
                    <i class="fa fa-folder"></i>
                    <span>Categories</span>
                </a>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-files-o"></i>
                    <span>Pages</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?php echo base_url() . 'post/posts?type=page&status=all'?>"><i class="fa fa-circle-o"></i> All pages</a></li>
                    <li><a href="<?php echo base_url() . 'post/newpost?type=page'?>"><i class="fa fa-circle-o"></i> Add new</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-files-o"></i>
                    <span>Posts</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?php echo base_url() . 'post/posts?status=all'?>"><i class="fa fa-circle-o"></i> All posts</a></li>
                    <li class="active"><a href="<?php echo base_url() . 'post/newpost'?>"><i class="fa fa-circle-o"></i> Add new</a></li>
                    <li><a href="<?php echo base_url() . 'tag/tags'?>"><i class="fa fa-circle-o"></i> Tags</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="<?php echo base_url() . 'comment/comments'?>">
                    <i class="fa fa-edit"></i> <span>Discussion</span>
                    <small class="label pull-right bg-yellow">
                        <?php echo $this->session->userdata('count_discussion_unapproved'); ?>
                    </small>
                </a>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-users"></i>
                    <span>Users</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?php echo base_url() . 'user/users?role=all'?>"><i class="fa fa-circle-o"></i> All users</a></li>
                    <li><a href="<?php echo base_url() . 'user/newuser'?>"><i class="fa fa-circle-o"></i> Add a user</a></li>
                    <li><a href="<?php echo base_url() . 'user/profile'; ?>"><i class="fa fa-circle-o"></i> Your profile</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="<?php echo base_url() . 'AdminRedirect/setting'?>">
                    <i class="fa fa-cog"></i>
                    <span>Setting</span>
                </a>
            </li>
            
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>