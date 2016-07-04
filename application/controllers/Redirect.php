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
        $data = array(
            // Set views
            "sidebar" => 'client/template/sidebar',
            "content" => 'client/index'
        );
        $data['post_latest'] = $this->mPost->getPosts('public', array('records' => 20, 'begin' => 0));
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
