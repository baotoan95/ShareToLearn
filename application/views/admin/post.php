<script src="<?php echo base_url() . 'assets/js/tinymce/tinymce.min.js' ?>"></script>
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
                        <label for="title">Title</label>
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
                        <label for="guid">Permalink</label>
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
                        <label for="excerpt">Excerpt</label>
                        <textarea id="excerpt" class="form-control" rows="5" 
                                  name="excerpt" onkeypress="change()"><?php echo isset($post) ? $post->getExcerpt() : set_value('excerpt');
                        ?></textarea>
                    </div>
                    <div class="form-group">

                        <label for="avatar">Avatar</label>
                        <input type="file" name="avatar">
                        <p class="help-block">Used to display.</p>
                        <img class="avatarPreview" src="<?php
                        echo isset($post) ? base_url() .
                                'assets/upload/images/' . $post->getBanner() : "";
                        ?>"/>
                    </div>
                    <div class="form-group">
                        <label>Content</label>
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
                                  name="content" onkeypress="change()"><?php echo isset($post) ? $post->getContent() : set_value('content');
                        ?></textarea>
                    </div>
                    <div class="form-group">
                        <label>Youtube link</label>
                        <input type="text" class="form-control" 
                               value="<?php echo (isset($post)) ? $post->getYoutube() : "" ?>" name="youtube">
                        <p class="help-block">Used to play video</p>
                    </div>
                    <div class="form-group">
                        <label>Cue</label>
                        <textarea class="form-control" name="cue"><?php echo (isset($post)) ? $post->getCue() : "" ?></textarea>
                        <p class="help-block">Used to play video with cues</p>
                    </div>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div>

        <div class="col-md-3">
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Attributes</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <div class="box-body">
                    <div class="form-group">
                        <label for="status">Status</label>
                        <select class="form-control" id="status" name="status">
                            <?php
                            if (isset($post) && $post->getStatus() == 'private') {
                                echo "<option value='private' selected='selected'>Private</option>";
                            } else {
                                ?>
                                <option value="public"
                                <?php
                                echo (isset($post) &&
                                $post->getStatus() == 'public') ? "selected='selected'" : ""
                                ?>>
                                    Public</option>
                                <option value="draf"
                                <?php
                                echo (isset($post) &&
                                $post->getStatus() == 'draf') ? "selected='selected'" : ""
                                ?>>
                                    Draf</option>
                                <option value="pending"
                                <?php
                                echo (isset($post) &&
                                $post->getStatus() == 'pending') ? "selected='selected'" : ""
                                ?>>
                                    Pending</option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="visibility">Visibility</label>
                        <select class="form-control" id="visibility" name="visibility">
                            <option value="public" 
                            <?php
                            echo (isset($post) &&
                            ($post->getStatus() == 'public' || strlen($post->getPassword()) > 0)) ? "selected='selected'" : ""
                            ?>>
                                Public</option>
                            <option value="private"
                            <?php
                            echo (isset($post) &&
                            $post->getStatus() == 'private') ? "selected='selected'" : ""
                            ?>>
                                Private</option>
                            <option value="protected"
                            <?php
                            echo (isset($post) &&
                            $post->getStatus() == 'public' && strlen($post->getPassword()) > 0) ? "selected='selected'" : ""
                            ?>>
                                Protected</option>
                        </select>
                    </div>
                    <div class="form-group" id="password" style="display: 
                         <?php echo (isset($post) && strlen($post->getPassword()) > 0) ? "block;" : "none;" ?>">
                        <label>Password</label>
                        <input class="form-control" placeholder="Password" name="password" type="text"
                               value="<?php echo (isset($post) && strlen($post->getPassword()) > 0) ? $post->getPassword() : "" ?>">
                    </div>
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="comment_allowed"
                            <?php
                            echo (isset($post) &&
                            $post->getCmt_allow() == TRUE) ? "checked='checked'" : !isset($post) ? "checked" : ""
                            ?>/>
                            Allow comment
                        </label>
                    </div>
                    <script>
                        $status = $('select[name=status]');

                        $('#visibility').change(function () {
                            $('#password').fadeOut(10);
                            if ($(this).val() === 'public') {
                                $status.empty();
                                $status.append("<option value='public'>Public</option>");
                                $status.append("<option value='draf'>Draf</option>");
                                $status.append("<option value='pending'>Pending</option>");
                                $('select[name=status] option[value=public]').attr('selected', 'selected');
                            } else if ($(this).val() === 'protected') {
                                $('#password').fadeIn(10);
                                $status.empty().append("<option value='public'>Public</option>");
                            } else if ($(this).val() === 'private') {
                                $status.empty().append("<option value='private'>Private</option>");
                            }
                        });
                    </script>
                </div><!-- /.box-body -->
                <div class="box-footer">
                    <button type="submit" class="btn btn-primary">
                        <?php
                        echo $action == 'update' ? "Update" : "ADD";
                        ?>
                    </button>
                </div>
            </div><!-- /.box -->

            <?php
            if (isset($post) ? $post->getType() == "post" : $type == "post") {
                ?>
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Categories</h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    <div class="box-body">
                        <div id="cate_container" class="form-group" style="max-height: 200px; overflow: auto;">
                            <?php
                            echo $categories;
                            ?>
                        </div>
                        <u id="add-cate" style="cursor: pointer;">ADD</u>
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
                        <button id="addCate" class="btn btn-primary">ADD</button>
                        <script lang="javascript">
                            // Handler category
                            $('#addCate').click(function (e) {
                                e.preventDefault();
                                addCategory();
                            });
                            $('#newcate').keypress(function (e) {
                                if (e.keyCode === 13) {
                                    e.preventDefault();
                                    addCategory();
                                }
                            });
                            function addCategory() {
                                var cate_name = $('input[name=newcate]').val().trim();
                                $('input[name=newcate]').val("");
                                if (cate_name.length === 0) {
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
                                        hasParentBox: true,
                                        slug: convert_vi_en(cate_name),
                                        desc: 'nothing'
                                    },
                                    success: function (res) {
                                        var response = $.parseJSON(res);
                                        var container = '#cate_container';
                                        if (response.category.parent > 0) {
                                            container = '#cate_' + response.category.parent;
                                        }
                                        if ($(container).has('ul').length === 0) {
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
                                <button class="btn btn-info btn-flat" onclick="addTag()" type="button">ADD</button>
                            </span>
                        </div>
                        <i>ADD tag cho bài viết</i>

                        <div id="tags" class="input-group" style="padding-top: 5px;">
                            <?php
                            $tags = "";
                            if (isset($post)) {
                                foreach ($post->getTags() as $tag) {
                                    echo "<l><i class='fa fa-times-circle-o'></i> "
                                    . $tag->getName() . "<input type='hidden' name='tags[]' value='" . $tag->getName() . "'/>" .
                                    "</l>&nbsp;&nbsp;&nbsp;";
                                    $tags .= "'" . $tag->getName() . "',";
                                }
                            }
                            ?>

                        </div>
                    </div><!-- /.box-body -->
                    <script lang="javascript">
                        // Handler tags
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
                                        + tag_name + '<input type="hidden" name="tags[]" value="' + tag_name + '"/>' +
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
        <script>
            tinymce.init({
                selector: 'textarea[name=content]',
                height: 500,
                plugins: [
                    'advlist autolink lists link image charmap print preview anchor',
                    'searchreplace visualblocks code fullscreen',
                    'insertdatetime media table contextmenu paste responsivefilemanager code codesample syntaxhl'
                ],
                toolbar: 'insertfile undo redo | styleselect | bold italic | ' +
                        'alignleft aligncenter alignright alignjustify | ' +
                        'bullist numlist outdent indent | link image | responsivefilemanager | codesample | syntaxhl',
                content_css: [
                    '//fast.fonts.net/cssapi/e6dc9b99-64fe-4292-ad98-6974f93cd2a2.css',
                    '//www.tinymce.com/css/codepen.min.css'
                ],
                external_filemanager_path: "<?php echo base_url(); ?>/filemanager/",
                filemanager_title: "File manager",
                external_plugins: {"filemanager": "<?php echo base_url(); ?>/filemanager/plugin.min.js"}
            });
        </script>
    </form>
</div>