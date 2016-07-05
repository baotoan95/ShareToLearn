<?php

defined('BASEPATH') or exit('No derect script access allowed');

/**
 * Description of PostController
 *
 * @author BaoToan
 */
class AdminRedirect extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('mPost');
        $this->load->model('mCategory');
    }

    public function index() {
        $data = array(
            "content" => "admin/statistic"
        );
        $this->load->view('admin/template/main', $data);
    }

    public function posts($status, $p = 1) {
        $this->load->library("pagination");
        
        // Init data receive from client
        if($status == 'all') {
            $status = array("public", "draf", "pending", "private");
        }
        $date = $this->input->get('date', TRUE);
        $category = $this->input->get('category', TRUE);
        
        // Get list count by status
        $count = $this->mPost->countByStatus();
        
        // Config for pagination
        $config["base_url"] = base_url() . "adminredirect/posts/" . 
                (is_array($status) ? "all" : $status) . '/';
        $config["total_rows"] = is_array($status) ? $count['total'] : $count[$status];
        $config["per_page"] = 2;
        // Call pagination helper to make links
        $pagination = pagination($config, $this->pagination);
        
        // Get begin record from url at segment 4
        $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;

        // Init data response client
        $posts = $this->mPost->getPosts($status, array('records' => $config['per_page'], 'begin' => $page));
        $data = array(
            "content" => "admin/posts",
            "posts" => $posts,
            "links" => $pagination,
            "count" => $count,
            "dates" => $this->mPost->groupDateOfPosts(),
            "categories" => $this->mCategory->getCategoriesParentBox(0)
        );

        $this->load->view('admin/template/main', $data);
    }

    public function tags() {
        $data = array(
            "content" => "admin/tags"
        );
        $this->load->view('admin/template/main', $data);
    }

    public function menus() {
        $data = array(
            "content" => "admin/menus"
        );
        $this->load->view('admin/template/main', $data);
    }

    public function categories() {
        $data = array(
            "content" => "admin/categories"
        );
        $this->load->view('admin/template/main', $data);
    }

    public function comments() {
        $data = array(
            "content" => "admin/comments"
        );
        $this->load->view('admin/template/main', $data);
    }

    public function users() {
        $data = array(
            "content" => "admin/comments"
        );
        $this->load->view('admin/template/main', $data);
    }

    public function newuser() {
        $data = array(
            "content" => "admin/user"
        );
        $this->load->view('admin/template/main', $data);
    }

    public function profile() {
        $data = array(
            "content" => "admin/user"
        );
        $this->load->view('admin/template/main', $data);
    }

}

?>
