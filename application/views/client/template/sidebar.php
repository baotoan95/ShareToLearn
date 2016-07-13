<aside id="sidebar" class="four column pull-right">
    <ul class="no-bullet">
        <li class="widget tabs-widget clearfix">
            <ul class="tab-links no-bullet clearfix">
                <li class="active"><a href="#popular-tab">Phổ Biến</a></li>
                <li><a href="#comments-tab">Bình Luận</a></li>
            </ul>

            <div id="popular-tab" class="tab">
                <ul>
                    <?php
                        foreach($populars as $post) {
                    ?>
                    <li>
                        <a href="<?php echo base_url() . 'redirect/single/' . $post->getId(); ?>">
                            <img alt="<?php echo $post->getTitle(); ?>" src="<?php echo base_url() . "upload/images/" . $post->getBanner(); ?>">
                        </a>
                        <h3>
                            <a href="<?php echo base_url() . 'redirect/single/' . $post->getId(); ?>"><?php echo $post->getTitle(); ?></a>
                        </h3>
                        <div class="post-date"><?php echo $post->getPublished(); ?></div>
                    </li>
                    <?php
                        }
                    ?>
                    
                </ul>
            </div>

            <div id="comments-tab" class="tab">
                <ul>
                    <?php
                        foreach($latests as $comment) {
                    ?>
                    <li>
                        <a href="#">
                            <img alt="" src="http://placehold.it/60x60">
                        </a>
                        <h3>
                            <a href="#"><?php echo $comment->getAuthor(); ?> says:</a>
                        </h3>
                        <div class="author-comment"><?php echo $comment->getContent(); ?></div>
                    </li>
                    <?php
                        }
                    ?>
                </ul>
            </div>
        </li>
        <li class="widget subscribe-widget clearfix">
            <h3 class="widget-title">Subscribe via email</h3>
            <form>
                <input type="text" data-value="Enter your email address"
                       value="Enter your email address"> <input type="submit"
                       value="Submit">
            </form>
        </li>
        <li class="widget widget_ads_big clearfix">
            <h3 class="widget-title">Ads Big</h3>
            <div class="clearfix">
                <a
                    href="http://themeforest.net/user/nextWPthemes/portfolio?ref=nextWPThemes"><img
                        alt="" src="http://placehold.it/300x250"></a>
            </div>
        </li>
        <li class="widget widget_facebook_box clearfix">
            <h3 class="widget-title">Find Us On Facebook</h3> <iframe
                src="http://www.facebook.com/plugins/likebox.php?href=http://facebook.com/psdtuts&amp;width=285&amp;colorscheme=light&amp;show_faces=true&amp;border_color&amp;stream=false&amp;header=false&amp;height=258"
                scrolling="no" frameborder="0" allowtransparency="true"></iframe>
        </li>
        <li class="widget widget_video clearfix">
            <h3 class="widget-title">Featured Video</h3>
            <div class="flex-video widescreen">
                <iframe src="http://www.youtube.com/embed/YdaMGcOyfjM"
                        frameborder="0" webkitallowfullscreen="" mozallowfullscreen=""
                        allowfullscreen=""></iframe>
            </div>
        </li>
        <li class="widget widget_ads_small clearfix">
            <h3 class="widget-title">Ads Small</h3>
            <ul class="no-bullet clearfix">
                <li><a
                        href="http://themeforest.net/user/nextWPthemes/portfolio?ref=nextWPThemes"><img
                            alt="" src="http://placehold.it/150x150"></a></li>
                <li><a
                        href="http://themeforest.net/user/nextWPthemes/portfolio?ref=nextWPThemes"><img
                            alt="" src="http://placehold.it/150x150"></a></li>
                <li><a
                        href="http://themeforest.net/user/nextWPthemes/portfolio?ref=nextWPThemes"><img
                            alt="" src="http://placehold.it/150x150"></a></li>
                <li><a
                        href="http://themeforest.net/user/nextWPthemes/portfolio?ref=nextWPThemes"><img
                            alt="" src="http://placehold.it/150x150"></a></li>
            </ul>
        </li>
        <li class="widget widget_social_media clearfix">
            <h3 class="widget-title">Follow us</h3>
            <ul class="no-bullet">
                <li class="twitter">
                    <div class="btn">
                        <a href="https://twitter.com/nextWPthemes"
                           class="twitter-follow-button" data-show-count="false"
                           data-show-screen-name="false">Follow @nextWPthemes</a>
                        <script>
                            !function (d, s, id) {
                                var js, fjs = d.getElementsByTagName(s)[0];
                                if (!d.getElementById(id)) {
                                    js = d.createElement(s);
                                    js.id = id;
                                    js.src = "//platform.twitter.com/widgets.js";
                                    fjs.parentNode.insertBefore(js, fjs);
                                }
                            }(document, "script", "twitter-wjs");
                        </script>
                    </div>
                </li>
                <li class="google_plus">
                    <div class="btn">
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
                    </div>
                </li>
                <li class="facebook">
                    <div class="btn">
                        <script>
                            (function (d, s, id) {
                                var js, fjs = d.getElementsByTagName(s)[0];
                                if (d.getElementById(id))
                                    return;
                                js = d.createElement(s);
                                js.id = id;
                                js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
                                fjs.parentNode.insertBefore(js, fjs);
                            }(document, 'script', 'facebook-jssdk'));
                        </script>

                        <div class="fb-like" data-href="http://www.nextwpthemes.com/"
                             data-send="false" data-layout="button_count" data-width="450"
                             data-show-faces="true"></div>
                    </div>
                </li>
                <li class="pinterest">
                    <div class="btn">
                        <a
                            href="http://pinterest.com/pin/create/button/?url=http%3A%2F%2Fthemeforest.net%2Fitem%2Fnext-magazine-responsive-magazine-template%2F2576082&amp;media=http%3A%2F%2F1.s3.envato.com%2Ffiles%2F29793891%2Fscreenshots%2F00_preview.__large_preview.jpg&amp;description=Next+Magazine+-+Responsive+Magazine+Template"
                            class="pin-it-button" count-layout="horizontal"><img
                                alt="Pin It" border="0"
                                src="//assets.pinterest.com/images/PinExt.png" title="Pin It" /></a>
                    </div>
                </li>
            </ul>
        </li>
        <li class="widget widget_tag_cloud clearfix">
            <h3 class="widget-title">Tags</h3>
            <div class="tagcloud">
                <a href="#" title="3 topics" style="font-size: 22pt;">business</a> <a
                    href="#" title="1 topic" style="font-size: 8pt;">Computers</a> <a
                    href="#" title="2 topics" style="font-size: 16.4pt;">css</a> <a
                    href="#" title="2 topics" style="font-size: 16.4pt;">design</a> <a
                    href="#" title="2 topics" style="font-size: 16.4pt;">graphics</a> <a
                    href="#" title="1 topic" style="font-size: 8pt;">html</a> <a
                    href="#" title="2 topics" style="font-size: 16.4pt;">jQuery</a> <a
                    href="#" title="2 topics" style="font-size: 16.4pt;">themes</a> <a
                    href="#" title="2 topics" style="font-size: 16.4pt;">Video</a> <a
                    href="#" title="1 topic" style="font-size: 8pt;">video</a> <a
                    href="#" title="1 topic" style="font-size: 8pt;">website</a>
            </div>
        </li>
    </ul>
</aside>