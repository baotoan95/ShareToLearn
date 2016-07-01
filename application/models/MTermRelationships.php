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
        $this->db->select('t_id, tt_id, tr_id, t_name, t_slug, t_group, tt_taxonomy_name, tt_desc, tt_parent, tt_count');
        $this->db->from($this->_table['table_name']);
        $this->db->join('posts', 'term_relationships.tr_object_id = posts.p_id');
        $this->db->join('term_taxonomy', 'term_relationships.tr_term_taxonomy_id = term_taxonomy.tt_id');
        $this->db->join('terms', 'term_taxonomy.tt_term_id = terms.t_id');
        $this->db->where('term_relationships.tr_object_id = "' . $object_id . 
                '" and term_taxonomy.tt_taxonomy_name = "' . $taxonomy_name . '"');
        return $this->db->get()->result_array();
    }
    
    public function deleteTermRelationshipByObjectId($object_id) {
        $this->db->where($this->_table['table_name'] . '.tr_object_id', $object_id);
        return $this->db->delete();
    }
}
