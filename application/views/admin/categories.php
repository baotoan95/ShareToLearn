<div class="row">
    <div class="col-md-3">
        <!-- general form elements -->
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Thêm Thể Loại</h3>
            </div><!-- /.box-header -->
            <!-- form start -->
            <form role="form" action="addcategory" action="get">
                <div class="box-body">
                    <div class="form-group">
                        <label for="cate-name">Tên Thể Loại</label>
                        <input class="form-control" name="newcate" id="cate-name" type="text">
                    </div>
                    <div class="form-group">
                        <label for="slug">Slug</label>
                        <input class="form-control" name="slug" id="slug" type="text">
                    </div>
                    <div class="form-group">
                        <label>Cha</label>
                        <select name="parent_cate" class="form-control">
                            <option value="0">---- Cha ----</option>
                            <?php echo $categoriesParentBox; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Mô Tả</label>
                        <textarea class="form-control" name="desc" rows="3" placeholder="Nhập ..."></textarea>
                    </div>
                </div><!-- /.box-body -->
                <div class="box-footer">
                    <button type="submit" id="submit" class="btn btn-primary">Thêm</button>
                    <script lang="javascript">
                        // ADD tag
                        $('#submit').click(function (e) {
                            e.preventDefault();
                            if(!$('input[name=newcate]').val()) {
                                return;
                            }
                            $.ajax({
                                url: <?php echo "\"" . base_url() . "category/addCategory\""; ?>,
                                type: "POST",
                                dataType: "text",
                                data: {
                                    newcate: $('input[name=newcate]').val(),
                                    slug: $('input[name=slug]').val(),
                                    parent_cate: $('select[name=parent_cate]').val(),
                                    desc: $('textarea[name=desc]').val(),
                                    hasParentBox : true
                                },
                                success: function (res) {
                                    if (res !== 'failure') {
                                        var data = $.parseJSON(res);
                                        var category = data.category;
                                        $('tbody').prepend(
                                                "<tr>" +
                                                "<td>" + category.name + "</td>" +
                                                "<td>" + category.desc + "</td>" +
                                                "<td>" + category.slug + "</td>" +
                                                "<td>" + category.count + "</td>" +
                                                "<td><i class='fa fa-fw fa-trash del_tag' id='" + category.id + "'></i></td>" +
                                                "</tr>"
                                                );
                                    } else {

                                    }
                                },
                                failure: function (error) {
                                    alert(err);
                                }
                            });
                        });
                    </script>
                </div>
            </form>
        </div><!-- /.box -->
    </div>

    <div class="col-md-9">

        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Danh Sách Bài Viết</h3><br/>
                <?php echo (isset($_GET['search']) && strlen(trim($_GET['search'])) > 0) ? "Kết quả cho\"" . $_GET['search'] . "\"" : "";?>
                <div class="box-tools">
                    <form action="" method="get">
                        <div class="input-group" style="width: 150px;">
                            <input name="search" class="form-control input-sm pull-right" placeholder="Tìm kiếm" type="text">
                            <div class="input-group-btn">
                                <button class="btn btn-sm btn-default"><i class="fa fa-search"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div><!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Tên</th>
                            <th>Mô Tả</th>
                            <th>Slug</th>
                            <th>Số Lượng</th>
                            <th>Xóa</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($categories as $category) {
                            ?>
                            <tr>
                                <td><a href="<?php echo base_url() . 'category/editCategory/' . $category->getId(); ?>"><?php echo $category->getName(); ?></a></td>
                                <td><?php echo $category->getDesc(); ?></td>
                                <td><?php echo $category->getSlug(); ?></td>
                                <td><?php echo $category->getCount(); ?></td>
                                <td><i class="fa fa-fw fa-trash del_cate" id="<?php echo $category->getId(); ?>"></i></td>
                            </tr>
                            <?php
                        }
                        ?>
                    </tbody>
                </table>
                <script lang="javascript">
                    // DELETE tag
                    $('.del_cate').click(function () {
                        var element = $(this);
                        $.ajax({
                            url: <?php echo "\"" . base_url() . "category/deleteCategory\""; ?>,
                            type: "POST",
                            dataType: "text",
                            data: {
                                cate_id: element.attr('id')
                            },
                            success: function (res) {
                                if (res !== 'failure') {
                                    element.parent().parent().remove();
                                }
                            },
                            failure: function (error) {
                                alert(err);
                            }
                        });
                    });
                </script>
            </div><!-- /.box-body -->
            <div class="box-footer clearfix">
                <ul class="pagination pagination-sm no-margin pull-right">
                    <?php echo $links; ?>
                </ul>
            </div>
        </div><!-- /.box -->
    </div>
</div>