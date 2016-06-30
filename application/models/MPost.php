<?php

require_once 'BaseModel.php';

/**
 * Description of PostModel
 *
 * @author BaoToan
 */
class MPost extends BaseModel {

    public function __construct() {
        parent::__construct();
        $this->set_table('posts', 'p_id');
        $this->load->model('mTerm');
        $this->load->model('mTermRelationships');
    }

    public function addPost($post, $tags = array(), $categories = array()) {
        // Add tags to DB if them is new
        $this->mTerm->addTerms($tags, 'tag');
        // Add categories if them is new
        $this->mTerm->addTerms($categories, 'category');
        // Add post to DB
        $post_id = $this->insert($post);
        // Add tags for post
        if(!empty($tags)) {
            for($i = 0; $i < count($tags); $i++) {
                $term = $this->mTerm->getTerm($tags[$i], 'tag');
                $termRelationship = array( 
                    "tr_object_id" => $post_id,
                    "tr_term_taxonomy_id" => $term['t_id']
                );
                $this->mTermRelationships->addTermRelationship($termRelationship);
            }
        }
        
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
