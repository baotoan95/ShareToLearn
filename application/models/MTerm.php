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

    public function addTerm($term, $taxonomy_name) {
        // If term is tag then it not have parent
        $parent = -1;
        if($term instanceof ECategory) {
            $parent = $term->getParent();
        }
        // Check tag have not exist in DB
        $term_id = 0;
        if (empty($this->getTerm($term->getName(), $taxonomy_name, $parent))) {
            $this->db->trans_start();
            $data = array(
                "t_name" => $term->getName(),
                "t_slug" => strlen(trim($term->getSlug())) > 0 ? 
                trim($term->getSlug()) : convert_vi_to_en($term->getName(), TRUE)
            );

            // Add new a term to DB
            $term_id = $this->insert($data);
            // Specifit type of term
            $term_taxonomy = array(
                "tt_term_id" => $term_id,
                "tt_taxonomy_name" => $taxonomy_name,
                "tt_desc" => $term->getDesc(),
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

    /**
     * 
     * @param string $taxonomy_name
     * @param array $limitConfig (records, begin)
     * @param string $term_name term name
     * @return array if specific limitConfig then return array(array terms, int total), 
     * else just return array terms
     */
    public function getTermsByTaxonomy($taxonomy_name, $limitConfig = array(), $term_name = '') {
        $this->db->select('SQL_CALC_FOUND_ROWS t_id, tt_id, t_name, t_slug, t_group, tt_taxonomy_name, '
                . 'tt_desc, tt_parent, tt_count', FALSE);
        $this->db->from($this->_table['table_name']);
        $this->db->join('term_taxonomy', 'terms.t_id = term_taxonomy.tt_term_id');
        if($term_name != '') {
            $this->db->group_start();
            $this->db->like('terms.t_name', $term_name, 'before');
            $this->db->or_like('terms.t_name', $term_name);
            $this->db->or_like('terms.t_name', $term_name, 'after');
            $this->db->group_end();
        }
        $this->db->where('term_taxonomy.tt_taxonomy_name = "' . $taxonomy_name . '"');
        if(count($limitConfig) > 0) {
            $this->db->limit($limitConfig['records'], $limitConfig['begin']);
            $records = $this->db->get()->result_array();
            $count = $this->db->query('select FOUND_ROWS() count')->row()->count;
            return array(
                "terms" => $records,
                "total" => $count
            );
        }
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
        $this->db->trans_start();
        $this->mTermTaxonomy->deleteTermTaxonomyByTermId($id);
        $this->delete($id);
        $this->db->trans_complete();
        if($this->db->trans_status() == FALSE) {
            $this->db->trans_rollback();
            return FALSE;
        } else {
            $this->db->trans_commit();
            return TRUE;
        }
    }

    public function updateTerm($term) {
        $this->db->trans_start();
        $data = array(
            "t_id" => $term->getId(),
            "t_name" => $term->getName(),
            "t_slug" => (strlen(trim($term->getSlug())) > 0) ? trim($term->getSlug()) : convert_vi_to_en($term->getName(), TRUE)
        );
        
        $this->update($data);
        $term_taxonomy = array(
            "tt_desc" => $term->getDesc(),
            "tt_count" => $term->getCount()
        );
        if($term instanceof ECategory) {
            $term_taxonomy["tt_parent"] = $term->getParent();
        }
        $this->mTermTaxonomy->updateTermTaxonomyByTermId($term->getId(), $term_taxonomy);
        $this->db->trans_complete();
        if($this->db->trans_status() == FALSE) {
            $this->db->trans_rollback();
            return FALSE;
        } else {
            $this->db->trans_commit();
            return TRUE;
        }
    }

}
