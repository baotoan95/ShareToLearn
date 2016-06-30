<?php
    print_r($categories);
    echo $categories[0]->getName();
?>

<script>
    var edited = false;
    $(document).ready(function () {
        // Submit form
        $('#post').submit(function () {
            edited = false;
        });
        // If have change, confirm before redirect
        window.onbeforeunload = function () {
            if (edited) {
                return "If you leave this page, data may be lost.";
            }
        };
    });

    function change() {
        edited = true;
    }
</script>

<div class="row">
    <form id="post" action="<?php echo base_url() . 'post/addpost' ?>" method="post">
        <div class="col-md-9">
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title"><?php echo isset($title) ? $title : "Bài Viết" ?></h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <div class="box-body">
                    <div class="form-group">
                        <label for="title">Tiêu Đề</label>
                        <?php
                        if (form_error('title')) {
                            echo "<div class='has-error'>"
                            . "<label class='control-label' for='inputError'>"
                            . form_error('title')
                            . "</label>"
                            . "</div>";
                        }
                        ?>
                        <input class="form-control" id="title" name="title" onkeyup="updateGuid(this.value);" onkeypress="change();"
                               value="<?php echo set_value('title') ?>" type="text">
                        <script lang="javascript">
                            function updateGuid(str) {
                                $('input[name=guid]').val(convert_vi_en(str));
                            }
                        </script>
                    </div>
                    <div class="form-group">
                        <label for="guid">Đường dẫn</label>
                        <?php
                        if (form_error('guid')) {
                            echo "<div class='has-error'>"
                            . "<label class='control-label' for='inputError'>"
                            . form_error('guid')
                            . "</label>"
                            . "</div>";
                        }
                        ?>
                        <input class="form-control" id="title" name="guid" onkeypress="change()"
                               value="<?php echo set_value('guid') ?>" type="text">
                    </div>
                    <div class="form-group">
                        <label for="excerpt">Trích Đoạn</label>
                        <textarea id="excerpt" class="form-control" rows="5" name="excerpt" onkeypress="change()">
                            <?php echo set_value('excerpt'); ?>
                        </textarea>
                    </div>
                    <div class="form-group">
                        <label for="avatar">Hình Đặc Trưng</label>
                        <input id="avatar" type="file" name="avatar">
                        <p class="help-block">Sử dụng để hiển thị.</p>
                    </div>
                    <div class="form-group">
                        <label>Nội Dung</label>
                        <?php
                        if (form_error('content')) {
                            echo "<div class='has-error'>"
                            . "<label class='control-label' for='inputError'>"
                            . form_error('content')
                            . "</label>"
                            . "</div>";
                        }
                        ?>
                        <textarea class="form-control" rows="30" name="content" onkeypress="change()">
                            <?php echo set_value('content'); ?>
                        </textarea>
                    </div>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div>

        <div class="col-md-3">
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Thuộc Tính</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <div class="box-body">
                    <div class="form-group">
                        <label for="status">Trạng thái</label>
                        <select class="form-control" id="status" name="status">
                            <option value="public">Công Khai</option>
                            <option value="draf">Nháp</option>
                            <option value="pending">Chờ Duyệt</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="visibility">Hiển Thị</label>
                        <select class="form-control" id="visibility" name="visibility">
                            <option value="public">Công khai</option>
                            <option value="private">Riêng tư</option>
                            <option value="protected">Bảo vệ</option>
                        </select>
                    </div>
                    <div class="form-group" id="password" style="display: none;">
                        <label>Mật khẩu</label>
                        <input class="form-control" placeholder="Password" name="password" type="text">
                    </div>
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="comment_allowed">
                            Cho phép bình luận
                        </label>
                    </div>
                    <script>
                        $status = $('select[name=status]');

                        $('#visibility').change(function () {
                            $('#password').fadeOut(10);
                            if ($(this).val() === 'public') {
                                $status.empty();
                                $status.append("<option value='public'>Công khai</option>");
                                $status.append("<option value='draf'>Nháp</option>");
                                $status.append("<option value='pending'>Chờ duyệt</option>");
                                $('select[name=status] option[value=public]').attr('selected', 'selected');
                            } else if ($(this).val() === 'protected') {
                                $('#password').fadeIn(10);
                                $status.empty().append("<option value='public'>Công khai</option>");
                            } else if ($(this).val() === 'private') {
                                $status.empty().append("<option value='private'>Riêng tư</option>");
                            }
                        });
                    </script>
                </div><!-- /.box-body -->
                <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div><!-- /.box -->

            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Thể Loại</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <div class="box-body">
                    <div class="form-group" style="max-height: 200px; overflow: scroll;">
<!--                        <ul>
                            <li>
                                <div class='checkbox'>
                                    <input type='checkbox'> Check 1
                                </div>
                            </li>
                            <li>
                                <div class='checkbox'>
                                    <input type='checkbox'> Check 1
                                </div>
                                <ul>
                                    <li>
                                        <div class='checkbox'>
                                            <input type='checkbox'> Check 1
                                        </div>
                                        <ul>
                                            <li>    
                                                <div class='checkbox'>
                                                    <input type='checkbox'> Check 1
                                                </div>
                                                <ul>
                                                    <li>    
                                                        <div class='checkbox'>
                                                            <input type='checkbox'> Check 1
                                                        </div>
                                                        <ul>
                                                            <li>    
                                                                <div class='checkbox'>
                                                                    <input type='checkbox'> Check 1
                                                                </div>
                                                                <ul>
                                                                    <li>    
                                                                        <div class='checkbox'>
                                                                            <input type='checkbox'> Check 1
                                                                        </div>
                                                                    </li>
                                                                </ul>
                                                            </li>
                                                        </ul>
                                                    </li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                        </ul>-->
                        
                        
                        <?php
                        foreach ($categories as $category) {
                            echo "<div class='checkbox'>" .
                            "<label>" .
                            "<input type='checkbox' name='categories[]' value='" . 
                                    $category->getId() . "'>" . $category->getName() .
                            "</label>" .
                            "</div>";
                        }
                        ?>
                    </div>
                    <u id="add-cate" style="cursor: pointer;">Thêm thể loại mới</u>
                </div><!-- /.box-body -->
                <div class="box-footer" style="display: none;" id="add-cate-panel">
                    <div class="box-body">
                        <div class="form-group">
                            <input class="form-control" id="newcate" name="newcate" type="text">
                        </div>
                        <div class="form-group">
                            <select class="form-control" name="parent_cate">
                                <option>-- Parent Category --</option>
                                <?php
                                foreach ($categories as $catgory) {
                                    echo "<option value='". $catgory->getId() ."'>" . $catgory->getName() . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div><!-- /.box-body -->
                    <button type="submit" class="btn btn-primary">Thêm Thể Loại</button>
                </div>
                <script lang="javascript">
                    opened = false;
                    $('#add-cate').click(function () {
                        if (opened) {
                            $('#add-cate-panel').fadeOut(10);
                            opened = false;
                        } else {
                            $('#add-cate-panel').fadeIn(10);
                            opened = true;
                        }
                    });
                </script>
            </div><!-- /.box -->

            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Tags</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <div class="box-body">
                    <div class="input-group input-group-sm">
                        <input class="form-control" id="tag_name" type="text">
                        <span class="input-group-btn">
                            <button class="btn btn-info btn-flat" onclick="addTag()" type="button">Thêm</button>
                        </span>
                    </div>
                    <i>Thêm tag cho bài viết</i>

                    <div id="tags" class="input-group" style="padding-top: 5px;">
                        <input type="hidden" name="tags" value=""/>
                    </div>
                </div><!-- /.box-body -->
                <script lang="javascript">
                    tags = [];

                    function normalizationString(str) {
                        str = str.trim();
                        for (i = 0; i < str.length; i++) {
                            str = str.replace("  ", " ");
                        }
                        return str;
                    }

                    function addTag() {
                        tag_name = normalizationString($('input[id=tag_name]').val());
                        if (tag_name.length > 0 && tags.indexOf(tag_name) < 0) {
                            $('#tags').append('<l><i class="fa fa-times-circle-o"></i> '
                                    + tag_name +
                                    '<l>&nbsp;&nbsp;&nbsp;');
                            tags.push(tag_name);
                            $('input[name=tags]').val(tags);
                        }
                        $('input[id=tag_name]').val("");
                    }

                    $('#tag_name').keypress(function (e) {
                        if (e.which === 13) {
                            e.preventDefault();
                            addTag();
                        }
                        ;
                    });

                    $(document).on('click', '#tags .fa-times-circle-o', function () {
                        tags.splice(tags.indexOf($(this).parent().text().trim()), 1);
                        $(this).parent().remove();
                        $('input[name=tags]').val(tags);
                    });
                </script>
            </div><!-- /.box -->
        </div>
    </form>
</div>