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

    <h4 class="post-title">13 Comments</h4>

    <br>

    <ol id="comments">
        <li class="depth-1">
            <div class="author-avatar"><img alt="" src="<?php echo base_url() . 'assets/client/images/avatar.jpg' ?>"></div>
            <div class="comment-author">Faton</div>
            <div class="comment-date">May 17, 2012</div>
            <div class="comment-text"><p>First comment!</p></div>
            <div class="comment-reply"><a class="comment-reply-link" rel="nofollow" href="1">reply</a></div>

            <ul class="children">
                <li class="depth-2">
                    <div class="author-avatar"><img alt="" src="<?php echo base_url() . 'assets/client/images/avatar.jpg' ?>"></div>
                    <div class="comment-author">Doni</div>
                    <div class="comment-date">May 17, 2012</div>
                    <div class="comment-text"><p>First comment!</p></div>
                    <div class="comment-reply"><a class="comment-reply-link" rel="nofollow" href="#reply">reply</a></div>

                    <ul class="children">
                        <li class="depth-3">
                            <div class="author-avatar"><img alt="" src="<?php echo base_url() . 'assets/client/images/avatar.jpg' ?>"></div>
                            <div class="comment-author">Faton</div>
                            <div class="comment-date">May 17, 2012</div>
                            <div class="comment-text"><p>Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. </p></div>
                            <div class="comment-reply"><a class="comment-reply-link" rel="nofollow" href="#reply">reply</a></div>

                            <ul class="children">
                                <li class="depth-4">
                                    <div class="author-avatar"><img alt="" src="<?php echo base_url() . 'assets/client/images/avatar.jpg' ?>"></div>
                                    <div class="comment-author"><a href="#">Vedat</a></div>
                                    <div class="comment-date">May 17, 2012</div>
                                    <div class="comment-text"><p>First comment!</p></div>
                                    <div class="comment-reply"><a class="comment-reply-link" rel="nofollow" href="#reply">reply</a></div>
                                </li>
                            </ul>
                        </li>

                        <li class="depth-3">
                            <div class="author-avatar"><img alt="" src="<?php echo base_url() . 'assets/client/images/avatar.jpg' ?>"></div>
                            <div class="comment-author"><a href="#">Sami</a></div>
                            <div class="comment-date">May 17, 2012</div>
                            <div class="comment-text"><p>First comment!</p></div>
                            <div class="comment-reply"><a class="comment-reply-link" rel="nofollow" href="#reply">reply</a></div>
                        </li>

                        <li class="depth-3">
                            <div class="author-avatar"><img alt="" src="<?php echo base_url() . 'assets/client/images/avatar.jpg' ?>"></div>
                            <div class="comment-author">Faton</div>
                            <div class="comment-date">May 17, 2012</div>
                            <div class="comment-text"><p>First comment!</p></div>
                            <div class="comment-reply"><a class="comment-reply-link" rel="nofollow" href="#reply">reply</a></div>

                            <ul class="children">
                                <li class="depth-4">
                                    <div class="author-avatar"><img alt="" src="<?php echo base_url() . 'assets/client/images/avatar.jpg' ?>"></div>
                                    <div class="comment-author"><a href="#">Vedat</a></div>
                                    <div class="comment-date">May 17, 2012</div>
                                    <div class="comment-text"><p>First comment!</p></div>
                                    <div class="comment-reply"><a class="comment-reply-link" rel="nofollow" href="#reply">reply</a></div>
                                </li>

                                <li class="depth-4">
                                    <div class="author-avatar"><img alt="" src="<?php echo base_url() . 'assets/client/images/avatar.jpg' ?>"></div>
                                    <div class="comment-author"><a href="#">Vedat</a></div>
                                    <div class="comment-date">May 17, 2012</div>
                                    <div class="comment-text"><p>First comment!</p></div>
                                    <div class="comment-reply"><a class="comment-reply-link" rel="nofollow" href="#reply">reply</a></div>

                                    <ul class="children">
                                        <li class="depth-5">
                                            <div class="author-avatar"><img alt="" src="<?php echo base_url() . 'assets/client/images/avatar.jpg' ?>"></div>
                                            <div class="comment-author"><a href="#">Vedat</a></div>
                                            <div class="comment-date">May 17, 2012</div>
                                            <div class="comment-text"><p>First comment!</p></div>
                                            <div class="comment-reply"><a class="comment-reply-link" rel="nofollow" href="#reply">reply</a></div>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>

                <li class="depth-2">
                    <div class="author-avatar"><img alt="" src="<?php echo base_url() . 'assets/client/images/avatar.jpg' ?>"></div>
                    <div class="comment-author">Faton</div>
                    <div class="comment-date">May 17, 2012</div>
                    <div class="comment-text"><p>First comment!</p></div>
                    <div class="comment-reply"><a class="comment-reply-link" rel="nofollow" href="#reply">reply</a></div>
                </li>
            </ul>
        </li>

        <li class="depth-1">
            <div class="author-avatar"><img alt="" src="<?php echo base_url() . 'assets/client/images/avatar.jpg' ?>"></div>
            <div class="comment-author"><a href="#">Fisi</a></div>
            <div class="comment-date">May 17, 2012</div>
            <div class="comment-text"><p>First comment!</p></div>
            <div class="comment-reply"><a class="comment-reply-link" rel="nofollow" href="#reply">reply</a></div>
        </li>

        <li class="depth-1">
            <div class="author-avatar"><img alt="" src="<?php echo base_url() . 'assets/client/images/avatar.jpg' ?>"></div>
            <div class="comment-author">Besi</div>
            <div class="comment-date">May 17, 2012</div>
            <div class="comment-text"><p>First comment!</p></div>
            <div class="comment-reply"><a class="comment-reply-link" rel="nofollow" href="#reply">reply</a></div>
            
        </li>
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
            <input tabindex="5" id="submit" type="submit" value="Gửi">
        </form>
    </div>
    <!-- End Contact Form -->
    
    <script lang="javascript">
        $(document).ready(function() {
            $('#submit').click(function(e) {
                e.preventDefault();
                $.ajax({
                    url: <?php echo "\"" . base_url() . "comment/addComment\""?>,
                    type: "POST",
                    dataType: "text",
                    data: {
                        postId: $('input[name=postId]').val(),
                        name: $('input[name=name]').val(),
                        website: $('input[name=website]').val(),
                        content: $('textarea[name=content]').val(),
                        parent: $(this).attr('data-value'),
                        email: $('input[name=mail]').val()
                    },
                    success: function(res){
                        alert(res);
                    },
                    failure: function(error) {
                        alert(error);
                    }
                });
            });
        });
    </script>
    
    <script lang="javascript">
        $(document).ready(function() {
            $('.comment-reply-link').click(function(e) {
                e.preventDefault();
                $('body, html').animate({
                    scrollTop: $('#comment_part').offset().top
                }, 800);
                $('#submit').attr('data-value', $(this).attr('href'));
            });
        });
    </script>
</section>