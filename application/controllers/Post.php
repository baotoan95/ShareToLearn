<?php

/**
 * Description of PostController
 *
 * @author BaoToan
 */
class Post extends CI_Controller {

    public function __construct() {
        parent::__construct();
        // Import class
        $this->load->model('ETag');
        $this->load->model('EPost');
        // Load model class
        $this->load->model('MPost');
        $this->load->model('MCategory');
    }

    // util functions
    private function initPostView() {
        $categoriesParentBox = $this->MCategory->getCategoriesParentBox(0);
        $data = array(
            "content" => "admin/post",
            "categoriesParentBox" => $categoriesParentBox
        );
        return $data;
    }
    private function getCategoriesBox($parentId, $categoriesNeedChecked) {
        $categories = $this->MCategory->getCategoriesByParent($parentId, 'category');
        // If not have any child return "" (it is condition to stop recursive)
        if ($categories) {
            $html = "<ul>";
            foreach ($categories as $category) {
                $html .= "<li id='cate_" . $category->getId() . "'>" .
                            "<div class='checkbox'>" .
                            "<label>" .
                            "<input type='checkbox' " . 
                        (is_contain($categoriesNeedChecked, $category) ? "checked" : "sfdf")
                        . " name='categories[]' value='" .
                            $category->getId() . "'>" . $category->getName() .
                            "</label>" .
                            "</div>" . $this->getCategoriesBox($category->getId(), $categoriesNeedChecked) .
                        "</li>";
            }
            return $html .= "</ul>";
        }
        return "";
    }
    private function upload_image($image, $dis, $config = array()) {
        $config["upload_path"] = $dis;
        $config["allowed_types"] = "gif|png|jpg|jpeg";
        $config["max_size"] = "900";
        $this->load->library("upload", $config);
        if (!$this->upload->do_upload($image)) {
            echo $this->upload->display_errors();
            return FALSE;
        } else {
            return $this->upload->data()["file_name"];
        }
    }
    
    // End util functions

    public function newPost() {
        $data = $this->initPostView();
        $data["title"] = "Add post";
        $data['action'] = "addpost";
        $data['categories'] = $this->getCategoriesBox(0, array());
        $type = $this->input->get('type', TRUE);
        $data['type'] = (isset($type) && $type != "post") ? "page" : "post";
        $this->load->view('admin/template/main', $data);
    }

    public function addPost() {
        // Validation form
        $this->form_validation->set_rules('title', 'Title', 'required');
        // Data default when error occur
        $data = $this->initPostView();
        $data["title"] = "Add post";
        $data["action"] = "addpost";
        $data['categories'] = $this->getCategoriesBox(0, array());
        $data['type'] = $this->input->post('type');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('admin/template/main', $data);
            return;
        }

        // Upload avatar
        $config["file_name"] = $this->input->post('guid') . time();
        $avatar = $this->upload_image('avatar', './assets/upload/images', $config);
        if (!$avatar) { // Upload fail
            $this->session->set_flashdata('flash_error', 'Ops! please chose a picture with condition below'
                    . '<br/>Condition:'
                    . '<ul>'
                    . '<li>Extension: png/jpg/gif</li>'
                    . '<li>Quantity: not too 900kb</li>'
                    . '</ul>');
            $this->load->view('admin/template/main', $data);
            return;
        }

        // Refine data
        $tags = array();
        if (!empty($tag_names = $this->input->post('tags'))) {
            foreach ($tag_names as $tag_name) {
                $tags[] = new ETag(0, $tag_name, $tag_name, convert_vi_to_en($tag_name, TRUE));
            }
        }

        $categories = array();
        if (!empty($category_ids = $this->input->post('categories'))) {
            foreach ($category_ids as $id) {
                $categories[] = $this->MCategory->getCategoryById($id);
            }
        }

        $visibility = $this->input->post('visibility');

        // Create a new post and add it to DB
        $post = new EPost();
        $post->setTitle($this->input->post('title'));
        $post->setContent($this->input->post('content'));
        $post->setAuthor($this->session->userdata['cur_user']['id']);
        $post->setViews(0);
        $post->setComments(0);
        $post->setExcerpt($this->input->post('excerpt'));
        $post->setCatalogue($this->input->post('catalogue'));
        // set status for post
        $post->setStatus($this->input->post('status'));
        if ($this->input->post('status') == 'draf') {
            $post->setStatus($this->input->post('status'));
        }
        $post->setPublished(date('Y-m-d H:i:s'));
        $post->setGuid($this->input->post('guid'));
        $post->setCmt_allow(empty($this->input->post('comment_allowed')) ? FALSE : TRUE);
        $post->setOrder(0);
        $post->setType($this->input->post('type'));
        $post->setBanner($avatar);
        $post->setPassword($this->input->post('password'));
        $post->setParent(0);
        $post->setCategories($categories);
        $post->setTags($tags);
        $post_id = $this->MPost->addPost($post);
        if ($post_id) {
            $this->session->set_flashdata("flash_message", "Added: " . $post->getTitle()
                    . " | <a href='" . base_url() . "post/view/" . $post->getGuid() . "'>Xem</a>");
        } else {
            $this->session->set_flashdata("flash_error", "Duplicate: " . $post->getTitle()
                    . " | <a href='" . base_url() . "post/view/" . $post->getGuid() . "'>Xem</a>");
        }
        // When add success then redirect to update page
        header('Location: ' . base_url() . 'post/edit/' . $post_id, TRUE, 301);
    }
    
    public function posts() {
        $this->load->library("pagination");

        // Init data receive from client
        $type = $this->input->get('type', TRUE);
        if(!isset($type) || $type != 'page') {
            $type = "post";
        }
        
        $segment = trim($this->input->get('p', TRUE));
        $page = isset($segment) ? $segment : 0;

        $status = trim($this->input->get('status', TRUE));
        if (!isset($status) || $status == 'all' || $status == '') {
            $status = array("public", "draf", "pending", "private");
        }
        $date = trim($this->input->get('date', TRUE));

        $category = trim($this->input->get('category', TRUE));
        $tag = trim($this->input->get('tag', TRUE));
        if (!isset($category)) {
            $category = '';
        }
        if(isset($tag) && strlen(trim($tag)) > 0) {
            $category = $tag;
        }

        $search = trim($this->input->get('search', TRUE));

        // Get list count by status
        $count = $this->MPost->countByStatus($type);

        // Config for pagination
        $config["base_url"] = base_url() . "post";
        $config["prefix"] = "posts?status=" . (is_array($status) ? "all" : $status) .
                "&category=$category&date=$date&search=$search&p=";
        $config["per_page"] = 20;
        $config["cur_page"] = $segment;

        // GET data response client
        $condition = array(
            "type" => $type,
            "status" => $status,
            "taxonomy" => $category,
            "fromDate" => $date,
            "title" => $search
        );
        $result = $this->MPost->getPosts($condition, array('records' => $config['per_page'], 'begin' => $page));
        $config["total_rows"] = $result['total'];

        // Call pagination helper to make links
        $pagination = pagination($config, $this->pagination);
        $data = array(
            "title" => $type == 'post' ? "Posts" : "Pages",
            "content" => "admin/posts",
            "posts" => $result['posts'],
            "links" => $pagination,
            "count" => $count,
            "dates" => $this->MPost->groupDateOfPosts(),
            "categories" => $this->MCategory->getCategoriesParentBox(0, "", array(intval($category))),
            "status" => (is_array($status) ? "all" : $status),
            "totalResult" => $result['total'],
            "type" => $type
        );

        $this->load->view('admin/template/main', $data);
    }

    public function edit($k) {
        $data = $this->initPostView();
        $data['post'] = ($post = $this->MPost->getPostById($k, TRUE, TRUE));
        $data['title'] = "Update post";
        $data['action'] = "update";
        $categoriesNeedChecked = $post->getCategories();
        $data['categories'] = $this->getCategoriesBox(0, $categoriesNeedChecked);
        $this->load->view('admin/template/main', $data);
    }

    public function update() {
        
        // Validation form
        $this->form_validation->set_rules('title', 'Title', 'required');

        $data = $this->initPostView();
        $data["title"] = "Add post";
        $data['action'] = "update";
        $data['categories'] = $this->getCategoriesBox(0, array());

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('admin/template/main', $data);
            return;
        }
        
        // Refine data
        $tags = array();
        if (!empty($tag_names = $this->input->post('tags'))) {
            foreach ($tag_names as $tag_name) {
                $tags[] = new ETag(0, $tag_name, $tag_name, convert_vi_to_en($tag_name, TRUE));
            }
        }
        $categories = array();
        if (!empty($category_ids = $this->input->post('categories'))) {
            foreach ($category_ids as $id) {
                $categories[] = $this->MCategory->getCategoryById($id);
            }
        }

        // Create a new instance for old post
        $post = new EPost();
        $post->setId($this->input->post('id'));
        $post->setTitle($this->input->post('title'));
        $post->setContent($this->input->post('content'));
        $post->setAuthor(1);
        $post->setViews(0);
        $post->setComments(0);
        $post->setExcerpt($this->input->post('excerpt'));
        $post->setCatalogue($this->input->post('catalogue'));
        $post->setPublished(date('Y-m-d H:i:s'));
        $post->setGuid($this->input->post('guid'));
        $post->setCmt_allow(empty($this->input->post('comment_allowed')) ? FALSE : TRUE);
        $post->setOrder(0);
        $post->setType($this->input->post('type'));
        // When have request change avatar then update it
        if ($_FILES['avatar']['error'] == 0) {
            // Upload avatar
            $config["file_name"] = $this->input->post('guid') . time();
            $avatar = $this->upload_image('avatar', './assets/upload/images', $config);
            if (!$avatar) { // Upload fail
                $this->session->set_flashdata('flash_error', 'Ops! please chose a picture with condition below'
                    . '<br/>Condition:'
                    . '<ul>'
                    . '<li>Extension: png/jpg/gif</li>'
                    . '<li>Quantity: not too 900kb</li>'
                    . '</ul>');
                $this->load->view('admin/template/main', $data);
                return;
            }
            $post->setBanner($avatar);
        } else {
            // If not have request to change avatar then set default for it
            $post->setBanner($this->MPost->getPostById($post->getId())->getBanner());
        }
        // set status for post
        $post->setStatus($this->input->post('status'));
//        if ($this->input->post('status') == 'draf') {
//            $post->setStatus($this->input->post('status'));
//        }
        
        // Set password
        $visibility = $this->input->post('visibility');
        $password = $this->input->post('password');
        if($visibility != 'protected' && ($post->getStatus() == 'public' || $post->getStatus() == 'private')) {
            $password = '';
        }
        $post->setPassword($password);
        
        $post->setParent(0);
        $post->setCategories($categories);
        $post->setTags($tags);
        

        // Update post
        if ($this->MPost->updatePost($post)) {
            $this->session->set_flashdata('flash_message', 'Update successful');
        } else {
            $this->session->set_flashdata('flash_error', 'Update fail');
        }

        // When update success redirect to itself
        header('Location: ' . base_url() . 'post/edit/' . $post->getId(), TRUE, 301);
    }
    
    public function deletePost() {
        $post_id = $this->input->post('id');
        if($this->MPost->deletePost($post_id)) {
            echo "success";
        } else {
            echo "failure";
        }
    }
    
    public function searchPostsAjax() {
        $name = $this->input->post('name');
        $type = $this->input->post('type');
        $condition = array(
            "type" => $type,
            "status" => "public"
        );
        if($name != '') {$condition['title'] = $name;}
        echo json_encode($this->MPost->getPosts($condition)['posts']);
    }
    
    public function getPostsAjax() {
        $pageIds = $this->input->post('pageIds');
        $type = $this->input->post('type');
        
        if(empty($pageIds)) {
            return;
        }
        
        $condition = array(
            "type" => $type,
            "status" => "public",
            "ids" => $pageIds
        );
        echo json_encode($this->MPost->getPosts($condition)['posts']);
    }
    
    public function addLink() {
        $name = $this->input->post('name');
        $link = $this->input->post('link');
        
        $post = new EPost();
        $post->setTitle($name);
        $post->setGuid($link);
        $post->setType('navigation');
        $post->setStatus('public');
        $post->setPublished(date('Y-m-d H:i:s'));
        
        $post_id = $this->MPost->addPost($post);
        if($post_id) {
            echo $post_id;
        } else {
            echo "failure";
        }
    }

}
