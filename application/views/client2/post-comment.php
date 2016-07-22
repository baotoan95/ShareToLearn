<?php
    if($post->getCmt_allow()) {
?>
<div class="comments">
    <div class="title-default">
        <a class="active">Comments</a>
    </div>

    <ul id="comments">
        <?php echo $comments; ?>
    </ul>

    <div class="add-comment" id="comment_part">
        <div id="reply" style="display: none; cursor: pointer; color: orangered;" title="Click here to cancel reply mode">REPLY model</div>
        <div id="form_error"></div>
        <form  id="contact" action="<?php echo base_url() . "comment/addComment"; ?>" method="POST">
            <input type="hidden" name="postId" value="<?php echo $post->getId(); ?>">
            <p>
                <input type="text" name="name" class="form-control" placeholder="Your name">
                <input type="text" name="mail" class="form-control" placeholder="E-mail address">
                <input type="text" name="website" class="form-control" placeholder="Web address">
            </p>
            <p>
                <textarea class="form-control" name="content" placeholder="Your comment"></textarea>
            </p>
            <button type="button" id="submit" data-value="0" class="btn btn-default"><span>Post comment</span></button>
        </form>
        <script lang="javascript">
        $(document).ready(function () {
            // Event for reply button
            $('.reply-link').click(function (e) {
                e.preventDefault();
                $('#reply').show();
                $('body, html').animate({
                    scrollTop: $('#comment_part').offset().top - 50
                }, 800);
                $('#submit').attr('data-value', $(this).attr('href'));
            });
            
            // Exit reply mode
            $('#reply').on('click', function() {
                $('#submit').attr('data-value', '0');
                $(this).hide();
            });
            
            // Submit form
            $('#submit').click(function (e) {
                e.preventDefault();
                $('#submit').val('Sending...');
                var author_name = $('input[name=name]').val();
                var cmt_content = $('textarea[name=content]').val();
                var parent_id = $(this).attr('data-value');
                
                $.ajax({
                    url: <?php echo "\"" . base_url() . "comment/addComment\"" ?>,
                    type: "POST",
                    dataType: "text",
                    data: {
                        postId: $('input[name=postId]').val(),
                        name: author_name,
                        website: $('input[name=website]').val(),
                        content: cmt_content,
                        parent: parent_id,
                        email: $('input[name=mail]').val(), 
                        type: 'comment'
                    },
                    success: function (res) {
                        alert(res);
                        if(res !== 'failure' && !$.isNumeric(res)) {
                            $('#form_error').empty().prepend(res);
                            $('#submit').val('Send');
                            return;
                        }
                        
                        if(res !== 'failure' && parent_id !== '0') {
                            if($('#cmt_' + parent_id).has('ul').length) {
                                $('#cmt_' + parent_id + ' ul').prepend(
                                    '<li id="cmt_' + res + '">' +
                                        '<div class="item">' +
                                            '<a href="#" class="image"><img src="' +
                                            document.location.origin + '/assets/upload/images/avatars/user.jpg"></a>' +
                                            '<div class="comment">' +
                                                '<div class="info">' +
                                                    '<h2><a href="goliath-post-1.html">' + author_name + '</a></h2>' +
                                                    '<span class="legend-default"><i class="fa fa-clock-o"></i>Mới đây</span>' +
                                                    '<span class="nr"></span>' +
                                                '</div>' +
                                                '<p>' +
                                                    cmt_content +
                                                '</p>' +
                                            '</div>' +
                                        '</div>' +
                                    '</li>'
                                );
                            } else {
                                $('#cmt_' + parent_id).append(
                                    '<ul>' +
                                        '<li id="cmt_' + res + '">' +
                                            '<div class="item">' +
                                                '<a href="#" class="image"><img src="' +
                                                document.location.origin + '/assets/upload/images/avatars/user.jpg"></a>' +
                                                '<div class="comment">' +
                                                    '<div class="info">' +
                                                        '<h2><a href="goliath-post-1.html">' + author_name + '</a></h2>' +
                                                        '<span class="legend-default"><i class="fa fa-clock-o"></i>Mới đây</span>' +
                                                        '<span class="nr"></span>' +
                                                    '</div>' +
                                                    '<p>' +
                                                        cmt_content +
                                                    '</p>' +
                                                '</div>' +
                                            '</div>' +
                                        '</li>' +
                                    '</ul>'
                                );
                            }
                            $('#submit').val('Sent. Thanks!');
                            // Delete comment parent id
                            $('#submit').attr('data-value', '0');
                        } else if(res !== 'failure') {
                            $('#comments').prepend(
                                    '<li id="cmt_' + res + '">' +
                                        '<div class="item">' +
                                            '<a href="#" class="image"><img src="' +
                                            document.location.origin + '/assets/upload/images/avatars/user.jpg"></a>' +
                                            '<div class="comment">' +
                                                '<div class="info">' +
                                                    '<h2><a href="goliath-post-1.html">' + author_name + '</a></h2>' +
                                                    '<span class="legend-default"><i class="fa fa-clock-o"></i>Mới đây</span>' +
                                                    '<span class="nr"></span>' +
                                                '</div>' +
                                                '<p>' +
                                                    cmt_content +
                                                '</p>' +
                                            '</div>' +
                                        '</div>' +
                                    '</li>'
                            );
                            $('#submit').val('Sent. Thanks!');
                        } else {
                            $('#submit').val('Error');
                        }
                        
                        // Scroll to recent comment
                        $('body, html').animate({
                            scrollTop: $('#cmt_' + res).offset().top - 70
                        }, 800);
                    },
                    failure: function (error) {
                        alert(error);
                        // Delete comment parent id
                        $('#submit').attr('data-value', '0');
                    }
                });
            });
        });
    </script>
    </div>

</div>
<?php
    }
?>