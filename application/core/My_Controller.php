<?php

/**
 * Description of Base_Client_Controller
 *
 * @author BaoToan
 */
class My_Controller extends CI_Controller {
    protected $_data;
    
    public function __construct() {
        parent::__construct();
        $this->load->model('mPost');
        $this->load->model('mComment');
        $this->load->model('mUser');
        $this->load->model('mMenu');
        
        $this->_data = array(
            "menu" => $this->mMenu->generateMenu($this->mMenu->getMenus(), array("tag_name"=>"a", "tag_container_name" => "ul"))
        );
    }
    
    
}
