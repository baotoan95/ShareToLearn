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
        $this->load->model('MPost');
        $this->load->model('MCategory');
        $this->load->model('MComment');
    }

    public function index() {
        $data = array(
            "content" => "admin/statistic"
        );
        $this->session->set_userdata('count_discussion_unapproved', $this->MComment->countByStatus('pending'));
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
