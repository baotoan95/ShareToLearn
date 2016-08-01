<link rel="stylesheet" href="<?php echo base_url() . 'assets/client/css/zoomify.min.css'; ?>">
<?php
$allowed = $this->session->userdata('passPosts') == NULL ? array() : $this->session->userdata('passPosts');
if (strlen($post->getPassword()) > 0 &&
        (!array_key_exists($post->getId(), $allowed) ||
        $post->getPassword() != $allowed[$post->getId()])) {
    ?>
    <div id="password_required">
        This post is password protected. To view it please enter your password below:
        <form action="<?php echo base_url() . 'user/checkLogin?action=passpost' ?>" method="post">
            <input type="hidden" name="id" value="<?php echo $post->getId(); ?>"/>
            <br/>
            <input type="password" placeholder="Enter password" style="width: 200px; display: inline;" name="password"/>
            <input type="submit" value="Enter"/>
        </form>
    </div>
    <?php
} else {
    ?>
    <div class="post-1">
        <?php if (isset($post) && $post->getType() == 'post') { ?>
            <div class="title">
                <h2 id="intro"><a><?php echo $post->getTitle(); ?></a></h2>
                <p>
                    <span class="legend-default">
                        <i class="fa fa-clock-o"></i><?php echo $post->getPublished(); ?>
                        <i class="fa fa-user"></i><a href="#"><?php echo $post->getAuthor()->getFull_name(); ?></a>
                        <i class="fa fa-comments"></i><?php echo $post->getComments(); ?>
                    </span>
                </p>

                <?php if ($post->getTags()) { ?>
                    <div class="tag-cloud tag-title">
                        <i class="fa fa-tags"></i>
                        <?php
                        foreach ($post->getTags() as $tag) {
                            echo "<a href='" . base_url() .
                            "ptag/{$tag->getSlug()}' class='tag-1'>"
                            . "<span>{$tag->getName()}</span></a>";
                        }
                        ?>
                    </div>
                <?php } ?>

                <div class="addthis_native_toolbox" style="margin-top: 5px;"></div>
            </div>
        <?php } ?>


        <div class="post">
            <p><?php echo $post->getContent(); ?></p>
        </div>
    </div>

    <?php if (isset($post) && $post->getType() == 'post') { ?>
        <div class="about-author" id="about-author">
            <div class="title-default">
                <a class="active">About author</a>
            </div>
            <div class="about">
                <div class="avatar">
                    <img class="lazy" alt="author" src="<?php echo base_url() . 'assets/upload/images/avatars/' . $post->getAuthor()->getAvatar(); ?>">
                </div>
                <h2><?php echo $post->getAuthor()->getFull_name(); ?><span><?php echo $post->getAuthor()->getRole(); ?></span></h2>
                <p><?php echo $post->getAuthor()->getDesc(); ?></p>
                <div class="social">
                    <a href="#"><i class="fa fa-twitter-square"></i></a>
                    <a href="<?php echo $post->getAuthor()->getFacebook(); ?>"><i class="fa fa-facebook-square"></i></a>
                    <a href="<?php echo $post->getAuthor()->getGoogle(); ?>"><i class="fa fa-google-plus-square"></i></a>
                </div>
            </div>
        </div>
    <?php } ?>

    <?php $this->load->view('client/post-comment'); ?>

    <?php
}
?>

<!-- Enable zoomify -->
<script src="<?php echo base_url() . 'assets/client/js/zoomify.min.js'; ?>"></script>

<script>
    $('img.zoomable').zoomify({ duration: 500 });
</script>