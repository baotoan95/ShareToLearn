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

    public function comments() {
        $data = array(
            "content" => "admin/comments"
        );
        $this->load->view('admin/template/main', $data);
    }

    public function profile() {
        $data = array(
            "content" => "admin/user"
        );
        $this->load->view('admin/template/main', $data);
    }
    
    public function setting() {
        $data = array(
            "content" => "admin/setting"
        );
        $this->load->view('admin/template/main', $data);
    }

}

?>
