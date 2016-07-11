<?php

defined('BASEPATH') or exit('No derect script access allowed');

/**
 * Description of PostController
 *
 * @author BaoToan
 */
class Redirect extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('mPost');
    }

    public function index() {
        $this->load->library('pagination');
        $segment = $this->input->get('p');
        
        $config = array(
            "base_url" => base_url(),
            "prefix" => "redirect?p=",
            "per_page" => 1,
            "cur_page" => $segment
        );
        $condition = array(
            "type" => "post",
            "status" => "public"
        );
        // GET result (return list of posts)
        $result = $this->mPost->getPosts($condition, array('records' => $config['per_page'], 'begin' => $segment));
        $config['total_rows'] = $result['total'];
        
        // Init data to response client
        $data = array(
            "sidebar" => 'client/template/sidebar',
            "content" => 'client/index',
            "post_latest" => $result['posts'],
            "links" => pagination($config, $this->pagination) // Init pagination
        );
        
        $this->load->view('client/template/main', $data);
    }

    public function category() {
        $data = array(
            "sidebar" => 'client/template/sidebar',
            "content" => 'client/category'
        );
        $this->load->view('client/template/main', $data);
    }

    public function single($p) {
        $data = array(
            "sidebar" => 'client/template/sidebar',
            "content" => 'client/single',
            "post" => $this->mPost->getPostById($p)
        );
        $this->load->view('client/template/main', $data);
    }

    public function contact() {
        $data = array(
            "sidebar" => 'client/template/sidebar2',
            "content" => 'client/contact'
        );
        $this->load->view('client/template/main', $data);
    }

    public function video() {
        $data = array(
            "content" => 'client/video'
        );
        $this->load->view('client/template/main', $data);
    }

    public function error404() {
        $data = array(
            "sidebar" => 'client/template/sidebar2',
            "content" => 'client/404'
        );
        $this->load->view('client/template/main', $data);
    }

    public function underconstruct() {
        $this->load->view('client/underconstruction');
    }

    public function youtube() {
        $data = array(
            "sidebar" => 'client/template/sidebar2',
            "content" => 'client/youtube'
        );
        $this->load->view('client/template/main', $data);
    }

    public function shortcodes() {
        $data = array(
            "content" => 'client/shortcodes'
        );
        $this->load->view('client/template/main', $data);
    }

    public function authors() {
        $data = array(
            "sidebar" => 'client/template/sidebar',
            "content" => 'client/authors'
        );
        $this->load->view('client/template/main', $data);
    }

}
