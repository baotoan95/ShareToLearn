<div class="row">
    <div class="col-md-3">
        <section class="sidebar box box-primary">
            <ul class="sidebar-menu">
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-folder"></i>
                        <span>Custom Link</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li>
                            <form role="form">
                                <div class="box-body box-default">
                                    <div class="form-group">
                                        <label for="link">Link</label>
                                        <input id="link" class="form-control" placeholder="" type="text">
                                    </div>
                                    <div class="form-group">
                                        <label for="link_name">Link name</label>
                                        <input id="link_name" class="form-control" placeholder="" type="text">
                                    </div>
                                    <div class="form-group">
                                        <button id="add_link" class="btn btn-primary">ADD</button>
                                    </div>
                                </div>
                            </form>
                        </li>
                    </ul>
                </li>
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-files-o"></i>
                        <span>Category</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li>
                            <form role="form">
                                <div class="box-body">
                                    <div class="form-group">
                                        <label for="search-cates">Search</label>
                                        <input id="search-cates" class="form-control" placeholder="" type="text">
                                    </div>
                                    <select id="cates" multiple="" class="form-control">
                                        <?php
                                            echo $categories;
                                        ?>
                                    </select>
                                </div>
                                <button id='add_cate' class="btn btn-primary">ADD</button>
                            </form>
                        </li>
                    </ul>
                </li>
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-edit"></i> 
                        <span>Pages</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li>
                            <form role="form">
                                <div class="box-body">
                                    <div class="form-group">
                                        <label for="search-page">Search</label>
                                        <input id="search-page" class="form-control" placeholder="" type="text">
                                    </div>
                                    <select id="pages" multiple="true" class="form-control">
                                        <?php
                                        foreach($pages as $page) {
                                            echo "<option value='{$page->getId()}'>{$page->getTitle()}</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <button id='add_page' class="btn btn-primary">ADD</button>
                            </form>
                        </li>
                    </ul>
                </li>
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-edit"></i> 
                        <span>Posts</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li>
                            <form role="form">
                                <div class="box-body">
                                    <div class="form-group">
                                        <label for="search-post">Search</label>
                                        <input id="search-post" class="form-control" placeholder="" type="text">
                                    </div>
                                    <select id="posts" multiple="true" class="form-control">
                                        <?php
                                        foreach($posts as $post) {
                                            echo "<option value='{$post->getId()}'>{$post->getTitle()}</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <button id='add_post' class="btn btn-primary">ADD</button>
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>
        </section>
    </div>

    <div class="col-md-9">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Menu Structure</h3>
            </div><!-- /.box-header -->
            <!-- form start -->
            <form role="form" action="<?php echo base_url() . 'menu/addAndUpdateMenu'?>" method="post">
                <div class="box-body">
                    <div class="dd" id="nestable">
                        <ol id="menus" class="dd-list">
                            <?php echo $menu; ?>
                        </ol>
                    </div>
                    <!-- DATA -->
                    <input type="hidden" id="nestable-output" name="menu"/>
                </div><!-- /.box-body -->
                <div class="box-footer">
                    <button id="delete_menu" class="btn btn-info pull-left">Delete Menu</button>
                    <button type="submit" class="btn btn-info pull-right">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="<?php echo base_url() . 'assets/admin/plugins/select2/select2.full.min.js' ?>" type="text/javascript"></script>
<script type="text/javascript">
    $(function () {
        //Initialize Select2 Elements
        $(".select2").select2();
    });
</script>

<!-- Nestabe -->
<script src="<?php echo base_url(); ?>assets/admin/dist/js/nestable.js"></script>
<script src="<?php echo base_url(); ?>assets/admin/dist/js/pages/menu_management.js"></script>