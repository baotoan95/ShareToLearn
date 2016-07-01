<?php

/**
 * Description of PostController
 *
 * @author BaoToan
 */
class Post extends CI_Controller {

    public function __construct() {
        parent::__construct();
        // import class
        $this->load->model('ETag');
        $this->load->model('EPost');
        // Load model class
        $this->load->model('mPost');
        $this->load->model('mCategory');
    }

    public function edit($k) {
        $data = $this->initPostView();
        $data['post'] = ($post = $this->mPost->getPostById($k, TRUE, TRUE));
        $data['title'] = "Cập nhật bài viết";
        $data['action'] = "update";
        $this->load->view('admin/template/main', $data);
    }
    
    public function update() {
        // Validation form
        $this->form_validation->set_rules('title', 'Tiêu đề', 'required');
        $this->form_validation->set_rules('content', 'Nội dung', 'required');

        $data = $this->initPostView();
        $data["title"] = "Thêm bài viết mới";

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('admin/template/main', $data);
            return;
        }

        // Refine data
        $tags = array();
        if (!empty($this->input->post('tags'))) {
            $tag_names = explode(',', $this->input->post('tags'));
            foreach ($tag_names as $tag_name) {
                $tags[] = new ETag(0, $tag_name, $tag_name, convert_vi_to_en($tag_name, TRUE));
            }
        }

        $categories = array();
        if (!empty($category_ids = $this->input->post('categories'))) {
            foreach ($category_ids as $id) {
                $categories[] = $this->mCategory->getCategoryById($id);
            }
        }
        
        // Create a new instance for old post
        $post = new EPost();
        $post->setTitle($this->input->post('title'));
        $post->setContent($this->input->post('content'));
        $post->setAuthor(1);
        $post->setViews(0);
        $post->setComments(0);
        $post->setExcerpt($this->input->post('excerpt'));
        $post->setCatalogue($this->input->post('catalogue'));
        $post->setPublished(date('yyyy-MM-dd HH:mm:ss'));
        $post->setGuid($this->input->post('guid'));
        $post->setCmt_allow(empty($this->input->post('comment_allowed')) ? FALSE : TRUE);
        $post->setOrder(0);
        $post->setType('post');
        $post->setBanner('assets/upload/images/Koala.jpg');
        $post->setPassword($this->input->post('password'));
        $post->setParent(0);
        $post->setCategories($categories);
        $post->setTags($tags);
        // set status for post
        $post->setStatus($this->input->post('status'));
        if ($this->input->post('status') == 'draf') {
            $post->setStatus($this->input->post('status'));
        }
        
        $this->mPost->updatePost($post);
        
        var_dump($post);
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
        $data['action'] = "addpost";
        $this->load->view('admin/template/main', $data);
    }

    public function addPost() {
        // Validation form
        $this->form_validation->set_rules('title', 'Tiêu đề', 'required');
        $this->form_validation->set_rules('content', 'Nội dung', 'required');

        $data = $this->initPostView();
        $data["title"] = "Thêm bài viết mới";

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('admin/template/main', $data);
            return;
        }

        // Refine data
        $tags = array();
        if (!empty($this->input->post('tags'))) {
            $tag_names = explode(',', $this->input->post('tags'));
            foreach ($tag_names as $tag_name) {
                $tags[] = new ETag(0, $tag_name, $tag_name, convert_vi_to_en($tag_name, TRUE));
            }
        }

        $categories = array();
        if (!empty($category_ids = $this->input->post('categories'))) {
            foreach ($category_ids as $id) {
                $categories[] = $this->mCategory->getCategoryById($id);
            }
        }

        $visibility = $this->input->post('visibility');

        // Create a new post and add it to DB
        $post = new EPost();
        $post->setTitle($this->input->post('title'));
        $post->setContent($this->input->post('content'));
        $post->setAuthor(1);
        $post->setViews(0);
        $post->setComments(0);
        $post->setExcerpt($this->input->post('excerpt'));
        $post->setCatalogue($this->input->post('catalogue'));
        // set status for post
        $post->setStatus($this->input->post('status'));
        if ($this->input->post('status') == 'draf') {
            $post->setStatus($this->input->post('status'));
        }
        $post->setPublished(date('yyyy-MM-dd HH:mm:ss'));
        $post->setGuid($this->input->post('guid'));
        $post->setCmt_allow(empty($this->input->post('comment_allowed')) ? FALSE : TRUE);
        $post->setOrder(0);
        $post->setType('post');
        $post->setBanner('assets/upload/images/Koala.jpg');
        $post->setPassword($this->input->post('password'));
        $post->setParent(0);
        $post->setCategories($categories);
        $post->setTags($tags);

        if ($this->mPost->addPost($post)) {
            $this->session->set_flashdata("flash_message", "Đã thêm bài viết: " . $post->getTitle()
                    . " | <a href='" . base_url() . "post/view/" . $post->getGuid() . "'>Xem</a>");
        } else {
            $this->session->set_flashdata("flash_error", "Bài viết bị trùng: " . $post->getTitle()
                    . " | <a href='" . base_url() . "post/view/" . $post->getGuid() . "'>Xem</a>");
        }

        // Restore data to view
        $data['post'] = $post;
        $this->load->view('admin/template/main', $data);
    }

}
