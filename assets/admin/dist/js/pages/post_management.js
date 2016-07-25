/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

// DELETE post
$('.del_post').click(function () {
    var element = $(this);
    $.ajax({
        url: document.location.origin + "/Post/deletePost",
        type: "POST",
        dataType: "text",
        data: {
            id: element.attr('id')
        },
        success: function (res) {
            alert(res);
            if (res !== 'failure') {
                element.parent().parent().remove();
            }
        },
        failure: function (error) {
            alert(error);
        }
    });
});
