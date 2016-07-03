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
            return $post_id;
        }
    }
    
    public function getPosts($start, $record, $pagination = false) {
        
    }

    public function getPostById($id, $inc_cates = false, $inc_tags = false) {
        $postTemp = $this->getByKey($id);
        $post = new EPost();
        $post->setId($postTemp['p_id']);
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
        $post->setCmt_allow($postTemp['p_comment_allow']);
        $post->setOrder($postTemp['p_menu_order']);
        $post->setType($postTemp['p_type']);
        $post->setBanner($postTemp['p_banner']);
        $post->setPassword($postTemp['p_password']);
        $post->setParent($postTemp['p_parent']);
        // Set categories for post
        if($inc_cates) {
            $categories = array();
            $term_relates = $this->mTermRelationships
                    ->getTermRelationshipByObjectId($post->getId(), 'category');
            foreach($term_relates as $term_relate) {
                $category = new ECategory($term_relate['t_id'], $term_relate['t_name'], 
                        $term_relate['t_slug'], $term_relate['tt_desc'], $term_relate['tt_parent']);
                $categories[] = $category;
            }
            $post->setCategories($categories);
        }
        // Set tags for post
        if($inc_cates) {
            $tags = array();
            $term_relates = $this->mTermRelationships
                    ->getTermRelationshipByObjectId($post->getId(), 'tag');
            foreach($term_relates as $term_relate) {
                $tag = new ETag($term_relate['t_id'], $term_relate['t_name'], 
                        $term_relate['tt_desc'], $term_relate['t_slug']);
                $tags[] = $tag;
            }
            $post->setTags($tags);
        }
        return $post;
    }

    public function updatePost($post) {
        // Add tags to DB if them is new
        $tags = $post->getTags();
        $this->mTag->addTags($tags, 'tag');
        // Add categories if them is new
        $categories = $post->getCategories();
        $this->mCategory->addCategories($categories, 'category');
        
        // Update post
        $data = array(
            "p_id" => $post->getId(),
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
        $this->db->trans_start();
        $this->update($data);
        // Update tags and categories for post in term_relationships
        $this->mTermRelationships->deleteTermRelationshipByObjectId($post->getId());
        // Add tags for post
        if (!empty($tags = $post->getTags())) {
            foreach ($tags as $tag) {
                $term = $this->mTerm->getTerm($tag->getName(), 'tag');
                if(!empty($term)) {
                    $termRelationship = array(
                        "tr_object_id" => $post->getId(),
                        "tr_term_taxonomy_id" => $term['tt_id']
                    );
                    $this->mTermRelationships->addTermRelationship($termRelationship);
                }
            }
        }
        // Add categories for post
        if (!empty($categories = $post->getCategories())) {
            foreach ($categories as $category) {
                $term = $this->mTerm->getTerm($category->getName(), 'category');
                if(!empty($term)) {
                    $termRelationship = array(
                        "tr_object_id" => $post->getId(),
                        "tr_term_taxonomy_id" => $term['tt_id']
                    );
                    $this->mTermRelationships->addTermRelationship($termRelationship);
                }
            }
        }
        // Commit if process successful
        $this->db->trans_complete();
        if($this->db->trans_status() == FALSE) {
            $this->db->trans_rollback();
            return FALSE;
        } else {
            $this->db->trans_commit();
            return TRUE;
        }
    }

}
