<div class="blog-block-1">
    <div class="title-default">
        <a class="active"><?php echo $listTitle; ?></a>
    </div>

    <div class="items">
        <?php
            echo count($posts) == 0 ? "<div class='twelve column'>Không có kết quả nào</div>" : "";
            foreach($posts as $post) {
        ?>
        <div class="post-item post-sticky">
            <div class="image">
                <a href="<?php echo base_url() . $post->getGuid() . '-' . $post->getId() . '.html'; ?>">
                    <img class="lazy" alt="<?php echo $post->getTitle(); ?>"
                        data-original="<?php echo base_url() . 'assets/upload/images/' . $post->getBanner(); ?>">
                </a>
            </div>
            <div class="title">
                <h2>
                    <a href="<?php echo base_url() . $post->getGuid() . '-' . $post->getId() . '.html'; ?>">
                        <?php echo $post->getTitle(); ?>
                    </a>
                </h2>
                <p>
                    <i class="tag-default"><?php echo $post->getAuthor()->getFull_name(); ?></i>
                    <span class="legend-default">
                        <i class="fa fa-clock-o"></i><?php echo $post->getPublished(); ?>
                        <i class="fa fa-comments"></i><?php echo $post->getComments(); ?>
                    </span>
                </p>
            </div>
            <div class="intro">
                <?php echo $post->getExcerpt(); ?>
                <a href="<?php echo base_url() . $post->getGuid() . '-' . $post->getId() . '.html'; ?>" class="more-link">Read more</a>
            </div>
        </div>
        <?php
            }
        ?>
    </div>

</div>