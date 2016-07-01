<?php

require_once 'Base_Model.php';

/**
 * Description of PostModel
 *
 * @author BaoToan
 */
class MPost extends Base_Model {

    public function __construct() {
        parent::__construct();
        $this->set_table('posts', 'p_id');
        $this->load->model('mTerm');
        $this->load->model('mTermRelationships');
        $this->load->model('mCategory');
        $this->load->model('mTag');
    }

    public function addPost($post) {
        // Add tags to DB if them is new
        $tags = $post->getTags();
        $this->mTag->addTags($tags, 'tag');
        // Add categories if them is new
        $categories = $post->getCategories();
        $this->mCategory->addCategories($categories, 'category');
        // Add post to DB
        $this->db->trans_start();
        $data = array(
            "p_title" => $post->getTitle(),
            "p_content" => $post->getContent(),
            "p_author" => $post->getAuthor(),
            "p_view_count" => $post->getViews(),
            "p_comment_count" => $post->getComments(),
            "p_excerpt" => $post->getExcerpt(),
            "p_catalogue" => $post->getCatalogue(),
            "p_status" => $post->getStatus(),
            "p_published" => $post->getPublished(),
            "p_guid" => $post->getGuid(),
            "p_comment_allow" => $post->getCmt_allow(),
            "p_type" => $post->getType(),
            "p_banner" => $post->getBanner(),
            "p_password" => $post->getPassword(),
            "p_menu_order" => $post->getOrder(),
            "p_parent" => $post->getParent()
        );
        $post_id = $this->insert($data);
        // Add tags for post
        if (!empty($tags)) {
            foreach ($tags as $tag) {
                $term = $this->mTerm->getTerm($tag->getName(), 'tag');
                $termRelationship = array(
                    "tr_object_id" => $post_id,
                    "tr_term_taxonomy_id" => $term['tt_id']
                );
                $this->mTermRelationships->addTermRelationship($termRelationship);
            }
        }
        // Add categories for post
        if (!empty($categories)) {
            foreach ($categories as $category) {
                $term = $this->mTerm->getTerm($category->getName(), 'category');
                $termRelationship = array(
                    "tr_object_id" => $post_id,
                    "tr_term_taxonomy_id" => $term['tt_id']
                );
                $this->mTermRelationships->addTermRelationship($termRelationship);
            }
        }
        $this->db->trans_complete();
        if($this->db->trans_status() == FALSE) {
            $this->db->trans_rollback();
            return FALSE;
        } else {
            $this->db->trans_commit();
            return TRUE;
        }
    }

    public function getPostById($id, $inc_cates = false, $inc_tags = false) {
        $postTemp = $this->getByKey($id);
        $post = new EPost();
        $post->setTitle($postTemp['p_title']);
        $post->setContent($postTemp['p_content']);
        $post->setAuthor($postTemp['p_author']);
        $post->setViews($postTemp['p_view_count']);
        $post->setComments($postTemp['p_comment_count']);
        $post->setExcerpt($postTemp['p_excerpt']);
        $post->setCatalogue($postTemp['p_catalogue']);
        $post->setStatus($postTemp['p_status']);
        $post->setPublished($postTemp['p_published']);
        $post->setGuid($postTemp['p_guid']);
        $post->setCmt_allow($postTemp['comment_allowed']);
        $post->setOrder($postTemp['p_menu_order']);
        $post->setType($postTemp['p_type']);
        $post->setBanner($postTemp['p_banner']);
        $post->setPassword($postTemp['p_password']);
        $post->setParent($postTemp['p_parent']);
        $post->setCategories();
        $post->setTags();
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
