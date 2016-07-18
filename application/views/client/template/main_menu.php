<header class="clearfix">
    <nav id="main-menu" class="left navigation">
        <ul class="sf-menu no-bullet inline-list m0">
            <?php echo $menu; ?>
        </ul>
    </nav>

    <div class="search-bar right clearfix">
        <form action="<?php echo base_url() . 'redirect/search'; ?>">
            <input name="s" type="text" data-value="search" value="">
            <input type="submit" value="">
        </form>
    </div>
</header>