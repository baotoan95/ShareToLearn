<?php
require_once 'Base_Model.php';
require_once 'ECategory.php';
/**
 * Description of TermModel
 *
 * @author BaoToan
 */
class MTerm extends Base_Model {
    public function __construct() {
        parent::__construct();
        $this->set_table('terms', 't_id');
        $this->load->model('mTermTaxonomy');
    }

    public function addTerms($terms, $taxonomy_name) {
        for($i = 0; $i < count($terms); $i++) {
            // Check tag have exist in DB
            if(empty($this->getTerm($terms[$i]->getName(), $taxonomy_name))) {
                $this->db->trans_start();
                $term = array(
                    "t_name" => $terms[$i]->getName(),
                    "t_slug" => convert_vi_to_en($terms[$i]->getName(), true)
                );
                
                // Add new a term to DB
                $term_id = $this->insert($term);
                
                // Specifit type of term
                $term_taxonomy = array(
                    "tt_term_id" => $term_id,
                    "tt_taxonomy_name" => $taxonomy_name,
                    "tt_desc" => $taxonomy_name,
                    "tt_parent" => ($terms[$i] instanceof ECategory) ? $terms[$i]->getParent() : 0,
                    "tt_count" => 0
                );
                $this->mTermTaxonomy->addTermTaxonomy($term_taxonomy);
                $this->db->trans_complete();
            } else {
                return false;
            }
        }
        if($this->db->trans_status() == FALSE) {
            $this->db->trans_rollback();
            return false;
        } else {
            $this->db->trans_commit();
            return true;
        }
    }
    
    public function getTermById($id) {
        $this->db->select('t_id, tt_id, t_name, t_slug, t_group, tt_taxonomy_name, tt_desc, tt_parent, tt_count');
        $this->db->from($this->_table['table_name']);
        $this->db->join('term_taxonomy', 'terms.t_id = term_taxonomy.tt_term_id');
        $this->db->where('terms.t_id = ' . $id);
        $this->db->limit(1, 0);
        return $this->db->get()->row_array();
    }
    
    public function getTermsByTaxonomy($taxonomy_name) {
        $this->db->select('t_id, tt_id, t_name, t_slug, t_group, tt_taxonomy_name, tt_desc, tt_parent, tt_count');
        $this->db->from($this->_table['table_name']);
        $this->db->join('term_taxonomy', 'terms.t_id = term_taxonomy.tt_term_id');
        $this->db->where('term_taxonomy.tt_taxonomy_name = "' . $taxonomy_name . '"');
        return $this->db->get()->result_array();
    }
    
    public function getTerm($term_name, $taxonomy_name) {
        $this->db->select('t_id, tt_id, t_name, t_slug, t_group, tt_taxonomy_name, tt_desc, tt_parent, tt_count');
        $this->db->from($this->_table['table_name']);
        $this->db->join('term_taxonomy', 'terms.t_id = term_taxonomy.tt_term_id');
        $this->db->where('t_slug = "' . convert_vi_to_en($term_name, true) .
                '" and tt_taxonomy_name = "' . $taxonomy_name . '"');
        return $this->db->get()->row_array();
    }
    
    public function deleteTermById($id) {
        $this->delete($id);
    }
    
    public function updateTerm($term) {
        $this->update($term);
    }
    
    
}
