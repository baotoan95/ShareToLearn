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
    <form id="post" action="<?php echo base_url() . 'post/' . $action ?>" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php echo isset($post) ? $post->getId() : "" ?>"/>
        <input type="hidden" name="type" value="<?php echo isset($post) ? $post->getType() : $type; ?>"/>
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
                               value="<?php echo isset($post) ? $post->getTitle() : set_value('title') ?>" type="text">
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
                               value="<?php echo isset($post) ? $post->getGuid() : set_value('guid') ?>" type="text">
                    </div>
                    <div class="form-group">
                        <label for="excerpt">Trích Đoạn</label>
                        <textarea id="excerpt" class="form-control" rows="5" 
                                  name="excerpt" onkeypress="change()"><?php echo isset($post) 
                                  ? $post->getExcerpt() : set_value('excerpt'); ?></textarea>
                    </div>
                    <div class="form-group">
                        
                        <label for="avatar">Hình Đặc Trưng</label>
                        <input type="file" name="avatar">
                        <p class="help-block">Sử dụng để hiển thị.</p>
                        <img class="avatarPreview" src="<?php echo isset($post) ? base_url() .
                                    'assets/upload/images/' . $post->getBanner() : "";
                            ?>"/>
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
                        <textarea class="form-control" rows="30" 
                                  name="content" onkeypress="change()"><?php echo isset($post) 
                                  ? $post->getContent() : set_value('content'); ?></textarea>
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
                            <?php
                            if (isset($post) && $post->getStatus() == 'private') {
                                echo "<option value='private' selected='selected'>Riêng tư</option>";
                            } else {
                                ?>
                                <option value="public"
                                        <?php echo (isset($post) &&
                                        $post->getStatus() == 'public') ? "selected='selected'" : ""
                                        ?>>
                                    Công Khai</option>
                                <option value="draf"
                                    <?php echo (isset($post) &&
                                    $post->getStatus() == 'draf') ? "selected='selected'" : ""
                                    ?>>
                                    Nháp</option>
                                <option value="pending"
                                <?php echo (isset($post) &&
                                $post->getStatus() == 'pending') ? "selected='selected'" : ""
                                ?>>
                                    Chờ Duyệt</option>
                                <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="visibility">Hiển Thị</label>
                        <select class="form-control" id="visibility" name="visibility">
                            <option value="public" 
                            <?php echo (isset($post) &&
                            ($post->getStatus() == 'public' || strlen($post->getPassword()) > 0)) ? "selected='selected'" : ""
                            ?>>
                                Công khai</option>
                            <option value="private"
                                    <?php echo (isset($post) &&
                                    $post->getStatus() == 'private') ? "selected='selected'" : ""
                                    ?>>
                                Riêng tư</option>
                            <option value="protected"
                         <?php echo (isset($post) &&
                         $post->getStatus() == 'public' && strlen($post->getPassword()) > 0) ? "selected='selected'" : ""
                         ?>>
                                Bảo vệ</option>
                        </select>
                    </div>
                    <div class="form-group" id="password" style="display: 
                            <?php echo (isset($post) && strlen($post->getPassword()) > 0) ? "block;" : "none;" ?>">
                        <label>Mật khẩu</label>
                        <input class="form-control" placeholder="Password" name="password" type="text"
                               value="<?php echo (isset($post) && strlen($post->getPassword()) > 0) ? $post->getPassword() : "" ?>">
                    </div>
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="comment_allowed"
                            <?php echo (isset($post) &&
                             $post->getCmt_allow() == TRUE) ? "checked='checked'" : !isset($post) ? "checked" : ""
                            ?>/>
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
                    <button type="submit" class="btn btn-primary">
                        <?php
                            echo $action == 'update' ? "Cập Nhật" : "Thêm";
                        ?>
                    </button>
                </div>
            </div><!-- /.box -->

            <?php
                if(isset($post) ? $post->getType() == "post" : $type == "post") {
            ?>
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Thể Loại</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <div class="box-body">
                    <div id="cate_container" class="form-group" style="max-height: 200px; overflow: auto;">
                        <?php
                            echo $categories;
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
                                <option value="0">-- Parent Category --</option>
                                <?php
                                    echo $categoriesParentBox;
                                ?>
                            </select>
                        </div>
                    </div><!-- /.box-body -->
                    <button id="addCate" class="btn btn-primary">Thêm</button>
                    <script lang="javascript">
                        // Handler category
                        $('#addCate').click(function (e) {
                            e.preventDefault();
                            addCategory();
                        });
                        $('#newcate').keypress(function(e) {
                            if(e.keyCode === 13) {
                                e.preventDefault();
                                addCategory();
                            }
                        });
                        function addCategory() {
                            var cate_name = $('input[name=newcate]').val().trim();
                            $('input[name=newcate]').val("");
                            if(cate_name.length === 0) {
                                $('input[name=newcate]').focus();
                                return;
                            }
                            $.ajax({
                                url: <?php echo "\"" . base_url() . "Category/addCategory\""; ?>,
                                type: "POST",
                                dataType: "text",
                                data: {
                                    newcate: cate_name,
                                    parent_cate: $('select[name=parent_cate]').val(),
                                    hasParentBox : true
                                },
                                success: function (res) {
                                    var response = $.parseJSON(res);
                                    var container = '#cate_container';
                                    if(response.category.parent > 0) {
                                        container = '#cate_' + response.category.parent;
                                    }
                                    if($(container).has('ul').length === 0) {
                                        $(container).append("<ul></ul>");
                                    }
                                    $(container + ' ul').first().append(
                                            "<li id='cate_" + response.category.id + "'>" +
                                            "<div class='checkbox'>" +
                                            "<label>" +
                                            "<input type='checkbox' name='categories[]' value='" +
                                            response.category.id + "'>" + response.category.name +
                                            "</label>" +
                                            "</div></li>"
                                    );
                                    $('select[name=parent_cate]').html(
                                            "<option value='0'>-- Parent Category --</option>" + 
                                            response.categoriesParentBox);
                                },
                                failure: function (err) {
                                    alert(err);
                                }
                            });
                        }
                    </script>
                </div>
                <script lang="javascript">
                    // Handler category panel
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
                        <?php
                        $tags = "";
                        if (isset($post)) {
                            foreach ($post->getTags() as $tag) {
                                echo "<l><i class='fa fa-times-circle-o'></i> "
                                . $tag->getName() . "<input type='hidden' name='tags[]' value='".$tag->getName()."'/>" .
                                "</l>&nbsp;&nbsp;&nbsp;";
                                $tags .= "'" . $tag->getName() . "',";
                            }
                        }
                        ?>
                        
                    </div>
                </div><!-- /.box-body -->
                <script lang="javascript"> // Handler tags
                    tags = [<?php echo $tags; ?>];

                    $(document).ready(function () {
                        $('input[name=tags]').val(tags);
                    });

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
                                    + tag_name + '<input type="hidden" name="tags[]" value="'+tag_name+'"/>' +
                                    '</l>&nbsp;&nbsp;&nbsp;');
                            tags.push(tag_name);
                        }
                        $('input[id=tag_name]').val("");
                    }

                    $('#tag_name').keypress(function (e) {
                        if (e.which === 13) {
                            e.preventDefault();
                            addTag();
                        }
                    });

                    $(document).on('click', '#tags .fa-times-circle-o', function () {
                        tags.splice(tags.indexOf($(this).parent().text().trim()), 1);
                        $(this).parent().remove();
                    });
                </script>
            </div><!-- /.box -->
            <?php
                }
            ?>
        </div>
        
        <script type="text/javascript">
            CKEDITOR.replaceAll();
        </script>
    </form>
</div>