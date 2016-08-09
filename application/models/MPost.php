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
        
        $this->load->model('MTerm');
        $this->load->model('MTermTaxonomy');
        $this->load->model('MTermRelationships');
        $this->load->model('MCategory');
        $this->load->model('MTag');
        $this->load->model('MComment');
        $this->load->model('MUser');
    }

    /**
     * 
     * @param object $post
     * @return boolean postId or FALSE if not success
     */
    public function addPost($post) {
        // Add tags to DB if them is new
        $tags = $post->getTags();
        $this->MTag->addTags($tags);
        
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
            "p_comment_allow" => $post->getCmt_allow(),
            "p_type" => $post->getType(),
            "p_banner" => $post->getBanner(),
            "p_password" => $post->getPassword(),
            "p_menu_order" => $post->getOrder(),
            "p_parent" => $post->getParent(),
            "p_youtube_url" => $post->getYoutube(),
            "p_cue" => $post->getCue()
        );
        // Avoid duplicate slug
        $data['p_guid'] = $post->getGuid() . $this->checkDuplicateGuid($post->getGuid());
        $post_id = $this->insert($data);
        
        // Add tags for post (not for page and navigation)
        if ($post->getType() == 'post' && !empty($tags)) {
            foreach ($tags as $tag) {
                $term = $this->MTerm->getTerm($tag->getName(), 'tag');
                $termRelationship = array(
                    "tr_object_id" => $post_id,
                    "tr_term_taxonomy_id" => $term['tt_id']
                );
                $this->MTermRelationships->addTermRelationship($termRelationship);
                // Increase count for tag
                $this->MTermTaxonomy->adjustCount($term['t_id'], '+');
            }
        }
        
        // Add categories for post (not for page and navigation)
        if ($post->getType() == 'post' && !empty($post->getCategories())) {
            foreach ($post->getCategories() as $category) {
                $term = $this->MTerm->getTerm($category->getName(), 'category');
                $termRelationship = array(
                    "tr_object_id" => $post_id,
                    "tr_term_taxonomy_id" => $term['tt_id']
                );
                $this->MTermRelationships->addTermRelationship($termRelationship);
                // Increase count for category
                $this->MTermTaxonomy->adjustCount($term['t_id'], '+');
            }
        }
        $this->db->trans_complete();
        if($this->db->trans_status() == FALSE) {
            $this->db->trans_rollback();
            return FALSE;
        } else {
            $this->db->trans_commit();
            return intval($post_id);
        }
    }
    
    /*
     * @param string guid of post
     * @return string
     */
    private function checkDuplicateGuid($guid) {
        $this->db->select('count(p_id) as count');
        $count = $this->db->get_where($this->_table['table_name'], 
                array('p_guid' => $guid))->row()->count;
        if($count > 0) {
            $this->db->select("count(p_id) as count");
            $count = $this->db->get_where($this->_table['table_name'], 
                    array('p_guid like' => "$guid-%"))->row()->count;
            return "-i" . (++$count);
        } else {
            return "";
        }
    }
    
    private function createAPost($postTemp, $inc_cates = FALSE, $inc_tags = TRUE) {
        if(empty($postTemp)) {
            return NULL;
        }
        $post = new EPost();
        $post->setId($postTemp['p_id']);
        $post->setTitle($postTemp['p_title']);
        $post->setContent($postTemp['p_content']);
        $post->setAuthor($this->MUser->getUserById($postTemp['p_author']));
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
        $post->setYoutube($postTemp['p_youtube_url']);
        $post->setCue($postTemp['p_cue']);
        
        if($post->getType() == "page") {
            return $post;
        }
        
        // Set categories for post
        if($inc_cates) {
            $categories = array();
            $term_relates = $this->MTermRelationships
                    ->getTermRelationshipByObjectId($post->getId(), 'category');
            foreach($term_relates as $term_relate) {
                $category = new ECategory(intval($term_relate['t_id']), $term_relate['t_name'], 
                        $term_relate['t_slug'], $term_relate['tt_desc'], intval($term_relate['tt_parent']),
                        intval($term_relate['tt_count']));
                $categories[] = $category;
            }
            $post->setCategories($categories);
        }
        // Set tags for post
        if($inc_tags) {
            $tags = array();
            $term_relates = $this->MTermRelationships
                    ->getTermRelationshipByObjectId($post->getId(), 'tag');
            foreach($term_relates as $term_relate) {
                $tag = new ETag(intval($term_relate['t_id']), $term_relate['t_name'], 
                        $term_relate['tt_desc'], $term_relate['t_slug'], intval($term_relate['tt_count']));
                $tags[] = $tag;
            }
            $post->setTags($tags);
        }
        return $post;
    }
    
    public function getPostByGuid($guid, $type, $inc_cates = FALSE, $inc_tags = TRUE) {
        $this->db->where('p_guid', $guid);
        $this->db->where('p_type', $type);
        $postTemp = $this->db->get($this->_table['table_name'])->row_array();
        return $this->createAPost($postTemp, $inc_cates, $inc_tags);
    }

    public function getPostById($id, $inc_cates = FALSE, $inc_tags = TRUE) {
        $postTemp = $this->getByKey($id);
        return $this->createAPost($postTemp, $inc_cates, $inc_tags);
    }

    public function updatePost($post) {
        // Add tags to DB if them is new
        $tags = $post->getTags();
        $this->MTag->addTags($tags);
        
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
            "p_parent" => $post->getParent(),
            "p_youtube_url" => $post->getYoutube(),
            "p_cue" => $post->getCue()
        );
        $this->db->trans_start();
        $this->update($data);
        // Update tags and categories for post in term_relationships
        $this->MTermRelationships->deleteTermRelationshipByObjectId($post->getId());
        // Add tags for post
        if (!empty($tags = $post->getTags())) {
            foreach ($tags as $tag) {
                $term = $this->MTerm->getTerm($tag->getName(), 'tag');
                if(!empty($term)) {
                    $termRelationship = array(
                        "tr_object_id" => $post->getId(),
                        "tr_term_taxonomy_id" => $term['tt_id']
                    );
                    $this->MTermRelationships->addTermRelationship($termRelationship);
                }
            }
        }
        // Add categories for post
        if (!empty($categories = $post->getCategories())) {
            foreach ($categories as $category) {
                $term = $this->MTerm->getTerm($category->getName(), 'category');
                if(!empty($category)) {
                    $termRelationship = array(
                        "tr_object_id" => $post->getId(),
                        "tr_term_taxonomy_id" => $term['tt_id']
                    );
                    $this->MTermRelationships->addTermRelationship($termRelationship);
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
     * @param array $condition type(array) and status(array) are required (taxonomy, fromDate, title, 'array ids' are optional)
     * @param array $limitConfig (records, begin) -optional
     * @return array includes posts and total records before limit
     */
    public function getPosts($condition, $limitConfig = array()) {
        $this->db->select('SQL_CALC_FOUND_ROWS p_id', FALSE);
        $this->db->from($this->_table['table_name']);
        
        $this->db->where_in('p_type', $condition['type']);
        $this->db->where_in('p_status', $condition['status']);
        
        if(array_key_exists('ids', $condition) && !empty($condition['ids'])) {
            $this->db->where_in('p_id', $condition['ids']);
        }
        
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
        if(!empty($limitConfig)) {
            $this->db->limit($limitConfig['records'], $limitConfig['begin']);
        }
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
        $post = $this->getPostById($post_id, TRUE, TRUE);
        
        $this->delete($post->getId());
        $this->MTermRelationships->deleteTermRelationshipByObjectId($post_id);
        
        // Delete comment on post
        $this->MComment->deleteCommentByPostId($post_id);
        
        foreach($post->getTags() as $tag) {
            // Reduce count for tag
            $this->MTermTaxonomy->adjustCount($tag->getId(), '-');
        }
        foreach($post->getCategories() as $category) {
            // Reduce count for category
            $this->MTermTaxonomy->adjustCount($category->getId(), '-');
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
    
    public function adjustCountComments($postId, $operation) {
        if($operation == '+' || $operation == '-' || $operation == '*' || $operation == '/') {
            $this->db->query("update posts set p_comment_count = "
                    . "(p_comment_count $operation 1) where p_id = $postId");
        }
    }
    
    public function getSuggestForPost($post, $limit) {
        // GET list term id (categories and tags)
        $terms = array_merge($post->getCategories(), $post->getTags());
        $totalTerm = count($terms);
        $termIds = "";
        for($i = 0; $i < $totalTerm; $i++) {
            if($i == ($totalTerm - 1)) {
                $termIds .= $terms[$i]->getId();
                break;
            }
            $termIds .= $terms[$i]->getId() . ', ';
        }
        
        $this->db->query("SELECT @min := MIN(p_id), @max := MAX(p_id) FROM posts");
        $rs = $this->db->query("
                SELECT DISTINCT p.*
                    FROM posts p 
                    JOIN term_relationships tr on p.p_id = tr.tr_object_id
                    JOIN term_taxonomy tt on tt.tt_id = tr.tr_term_taxonomy_id 
                    JOIN ( SELECT p_id FROM
                             ( SELECT p_id
                                 FROM ( SELECT @min + (@max - @min + 1 - 5) * RAND() AS start FROM DUAL ) AS init
                                 JOIN posts y
                                 WHERE    y.p_id > init.start
                                 ORDER BY y.p_id
                                 LIMIT 50
                             ) z ORDER BY RAND()
                            LIMIT $limit
                          ) r ON p.p_id = r.p_id where tt.tt_term_id in($termIds) and p.p_id != {$post->getId()}
                ")->result_array();
        $posts = array();
        foreach($rs as $item) {
            $posts[] = $this->createAPost($item, FALSE, FALSE);
        }
        return $posts;
    }

}
