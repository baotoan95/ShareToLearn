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
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">Cài Đặt</h3>
            </div><!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal">
                <div class="box-body">
                    Cài Đặt Chung
                    <div class="form-group">
                        <label for="site_title" class="col-sm-2 control-label">Tiêu đề trang</label>
                        <div class="col-sm-10">
                            <input class="form-control" id="site_title" type="text">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="slogan" class="col-sm-2 control-label">Khẩu hiệu</label>
                        <div class="col-sm-10">
                            <input class="form-control" id="slogan" type="text">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox"> Bật chức năng đăng ký
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="slogan" class="col-sm-2 control-label">Quyền mặc định</label>
                        <div class="col-sm-10">
                            <select class="form-control">
                                <option>option 1</option>
                                <option>option 2</option>
                                <option>option 3</option>
                                <option>option 4</option>
                                <option>option 5</option>
                            </select>
                        </div>
                    </div>

                    Cài đặt thảo luận
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox"> Cho phép bình luận
                                </label>
                            </div>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox"> Buộc phải điều tên và email trước khi bình luận hoặc gửi phản hồi
                                </label>
                            </div>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox"> Thành viên phải đăng nhập để có thể bình luận hoặc gửi phản hồi
                                </label>
                            </div>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox"> Gửi email khi có bất cứ phản hổi hay bình luận nào
                                </label>
                            </div>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox"> Bình luận phải chờ duyệt mới được xuất hiện
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="site_title" class="col-sm-2 control-label">Danh sách đen</label>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-12">
                            <p class="help-block">Những từ này sẽ được thay bằng #### (ngăn cách bởi dấu ",")</p>
                            <textarea class="form-control" rows="3"></textarea>
                        </div>
                    </div>
                </div><!-- /.box-body -->
                <div class="box-footer">
                    <button type="submit" class="btn btn-info">Lưu</button>
                </div><!-- /.box-footer -->
            </form>
        </div>
    </div>
</form>
</div>