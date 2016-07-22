<?php

/**
 * Description of Redirect2
 *
 * @author BaoToan
 */
class Redirect2 extends MY_Controller {
    public function __construct() {
        parent::__construct();
        $this->_data = array();
    }
    
    public function index() {
        $this->load->library('pagination');
        $segment = $this->input->get('p');
        // Config for pagination
        $config = array(
            "base_url" => base_url(),
            "prefix" => "redirect?p=",
            "per_page" => 20,
            "cur_page" => $segment
        );

        $condition = array(
            "type" => "post",
            "status" => "public"
        );
        // GET list post order by date (latest)
        $result = $this->MPost->getPosts($condition, array('records' => $config['per_page'], 'begin' => $segment));
        $config['total_rows'] = $result['total'];

        // Init data to response client
        $this->createListPostsPopular();
        $this->createListCmtsLatest();
        $this->_data['posts'] = $result['posts'];
        // Init pagination for post latest
        $this->_data['links'] = pagination($config, $this->pagination);
        
        $this->_data['listTitle'] = 'Bài viết mới nhất';
        $this->_data['content'] = 'client2/list-post';
        $this->load->view('client2/main', $this->_data);
    }
    
    public function single($guid, $id) {
        // Init data to response client
        $this->createListPostsPopular();
        $this->createListCmtsLatest();
        $this->_data['comments'] = $this->MComment->generateCommentLevel($this->MComment->getCommentsByPostId($id), 0, 0);
        
        // GET post include tags itself
        $post = NULL;
        if($id == 0) { // url: [guid].html
            $post = $this->MPost->getPostByGuid($guid, 'page', FALSE, TRUE);
        } else { // url: [guid]-[id].html
            $post = $this->MPost->getPostById($id, TRUE, TRUE);
        }
        // Check post is existed
        if(NULL == $post) {
            $this->_data['content'] = 'client/404';
            $this->load->view('client/template/main', $this->_data);
            return;
        }
        $this->_data['post'] = $post;
        $this->_data['title'] = $post->getTitle();
        $this->_data['nav'] = 'client2/nav-post';
        $this->_data['content'] = 'client2/single';
        if($guid == $post->getGuid()) {
            $this->load->view('client2/main', $this->_data);
        } else {
            header('Location: ' . base_url() . $post->getGuid() . '-' . $id . '.html');
        }
    }
}
