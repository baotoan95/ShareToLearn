<div class="row">
    <div class="col-md-12">
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
    </div>
    <div class="col-md-3">
        <!-- general form elements -->
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Add Tag</h3>
            </div><!-- /.box-header -->
            <!-- form start -->
            <form role="form">
                <div class="box-body">
                    <div class="form-group">
                        <label for="tag-name">Tag name</label>
                        <input class="form-control" name="tag_name" id="tag-name" type="text">
                    </div>
                    <div class="form-group">
                        <label for="slug">Slug</label>
                        <input class="form-control" id="slug" name="slug" type="text">
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <textarea name="desc" class="form-control" rows="3" placeholder="Enter ..."></textarea>
                    </div>
                </div><!-- /.box-body -->
                <div class="box-footer">
                    <button type="submit" class="btn btn-primary" id="submit">ADD</button>
                    <script lang="javascript">
                        // ADD tag
                        $('#submit').click(function (e) {
                            e.preventDefault();
                            $.ajax({
                                url: <?php echo "\"" . base_url() . "tag/newtag\""; ?>,
                                type: "POST",
                                dataType: "text",
                                data: {
                                    name: $('input[name=tag_name]').val(),
                                    slug: $('input[name=slug]').val(),
                                    desc: $('textarea[name=desc]').val()
                                },
                                success: function (res) {
                                    if (res !== 'failure') {
                                        var tag = $.parseJSON(res);
                                        $('tbody').prepend(
                                                "<tr>" +
                                                "<td>" + tag.name + "</td>" +
                                                "<td>" + tag.desc + "</td>" +
                                                "<td>" + tag.slug + "</td>" +
                                                "<td>" + tag.count + "</td>" +
                                                "<td><i class='fa fa-fw fa-trash del_tag' id='" + tag.id + "'></i></td>" +
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
                <h3 class="box-title">Tags</h3><br/>
                <?php echo (isset($_GET['search']) && strlen(trim($_GET['search'])) > 0) ? "Result for \"" . $_GET['search'] . "\"" : ""; ?>
                <div class="box-tools">
                    <form action="" method="get">
                        <div class="input-group" style="width: 150px;">
                            <input name="search" class="form-control input-sm pull-right" placeholder="Search" type="text">
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
                            <th>Name</th>
                            <th>Description</th>
                            <th>Slug</th>
                            <th>Count</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php
                        foreach ($tags as $tag) {
                            ?>
                            <tr>
                                <td><a href="<?php echo base_url() . 'tag/editTag/' . $tag->getId(); ?>"><?php echo $tag->getName(); ?></a></td>
                                <td><?php echo $tag->getDesc(); ?></td>
                                <td><?php echo $tag->getSlug(); ?></td>
                                <td><?php echo $tag->getCount(); ?></td>
                                <td><i class="fa fa-fw fa-trash del_tag" id="<?php echo $tag->getId(); ?>"></i></td>
                            </tr>
                            <?php
                        }
                        ?>
                    </tbody>
                </table>
                <script lang="javascript">
                    // DELETE tag
                    $('.del_tag').click(function () {
                        var element = $(this);
                        $.ajax({
                            url: <?php echo "\"" . base_url() . "tag/deleteTag\""; ?>,
                            type: "POST",
                            dataType: "text",
                            data: {
                                tag_id: element.attr('id')
                            },
                            success: function (res) {
                                if (res !== 'failure') {
                                    element.parent().parent().remove();
                                }
                            },
                            failure: function (error) {
                                alert(error);
                            }
                        });
                    });
                </script>
            </div><!-- /.box-body -->
            <div class="box-footer clearfix">
                Result: <?php echo count($tags) . "/" . $total ?>
                <?php echo $links; ?>
            </div>
        </div><!-- /.box -->
    </div>
</div>