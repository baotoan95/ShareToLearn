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

    public function posts() {
        $this->load->library("pagination");

        // Init data receive from client
        $segment = $this->input->get('p', TRUE);
        $page = isset($segment) ? $segment : 0;

        $status = $this->input->get('status', TRUE);
        if (!isset($status) || $status == 'all' || $status == '') {
            $status = array("public", "draf", "pending", "private");
        }
        $date = $this->input->get('date', TRUE);

        $category = $this->input->get('category', TRUE);
        $tag = $this->input->get('tag', TRUE);
        if (!isset($category)) {
            $category = '';
        }
        if(isset($tag) && strlen(trim($tag)) > 0) {
            $category = $tag;
        }

        $search = $this->input->get('search', TRUE);

        // Get list count by status
        $count = $this->mPost->countByStatus();

        // Config for pagination
        $config["base_url"] = base_url() . "adminredirect";
        $config["prefix"] = "posts?status=" . (is_array($status) ? "all" : $status) .
                "&category=$category&date=$date&search=$search&p=";
        $config["per_page"] = 2;
        $config["cur_page"] = $segment;

        // Init data response client
        $result = $this->mPost->getPosts($status, array('records' => $config['per_page'], 'begin' => $page), $category, $date, $search);
        $config["total_rows"] = $result['total'];

        // Call pagination helper to make links
        $pagination = pagination($config, $this->pagination);
        $data = array(
            "content" => "admin/posts",
            "posts" => $result['posts'],
            "links" => $pagination,
            "count" => $count,
            "dates" => $this->mPost->groupDateOfPosts(),
            "categories" => $this->mCategory->getCategoriesParentBox(0, "", array(intval($category))),
            "status" => (is_array($status) ? "all" : $status),
            "totalResult" => $result['total']
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
