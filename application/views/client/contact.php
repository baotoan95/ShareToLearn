<section id="content" class="eight column row pull-left">
    <h1 class="post-title">Get in touch with us</h1>

    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam ultrices elementum odio, ac fermentum justo sodales vel. Suspendisse potenti. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Nam scelerisque, massa quis pulvinar accumsan, leo sem iaculis enim, feugiat elementum erat lacus id eros. Nam at nunc metus, sit amet lobortis sem. Etiam ut mauris quis magna condimentum porttitor. Duis sit amet erat porttitor erat dictum molestie quis sit amet mi. Nullam risus massa, euismod id venenatis ut, tempus et eros.</p>

    <!-- Map -->
    <div id="map" class="row flex-video widescreen"></div>
    <!-- End Map -->

    <br>
    
    <h3 class="post-title">Send us a message</h3>

    <!-- Contact Form -->
    <div class="contact-form cleafix">
        <div id="form_error"></div>
        <form id="contact">
            <input name="name" class="left" type="text" data-value="Name" placeholder="Name">
            <input name="mail" class="right" type="text" data-value="E-mail" placeholder="E-mail">
            <textarea id="comment" name="content" class="twelve column" data-value="Message"></textarea>
            <div id="msg" class="message"></div>
            <input id="submit" type="submit" value="Send">
        </form>
    </div>
    <script lang="javascript">
        $(document).ready(function () {
            // Submit form
            $('#submit').click(function (e) {
                e.preventDefault();
                $(this).val('Sending...');
                var author_name = $('input[name=name]').val();
                var cmt_content = $('textarea[name=content]').val();
                
                $.ajax({
                    url: <?php echo "\"" . base_url() . "comment/addComment\"" ?>,
                    type: "POST",
                    dataType: "text",
                    data: {
                        postId: 0,
                        name: author_name,
                        website: $('input[name=website]').val(),
                        content: cmt_content,
                        parent: 0,
                        email: $('input[name=mail]').val(), 
                        type: 'contact'
                    },
                    success: function (res) {
                        if(res !== 'failure' && !$.isNumeric(res)) {
                            $('#form_error').empty().prepend(res);
                            $('#submit').val('Send');
                            return;
                        }
                        $('#submit').val('Sent. Thanks!');
                    },
                    failure: function (error) {
                        alert(error);
                    }
                });
            });
        });
    </script>
    <!-- End Contact Form -->

    <br>
    <br>
    <br>
</section>