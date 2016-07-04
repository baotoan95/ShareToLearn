<?php
require_once 'Base_Model.php';
/**
 * Description of TermRelationshipsModel
 *
 * @author BaoToan
 */
class MTermRelationships extends Base_Model {
    public function __construct() {
        parent::__construct();
        $this->set_table('term_relationships');
    }
    
    public function addTermRelationship($term_relationship) {
        $this->insert($term_relationship);
    }
    
    public function getTermRelationshipByObjectId($object_id, $taxonomy_name) {
        $this->db->select('t_id, t_slug, t_group, t_name, '
                . 'tt_id, tt_taxonomy_name, tt_desc, tt_parent, tt_count, '
                . 'tr_object_id, tr_term_taxonomy_id');
        $this->db->from($this->_table['table_name']);
        $this->db->join('term_taxonomy', 'term_relationships.tr_term_taxonomy_id = term_taxonomy.tt_id');
        $this->db->join('terms', 'term_taxonomy.tt_term_id = terms.t_id');
        $this->db->where('term_relationships.tr_object_id = "' . $object_id . 
                '" and term_taxonomy.tt_taxonomy_name = "' . $taxonomy_name . '"');
        return $this->db->get()->result_array();
    }
    
    public function deleteTermRelationshipByObjectId($object_id) {
        $this->db->where($this->_table['table_name'] . '.tr_object_id', $object_id);
        return $this->db->delete($this->_table['table_name']);
    }
}
