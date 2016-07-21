<?php

/**
 * Description of Error
 *
 * @author BaoToan
 */
class Error extends MY_Controller {
    public function __construct() {
        parent::__construct();
    }
    public function index() {
        // Init data to response client
        $this->createListPostsPopular();
        $this->createListCmtsLatest();
        $this->_data['title'] = 'Page not found';
        $this->_data['sidebar'] = 'client/template/sidebar';
        $this->_data['content'] = 'client/404';
       
        $this->load->view('client/template/main', $this->_data);
    }
}
