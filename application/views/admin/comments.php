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
        <input type="hidden" name="type" value="<?php // echo $type;    ?>"/>
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
                                <a id="all" href="<?php echo $uri . "?type=$type" ?>" 
                                   class="btn btn-sm btn-default <?php
                                   if (empty($_GET['status']) ||
                                           $_GET['status'] == 'all') {
                                       echo 'active';
                                   }
                                   ?>">
                                    Tất cả (<?php echo array_pop($count); ?>)
                                </a>
                                <?php
                                echo "<a id='pending' href='$uri?status=pending&type=$type' "
                                . "class='btn btn-sm btn-default " . ((!empty($_GET['status']) &&
                                $_GET['status'] == 'pending') ? "active" : "") . "'>"
                                . "Chờ duyệt (". (array_key_exists('pending', $count) ? $count['pending'] : '0') .")</a>";
                                
                                echo "<a id='approved' href='$uri?status=approved&type=$type' "
                                . "class='btn btn-sm btn-default " . ((!empty($_GET['status']) &&
                                $_GET['status'] == 'approved') ? "active" : "") . "'>"
                                . "Đã duyệt (". (array_key_exists('approved', $count) ? $count['approved'] : '0') .")</a>";
                                
                                echo "<a id='spam' href='$uri?status=spam&type=$type' "
                                . "class='btn btn-sm btn-default " . ((!empty($_GET['status']) &&
                                $_GET['status'] == 'spam') ? "active" : "") . "'>"
                                . "Rác (". (array_key_exists('spam', $count) ? $count['spam'] : '0') .")</a>";
                                
                                echo "<a id='trash' href='$uri?status=trash&type=$type' "
                                . "class='btn btn-sm btn-default " . ((!empty($_GET['status']) &&
                                $_GET['status'] == 'trash') ? "active" : "") . "'>"
                                . "Thùng rác (". (array_key_exists('trash', $count) ? $count['trash'] : '0') .")</a>";
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-3">
                        <select class="form-control" name="type">
                            <option value="all">Tất cả các loại</option>
                            <option value="comment" <?php echo isset($_GET['type']) && $_GET['type'] == 'comment' ? "selected" : ""
                                ?>>Bình luận</option>
                            <option value="contact" <?php echo isset($_GET['type']) && $_GET['type'] == 'contact' ? "selected" : ""
                                ?>>Liên hệ</option>
                        </select>
                    </div>
                    <div class="col-lg-1">
                        <button style="margin-top: 2px;" class="btn btn-sm btn-default">Lọc</button>
                    </div>
                </div>
            </div>
            <!-- End body control -->

            <!-- Body show data -->
            <div class="box-body table-responsive no-padding">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Tác Giả</th>
                            <th>Nội Dung</th>
                            <th>Ngày</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($comments as $comment) {
                            ?>
                            <tr class="data-row" id="<?php echo $comment->getId(); ?>">
                                <td><?php echo $comment->getAuthor(); ?></td>
                                <td><?php echo $comment->getContent(); ?></td>
                                <td><?php echo $comment->getDate(); ?></td>
                                <td id="action">
                                    <?php
                                        switch($comment->getStatus()) {
                                            case 'pending':
                                                echo "<a class='approved'>Duyệt</a> | <a class='reply'>Trả lời</a> | "
                                                . "<a href='".base_url().'comment/editComment/'. $comment->getId() . "'>Sửa</a> | <a class='spam'>Rác</a> | <a class='trash'>Xóa</a>";
                                                break;
                                            case 'approved':
                                                echo "<a class='restore'>Bỏ duyệt</a> | <a class='reply'>Trả lời</a> | "
                                                . "<a href='".base_url().'comment/editComment/'. $comment->getId() . "'>Sửa</a> | <a class='spam'>Rác</a> | <a class='trash'>Xóa</a>";
                                                break;
                                            case 'spam':
                                                echo "<a class='restore'>Bỏ Rác</a> | <a class='delete'>Xóa vĩnh viễn</a>";
                                                break;
                                            case 'trash':
                                                echo "<a class='restore'>Khôi phục</a> | <a class='delete'>Xóa vĩnh viễn</a>";
                                                break;
                                        }
                                    ?>
                                </td>
                            </tr>
                            <?php
                        }
                        ?>
                    </tbody>
                </table>
                <script lang="javascript">
                    $('.reply').click(function () {
                        if($('#replyrow').length) {
                            $('#replyrow').remove();
                        } else {
                        $(this).parent().parent().after(
                                '<tr id="replyrow">' +
                                '<td colspan="4">' +
                                '<div class="box-body">' +
                                '<div class="form-group">' +
                                '<textarea name="content" class="form-control"></textarea>' +
                                '</div>' +
                                '</div>' +
                                '<div class="box-footer">' +
                                '<a id="btnReply" data-value="' + 
                                $(this).parent().parent().attr('id') +
                                '" class="btn btn-primary pull-right">Trả Lời</a>' +
                                '</div>' +
                                '</td>' +
                                '</tr>');
                        }
                    });
                </script>
                <script lang="javascript">
                    // Delete
                    $('.delete').click(function() {
                        var element = $(this);
                        $.ajax({
                            url: <?php echo "\"" . base_url() . "comment/deleteComment\""; ?>,
                            type: "POST",
                            dataType: "text",
                            data: {
                                id: element.parent().parent().attr('id')
                            },
                            success: function (res) {
                                if (res !== 'failure') {
                                    element.parent().parent().remove();
                                    updateCounts(res);
                                }
                            },
                            failure: function (error) {
                                alert(error);
                            }
                        });
                    });
                    
                    // Reply
                    $('.table').on('click', "#btnReply", function() {
                        var element = $(this);
                        if($('textarea[name=content]').val().trim().length === 0) {
                            return;
                        }
                        $.ajax({
                            url: <?php echo "\"" . base_url() . "comment/reply\""; ?>,
                            type: "POST",
                            dataType: "text",
                            data: {
                                id: element.attr('data-value'),
                                content: $('textarea[name=content]').val()
                            },
                            success: function (res) {
                                alert(res);
                                if (res !== 'failure') {
                                    $('#replyrow').remove();
                                    var cmt = $.parseJSON(res);
                                    var action = '';
                                    alert(cmt.status);
                                    switch(cmt.status) {
                                        case 'pending':
                                            action = "<a class='approved'>Duyệt</a> | <a class='reply'>Trả lời</a> | "
                                            + "<a href='<?php echo base_url(); ?>comment/editComment/" + cmt.id + "'>Sửa</a> | <a class='spam'>Rác</a> | <a class='trash'>Xóa</a>";
                                            break;
                                        case 'approved':
                                            action = "<a class='restore'>Bỏ duyệt</a> | <a class='reply'>Trả lời</a> | "
                                            + "<a href='<?php echo base_url(); ?>comment/editComment/" + cmt.id + "'>Sửa</a> | <a class='spam'>Rác</a> | <a class='trash'>Xóa</a>";
                                            break;
                                    }
                                    $('tbody').append(
                                        '<tr id="' + cmt.id + '">' +
                                            '<td>' + cmt.author + '</td>' +
                                            '<td>' + cmt.content + '</td>' +
                                            '<td>' + cmt.date + '</td>' +
                                            '<td id="action">' + action + '</td>' +
                                        '</tr>'
                                    );
                                }
                            },
                            failure: function (error) {
                                alert(error);
                            }
                        });
                    });
                    
                    // Change status and restore status
                    $('.pending, .approved, .spam, .trash, .restore').click(function () {
                        var element = $(this);
                        $.ajax({
                            url: <?php echo "\"" . base_url() . "comment/changeStatus\""; ?>,
                            type: "GET",
                            dataType: "text",
                            data: {
                                id: element.parent().parent().attr('id'),
                                status: element.attr('class').trim()
                            },
                            success: function (res) {
                                if (res !== 'failure') {
                                    element.parent().parent().remove();
                                    updateCounts(res);
                                }
                            },
                            failure: function (error) {
                                alert(error);
                            }
                        });
                    });
                    
                    function updateCounts(count) {
                        count = $.parseJSON(count);
                        $('#total').html('Tất cả (' + count.total + ')');
                        $('#pending').html('Chờ duyệt (' + ((typeof count.pending !== 'undefined') ? count.pending : '0') + ')');
                        $('#approved').html('Đã duyệt (' + ((typeof count.approved !== 'undefined') ? count.approved : '0') + ')');
                        $('#spam').html('Rác (' + ((typeof count.spam !== 'undefined') ? count.spam : '0') + ')');
                        $('#trash').html('Thùng rác (' + ((typeof count.trash !== 'undefined') ? count.trash : '0') + ')');
                        
                        // Update result (at last of table)
                        $('#numerator').html(parseInt($('#numerator').text()) - 1);
                        $('#denominator').html(parseInt($('#denominator').text()) - 1);
                    }
                </script>
            </div>
            <!-- End body show data -->
            <!-- /.box-body -->
            <div class="box-footer clearfix">
                Kết quả: <?php echo "<i id='numerator'>" . count($comments) . "</i>/<i id='denominator'>" . $total . "</i>"; ?>
                <!-- Pagination -->
                <?php echo $links ?>
            </div>
    </form>
</div><!-- /.box -->
</div>