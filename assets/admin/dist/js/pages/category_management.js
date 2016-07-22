/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

// ADD tag
$(document).ready(function() {
    $('#submit').click(function (e) {
        e.preventDefault();
        if (!$('input[name=newcate]').val()) {
            return;
        }
        $.ajax({
            url: document.location.origin + "/category/addCategory",
            type: "POST",
            dataType: "text",
            data: {
            newcate: $('input[name=newcate]').val(),
                slug: $('input[name=slug]').val(),
                parent_cate: $('select[name=parent_cate]').val(),
                desc: $('textarea[name=desc]').val(),
                hasParentBox: true
            },
            success: function (res) {
                if (res !== 'failure') {
                var data = $.parseJSON(res);
                    var category = data.category;
                        $('tbody').prepend(
                        "<tr>" +
                        "<td>" + category.name + "</td>" +
                        "<td>" + category.desc + "</td>" +
                        "<td>" + category.slug + "</td>" +
                        "<td>" + category.count + "</td>" +
                        "<td><i class='fa fa-fw fa-trash del_cate' id='" + category.id + "'></i></td>" +
                        "</tr>"
                    );
                    updateCounts( - 1);
                } else {
                    alert('error');
                }
            },
            failure: function (error) {
                alert(error);
            }
        });
    });
    // DELETE tag
    $('.table tbody').on('click', '.del_cate', function () {
        var element = $(this);
            $.ajax({
                url: document.location.origin + "/category/deleteCategory",
                type: "POST",
                dataType: "text",
                data: {
                    cate_id: element.attr('id')
                },
                success: function (res) {
                    if (res !== 'failure') {
                    element.parent().parent().remove();
                            updateCounts(1);
                    }
                },
                failure: function (error) {
                    alert(error);
                }
            });
    });
    function updateCounts(numb) {
        // Update result (at last of table)
        $('#numerator').html(parseInt($('#numerator').text()) - numb);
        $('#denominator').html(parseInt($('#denominator').text()) - numb);
    }
});