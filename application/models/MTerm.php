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

    public function addTerm($term, $taxonomy_name, $parent = -1) {
        // Check tag have not exist in DB
        $term_id = 0;
        if (empty($this->getTerm($term->getName(), $taxonomy_name, $parent))) {
            $this->db->trans_start();
            $data = array(
                "t_name" => $term->getName(),
                "t_slug" => convert_vi_to_en($term->getName(), TRUE)
            );

            // Add new a term to DB
            $term_id = $this->insert($data);

            // Specifit type of term
            $term_taxonomy = array(
                "tt_term_id" => $term_id,
                "tt_taxonomy_name" => $taxonomy_name,
                "tt_desc" => $taxonomy_name,
                "tt_parent" => ($term instanceof ECategory) ? $term->getParent() : 0,
                "tt_count" => 0
            );
            $this->mTermTaxonomy->addTermTaxonomy($term_taxonomy);
            $this->db->trans_complete();
        } else {
            return FALSE;
        }
        if ($this->db->trans_status() == FALSE) {
            $this->db->trans_rollback();
            return FALSE;
        } else {
            $this->db->trans_commit();
            return $term_id;
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
    
    public function getTermByParent($parentId, $taxonomy_name) {
        $this->db->select('t_id, tt_id, t_name, t_slug, t_group, tt_taxonomy_name, tt_desc, tt_parent, tt_count');
        $this->db->from($this->_table['table_name']);
        $this->db->join('term_taxonomy', 'terms.t_id = term_taxonomy.tt_term_id');
        $this->db->where('term_taxonomy.tt_parent = "' . $parentId . 
                '" and term_taxonomy.tt_taxonomy_name = "' . $taxonomy_name . '"');
        return $this->db->get()->result_array();
    }

    public function getTerm($term_name, $taxonomy_name, $parent = -1) {
        $this->db->select('t_id, tt_id, t_name, t_slug, t_group, tt_taxonomy_name, tt_desc, tt_parent, tt_count');
        $this->db->from($this->_table['table_name']);
        $this->db->join('term_taxonomy', 'terms.t_id = term_taxonomy.tt_term_id');
        $this->db->where('t_slug = "' . convert_vi_to_en($term_name, TRUE) .
                '" and tt_taxonomy_name = "' . $taxonomy_name . '"' . 
                (($parent != -1) ? " and tt_parent=" . $parent : ""));
        return $this->db->get()->row_array();
    }

    public function deleteTermById($id) {
        $this->delete($id);
    }

    public function updateTerm($term) {
        $this->update($term);
    }

}
