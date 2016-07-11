<div class="col-xs-12">
    <?php
    if ($this->session->has_userdata('flash_message') || $this->session->has_userdata('flash_error')) {
        $isMsg = $this->session->has_userdata('flash_message');
        echo "<div class='callout " . ($isMsg ? "callout-success" : "callout-warning") . "'>" .
        "<h4>Thông báo!</h4>" .
        "<p>" . $this->session->flashdata('flash_message') .
        $this->session->flashdata('flash_error') . "</p>" .
        "</div>";
    }
    ?>
    <form action="" method="get">
        <input type="hidden" name="type" value="<?php // echo $type; ?>"/>
        <div class="box">
            <div class="box-header">
                <h3 class="box-title"><?php echo $title; ?></h3><br/>
                <?php echo (isset($_GET['search']) && strlen(trim($_GET['search'])) > 0) ? "Kết quả tìm kiếm cho \"" . $_GET['search'] . "\"" : "" ?>
                <div class="box-tools">
                    <div class="input-group" style="width: 150px;">
                        <input name="search" class="form-control input-sm pull-right"  placeholder="Tìm kiếm" type="text">
                        <div class="input-group-btn">
                            <button class="btn btn-sm btn-default"><i class="fa fa-search"></i></button>
                        </div>
                    </div>
                </div>
            </div><!-- /.box-header -->

            <!-- Body control -->
            <div class="box-body">
                <div class="row">
                    <div class="col-xs-12 col-lg-3">
                        <div class="input-group">
                            <div class="input-group-btn">
                                <input type="hidden" value="<?php echo $status; ?>" name="status"/>
                                <?php $uri = base_url() . 'comment/comments'; ?>
                                <a href="<?php echo $uri . "?type=$type" ?>" 
                                   class="btn btn-sm btn-default <?php if (empty($_GET['status']) || 
                                           $_GET['status'] == 'all') {
                                    echo 'active';
                                } ?>">
                                    Tất cả (<?php echo array_pop($count); ?>)
                                </a>
                                <?php
                                foreach ($count as $key => $value) {
                                    switch ($key) {
                                        case 'pending': echo "<a href='$uri?status=$key&type=$type' "
                                            . "class='btn btn-sm btn-default " . ((!empty($_GET['status']) && 
                                                $_GET['status'] == 'pending') ? "active" : "") . "'>"
                                            . "Chờ duyệt ($value)</a>";
                                            break;
                                        case 'approved': echo "<a href='$uri?status=$key&type=$type' "
                                            . "class='btn btn-sm btn-default " . ((!empty($_GET['status']) && 
                                                $_GET['status'] == 'approved') ? "active" : "") . "'>"
                                            . "Đã duyệt ($value)</a>";
                                            break;
                                        case 'spam': echo "<a href='$uri?status=$key&type=$type' "
                                            . "class='btn btn-sm btn-default " . ((!empty($_GET['status']) && 
                                                $_GET['status'] == 'spam') ? "active" : "") . "'>"
                                            . "Rác ($value)</a>";
                                            break;
                                        case 'trash': echo "<a href='$uri?status=$key&type=$type' "
                                            . "class='btn btn-sm btn-default " . ((!empty($_GET['status']) && 
                                                $_GET['status'] == 'trash') ? "active" : "") . "'>"
                                            . "Thùng rác ($value)</a>";
                                            break;
                                    }
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-3">
                        <select class="form-control" name="type">
                            <option value="all">Tất cả các loại</option>
                            <option value="comment" <?php echo isset($_GET['type']) && $_GET['type'] 
                                    == 'comment' ? "selected" : ""?>>Bình luận</option>
                            <option value="contact" <?php echo isset($_GET['type']) && $_GET['type'] 
                                    == 'contact' ? "selected" : ""?>>Liên hệ</option>
                        </select>
                    </div>
                    <div class="col-lg-1">
                        <button class="btn btn-sm btn-default">Lọc</button>
                    </div>
                </div>
            </div>
            <!-- End body control -->

            <!-- Body show data -->
            <div class="box-body table-responsive no-padding">
                <table class="table table-hover">
                    <tbody>
                        <tr>
                            <th>Tác Giả</th>
                            <th>Nội Dung</th>
                            <th>Ngày</th>
                            <th>Trạng Thái</th>
                            <th>Sửa</th>
                            <th>Xóa</th>
                        </tr>
                        <?php
                        foreach ($comments as $comment) {
                            ?>
                            <tr>
                                <td><?php echo $comment->getAuthor(); ?></td>
                                <td><?php echo $comment->getContent(); ?></td>
                                <td><?php echo $comment->getDate(); ?></td>
                                <td><span class="label label-success"><?php echo $comment->getStatus(); ?></span></td>
                                <td><a href="<?php echo base_url() . "comment/editComment/" . $comment->getId(); ?>" class="fa fa-pencil-square-o"></a></td>
                                <td><i class="fa fa-fw fa-trash trash_comment" id="<?php echo $comment->getId(); ?>"></i></td>
                            </tr>
                            <?php
                        }
                        ?>
                    </tbody>
                </table>
                <script lang="javascript">
                    // DELETE comment
                    $('.trash_comment').click(function () {
                        var element = $(this);
                        $.ajax({
                            url: <?php echo "\"" . base_url() . "comment/moveToTrash\""; ?>,
                            type: "GET",
                            dataType: "text",
                            data: {
                                id: element.attr('id')
                            },
                            success: function (res) {
                                alert(res);
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
            </div>
            <!-- End body show data -->
            <!-- /.box-body -->
            <div class="box-footer clearfix">
                Kết quả: <?php echo count($comments) . '/' . $total; ?>
                <!-- Pagination -->
                <?php echo $links ?>
            </div>
    </form>
</div><!-- /.box -->
</div>