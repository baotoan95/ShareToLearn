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
        
        $this->load->model('MPost');
        $this->load->model('MCategory');
        $this->load->model('MMenu');
    }
    
    public function menus() {
        // GET pages
        $condition = array(
            "type" => 'page',
            "status" => 'public'
        );
        $pages = $this->MPost->getPosts($condition)['posts'];
        
        // GET post
        $condition = array(
            "type" => 'post',
            "status" => 'public'
        );
        $posts = $this->MPost->getPosts($condition)['posts'];
        $data = array(
            "title" => "Quản lý menu",
            "content" => "admin/menus",
            "categories" => $this->MCategory->getCategoriesParentBox(0, ""),
            "pages" => $pages,
            "posts" => $posts,
            "menu" => $this->MMenu->generateMenu($this->MMenu->getMenu(), array("tag_name"=>"div", "tag_container_name" => "ol"))
        );
        $this->load->view('admin/template/main', $data);
    }
    
    public function addMenuItemAjax() {
        $link_name = $this->input->post('name');
        $link = $this->input->post('link');
        $menuItem = new EMenuItem(0, $link_name, $link, 0);
        echo $this->MMenu->addMenuItem($menuItem);
    }
    
    public function addAndUpdateMenu() {
        // GET menu (json) from client
        $menu = $this->input->post('menu');
        
        $this->MMenu->addMenu(json_decode($menu, TRUE));
        
        $config = array(
            "tag_name" => "a",
            "tag_container_name" => "ol"
        );
        header('Location: ' . base_url() . 'menu/menus', 301);
    }
    
    
}
