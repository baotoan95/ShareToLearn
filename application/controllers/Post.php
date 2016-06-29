<?php

/**
 * Description of PostController
 *
 * @author BaoToan
 */
class Post extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('postModel');
        $this->load->model('tagModel');
    }
    // util functions
    private function initPostView() {
        $categories = array(
            "1" => "Học lập trình",
            "2" => "Linh tinh",
            "3" => "Giải trí"
        );
        $data = array(
            "content" => "admin/post",
            "categories" => $categories,
        );
        return $data;
    }
    
    private function post($field_name) {
        return $this->input->post($field_name);
    }
    // End util functions

    public function newPost() {
        $data = $this->initPostView();
        $data["title"] = "Thêm bài viết mới";
        $this->load->view('admin/template/main', $data);
    }
    
    public function addPost() {
        // Validation form
        $this->form_validation->set_rules('title', 'Tiêu đề', 'required');
        $this->form_validation->set_rules('content', 'Nội dung', 'required');
        
        $data = $this->initPostView();
        $data["title"] = "Thêm bài viết mới";
        
        if($this->form_validation->run() == FALSE) {
            $this->load->view('admin/template/main', $data);
            return;
        }
        
        // Add tags if it is new
        $tags = explode(',', $this->post('tags'));
        $this->tagModel->addTags($tags);
        
        // Create a new post
        $post = array(
            "p_title" => $this->input->post('title'),
            "p_content" => $this->post('content'),
            "p_author" => 1,
            "p_view_count" => 0,
            "p_comment_count" => 0,
            "p_excerpt" => $this->post('excerpt'),
            "p_catalogue" => $this->post('catalogue'),
            "p_status" => $this->post('status'),
            "p_published" => date('yyyy-MM-dd HH:mm:ss'),
            "p_guid" => $this->post('guid'),
            "p_comment_allow" => empty($this->post('comment_allowed')) ? false : true,
            "p_type" => "post",
            "p_banner" => "assets/upload/images/Koala.jpg",
            "p_password" => $this->post('password')
        );
        $this->postModel->addPost($post);
        
        // Add tags for post
        for($i = 0; $i < count($tags); $i++) {
            
        }
        
        $categories = $this->post('categories');
        $visibility = $this->post('visibility');
        
        $this->load->view('admin/template/main', $data);
    }

}
