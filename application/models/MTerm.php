<?php

/**
 * Description of TermModel
 *
 * @author BaoToan
 */
class MTerm extends BaseModel {
    public function __construct() {
        parent::__construct();
        $this->set_table('terms', 't_id');
        $this->load->model('mTermTaxonomy');
    }

    public function addTerms($terms, $taxonomy_name) {
        for($i = 0; $i < count($terms); $i++) {
            $this->db->trans_start();
            // Check tag have exist in DB
            if(empty($this->getTerm(convert_vi_to_en($terms[$i], true), $taxonomy_name))) {
                $term = array(
                    "t_name" => $terms[$i],
                    "t_slug" => convert_vi_to_en($terms[$i], true)
                );
                
                // Add new a term to DB
                $term_id = $this->insert($term);
                
                // Specifit type of term
                $term_taxonomy = array(
                    "tt_term_id" => $term_id,
                    "tt_taxonomy_name" => $taxonomy_name,
                    "tt_desc" => $taxonomy_name,
                    "tt_parent" => 0,
                    "tt_count" => 0
                );
                $this->mTermTaxonomy->addTermTaxonomy($term_taxonomy);
            }
            $this->db->trans_complete();
        }
    }
    
    public function deleteTerm($id) {
        $this->delete($id);
    }
    
    public function updateTerm($term) {
        $this->update($term);
    }
    
    public function getTermsByTaxonomy($taxonomy_name) {
        $this->db->select('t_id, t_name, t_slug, t_group, tt_taxonomy_name, tt_desc, tt_parent, tt_count');
        $this->db->from($this->_table['table_name']);
        $this->db->join('term_taxonomy', 'terms.t_id = term_taxonomy.tt_term_id');
        $this->db->where('term_taxonomy.tt_taxonomy_name = "' . $taxonomy_name . '"');
        return $term_id = $this->db->get()->result_array();
    }
    
    public function getTerm($term_name, $taxonomy_name) {
        $this->db->select('t_id, t_name, t_slug, t_group, tt_taxonomy_name, tt_desc, tt_parent, tt_count');
        $this->db->from($this->_table['table_name']);
        $this->db->join('term_taxonomy', 'terms.t_id = term_taxonomy.tt_term_id');
        $this->db->where('terms.t_slug = "' . convert_vi_to_en($term_name) .
                '" and term_taxonomy.tt_taxonomy_name = "' . $taxonomy_name . '"');
        $this->db->limit(1);
        return $term_id = $this->db->get()->result_array();
    }
}
