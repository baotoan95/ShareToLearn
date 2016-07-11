<div class="row">
    <form id="post" action="<?php echo base_url() . 'comment/updateComment' ?>" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php echo isset($comment) ? $comment->getId() : "" ?>"/>
        <div class="col-md-9">
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
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Chỉnh sửa phản hồi</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <div class="box-body">
                    <div class="form-group">
                        <label for="author">Tên tác giả</label>
                        <input class="form-control" id="author" name="author"
                               value="<?php echo isset($comment) ? $comment->getAuthor() : "" ?>" type="text">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input class="form-control" id="email" name="email" value="<?php echo isset($comment) ? $comment->getEmail() : "" ?>" type="text">
                    </div>
                    <div class="form-group">
                        <label for="content">Nội dung</label>
                        <textarea id="content" class="form-control" rows="5" 
                                  name="content"><?php echo isset($comment) ? $comment->getContent() : "";
            ?></textarea>
                    </div>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div>

        <div class="col-md-3">
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Trạng thái</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <div class="box-body">
                    <div class="form-group">
                        <div class="radio">
                            <label>
                                <input name="status" <?php echo $comment->getStatus() == 'approved' ? "checked" : ""?>
                                       id="approved" value="approved" checked="" type="radio">
                                Đã chấp nhận
                            </label>
                        </div>
                        <div class="radio">
                            <label>
                                <input name="status" <?php echo $comment->getStatus() == 'pending' ? "checked" : ""?>
                                       id="pending" value="pending" type="radio">
                                Chờ duyệt
                            </label>
                        </div>
                        <div class="radio">
                            <label>
                                <input name="status" <?php echo $comment->getStatus() == 'spam' ? "checked" : ""?>
                                       id="spam" value="spam" type="radio">
                                Rác
                            </label>
                        </div>
                        <p class="margin">Ngày: <code><?php echo $comment->getDate(); ?></code></p>
                    </div>
                </div><!-- /.box-body -->
                <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Cập Nhật</button>
                    <a href="" class="pull-right">Move to Trash</a>
                </div>
            </div><!-- /.box -->
        </div>
    </form>
</div>