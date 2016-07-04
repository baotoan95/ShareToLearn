<div class="col-xs-12">
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Danh Sách Bài Viết</h3>
            <div class="input-group">
                <div class="input-group-btn">
                    <button class="btn btn-sm btn-default">Tất cả (100)</button>
                    <button class="btn btn-sm btn-default">Chờ duyệt (12)</button>
                    <button class="btn btn-sm btn-default">Công khai (32)</button>
                    <button class="btn btn-sm btn-default">Riêng tư (32)</button>
                    <button class="btn btn-sm btn-default">Nháp (32)</button>
                    <button class="btn btn-sm btn-default">Rác (32)</button>
                </div>
            </div>
            <div class="box-tools">
                <div class="input-group" style="width: 150px;">
                    <input name="table_search" class="form-control input-sm pull-right" placeholder="Search" type="text">
                    <div class="input-group-btn">
                        <button class="btn btn-sm btn-default"><i class="fa fa-search"></i></button>
                    </div>
                </div>
            </div>
        </div><!-- /.box-header -->
        <div class="box-body table-responsive no-padding">
            <table class="table table-hover">
                <tbody>
                    <tr>
                        <th>ID</th>
                        <th>Tiêu Đề</th>
                        <th>Tác Giả</th>
                        <th>Thể Loại</th>
                        <th>Tags</th>
                        <th>Bình Luận</th>
                        <th>Lượt Xem</th>
                        <th>Ngày Đăng</th>
                        <th>Trạng Thái</th>
                    </tr>
                    <?php
                        foreach($posts as $post) {
                    ?>
                    <tr>
                        <td><?php echo $post->getId(); ?></td>
                        <td><a href="<?php echo base_url() . 'post/edit/' . $post->getId(); ?>"><?php echo $post->getTitle(); ?></a></td>
                        <td>John Doe</td>
                        <td>Học lập trình</td>
                        <td>hoclaptrinh, baotoan, damme</td>
                        <td><?php echo $post->getComments(); ?></td>
                        <td><?php echo $post->getViews(); ?></td>
                        <td><?php echo $post->getPublished(); ?></td>
                        <td><span class="label label-success">Approved</span></td>
                    </tr>
                    <?php
                        }
                    ?>
                </tbody>
            </table>
        </div><!-- /.box-body -->
        <div class="box-footer clearfix">
            <?php echo $links ?>
<!--            <ul class="pagination pagination-sm no-margin pull-right">
                <li><a href="#">«</a></li>
                <li><a href="#">1</a></li>
                <li><a href="#">2</a></li>
                <li><a href="#">3</a></li>
                <li><a href="#">»</a></li>
            </ul>-->
        </div>
    </div><!-- /.box -->
</div>