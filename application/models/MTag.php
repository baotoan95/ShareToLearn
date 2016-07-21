<?php

require_once 'Base_Model.php';

/**
 * Description of TagModel
 *
 * @author BaoToan
 */
class MTag extends Base_Model {

    public function __construct() {
        parent::__construct();
        
        $this->load->model('ETag');
        
        $this->load->model('MTerm');
        $this->load->model('MTermTaxonomy');
    }
    
    /**
     * For ajax
     * @param type $tag
     */
    public function addTag($tag) {
        return $this->MTerm->addTerm($tag, 'tag');
    }

    /**
     * 
     * @param array $tags (list of tag name)
     * @return void
     */
    public function addTags($tags = array()) {
        foreach ($tags as $tag) {
            $this->MTerm->addTerm($tag, 'tag');
        }
    }
    
    /**
     * 
     * @param int $tag_id
     * @return ETag
     */
    public function getTagById($tag_id) {
        $term = $this->MTerm->getTermById($tag_id);
        return new ETag($term['t_id'], $term['t_name'], $term['tt_desc'], $term['t_slug'], $term['tt_count']);
    }

    public function getTags($limitConfig = array(), $term_name = '') {
        $result = $this->MTerm->getTermsByTaxonomy('tag', $limitConfig, $term_name);
        $tags = array();
        foreach($result['terms'] as $term) {
            $tags[] = new ETag(intval($term['t_id']), $term['t_name'], $term['tt_desc'], $term['t_slug'], $term['tt_count']);
        }
        return array(
            "tags" => $tags,
            "total" => intval($result['total'])
        );
    }
    
    public function deleteTag($tag_id) {
        return $this->MTerm->deleteTermById($tag_id);
    }
    
    public function updateTag($tag) {
        return $this->MTerm->updateTerm($tag);
    }

}
