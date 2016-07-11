<section id="content" class="eight column row pull-left">
    <!-- Latest posts -->
    <h4 class="cat-title mb25">Bài Viết Mới</h4>

    <!-- Posts -->
    <section class="row">
        <?php
            foreach($post_latest as $post) {
        ?>
        <!-- post -->
        <article class="post six column">
            <div class="post-image">
                <a href="<?php echo base_url() . 'redirect/single/' . $post->getId(); ?>"><img src="<?php echo base_url() . 'assets/upload/images/' . $post->getBanner(); ?>" alt=""></a>
            </div>

            <div class="post-container">
                <h2 class="post-title"><?php echo $post->getTitle(); ?></h2>
                <div class="post-content">
                    <p><?php echo $post->getExcerpt(); ?></p>
                </div>
            </div>

            <div class="post-meta">
                <span class="comments"><a href="#"><?php echo $post->getComments(); ?></a></span>
                <span class="author"><a href="#"><?php echo $post->getAuthor()->getFull_name(); ?></a></span>
                <span class="date"><a href="#"><?php echo $post->getPublished(); ?></a></span>
            </div>
        </article>
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