<div class="container trending">
    <div class="title-default">
        <a href="#" class="active">Trending</a>
    </div>
    <div class="controls">
        <div>
            <a href="#" id="ticker-prev"><i class="fa fa-caret-up"></i></a>
            <a href="#" id="ticker-next"><i class="fa fa-caret-down"></i></a>
            <a href="#" class="pause"><i class="fa fa-pause"></i></a>
        </div>
    </div>
    <div class="items-wrapper">
        <ul id="newsticker" class="items newsticker cycle-slideshow" 
            data-index="1"
            data-cycle-slides="> li"
            data-cycle-auto-height="calc"
            data-cycle-paused="false"                                 
            data-cycle-speed="500"
            data-cycle-next="#ticker-next"
            data-cycle-prev="#ticker-prev"
            data-cycle-fx="scrollVert"
            data-cycle-log="false"
            data-cycle-pause-on-hover="true"
            data-cycle-timeout="2000">
            <?php
            foreach ($trending as $post) {
                ?>
                <li class="item hot">
                    <a href="<?php echo base_url() . $post->getGuid() . '-' . $post->getId() . '.html'; ?>"><i class="tag-default">Hot</i><?php echo $post->getTitle(); ?></a>
                    <span class="legend-default"><i class="fa fa-clock-o"></i><?php echo $post->getPublished(); ?></span>
                </li>
                <?php
            }
            ?>
        </ul>
    </div>

    <div class="social">
        <a target="_blank" href="https://twitter.com/BaoToan1995"><i class="fa fa-twitter-square"></i></a>
        <a target="_blank" href="https://www.facebook.com/btit95"><i class="fa fa-facebook-square"></i></a>
        <a target="_blank" href="https://www.youtube.com/channel/UCyP2SAolzfk4wng8nbGVxdw"><i class="fa fa-youtube-square"></i></a>
        <a target="_blank" href="https://plus.google.com/u/0/+To%C3%A0nB%E1%BA%A3oBTIT95/about"><i class="fa fa-google-plus-square"></i></a>
    </div>
</div>