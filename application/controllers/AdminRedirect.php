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
    }

    public function index() {
        $data = array(
            "content" => "admin/statistic"
        );
        $this->load->view('admin/template/main', $data);
    }

    public function posts($status = array("public", "draf", "pending", "private"), $p = 1) {
        $this->load->library("pagination");

        $count = $this->mPost->countByStatus();
        print_r($count);

//        $config = array();
//        $config["base_url"] = base_url() . "post/posts/" . 
//                (is_array($status) ? "" : $status) . '/';
//        $config["total_rows"] = is_array($status) ? end($count)['total'] : $count[$status]['count(p_status)'];
//        $config["per_page"] = 2;
//        $config["uri_segment"] = 3;
        
//        echo $count[0]['count(p_status)'];

//        $this->pagination->initialize($config);
//        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
//        $data["results"] = $this->Countries->
//                fetch_countries($config["per_page"], $page);
//        $data["links"] = $this->pagination->create_links();
//
//        $config['base_url'] = base_url() . 'posts?' . (is_array($status) ? "" : 'status=' . $status) . '&p=';
//        $config['total_rows'] = is_array($status) ? end($count)['total'] : $status;
//        $config['per_page'] = 10;
//        $config['cur_page'] = $p;
//        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

        $data = array(
            "content" => "admin/posts",
            "posts" => $this->mPost->getPosts($status, array('records' => $config['per_page'], 'begin' => $page))
        );

//        $data["links"] = $this->pagination->create_links();
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
