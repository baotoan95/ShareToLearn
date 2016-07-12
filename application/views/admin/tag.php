<div class="row">
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
                <h3 class="box-title">Thêm Người Dùng</h3>
            </div><!-- /.box-header -->
            <!-- form start -->
            <form role="form" action="<?php echo base_url() . 'tag/updateTag' ?>" method="post">
                <input type="hidden" name="id" value="<?php echo $tag->getId(); ?>"/>
                <input type="hidden" name="count" value="<?php echo $tag->getCount(); ?>"/>
                <div class="box-body">
                    <div class="form-group">
                        <label for="name">Tên thẻ</label>
                        <input class="form-control" name="name" 
                               value="<?php echo $tag->getName(); ?>" id="name" placeholder="" type="text">
                    </div>
                    <div class="form-group">
                        <label for="slug">Slug</label>
                        <input class="form-control" name="slug" 
                               value="<?php echo $tag->getSlug(); ?>" id="slug" placeholder="slug" type="text">
                    </div>
                    <div class="form-group">
                        <label>Mô tả</label>
                        <textarea class="form-control" rows="5" name="desc" placeholder="Nhập mô tả ...">
                            <?php echo $tag->getDesc(); ?>
                        </textarea>
                    </div>
                </div><!-- /.box-body -->

                <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Cập Nhật</button>
                </div>
            </form>
        </div><!-- /.box -->
    </div>
</div>