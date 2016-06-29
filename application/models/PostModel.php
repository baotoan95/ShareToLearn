<?php

require_once 'BaseModel.php';

/**
 * Description of PostModel
 *
 * @author BaoToan
 */
class PostModel extends BaseModel {

    public function __construct() {
        parent::__construct();
        $this->set_table('posts', 'p_id');
    }

    public function addPost($post, $categories, $tags) {
        return $this->insert($post);
    }

    public function getPostById($id) {
        return $this->getByKey($id);
    }
    
    public function getPosts() {
        return $this->getAll();
    }
    
    public function deletePostById($id) {
        return $this->delete($id);
    }
    
    public function countPosts($condition = array()) {
        return $this->count($condition);
    }

}
