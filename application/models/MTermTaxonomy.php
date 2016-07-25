<?php
require_once 'Base_Model.php';
/**
 * Description of TermTaxonomyModel
 *
 * @author BaoToan
 */
class MTermTaxonomy extends Base_Model {

    public function __construct() {
        parent::__construct();
        $this->set_table('term_taxonomy', 'tt_id');
    }

    public function addTermTaxonomy($term_taxonomy) {
        $this->insert($term_taxonomy);
    }
    
    public function deleteTermTaxonomyByTermId($term_id) {
        $this->db->where('tt_term_id', $term_id);
        return $this->db->delete($this->_table['table_name']);
    }
    
    public function updateTermTaxonomyByTermId($term_id, $term_taxonomy) {
        $this->db->where('tt_term_id', $term_id);
        return $this->db->update($this->_table['table_name'], $term_taxonomy);
    }
    
    /**
     * 
     * @param int $termId
     * @param char $operation (+,-,*,/)
     */
    public function adjustCount($termId, $operation) {
        if($operation == '+' || $operation == '-' || 
                $operation == '*' || $operation == '/') {
            $this->db->query("update term_taxonomy set tt_count = tt_count "
                    . "$operation 1 where tt_term_id = $termId");
        }
    }
}
