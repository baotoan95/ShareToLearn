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
                        foreach($populars as $popular) {
                    ?>
                    <li>
                        <a href="<?php echo base_url() . $popular->getGuid() . '-' . $popular->getId() . '.html'; ?>">
                            <img alt="<?php echo $popular->getTitle(); ?>" src="<?php echo base_url() . "assets/upload/images/" . $popular->getBanner(); ?>">
                        </a>
                        <h3>
                            <a href="<?php echo base_url() . $popular->getGuid() . '-' . $popular->getId() . '.html'; ?>"><?php echo $popular->getTitle(); ?></a>
                        </h3>
                        <div class="post-date"><?php echo $popular->getPublished(); ?></div>
                    </li>
                    <?php
                        }
                    ?>
                </ul>
            </div>

            <div id="comments-tab" class="tab">
                <ul>
                    <?php
                        foreach($cmt_latests as $comment) {
                    ?>
                    <li>
                        <a href="<?php echo base_url() . $comment->getPost()->getGuid() . '-' . 
                                $comment->getPost()->getId() . '.html#cmt_' . $comment->getId(); ?>">
                            <img alt="" src="http://placehold.it/60x60">
                        </a>
                        <h3>
                            <a href="<?php echo base_url() . $comment->getPost()->getGuid() . '-' . 
                                    $comment->getPost()->getId() . '.html#cmt_' . $comment->getId(); ?>">
                                        <?php echo $comment->getAuthor(); ?>
                            </a>
                        </h3>
                        <div class="author-comment"><?php echo $comment->getContent(); ?></div>
                    </li>
                    <?php
                        }
                    ?>
                </ul>
            </div>
        </li>
        <?php
            if(isset($post) && $post->getType() == 'post') {
        ?>
        <li class="widget widget_tag_cloud clearfix">
            <h3 class="widget-title">Tags</h3>
            <div class="tagcloud">
                <?php
                    foreach($post->getTags() as $tag) {
                        echo "<a href='" . base_url() . "tag/{$tag->getSlug()}' "
                        . "style='font-size: 22pt;'>{$tag->getName()}</a>";
                    }
                ?>
            </div>
        </li>
        <li class="widget widget_tag_cloud clearfix">
            <h3 class="widget-title">Categories</h3>
            <div class="tagcloud">
                <?php
                    foreach($post->getCategories() as $category) {
                        echo "<a href='" . base_url() . "the-loai/{$category->getSlug()}' "
                        . "style='font-size: 22pt;'>{$category->getName()}</a>";
                    }
                ?>
            </div>
        </li>
        <?php 
            }
        ?>
        <li class="widget subscribe-widget clearfix">
            <h3 class="widget-title">Subscribe via email</h3>
            <form>
                <input type="text" data-value="Enter your email address"
                       value="Enter your email address"> <input type="submit"
                       value="Submit">
            </form>
        </li>
        <li class="widget widget_facebook_box clearfix">
            <h3 class="widget-title">Find Us On Facebook</h3> <iframe
                src="http://www.facebook.com/plugins/likebox.php?href=http://facebook.com/psdtuts&amp;width=285&amp;colorscheme=light&amp;show_faces=true&amp;border_color&amp;stream=false&amp;header=false&amp;height=258"
                scrolling="no" frameborder="0" allowtransparency="true"></iframe>
        </li>
    </ul>
</aside>