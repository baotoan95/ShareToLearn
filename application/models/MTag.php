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
        $this->load->model('mTerm');
        $this->load->model('mTermTaxonomy');
    }
    
    public function addTags($tags = array()) {
        return $this->mTerm->addTerms($tags, 'tag');
    }
    
    public function getTagsByPost($post_id) {
//        $tags = $this->mTerm->getTerm()
    }
}
