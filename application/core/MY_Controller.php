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
        $this->load->model('MPost');
        $this->load->model('MComment');
        $this->load->model('MUser');
        $this->load->model('MMenu');
        
        $this->_data = array(
            "menu" => $this->MMenu->generateMenu($this->MMenu->getMenu(), array("tag_name"=>"a", "tag_container_name" => "ul"))
        );
    }
    
    public function createListPostsPopular() {
        // GET list post popular
        $condition = array(
            "order_by" => "p_view_count",
            "type" => 'post',
            "status" => 'public',
        );
        $this->_data['populars'] = $this->MPost->getPosts($condition, 
                array('records' => 10, 'begin' => 0))['posts'];
    }
    
    protected function createListCmtsLatest() {
        // GET list comment latest
        $condition = array(
            "type" => "comment"
        );
        $this->_data['cmt_latests'] = $this->MComment->getComments($condition, 
                array('records' => 10, 'begin' => 0))['comments'];
    }
    
    
}
