<?php

/**
 * Description of PostController
 *
 * @author BaoToan
 */
class Post extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('mPost');
        $this->load->model('mCategory');
    }
    // util functions
    private function initPostView() {
        $categories = $this->mCategory->getCategories();
        $data = array(
            "content" => "admin/post",
            "categories" => $categories,
        );
        return $data;
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
        
        // Refine data
        $tags = array();
        if(!empty(get_data_by_post('tags'))) {
            $tags = explode(',', $this->post('tags'));
        }
        $categories = get_data_by_post('categories');
        $visibility = get_data_by_post('visibility');
        
        // Create a new post and add it to DB
        $post = array(
            "p_title" => get_data_by_post('title'),
            "p_content" => get_data_by_post('content'),
            "p_author" => 1,
            "p_view_count" => 0,
            "p_comment_count" => 0,
            "p_excerpt" => get_data_by_post('excerpt'),
            "p_catalogue" => get_data_by_post('catalogue'),
            "p_status" => get_data_by_post('status'),
            "p_published" => date('yyyy-MM-dd HH:mm:ss'),
            "p_guid" => get_data_by_post('guid'),
            "p_comment_allow" => empty(get_data_by_post('comment_allowed')) ? false : true,
            "p_type" => "post",
            "p_banner" => "assets/upload/images/Koala.jpg",
            "p_password" => get_data_by_post('password')
        );
        $this->mPost->addPost($post, $tags, $categories);
        
        $this->load->view('admin/template/main', $data);
    }

}
