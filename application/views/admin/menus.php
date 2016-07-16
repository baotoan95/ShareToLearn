<div class="row">
    <div class="col-md-3">
        <section class="sidebar box box-primary">
            <ul class="sidebar-menu">
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-folder"></i>
                        <span>Liên kết</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li>
                            <form role="form">
                                <div class="box-body box-default">
                                    <div class="form-group">
                                        <label for="link">Liên kết</label>
                                        <input id="link" class="form-control" placeholder="" type="text">
                                    </div>
                                    <div class="form-group">
                                        <label for="link_name">Tên liên kết</label>
                                        <input id="link_name" class="form-control" placeholder="" type="text">
                                    </div>
                                    <div class="form-group">
                                        <button id="add_link" class="btn btn-primary">Thêm</button>
                                    </div>
                                    
                                </div>
                            </form>
                        </li>
                    </ul>
                </li>
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-files-o"></i>
                        <span>Thể Loại</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li>
                            <form role="form">
                                <div class="box-body">
                                    <div class="form-group">
                                        <label for="search-cates">Tìm kiếm</label>
                                        <input id="search-cates" class="form-control" placeholder="" type="text">
                                    </div>
                                    <select id="cates" multiple="" class="form-control">
                                        <?php
                                            echo $categories;
                                        ?>
                                    </select>
                                </div>
                                <button id='add_cate' class="btn btn-primary">Thêm</button>
                                <script type="text/javascript">
                                        // SEARCH category
                                        $('#search-cates').on('keyup', function() {
                                            $.ajax({
                                                url: "<?php echo base_url() . 'category/searchCategoriesAjax'?>",
                                                type: "post",
                                                contextType: "text",
                                                data: {
                                                    name: $('#search-cates').val()
                                                },
                                                success: function(res) {
                                                    $('#cates').empty();
                                                    if($('#search-cates').val() === '') {
                                                        $('#cates').append(res);
                                                        return;
                                                    }
                                                    var cates = $.parseJSON(res);
                                                    $('#cates').empty();
                                                    cates.forEach(function(cate) {
                                                        $('#cates').append(
                                                            "<option value='" + cate.id + "'>" + cate.name + "</option>"
                                                        );
                                                    });
                                                },
                                                failure: function(error) {
                                                    alert(error);
                                                }
                                            });
                                        });
                                        
                                        
                                    </script>
                            </form>
                        </li>
                    </ul>
                </li>
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-edit"></i> 
                        <span>Trang</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li>
                            <form role="form">
                                <div class="box-body">
                                    <div class="form-group">
                                        <label for="search-page">Tìm kiếm</label>
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
                                <button id='add_page' class="btn btn-primary">Thêm</button>
                                <script type="text/javascript">
                                        // Search page
                                        $('#search-page').on('keyup', function() {
                                            $.ajax({
                                                url: "<?php echo base_url() . 'post/searchPageAjax'?>",
                                                type: "post",
                                                contextType: "text",
                                                data: {
                                                    name: $('#search-page').val()
                                                },
                                                success: function(res) {
                                                    var posts = $.parseJSON(res);
                                                    $('#pages').empty();
                                                    posts.forEach(function(post) {
                                                        $('#pages').append(
                                                            "<option value='" + post.id + "'>" + post.title + "</option>"
                                                        );
                                                    });
                                                },
                                                failure: function(error) {
                                                    alert(error);
                                                }
                                            });
                                        });
                                        
                                        
                                    </script>
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
                <h3 class="box-title">Cấu trúc menu</h3>
            </div><!-- /.box-header -->
            <!-- form start -->
            <form role="form">
                <div class="box-body">
                    <div class="dd" id="nestable">
                        <ol id="menus" class="dd-list">
                        </ol>
                    </div>

                    <textarea id="nestable-output"></textarea>
                </div><!-- /.box-body -->
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
<script>
    $(document).ready(function () {
        // Create menu view
        var updateOutput = function (e) {
            var list = e.length ? e : $(e.target),
                    output = list.data('output');
            if (window.JSON) {
                output.val(window.JSON.stringify(list.nestable('serialize')));//, null, 2));
            } else {
                output.val('JSON browser support required for this demo.');
            }
        };

        // activate Nestable for list 1
        $('#nestable').nestable({
            group: 1
        }).on('change', updateOutput);

        // output initial serialised data
        updateOutput($('#nestable').data('output', $('#nestable-output')));

        $('#nestable-menu').on('click', function (e) {
            var target = $(e.target), action = target.data('action');
            if (action === 'expand-all') {
                $('.dd').nestable('expandAll');
            }
            if (action === 'collapse-all') {
                $('.dd').nestable('collapseAll');
            }
        });
        // End create menu view
        
        // ADD link
        $('#add_link').on('click', function(e) {
            e.preventDefault();
            $('#link, #link_name').css({"border": "1px solid #D2D6DE"});
                if($('#link').val() === '') {
                    $('#link').css({"border": "1px solid red"});
                    return;
                }
                if($('#link_name').val() === '') {
                    $('#link_name').css({"border": "1px solid red"});
                    return;
                }
                $('#menus').append(
                    '<li class="dd-item" data-id="0">' +
                        '<div class="dd-handle">'+ $('#link_name').val() +'</div>' +
                    '</li>'
                );
                updateOutput($('#nestable').data('output', $('#nestable-output')));
        });
        // END add link
        
        // ADD category to menu
        $('#add_cate').on('click', function(e) {
            e.preventDefault();
            if($('#cates').val() === null) {
                return;
            }
            $.ajax({
                url: "<?php echo base_url() . 'category/getCategoriesAjax'?>",
                type: "post",
                contextType: "text",
                data: {
                    cateIds: $('#cates').val()
                },
                success: function(res) {
                    var cates = $.parseJSON(res);
                    cates.forEach(function(cate) {
                        $('#menus').append(
                            '<li class="dd-item" data-id="' + cate.id + '">' +
                                '<div class="dd-handle">'+ cate.name +'</div>' +
                            '</li>'
                        );
                    });
                    updateOutput($('#nestable').data('output', $('#nestable-output')));
                },
                failure: function(error) {
                    alert(error);
                }
            });
        });
        // END add category to menu
        
        // ADD page to menu
        $('#add_page').on('click', function(e) {
            e.preventDefault();
            if($('#pages').val() === null) {
                return;
            }
            $.ajax({
                url: "<?php echo base_url() . 'post/getPagesAjax'?>",
                type: "post",
                contextType: "text",
                data: {
                    pageIds: $('#pages').val()
                },
                success: function(res) {
                    var pages = $.parseJSON(res);
                    pages.forEach(function(page) {
                        $('#menus').append(
                            '<li class="dd-item" data-id="' + page.id + '">' +
                                '<div class="dd-handle">'+ page.title +'</div>' +
                            '</li>'
                        );
                    });
                    updateOutput($('#nestable').data('output', $('#nestable-output')));
                },
                failure: function(error) {
                    alert(error);
                }
            });
        });
        // END add page to menu
    });
</script>