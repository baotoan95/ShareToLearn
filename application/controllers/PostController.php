<?php

/**
 * Description of PostController
 *
 * @author BaoToan
 */
class PostController extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('postModel');
    }

    public function index() {
        echo $this->postModel->countPosts();
    }

}
