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
    }

    public function index() {
        $data = array(
            "content" => "admin/statistic"
        );
        $this->load->view('admin/template/main', $data);
    }

    public function posts() {
        $data = array(
            "content" => "admin/posts"
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
