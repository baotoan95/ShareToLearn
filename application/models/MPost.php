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
        
        $this->load->model('EPost');
        $this->load->model('ETag');
        
        $this->load->model('mTerm');
        $this->load->model('mTermRelationships');
        $this->load->model('mCategory');
        $this->load->model('mTag');
        $this->load->model('mUser');
    }

    public function addPost($post) {
        // Add tags to DB if them is new
        $tags = $post->getTags();
        $this->mTag->addTags($tags);
        
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
        if (!empty($post->getCategories())) {
            foreach ($post->getCategories() as $category) {
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

    public function getPostById($id, $inc_cates = FALSE, $inc_tags = TRUE) {
        $postTemp = $this->getByKey($id);
        $post = new EPost();
        $post->setId($postTemp['p_id']);
        $post->setTitle($postTemp['p_title']);
        $post->setContent($postTemp['p_content']);
        $post->setAuthor($this->mUser->getUserById($postTemp['p_author']));
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
        
        if($post->getType() == "page") {
            return $post;
        }
        
        // Set categories for post
        if($inc_cates) {
            $categories = array();
            $term_relates = $this->mTermRelationships
                    ->getTermRelationshipByObjectId($post->getId(), 'category');
            foreach($term_relates as $term_relate) {
                $category = new ECategory(intval($term_relate['t_id']), $term_relate['t_name'], 
                        $term_relate['t_slug'], $term_relate['tt_desc'], intval($term_relate['tt_parent']));
                $categories[] = $category;
            }
            $post->setCategories($categories);
        }
        // Set tags for post
        if($inc_tags) {
            $tags = array();
            $term_relates = $this->mTermRelationships
                    ->getTermRelationshipByObjectId($post->getId(), 'tag');
            foreach($term_relates as $term_relate) {
                $tag = new ETag(intval($term_relate['t_id']), $term_relate['t_name'], 
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
        $this->mTag->addTags($tags);
        
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
                if(!empty($category)) {
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
    
    /**
     * 
     * @param array $condition type and status are required (taxonomy, fromDate, title are optional)
     * @param array $limitConfig (records, begin)
     * @return array includes posts and total records before limit
     */
    public function getPosts($condition, $limitConfig) {
        $this->db->select('SQL_CALC_FOUND_ROWS p_id', FALSE);
        $this->db->from($this->_table['table_name']);
        // If specific taxonomy then join, else...
        if(array_key_exists('taxonomy', $condition) && $condition['taxonomy'] != '') {
            $this->db->join('term_relationships', 'tr_object_id = p_id');
            $this->db->join('term_taxonomy', 'tr_term_taxonomy_id = tt_id');
            $this->db->where('tt_term_id = ' . $condition['taxonomy']);
        }
        
        if(array_key_exists('fromDate', $condition) && $condition['fromDate'] != '') {
            $this->db->where('month(p_published) <= month("' . date_format(date_create($condition['fromDate']), 'y-m-d') . '")');
            $this->db->where('year(p_published) <= year("' . date_format(date_create($condition['fromDate']), 'y-m-d') . '")');
        }
        
        $this->db->where('p_type', $condition['type']);
        $this->db->where_in('p_status', $condition['status']);
        
        if(array_key_exists('title', $condition) && $condition['title'] != '') {
            $this->db->group_start();
            $this->db->like('p_title', $condition['title'], 'before');
            $this->db->or_like('p_title', $condition['title']);
            $this->db->or_like('p_title', $condition['title'], 'after');
            $this->db->group_end();
        }
        
        if(!array_key_exists('order_by', $condition) || $condition['order_by'] == '') {
            $this->db->order_by('p_published', 'DESC');
        } else {
            $this->db->order_by($condition['order_by'], 'DESC');
        }
        $this->db->limit($limitConfig['records'], $limitConfig['begin']);
        $postIds = $this->db->get()->result_array();
        $total = $this->db->query('select FOUND_ROWS() count')->row()->count;
        
        $posts = array();
        foreach($postIds as $postId) {
            $posts[] = $this->getPostById($postId['p_id'], TRUE, TRUE);
        }
        
        return array(
            "posts" => $posts,
            "total" => $total
        );
    }
    
    public function deletePost($post_id) {
        $this->db->trans_start();
        $this->delete($post_id);
        $this->mTermRelationships->deleteTermRelationshipByObjectId($post_id);
        $this->db->trans_complete();
        if($this->db->trans_status() == FALSE) {
            $this->db->trans_rollback();
            return FALSE;
        } else {
            $this->db->trans_commit();
            return TRUE;
        }
    }
    
    /**
     * Calc total of each post status type
     * @return array (list count post status type and last element is total of all)
     */
    public function countByStatus($type) {
        $this->db->select("p_status as name, count(p_status) as value");
        $this->db->where("p_type", $type);
        $this->db->group_by("p_status");
        $count = $this->db->get($this->_table['table_name'])->result_array();
        
        $total = 0;
        
        $result = array();
        foreach($count as $i) {
            $result[$i['name']] = $i['value'];
            $total += intval($i['value']);
        }
        $result['total'] = $total;
        return $result;
    }
    
    /**
     * @return array date of post group by month and year published
     */
    public function groupDateOfPosts() {
        $this->db->select("p_published");
        $this->db->group_by("month(p_published)");
        $this->db->group_by("year(p_published)");
        $this->db->order_by("p_published");
        $result = $this->db->get($this->_table['table_name'])->result_array();
        $dates = array();
        foreach($result as $date) {
            $dates[] = $date["p_published"];
        }
        return $dates;
    }
    
    /**
     * 
     * @param int $user_id
     * @return int number of posts made by user have id = $user_id
     */
    public function countPostByUserId($user_id) {
        $this->db->select("count(p_id) as count");
        $this->db->where("p_author", $user_id);
        return $this->db->get($this->_table['table_name'])->row_array()['count'];
    }

}
