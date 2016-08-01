$(document).ready(function () {
    // Event for reply button
    $('.reply-link').click(function (e) {
        e.preventDefault();
        $('#reply').show();
        $('body, html').animate({
            scrollTop: $('#comment_part').offset().top - 50
        }, 800);
        $('#submit').attr('data-value', $(this).attr('href'));
    });

    // Exit reply mode
    $('#reply').on('click', function () {
        $('#submit').attr('data-value', '0');
        $(this).hide();
    });

    // Submit form
    $('#submit').click(function (e) {
        e.preventDefault();
        $('#submit').val('Sending...');
        var author_name = $('input[name=name]').val();
        var cmt_content = $('textarea[name=content]').val();
        var parent_id = $(this).attr('data-value');
        var post_id = $('input[name=postId]').val();

        $.ajax({
            url: document.location.origin + "/comment/addComment",
            type: "POST",
            dataType: "text",
            data: {
                postId: post_id,
                name: author_name,
                website: $('input[name=website]').val(),
                content: cmt_content,
                parent: parent_id,
                email: $('input[name=mail]').val(),
                type: $('#submit').attr('data-type')
            },
            success: function (res) {
                if (res !== 'failure' && !$.isNumeric(res)) {
                    $('#form_error').empty().prepend(res);
                    $('#submit').val('Send');
                    return;
                }

                if (res !== 'failure' && parent_id !== '0') {
                    if ($('#cmt_' + parent_id).has('ul').length) {
                        $('#cmt_' + parent_id + ' ul').prepend(
                                '<li id="cmt_' + res + '">' +
                                '<div class="item">' +
                                '<a href="#" class="image"><img src="' +
                                document.location.origin + '/assets/upload/images/avatars/user.jpg"></a>' +
                                '<div class="comment">' +
                                '<div class="info">' +
                                '<h2><a>' + author_name + '</a></h2>' +
                                '<span class="legend-default"><i class="fa fa-clock-o"></i>Mới đây</span>' +
                                '<span class="nr"></span>' +
                                '</div>' +
                                '<p>' +
                                cmt_content +
                                '</p>' +
                                '</div>' +
                                '</div>' +
                                '</li>'
                                );
                    } else {
                        $('#cmt_' + parent_id).append(
                                '<ul>' +
                                '<li id="cmt_' + res + '">' +
                                '<div class="item">' +
                                '<a href="#" class="image"><img src="' +
                                document.location.origin + '/assets/upload/images/avatars/user.jpg"></a>' +
                                '<div class="comment">' +
                                '<div class="info">' +
                                '<h2><a>' + author_name + '</a></h2>' +
                                '<span class="legend-default"><i class="fa fa-clock-o"></i>Mới đây</span>' +
                                '<span class="nr"></span>' +
                                '</div>' +
                                '<p>' +
                                cmt_content +
                                '</p>' +
                                '</div>' +
                                '</div>' +
                                '</li>' +
                                '</ul>'
                                );
                    }
                    // Delete comment parent id
                    $('#submit').attr('data-value', '0');
                } else if (res !== 'failure') {
                    $('#comments').prepend(
                            '<li id="cmt_' + res + '">' +
                            '<div class="item">' +
                            '<a href="#" class="image"><img src="' +
                            document.location.origin + '/assets/upload/images/avatars/user.jpg"></a>' +
                            '<div class="comment">' +
                            '<div class="info">' +
                            '<h2><a>' + author_name + '</a></h2>' +
                            '<span class="legend-default"><i class="fa fa-clock-o"></i>Mới đây</span>' +
                            '<span class="nr"></span>' +
                            '</div>' +
                            '<p>' +
                            cmt_content +
                            '</p>' +
                            '</div>' +
                            '</div>' +
                            '</li>'
                            );
                } else {
                    $('#submit').val('Error');
                    return;
                }
                
                $('#submit').val('Sent. Thanks!');
                $('.no-comments').remove();
                // Scroll to recent comment
                $('body, html').animate({
                    scrollTop: $('#cmt_' + res).offset().top - 70
                }, 800);
            },
            failure: function (error) {
                alert(error);
                // Delete comment parent id
                $('#submit').attr('data-value', '0');
            }
        });
    });
});