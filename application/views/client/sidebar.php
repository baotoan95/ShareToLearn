<div class="main-sidebar">
    <?php if (isset($suggest) && count($suggest) > 0) { ?>
        <!-- Suggest -->
        <div class="widget-tabs mobile">
            <div class="title-default">
                <a class="active">Suggest</a>
            </div>
            <?php
            foreach ($suggest as $sug) {
                ?>
                <div class="items">
                    <div class="post-item" data-overlay="1" 
                         data-overlay-excerpt="<?php echo $sug->getExcerpt(); ?>" 
                         data-overlay-url="<?php echo base_url() . $sug->getGuid() . '-' . $sug->getId() . '.html'; ?>">
                        <div class="image">
                            <a href="<?php echo base_url() . $sug->getGuid() . '-' . $sug->getId() . '.html'; ?>">
                                <img class="lazy" alt="<?php echo $sug->getTitle(); ?>" 
                                     src="<?php echo base_url() . 'assets/upload/images/' . $sug->getBanner(); ?>">
                            </a>
                        </div>
                        <div class="title">
                            <h2>
                                <a href="<?php echo base_url() . $sug->getGuid() . '-' . $sug->getId() . '.html'; ?>">
                                    <?php echo $sug->getTitle(); ?>
                                </a>
                            </h2>
                            <p>
                                <i class="tag-default"><?php echo $sug->getAuthor()->getFull_name(); ?></i>
                                <span class="legend-default">
                                    <i class="fa fa-clock-o"></i><?php echo $sug->getPublished(); ?>
                                    <i class="fa fa-comments"></i><?php echo $sug->getComments(); ?>
                                </span>
                            </p>
                        </div>
                    </div>
                </div>
                <?php
            }
            ?>
        </div>
        <?php
    }
    ?>

    <!-- Tabs -->
    <div class="widget-tabs switchable-tabs mobile">
        <div class="title-default">
            <a href="#" class="active">Popular</a>
            <a href="#">Comments</a>
        </div>

        <div class="tabs-content">
            <!-- Popular posts -->
            <div class="items">
                <?php
                foreach ($populars as $popular) {
                    ?>
                    <div class="post-item" data-overlay="1" data-overlay-excerpt="<?php echo $popular->getExcerpt(); ?>" data-overlay-url="<?php echo base_url() . $popular->getGuid() . '-' . $popular->getId() . '.html'; ?>">
                        <div class="image">
                            <a href="<?php echo base_url() . $popular->getGuid() . '-' . $popular->getId() . '.html'; ?>">
                                <img class="lazy" alt="<?php echo $popular->getTitle(); ?>" src="<?php echo base_url() . "assets/upload/images/" . $popular->getBanner(); ?>">
                            </a>
                        </div>
                        <div class="title">
                            <h2><a href="<?php echo base_url() . $popular->getGuid() . '-' . $popular->getId() . '.html'; ?>"><?php echo $popular->getTitle(); ?></a></h2>
                            <p><i class="tag-default"><?php echo $popular->getAuthor()->getFull_name(); ?></i><span class="legend-default"><i class="fa fa-clock-o"></i><?php echo $popular->getPublished(); ?><i class="fa fa-comments"></i><?php echo $popular->getComments(); ?></span></p>
                        </div>
                    </div>
                    <?php
                }
                ?>
            </div>

            <div class="items">
                <?php
                foreach ($cmt_latests as $comment) {
                    ?>
                    <div class="post-item" data-overlay="1" data-overlay-excerpt="<?php echo $comment->getContent(); ?>" 
                         data-overlay-url="<?php
                         echo base_url() . $comment->getPost()->getGuid() . '-' .
                         $comment->getPost()->getId() . '.html#cmt_' . $comment->getId();
                         ?>">
                        <div class="image">
                            <a href="<?php
                            echo base_url() . $comment->getPost()->getGuid() . '-' .
                            $comment->getPost()->getId() . '.html#cmt_' . $comment->getId();
                            ?>">
                                <img class="lazy" alt="<?php echo $comment->getContent(); ?>" 
                                     src="<?php
                                     echo base_url() . 'assets/upload/images/avatars/' .
                                     ((NULL == $comment->getUser()) ? 'user.jpg' : $comment->getUser()->getAvatar())
                                     ?>">
                            </a>
                        </div>
                        <div class="title">
                            <h2>
                                <a href="<?php
                                echo base_url() . $comment->getPost()->getGuid() . '-' .
                                $comment->getPost()->getId() . '.html#cmt_' . $comment->getId();
                                ?>">
                                    <?php echo $comment->getAuthor(); ?> say: <?php echo $comment->getContent(); ?>
                                </a>
                            </h2>
                            <p>
                                <span class="legend-default">
                                    <i class="fa fa-clock-o"></i><?php echo $comment->getDate(); ?>
                                </span>
                            </p>
                        </div>
                    </div>
                    <?php
                }
                ?>
            </div>
        </div>
    </div>

    <div class="banner-300x250">
        <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
        <!-- ad_1 -->
        <ins class="adsbygoogle"
             style="display:block"
             data-ad-client="ca-pub-5942999264053046"
             data-ad-slot="8043674814"
             data-ad-format="auto"></ins>
        <script>
            (adsbygoogle = window.adsbygoogle || []).push({});
        </script>
    </div>

    <?php
    if (isset($post) && $post->getType() == 'post' && count($post->getCategories()) > 0) {
        ?>
        <!-- Tags -->
        <div class="widget-tabs">
            <div class="title-default">
                <a class="active">Post categories</a>
            </div>
            <div class="items tag-cloud">
                <?php
                foreach ($post->getCategories() as $category) {
                    echo "<a href='" . base_url() .
                    "the-loai/{$category->getSlug()}' class='tag-1'>"
                    . "<span>{$category->getName()}</span></a>";
                }
                ?>
            </div>
        </div>
        <?php
    }
    ?>

    <!-- Tags -->
    <div class="widget-tabs">
        <div class="title-default">
            <a class="active">Find On Facebook</a>
        </div>
        <div class="items">
            <div class="fb-page"
                 data-href="https://www.facebook.com/Btit95-588678394647082/" 
                 data-width="340"
                 data-hide-cover="false"
                 data-show-facepile="true"></div>
        </div>
    </div>
</div>