<section id="content" class="eight column row pull-left">
    <!-- Latest posts -->
    <h4 class="cat-title mb25"><?php echo $boxTitle; ?></h4>

    <!-- Posts -->
    <section class="row">
        <?php
            echo count($posts) == 0 ? "<div class='twelve column'>Không có kết quả nào</div>" : "";
            foreach($posts as $post) {
        ?>
        <!-- post -->
        <div class="twelve column">
            <article class="post-horizontal">
                <div class="post-info">
                    <h2 class="post-title">
                        <a href="<?php echo base_url() . $post->getGuid() . '-' . $post->getId() . '.html'; ?>">
                            <?php echo $post->getTitle(); ?>
                        </a>
                    </h2>
                    <div class="post-meta">
                        <span class="comments"><a href="#"><?php echo $post->getComments(); ?></a></span>
                        <span class="author"><a href="#"><?php echo $post->getAuthor()->getFull_name(); ?></a></span>
                        <span class="date"><a href="#"><?php echo $post->getPublished(); ?></a></span>
                    </div>
                </div>
                
                <div class="post-container">
                    <div class="post-image">
                        <a href="<?php echo base_url() . $post->getGuid() . '-' . $post->getId() . '.html'; ?>"><img src="<?php echo base_url() . 'assets/upload/images/' . $post->getBanner(); ?>" alt=""></a>
                    </div>
                    <p class="post-desc"><?php echo $post->getExcerpt(); ?></p>
                    <div class="clear"></div>
                </div>
            </article>
        </div>
        <!-- End post -->
        <?php
            }
        ?>
    </section>
    <!-- End Posts -->

    <!-- Pagenation -->
    <div class="pagenation clearfix">
        <?php echo $links; ?>
    </div>
    <!-- End latest posts -->
</section>