<?php
    if($post->getCmt_allow()) {
?>
<div class="comments">
    <div class="title-default">
        <a class="active">Comments</a>
    </div>

    <ul id="comments">
        <?php
        if(strlen($comments) == 0) {
            echo "
                <div class='no-comments'>
                    <p>No comments so far.</p>
			<p>Be first to leave comment below.</p>
		</div>
            ";
        } else {
            echo $comments;
        }
        ?>
    </ul>

    <div class="add-comment" id="comment_part">
        <div id="reply" style="display: none; cursor: pointer; color: orangered;" title="Click here to cancel reply mode">REPLY model</div>
        <div id="form_error"></div>
        <form  id="contact" action="<?php echo base_url() . "comment/addComment"; ?>" method="POST">
            <input type="hidden" name="postId" value="<?php echo $post->getId(); ?>">
            <p>
                <input type="text" name="name" class="form-control" placeholder="Your name">
                <input type="text" name="mail" class="form-control" placeholder="E-mail address">
                <input type="text" name="website" class="form-control" placeholder="Web address">
            </p>
            <p>
                <textarea class="form-control" name="content" placeholder="Your comment"></textarea>
            </p>
            <input type="button" id="submit" data-type="comment" data-value="0" class="btn btn-default" value="Post comment"></input>
        </form>
        <script lang="javascript" src="<?php echo base_url() . 'assets/client/js/comment.js'; ?>"></script>
    </div>

</div>
<?php
    }
?>