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
        $this->load->model('mComment');
        $this->load->model('mUser');
    }

    public function index() {
        $this->load->library('pagination');
        $segment = $this->input->get('p');

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
        // GET list post order by date
        $result = $this->mPost->getPosts($condition, array('records' => $config['per_page'], 'begin' => $segment));
        $config['total_rows'] = $result['total'];

        // GET list post popular
        $condition = array(
            "order_by" => "p_view_count",
            "type" => 'post',
            "status" => 'public',
        );
        $populars = $this->mPost->getPosts($condition, array('records' => 10, 'begin' => 0));

        // GET list comment latest
        $lastest_comments = $this->mComment->getComments(array(), array('records' => 10, 'begin' => 0));

        // Init data to response client
        $data = array(
            "sidebar" => 'client/template/sidebar',
            "content" => 'client/index',
            "post_latest" => $result['posts'],
            "populars" => $populars['posts'],
            "latests" => $lastest_comments['comments'],
            "links" => pagination($config, $this->pagination) // Init pagination
        );

        $this->load->view('client/template/main', $data);
    }

    public function category() {
        $data = array(
            "sidebar" => 'client/template/sidebar',
            "content" => 'client/category'
        );
        $this->load->view('client/template/main', $data);
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

    public function single($id) {
        // GET list post popular
        $condition = array(
            "order_by" => "p_view_count",
            "type" => 'post',
            "status" => 'public',
        );
        $populars = $this->mPost->getPosts($condition, array('records' => 10, 'begin' => 0));

        // GET list comment latest
        $lastest_comments = $this->mComment->getComments(array(), array('records' => 10, 'begin' => 0));

        $data = array(
            "sidebar" => 'client/template/sidebar',
            "content" => 'client/single',
            "populars" => $populars['posts'],
            "latests" => $lastest_comments['comments'],
            "comments" => $this->generateCommentLevel($this->mComment->getCommentsByPostId($id), 0, 0),
            "post" => $this->mPost->getPostById($id, FALSE, TRUE) // GET post by id include tags itself
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
        // GET list post popular
        $condition = array(
            "order_by" => "p_view_count",
            "type" => 'post',
            "status" => 'public',
        );
        $populars = $this->mPost->getPosts($condition, array('records' => 10, 'begin' => 0));

        // GET list comment latest
        $lastest_comments = $this->mComment->getComments(array(), array('records' => 10, 'begin' => 0));
        
        $data = array(
            "title" => 'Danh Sách Tác Giả',
            "sidebar" => 'client/template/sidebar',
            "content" => 'client/authors',
            "populars" => $populars['posts'],
            "latests" => $lastest_comments['comments'],
            "users" => $this->mUser->getUsers(array("records" => 100, "begin" => 0), 'writer')['users']
        );
        $this->load->view('client/template/main', $data);
    }

}
