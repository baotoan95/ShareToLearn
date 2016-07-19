<?php

defined('BASEPATH') or exit('No derect script access allowed');

/**
 * Description of PostController
 *
 * @author BaoToan
 */
class Redirect extends My_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('mTerm');
    }

    public function index() {
        $this->load->library('pagination');
        $segment = $this->input->get('p');
        // Config for pagination
        $config = array(
            "base_url" => base_url(),
            "prefix" => "redirect?p=",
            "per_page" => 10,
            "cur_page" => $segment
        );

        $condition = array(
            "type" => "post",
            "status" => "public"
        );
        // GET list post order by date (latest)
        $result = $this->mPost->getPosts($condition, array('records' => $config['per_page'], 'begin' => $segment));
        $config['total_rows'] = $result['total'];

        // Init data to response client
        $this->createListPostsPopular();
        $this->createListCmtsLatest();
        $this->_data['boxTitle'] = "Bài Viết Mới";
        $this->_data['sidebar'] = 'client/template/sidebar';
        $this->_data['content'] = 'client/index';
        $this->_data['posts'] = $result['posts'];
        // Init pagination for post latest
        $this->_data['links'] = pagination($config, $this->pagination);

        $this->load->view('client/template/main', $this->_data);
    }

    public function single($guid, $id) {
        // Init data to response client
        $this->createListPostsPopular();
        $this->createListCmtsLatest();
        $this->_data['sidebar'] = 'client/template/sidebar';
        $this->_data['comments'] = $this->generateCommentLevel($this->mComment->getCommentsByPostId($id), 0, 0);
        
        // GET post include tags itself
        $post = NULL;
        if($id == 0) { // url: [guid].html
            $post = $this->mPost->getPostByGuid($guid, 'page', FALSE, TRUE);
        } else { // url: [guid]-[id].html
            $post = $this->mPost->getPostById($id, FALSE, TRUE);
        }
        // Check post is existed
        if(NULL == $post) {
            $this->_data['content'] = 'client/404';
            $this->load->view('client/template/main', $this->_data);
            return;
        }
        $this->_data['post'] = $post;
        $this->_data['title'] = $post->getTitle();
        $this->_data['content'] = 'client/single';
        if($guid == $post->getGuid()) {
            $this->load->view('client/template/main', $this->_data);
        } else {
            header('Location: ' . base_url() . $post->getGuid() . '-' . $id . '.html');
        }
    }

    public function contact() {
        $this->createListPostsPopular();
        $this->createListCmtsLatest();
        $this->_data['title'] = 'Liên hệ';
        $this->_data['sidebar'] = 'client/template/sidebar';
        $this->_data['content'] = 'client/contact';
        
        $this->load->view('client/template/main', $this->_data);
    }
    
    public function authors() {
        $this->createListPostsPopular();
        $this->createListCmtsLatest();
        $this->_data['title'] = 'Danh sách tác giả';
        $this->_data['sidebar'] = 'client/template/sidebar';
        $this->_data['content'] = 'client/authors';
        $this->_data['users'] = $this->mUser->getUsers(array("records" => 100, "begin" => 0), 'writer')['users'];
        $this->load->view('client/template/main', $this->_data);
    }
    
    public function search() {
        $this->load->library('pagination');
        
        $s = $this->input->get('s');
        $segment = intval($this->input->get('p'));
        
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
        $result = $this->mPost->getPosts($condition, 
                array('records' => $config['per_page'], 'begin' => $segment));
        $config['total_rows'] = $result['total'];
        
        // Init pagination for post latest
        $this->createListPostsPopular();
        $this->createListCmtsLatest();
        $this->_data['title'] = 'Kết quả tìm kiếm';
        $this->_data['boxTitle'] = "Kết quả cho \"$s\"";
        $this->_data['sidebar'] = 'client/template/sidebar';
        $this->_data['content'] = 'client/index';
        $this->_data['posts'] = $result['posts'];
        $this->_data['links'] = pagination($config, $this->pagination);
        
        $this->load->view('client/template/main', $this->_data);
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
        $this->_data['title'] = 'Kết quả tìm kiếm';
        $this->_data['sidebar'] = 'client/template/sidebar';
        
        $segment = intval($this->input->get('p'));
        
        // GET termTaxonomy id (category or tag)
        $term = $this->mTerm->getTermBySlug($slug, $cate);
        if(empty($term)) { // If not exist term taxonomy then error 404
            $this->_data['content'] = 'client/404';
            $this->load->view('client/template/main', $this->_data);
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
        $result = $this->mPost->getPosts($condition, array('records' => $config['per_page'], 'begin' => $segment));
        $config['total_rows'] = $result['total'];
        
        $this->_data['content'] = 'client/index';
        $this->_data['posts'] = $result['posts'];
        $this->_data['boxTitle'] = $term['t_name'];
        $this->_data['links'] = pagination($config, $this->pagination);
        
        $this->load->view('client/template/main', $this->_data);
    }

    private function generateCommentLevel($comments, $parentId, $level, $html = '') {
        // Create a temp list
        $cmtTemps = $comments;
        // GET list sub comment by parentId search in comments list
        $subCmts = array();
        for ($i = 0; $i < count($cmtTemps); $i ++) {
            // If found: remove it from $comments and add to subCmts
            if ($comments[$i]->getParent() == $parentId) {
                unset($comments[$i]);
                $subCmts[] = $cmtTemps[$i];
            }
        }
        $comments = array_values($comments);
        
        // Add list sub comment to html and recursive
        if(empty($subCmts)) {
            return "";
        } else {
            $html = ($parentId == 0 ? "" : '<ul class = "children">');
            foreach ($subCmts as $cmt) {
                if($cmt->getParent() == 0) {
                    $level = 0;
                }
                $html .=
                            '<li id="cmt_'. $cmt->getId() .'" class="depth-' . $level .'">' .
                                '<div class="author-avatar"><img alt="" src ="'.base_url().'assets/client/images/avatar.jpg"/></div>' .
                                '<div class="comment-author"><a>' . $cmt->getAuthor() . '</a></div>' .
                                '<div class="comment-date">' . $cmt->getDate() . '</div>' .
                                '<div class="comment-text"><p>' . $cmt->getContent() . '</p></div>' .
                                '<div class="comment-reply"><a class="comment-reply-link" rel="nofollow" href="' . $cmt->getId() . '">reply</a></div>' .
                                $this->generateCommentLevel($comments, $cmt->getId(), ++$level, $html) .
                            '</li>';
                $level--;
            }
            return $html .= ($parentId == 0 ? "" : "</ul>");
        }
    }

}
