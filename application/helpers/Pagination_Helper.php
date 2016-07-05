<?php

function pagination($my_config, $pagination) {
    $default_config = array();
    $default_config["full_tag_open"] = "<ul class='pagination pagination-sm no-margin pull-right'>";
    $default_config["full_tag_close"] = "</ul>";
    $default_config["first_tag_open"] = "<li>";
    $default_config["first_tag_close"] = "<li>";
    $default_config["prev_tag_open"] = "<li>";
    $default_config["prev_tag_close"] = "</li>";
    $default_config["cur_tag_open"] = "<li class='active'><a>";
    $default_config["cur_tag_close"] = "</a></li>";
    $default_config["num_tag_open"] = "<li>";
    $default_config["num_tag_close"] = "</li>";
    $default_config["next_tag_open"] = "<li>";
    $default_config["next_tag_close"] = "</li>";
    $default_config["last_tag_open"] = "<li>";
    $default_config["last_tag_close"] = "</li>";

    $pagination->initialize(array_merge($default_config, $my_config));
    return $pagination -> create_links();
}
