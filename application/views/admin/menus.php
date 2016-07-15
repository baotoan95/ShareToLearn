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
                                        <label for="exampleInputEmail1">Liên kết</label>
                                        <input class="form-control" placeholder="" type="text">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Tên liên kết</label>
                                        <input class="form-control" placeholder="" type="text">
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary">Thêm</button>
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
                                        <label for="exampleInputEmail1">Tìm kiếm</label>
                                        <input class="form-control" placeholder="" type="text">
                                    </div>
                                    <select multiple="" class="form-control">
                                        <?php
                                            echo $categories;
                                        ?>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary">Thêm</button>
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
                                        <label for="exampleInputEmail1">Tìm kiếm</label>
                                        <input class="form-control" placeholder="" type="text">
                                    </div>
                                    <select multiple="" class="form-control">
                                        <?php
                                        foreach($pages as $page) {
                                            echo "<option value='{$page->getId()}'>{$page->getTitle()}</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary">Thêm</button>
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
                        <ol class="dd-list">
                            <li class="dd-item" data-id="1">
                                <div class="dd-handle">Item 1</div>
                            </li>
                            <li class="dd-item" data-id="2">
                                <div class="dd-handle">Item 2</div>
                                <ol class="dd-list">
                                    <li class="dd-item" data-id="3"><div class="dd-handle">Item 3</div></li>
                                    <li class="dd-item" data-id="4"><div class="dd-handle">Item 4</div></li>
                                    <li class="dd-item" data-id="5">
                                        <div class="dd-handle">Item 5</div>
                                        <ol class="dd-list">
                                            <li class="dd-item" data-id="6"><div class="dd-handle">Item 6</div></li>
                                            <li class="dd-item" data-id="7"><div class="dd-handle">Item 7</div></li>
                                            <li class="dd-item" data-id="8"><div class="dd-handle">Item 8</div></li>
                                        </ol>
                                    </li>
                                    <li class="dd-item" data-id="9"><div class="dd-handle">Item 9</div></li>
                                    <li class="dd-item" data-id="10"><div class="dd-handle">Item 10</div></li>
                                </ol>
                            </li>
                            <li class="dd-item" data-id="11">
                                <div class="dd-handle">Item 11</div>
                            </li>
                            <li class="dd-item" data-id="12">
                                <div class="dd-handle">Item 12</div>
                            </li>
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
        })
                .on('change', updateOutput);

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
    });
</script>