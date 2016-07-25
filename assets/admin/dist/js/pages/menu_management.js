/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$(document).ready(function () {
    // Create menu view
    var updateOutput = function (e) {
        var list = e.length ? e : $(e.target),
                output = list.data('output');
        if (window.JSON) {
            output.val(window.JSON.stringify(list.nestable('serialize')));//, null, 2));
        } else {
            output.val('JSON browser support required for this demo.');
        }
    };

    // activate Nestable for list 1
    $('#nestable').nestable({
        group: 1
    }).on('change', updateOutput);

    // output initial serialised data
    updateOutput($('#nestable').data('output', $('#nestable-output')));

    $('#nestable-menu').on('click', function (e) {
        var target = $(e.target), action = target.data('action');
        if (action === 'expand-all') {
            $('.dd').nestable('expandAll');
        }
        if (action === 'collapse-all') {
            $('.dd').nestable('collapseAll');
        }
    });
    // End create menu view

    // ADD link
    $('#add_link').on('click', function (e) {
        e.preventDefault();
        $('#link, #link_name').css({"border": "1px solid #D2D6DE"});
        if ($('#link').val() === '') {
            $('#link').css({"border": "1px solid red"});
            return;
        }
        if ($('#link_name').val() === '') {
            $('#link_name').css({"border": "1px solid red"});
            return;
        }

        $.ajax({
            url: document.location.origin + "/post/addLink",
            type: 'post',
            contextType: 'text',
            data: {
                name: $('#link_name').val(),
                link: $('#link').val()
            },
            success: function (res) {
                if (res !== 'failure') {
                    $('#menus').append(
                            '<li class="dd-item dd3-item" data-id="' + res + '-navigation">' +
                            '<div class="dd-handle dd3-handle"></div>' +
                            '<div class="dd3-content">' + $('#link_name').val() + ' [NAVIGATION]' +
                            '<a class="pull-right del-mnItem" title="Delete">X</a>' +
                            '</div>' +
                            '</li>'
                            );
                    updateOutput($('#nestable').data('output', $('#nestable-output')));
                }
            },
            failure: function (error) {
                alert(error);
            }
        });
    });
    // END add link

    // SEARCH category
    $('#search-cates').on('keyup', function () {
        $.ajax({
            url: document.location.origin + "/category/searchCategoriesAjax",
            type: "post",
            contextType: "text",
            data: {
                name: $('#search-cates').val()
            },
            success: function (res) {
                $('#cates').empty();
                if ($('#search-cates').val() === '') {
                    $('#cates').append(res);
                    return;
                }
                var cates = $.parseJSON(res);
                $('#cates').empty();
                cates.forEach(function (cate) {
                    $('#cates').append(
                            "<option value='" + cate.id + "'>" + cate.name + "</option>"
                            );
                });
            },
            failure: function (error) {
                alert(error);
            }
        });
    });
    // ADD category to menu
    $('#add_cate').on('click', function (e) {
        e.preventDefault();
        if ($('#cates').val() === null) {
            return;
        }
        $.ajax({
            url: document.location.origin + "/category/getCategoriesAjax",
            type: "post",
            contextType: "text",
            data: {
                cateIds: $('#cates').val()
            },
            success: function (res) {
                var cates = $.parseJSON(res);
                cates.forEach(function (cate) {
                    $('#menus').append(
                            '<li class="dd-item dd3-item" data-id="' + cate.id + '-category">' +
                            '<div class="dd-handle dd3-handle"></div>' +
                            '<div class="dd3-content">' + cate.name + ' [CATEGORY]' +
                            '<a class="pull-right del-mnItem" title="Delete">X</a>' +
                            '</div>' +
                            '</li>'
                            );
                });
                updateOutput($('#nestable').data('output', $('#nestable-output')));
            },
            failure: function (error) {
                alert(error);
            }
        });
    });
    // END add category to menu

    // Search page
    $('#search-page').on('keyup', function () {
        $.ajax({
            url: document.location.origin + "/post/searchPostsAjax",
            type: "post",
            contextType: "text",
            data: {
                name: $('#search-page').val(),
                type: 'page'
            },
            success: function (res) {
                var pages = $.parseJSON(res);
                $('#pages').empty();
                pages.forEach(function (page) {
                    $('#pages').append(
                            "<option value='" + page.id + "'>" + page.title + "</option>"
                            );
                });
            },
            failure: function (error) {
                alert(error);
            }
        });
    });
    // ADD page to menu
    $('#add_page').on('click', function (e) {
        e.preventDefault();
        if ($('#pages').val() === null) {
            return;
        }
        $.ajax({
            url: document.location.origin + "/post/getPostsAjax",
            type: "post",
            contextType: "text",
            data: {
                pageIds: $('#pages').val(),
                type: 'page'
            },
            success: function (res) {
                var pages = $.parseJSON(res);
                pages.forEach(function (page) {
                    $('#menus').append(
                            '<li class="dd-item dd3-item" data-id="' + page.id + '-page">' +
                            '<div class="dd-handle dd3-handle"></div>' +
                            '<div class="dd3-content">' + page.title + ' [PAGE]' +
                            '<a class="pull-right del-mnItem" title="Delete">X</a>' +
                            '</div>' +
                            '</li>'
                            );
                });
                updateOutput($('#nestable').data('output', $('#nestable-output')));
            },
            failure: function (error) {
                alert(error);
            }
        });
    });
    // END add page to menu

    // Search post
    $('#search-post').on('keyup', function () {
        $.ajax({
            url: document.location.origin + "/post/searchPostsAjax",
            type: "post",
            contextType: "text",
            data: {
                name: $('#search-post').val(),
                type: 'post'
            },
            success: function (res) {
                var posts = $.parseJSON(res);
                $('#posts').empty();
                posts.forEach(function (post) {
                    $('#posts').append(
                            "<option value='" + post.id + "'>" + post.title + "</option>"
                            );
                });
            },
            failure: function (error) {
                alert(error);
            }
        });
    });
    // ADD post to menu
    $('#add_post').on('click', function (e) {
        e.preventDefault();
        if ($('#posts').val() === null) {
            return;
        }
        $.ajax({
            url: document.location.origin + "/post/getPostsAjax",
            type: "post",
            contextType: "text",
            data: {
                pageIds: $('#posts').val(),
                type: 'post'
            },
            success: function (res) {
                var posts = $.parseJSON(res);
                posts.forEach(function (post) {
                    $('#menus').append(
                            '<li class="dd-item dd3-item" data-id="' + post.id + '-post">' +
                            '<div class="dd-handle dd3-handle"></div>' +
                            '<div class="dd3-content">' + post.title + ' [POST]' +
                            '<a class="pull-right del-mnItem" title="Delete">X</a>' +
                            '</div>' +
                            '</li>'
                            );
                });
                updateOutput($('#nestable').data('output', $('#nestable-output')));
            },
            failure: function (error) {
                alert(error);
            }
        });
    });
    // END add post to menu

    // Delete menu Item
    $('#nestable').on('click', '.del-mnItem', function (e) {
        e.preventDefault();
        $(this).parent().parent().remove();
    });
    
    // Delete menu
    $('#delete_menu').on('click', function(e) {
        e.preventDefault();
        $.ajax({
            url: document.location.origin + "/menu/deleteMenu",
            type: "post",
            contextType: "text",
            success: function (res) {
                if(res === 'successful') {
                    $('#menus').empty();
                    updateOutput($('#nestable').data('output', $('#nestable-output')));
                }
            },
            failure: function (error) {
                alert(error);
            }
        });
    });
});

