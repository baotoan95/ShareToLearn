<section id="content" class="eight column row pull-left">
    <section class="row">
        <?php
            foreach($users as $u) {
        ?>
        <!-- Category posts -->
        <article class="six column">
            <div class="post">
            <h4 class="cat-title"><a href="#">Tác Giả</a></h4>
            <div class="post-image">
                <a href="#"><img src="<?php echo base_url() . 'assets/upload/images/avatars/' . $u->getAvatar(); ?>" alt=""></a>
            </div>

            <div class="post-container">
                <h2 class="post-title"><?php echo $u->getFull_name(); ?></h2>
                <div class="post-content">
                    <p><?php echo $u->getDesc(); ?></p>
                </div>
            </div>

            <div class="post-meta">
                <span class="comments"><a href="#">24</a></span>
                <span class="author"><a href="#">nextwpthemes</a></span>
                <span class="date"><a href="#">13 Jan 2013</a></span>
            </div>
            </div>
        </article>
        <!-- End Category posts -->
        <?php
            }
        ?>
    </section>
</section>