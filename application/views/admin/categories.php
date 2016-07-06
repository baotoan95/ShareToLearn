<div class="row">
    <div class="col-md-3">
        <!-- general form elements -->
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Thêm Thể Loại</h3>
            </div><!-- /.box-header -->
            <!-- form start -->
            <form role="form">
                <div class="box-body">
                    <div class="form-group">
                        <label for="tag-name">Tên Thể Loại</label>
                        <input class="form-control" name="name" id="tag-name" type="text">
                    </div>
                    <div class="form-group">
                        <label for="slug">Slug</label>
                        <input class="form-control" name="slug" id="slug" type="text">
                    </div>
                    <div class="form-group">
                        <label>Cha</label>
                        <select name="cate_parent" class="form-control">
                            <option>---- Cha ----</option>
                            <?php echo $categoriesParentBox; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Mô Tả</label>
                        <textarea class="form-control" rows="3" placeholder="Nhập ..."></textarea>
                    </div>
                </div><!-- /.box-body -->
                <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Thêm</button>
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
                    <tbody>
                        <tr>
                            <th>Tên</th>
                            <th>Mô Tả</th>
                            <th>Slug</th>
                            <th>Xóa</th>
                        </tr>
                        <?php
                        foreach ($categories as $category) {
                            ?>
                            <tr>
                                <td><a href="<?php echo base_url() . 'category/editCategory/' . $category->getId(); ?>"><?php echo $category->getName(); ?></a></td>
                                <td><?php echo $category->getDesc(); ?></td>
                                <td><?php echo $category->getSlug(); ?></td>
                                <td><i class="fa fa-fw fa-trash del_tag" id="<?php echo $category->getId(); ?>"></i></td>
                            </tr>
                            <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div><!-- /.box-body -->
            <div class="box-footer clearfix">
                <ul class="pagination pagination-sm no-margin pull-right">
                    <?php echo $links; ?>
                </ul>
            </div>
        </div><!-- /.box -->
    </div>
</div>