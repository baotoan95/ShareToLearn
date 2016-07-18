<?php

/**
 * Description of Error
 *
 * @author BaoToan
 */
class Error extends CI_Controller {
    public function __construct() {
        parent::__construct();
        
        $this->load->model('mPost');
        $this->load->model('mComment');
        $this->load->model('mUser');
        $this->load->model('mMenu');
    }
    public function index() {
        // GET list post popular
        $condition = array(
            "order_by" => "p_view_count",
            "type" => 'post',
            "status" => 'public',
        );
        $populars = $this->mPost->getPosts($condition, array('records' => 10, 'begin' => 0));

        // GET list comment latest
        $lastest_comments = $this->mComment->getComments(array(), array('records' => 10, 'begin' => 0));

        // Init data to response client
        $data = array(
            "title" => 'Page not found',
            "sidebar" => 'client/template/sidebar',
            "menu" => $this->mMenu->generateMenu($this->mMenu->getMenus(), array("tag_name"=>"a", "tag_container_name" => "ul")),
            "content" => 'client/404',
            "populars" => $populars['posts'],
            "latests" => $lastest_comments['comments']
        );
        $this->load->view('client/template/main', $data);
    }
}
