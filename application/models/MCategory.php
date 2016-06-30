<?php
require_once 'ECategory.php';
/**
 * Description of CategoryModel
 *
 * @author BaoToan
 */
class MCategory extends CI_Model {
    public function __construct() {
        parent::__construct();
        $this->load->model('mTerm');
    }
    
    public function getCategories() {
        $terms = $this->mTerm->getTermsByTaxonomy('category');
        $categories = array();
        foreach($terms as $category) {
            $categories[] = new ECategory($category['t_name'], $category['t_slug'], 
                $category['tt_desc'], $category['tt_parent'], $category['t_id']);
        }
        return $categories;
    }
    
    public function addCategories($categories) {
        return $this->mTerm->addTerms($categories, 'category');
//        for($i = 0; $i < count($categories); $i++) {
//            $this->db->trans_start();
//            $this->db->from('terms');
//            $this->db->join('term_taxonomy', 'term_taxonomy.tt_term_id = terms.t_id');
//            $this->db->where('tt_taxonomy_name', 'tag');
//            $this->db->where('tt_term_id', $categories[$i]);
//            // Check tag (category) have exist in DB
//            if($this->db->count_all_results() == 0) {
//                $category = array(
//                    "t_name" => $categories[$i],
//                    "t_slug" => convert_vi_to_en($categories[$i])
//                );
//                // Add new a term (category) to DB
//                $this->termModel->addTerm($category);
//                
//                // Specifit type of term (category)
//                $term_taxonomy = array(
//                    "tt_term_id" => $categories[$i],
//                    "tt_taxonomy_name" => "category",
//                    "tt_desc" => "category",
//                    "tt_parent" => 0,
//                    "tt_count" => 0
//                );
//                $this->mTermTaxonomy->addTermTaxonomy($term_taxonomy);
//            }
//            $this->db->trans_complete();
//        }
    }
}
