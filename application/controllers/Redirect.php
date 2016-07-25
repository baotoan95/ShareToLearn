<?php

defined('BASEPATH') or exit('No derect script access allowed');

/**
 * Description of PostController
 *
 * @author BaoToan
 */
class Redirect extends MY_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('MTerm');
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
        
        $this->_data['listTitle'] = 'Latest';
        $this->_data['content'] = 'client/list-post';
        $this->load->view('client/main', $this->_data);
    }

    public function single($guid, $id) {
        // Init data to response client
        $this->createListPostsPopular();
        $this->createListCmtsLatest();
        $this->_data['comments'] = $this->MComment->generateCommentLevel($this->MComment->getCommentsByPostId($id), 0, 0);
        
        $post = NULL;
        if($id == 0) { // url: [guid].html
            // GET page
            $post = $this->MPost->getPostByGuid($guid, 'page', FALSE, FALSE);
        } else { // url: [guid]-[id].html
            // GET post include tags and categories itself
            $post = $this->MPost->getPostById($id, TRUE, TRUE);
        }
        // Check post is existed
        if(NULL == $post) {
            $this->_data['content'] = 'client/404';
            $this->load->view('client/main', $this->_data);
            return;
        }
        
        $this->_data['post'] = $post;
        $this->_data['title'] = $post->getTitle();
        $this->_data['content'] = 'client/single';
        if($guid == $post->getGuid()) {
            // Update view count
            $post->setViews($post->getViews() + 1);
            $post->setAuthor($post->getAuthor()->getId());
            $this->MPost->updatePost($post);
            
            $post->setAuthor($this->MUser->getUserById($post->getAuthor()));
            $this->load->view('client/main', $this->_data);
        } else {
            header('Location: ' . base_url() . $post->getGuid() . '-' . $id . '.html');
        }
    }

    public function contact() {
        $this->createListPostsPopular();
        $this->createListCmtsLatest();
        $this->_data['title'] = 'Liên hệ';
        $this->_data['content'] = 'client/contact';
        $this->_data['page'] = $this->MPost->getPostByGuid('lien-he', 'page');
        
        $this->load->view('client/main', $this->_data);
    }
    
    public function authors() {
        $this->createListPostsPopular();
        $this->createListCmtsLatest();
        $this->_data['title'] = 'Danh sách tác giả';
        $this->_data['content'] = 'client/authors';
        $this->_data['users'] = $this->MUser->getUsers(array("records" => 100, "begin" => 0), 'writer')['users'];
        $this->load->view('client/main', $this->_data);
    }
    
    public function search() {
        $this->load->library('pagination');
        
        $s = htmlentities($this->input->get('s'));
        $segment = intval(intval($this->input->get('p')));
        
        // Config pagination
        $config = array(
            "base_url" => base_url() . 'redirect',
            "prefix" => "search?s={$s}&p=",
            "per_page" => 10,
            "cur_page" => $segment
        );

        $condition = array(
            "type" => ["post", "page"],
            "status" => "public",
            "title" => $s
        );
        // GET list post order by date (latest)
        $result = $this->MPost->getPosts($condition, 
                array('records' => $config['per_page'], 'begin' => $segment));
        $config['total_rows'] = $result['total'];
        
        // Init pagination for post latest
        $this->createListPostsPopular();
        $this->createListCmtsLatest();
        $this->_data['title'] = 'Kết quả tìm kiếm';
        $this->_data['listTitle'] = "Kết quả cho \"$s\"";
        $this->_data['content'] = 'client/list-post';
        $this->_data['posts'] = $result['posts'];
        $this->_data['links'] = pagination($config, $this->pagination);
        
        $this->load->view('client/main', $this->_data);
    }
    
    /**
     * GET list post by category or tag
     * @param string $slug
     */
    public function category($cate, $slug) {
        $this->load->library('pagination');
        // Init data response to client
        $this->createListPostsPopular();
        $this->createListCmtsLatest();
        
        $segment = intval($this->input->get('p'));
        
        // GET termTaxonomy id (category or tag)
        $term = $this->MTerm->getTermBySlug($slug, htmlentities($cate));
        if(empty($term)) { // If not exist term taxonomy then error 404
            $this->_data['content'] = 'client/404';
            $this->load->view('client/main', $this->_data);
            return;
        }
        
        // Config pagination
        $config = array(
            "base_url" => base_url() . 'redirect',
            "prefix" => "category&p=",
            "per_page" => 10,
            "cur_page" => $segment
        );

        $condition = array(
            "type" => ["post", "page"],
            "status" => "public",
            "taxonomy" => $term['t_id']
        );
        // GET list post order by date (latest)
        $result = $this->MPost->getPosts($condition, array('records' => $config['per_page'], 'begin' => $segment));
        $config['total_rows'] = $result['total'];
        
        $this->_data['content'] = 'client/list-post';
        $this->_data['posts'] = $result['posts'];
        $this->_data['listTitle'] = $term['t_name'];
        $this->_data['links'] = pagination($config, $this->pagination);
        $this->_data['title'] = $term['t_name'];
        
        $this->load->view('client/main', $this->_data);
    }

}
