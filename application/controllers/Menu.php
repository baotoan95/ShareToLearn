<?php

/**
 * Description of Menu
 *
 * @author BaoToan
 */
class Menu extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('EMenuItem');
        
        $this->load->model('mPost');
        $this->load->model('mCategory');
        $this->load->model('mMenu');
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
    
    public function addMenuItemAjax() {
        $link_name = $this->input->post('name');
        $link = $this->input->post('link');
        $menuItem = new EMenuItem(0, $link_name, $link, 0);
        echo $this->mMenu->addMenuItem($menuItem);
    }
    
    public function addAndUpdateMenu() {
        // GET menu (json) from client
        $menu = $this->input->post('menu');
        
        $this->mMenu->addMenu(json_decode($menu, TRUE));
        
        echo "<pre>";
        var_dump(json_decode($menu, TRUE));
        echo "</pre>";
    }
    
    
}
