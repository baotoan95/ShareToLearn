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
                                        <select class="form-control select2" style="width: 100%;">
                                            <option selected="selected">Alabama</option>
                                            <option>Alaska</option>
                                            <option>California</option>
                                            <option>Delaware</option>
                                            <option>Tennessee</option>
                                            <option>Texas</option>
                                            <option>Washington</option>
                                        </select>
                                    </div><!-- /.form-group -->
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
                                        <label>Thể Loại</label>
                                        <select class="form-control">
                                            <option>option 2</option>
                                            <option>option 3</option>
                                            <option>option 4</option>
                                            <option>option 5</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Parent</label>
                                        <select class="form-control">
                                            <option>option 2</option>
                                            <option>option 3</option>
                                            <option>option 4</option>
                                            <option>option 5</option>
                                        </select>
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
                        <i class="fa fa-edit"></i> 
                        <span>Trang</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li>
                            <form role="form">
                                <div class="box-body">
                                    <div class="form-group">
                                        <label>Trang</label>
                                        <select class="form-control">
                                            <option>option 2</option>
                                            <option>option 3</option>
                                            <option>option 4</option>
                                            <option>option 5</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Parent</label>
                                        <select class="form-control">
                                            <option>option 2</option>
                                            <option>option 3</option>
                                            <option>option 4</option>
                                            <option>option 5</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary">Thêm</button>
                                    </div>
                                </div>
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
                    <ul id="tree">
                        <li><a href="#">TECH</a>
                            <ul>
                                <li>Company Maintenance</li>
                                <li>Employees
                                    <ul>
                                        <li>Reports
                                            <ul>
                                                <li>Report1</li>
                                                <li>Report2</li>
                                                <li>Report3</li>
                                            </ul>
                                        </li>
                                        <li>Employee Maint.</li>
                                    </ul>
                                </li>
                                <li>Human Resources</li>
                            </ul>
                        </li>
                        <li>XRP
                            <ul>
                                <li>Company Maintenance</li>
                                <li>Employees
                                    <ul>
                                        <li>Reports
                                            <ul>
                                                <li>Report1</li>
                                                <li>Report2</li>
                                                <li>Report3</li>
                                            </ul>
                                        </li>
                                        <li>Employee Maint.</li>
                                    </ul>
                                </li>
                                <li>Human Resources</li>
                            </ul>
                        </li>
                    </ul>
                </div><!-- /.box-body -->

                <script lang="javascript">
                    $.fn.extend({
                        treed: function (o) {
                            var openedClass = 'glyphicon-minus-sign';
                            var closedClass = 'glyphicon-plus-sign';

                            if (typeof o !== 'undefined') {
                                if (typeof o.openedClass !== 'undefined') {
                                    openedClass = o.openedClass;
                                }
                                if (typeof o.closedClass !== 'undefined') {
                                    closedClass = o.closedClass;
                                }
                            }
                            ;

                            //initialize each of the top levels
                            var tree = $(this);
                            tree.addClass("tree");
                            tree.find('li').has("ul").each(function () {
                                var branch = $(this); //li with children ul
                                branch.prepend("<i class='indicator glyphicon " + closedClass + "'></i>");
                                branch.addClass('branch');
                                branch.on('click', function (e) {
                                    if (this === e.target) {
                                        var icon = $(this).children('i:first');
                                        icon.toggleClass(openedClass + " " + closedClass);
                                        $(this).children().children().toggle();
                                    }
                                });
                                branch.children().children().toggle();
                            });
                            //fire event from the dynamically added icon
                            tree.find('.branch .indicator').each(function () {
                                $(this).on('click', function () {
                                    $(this).closest('li').click();
                                });
                            });
                            //fire event to open branch if the li contains an anchor instead of text
                            tree.find('.branch>a').each(function () {
                                $(this).on('click', function (e) {
                                    $(this).closest('li').click();
                                    e.preventDefault();
                                });
                            });
                            //fire event to open branch if the li contains a button instead of text
                            tree.find('.branch>button').each(function () {
                                $(this).on('click', function (e) {
                                    $(this).closest('li').click();
                                    e.preventDefault();
                                });
                            });
                        }
                    });

                    //Initialization of treeviews

                    $('#tree').treed();
                </script>
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
