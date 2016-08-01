<div class="post-block-3">
    <div class="title-default">
        <a class="active">Danh sách tác giả</a>
    </div>

    <div class="items">
        <?php
            foreach($users as $u) {
        ?>
        <div class="post-item post-sticky" data-overlay="1" 
            data-overlay-excerpt="<?php echo $u->getDesc(); ?>" data-overlay-url="">
            <div class="image">
                <a href=""><img src="<?php echo base_url() . 'assets/upload/images/avatars/' . $u->getAvatar(); ?>"></a>
            </div>
            <div class="title">
                <h2><a href=""><?php echo $u->getFull_name(); ?></a></h2>
                <p>
                    <span class="legend-default">
                        <i class="fa fa-clock-o"></i><?php echo $u->getJoined(); ?>
                        <i class="fa fa-comments"></i><?php echo $u->getCount_posts(); ?>
                    </span>
                </p>
            </div>
            <div class="intro">
                <?php echo $u->getDesc(); ?>
            </div>
        </div>
        <?php
            }
        ?>
    </div>
</div>