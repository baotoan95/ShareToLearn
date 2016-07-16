<?php

/**
 * Description of Menu
 *
 * @author BaoToan
 */
class Menu extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('mPost');
        $this->load->model('mCategory');
    }
    
    public function menus() {
        // GET pages
        $condition = array(
            "type" => 'page',
            "status" => 'public'
        );
        $pages = $this->mPost->getPosts($condition)['posts'];
        
        // GET post
        $condition = array(
            "type" => 'post',
            "status" => 'public'
        );
        $posts = $this->mPost->getPosts($condition)['posts'];
        $data = array(
            "title" => "Quản lý menu",
            "content" => "admin/menus",
            "categories" => $this->mCategory->getCategoriesParentBox(0, ""),
            "pages" => $pages,
            "posts" => $posts
        );
        $this->load->view('admin/template/main', $data);
    }
}
