<?php
require_once 'Base_Model.php';
/**
 * Description of CategoryModel
 *
 * @author BaoToan
 */
class MCategory extends Base_Model {
    function __construct() {
        parent::__construct();
        $this->load->model('mTerm');
    }
    
    public function getCategoryById($id) {
        $term = $this->mTerm->getTermById($id);
        return new ECategory($term['t_id'], $term['t_name'], $term['t_slug'], 
                $term['tt_desc'], $term['tt_parent']);
    }
    
    public function getCategories() {
        $terms = $this->mTerm->getTermsByTaxonomy('category');
        $categories = array();
        foreach($terms as $term) {
            $categories[] = new ECategory($term['t_id'], $term['t_name'], $term['t_slug'], 
                $term['tt_desc'], $term['tt_parent']);
        }
        return $categories;
    }
    
    public function addCategories($categories) {
        return $this->mTerm->addTerms($categories, 'category');
    }
}
