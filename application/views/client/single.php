<section id="content" class="eight column row pull-left singlepost">
    <a class="featured-img"><img src="<?php echo base_url() . "assets/upload/images/" . $post->getBanner(); ?>" alt=""></a>

    <h1 class="post-title"><?php echo $post->getTitle(); ?></h1>

    <p></p>

    <blockquote><?php echo $post->getExcerpt(); ?></blockquote>

    <p><?php echo $post->getContent(); ?></p>

    <div class="post-meta">
        <span class="comments"><a href="#"><?php echo $post->getComments(); ?></a></span>
        <span class="author"><a href="#"><?php echo $post->getAuthor()->getFull_name(); ?></a></span>
        <span class="date"><a href="#"><?php echo $post->getPublished(); ?></a></span>
    </div>

    <div class="social-media clearfix">
        <ul>
            <li class="twitter">
                <a href="https://twitter.com/share" class="twitter-share-button" data-url="http://www.nextwpthemes.com/" data-text="">Tweet</a>
                <script>!function (d, s, id) {
                        var js, fjs = d.getElementsByTagName(s)[0];
                        if (!d.getElementById(id)) {
                            js = d.createElement(s);
                            js.id = id;
                            js.src = "//platform.twitter.com/widgets.js";
                            fjs.parentNode.insertBefore(js, fjs);
                        }
                    }(document, "script", "twitter-wjs");</script>
            </li>
            <li class="facebook">
                <script>(function (d, s, id) {
                        var js, fjs = d.getElementsByTagName(s)[0];
                        if (d.getElementById(id))
                            return;
                        js = d.createElement(s);
                        js.id = id;
                        js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
                        fjs.parentNode.insertBefore(js, fjs);
                    }(document, 'script', 'facebook-jssdk'));
                </script>

                <div class="fb-like" data-href="http://www.nextwpthemes.com/" data-send="false" data-layout="button_count" data-width="450" data-show-faces="true"></div>
            </li>
            <li class="google_plus">
                <!-- Place this tag where you want the +1 button to render. -->
                <div class="g-plusone" data-size="medium"></div>

                <!-- Place this tag after the last +1 button tag. -->
                <script type="text/javascript">
                    (function () {
                        var po = document.createElement('script');
                        po.type = 'text/javascript';
                        po.async = true;
                        po.src = 'https://apis.google.com/js/plusone.js';
                        var s = document.getElementsByTagName('script')[0];
                        s.parentNode.insertBefore(po, s);
                    })();
                </script>
            </li>
        </ul>
    </div>

    <div class="clear"></div>

    <div class="line"></div>

    <h4 class="post-title">Bình luận</h4>

    <br>

    <ol id="comments">
        <?php echo $comments; ?>
    </ol>
    <!-- End Comments -->

    <div id="comment_part" class="line"></div>

    <h4 class="post-title">Gửi một bình luận</h4>

    <!-- Contact Form -->
    <div class="contact-form comment cleafix">
        <form id="contact" action="<?php echo base_url() . "comment/addComment"; ?>" method="POST">
            <input tabindex="1" name="name" class="left" type="text" data-value="Name" value="Name"/>
            <input tabindex="3" name="website" class="right" type="text" data-value="Website" value="Website"/>
            <input tabindex="2" name="mail" class="right" type="text" data-value="E-mail" value="E-mail"/>
            <textarea tabindex="4" name="content" class="twelve column" data-value="Comment">Comment</textarea>
            <input type="hidden" name="postId" value="<?php echo $post->getId(); ?>">
            <input tabindex="5" data-value="0" id="submit" type="submit" value="Gửi">
        </form>
    </div>
    <!-- End Contact Form -->

    <script lang="javascript">
        $(document).ready(function () {
            // Scroll
            $('.comment-reply-link').click(function (e) {
                e.preventDefault();
                $('body, html').animate({
                    scrollTop: $('#comment_part').offset().top
                }, 800);
                $('#submit').attr('data-value', $(this).attr('href'));
            });
            
            // Submit form
            $('#submit').click(function (e) {
                e.preventDefault();
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
                        email: $('input[name=mail]').val()
                    },
                    success: function (res) {
                        if(res !== 'failure' && parent_id !== '0') {
                            if($('#cmt_' + parent_id).has('ul').length) {
                                $('#cmt_' + parent_id + ' ul').prepend(
                                    '<li id="cmt_'+ res +'">' +
                                        '<div class="author-avatar"><img alt="" src ="<?php echo base_url(); ?>assets/client/images/avatar.jpg"/></div>' +
                                        '<div class="comment-author"><a>' + author_name + '</a></div>' +
                                        '<div class="comment-date">Mới đây</div>' +
                                        '<div class="comment-text"><p>' + cmt_content + '</p></div>' +
                                        '<div class="comment-reply">Đang chờ duyệt...</div>' +
                                    '</li>'
                                );
                            } else {
                                $('#cmt_' + parent_id).append(
                                    '<ul class="children"><li id="cmt_'+ res +'">' +
                                        '<div class="author-avatar"><img alt="" src ="<?php echo base_url(); ?>assets/client/images/avatar.jpg"/></div>' +
                                        '<div class="comment-author"><a>' + author_name + '</a></div>' +
                                        '<div class="comment-date">Mới đây</div>' +
                                        '<div class="comment-text"><p>' + cmt_content + '</p></div>' +
                                        '<div class="comment-reply">Đang chờ duyệt...</div>' +
                                    '</li></ul>'
                                );
                            }
                            
                            // Delete comment parent id
                            $('#submit').attr('data-value', '0');
                        } else {
                            $('#comments').prepend(
                                    '<li id="cmt_'+ res +'">' +
                                        '<div class="author-avatar"><img alt="" src ="<?php echo base_url(); ?>assets/client/images/avatar.jpg"/></div>' +
                                        '<div class="comment-author"><a>' + author_name + '</a></div>' +
                                        '<div class="comment-date">Mới đây</div>' +
                                        '<div class="comment-text"><p>' + cmt_content + '</p></div>' +
                                        '<div class="comment-reply">Đang chờ duyệt...</div>' +
                                    '</li>'
                            );
                        }
                        
                        // Scroll to recent comment
                        $('body, html').animate({
                            scrollTop: $('#cmt_' + res).offset().top
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
</section>