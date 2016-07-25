<div class="post-1">
    <div class="post">
        <?php echo $page->getContent(); ?>
    </div>
</div>
<div class="add-comment">
    <div id="form_error"></div>
    <form>
        <input type="hidden" name="postId" value="0">
        <p>
            <input type="text" name="name" class="form-control" placeholder="Your name">
            <input type="text" name="mail" class="form-control" placeholder="E-mail address">
            <input type="text" name="website" class="form-control" placeholder="Web address">
        </p>
        <p>
            <textarea class="form-control" name="content" placeholder="Your comment"></textarea>
        </p>
        <input type="button" id="submit" data-type="contact" data-value="0" class="btn btn-default" value="Send"></input>
    </form>
    <script lang="javascript" src="<?php echo base_url() . 'assets/client/js/comment.js'; ?>"></script>
</div>