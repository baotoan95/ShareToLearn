<?php

/**
 * Description of TermRelationshipsModel
 *
 * @author BaoToan
 */
class MTermRelationships extends BaseModel {
    public function __construct() {
        parent::__construct();
        $this->set_table('term_relationships', 'tr_object_id');
    }
    
    public function addTermRelationship($term_relationship) {
        $this->insert($term_relationship);
    }
    
    public function deleteTermRelationship($term_taxonomy_id) {
        $this->delete($term_taxonomy_id);
    }
    
    public function updateTermRelationship($term_relationship) {
        $this->update($term_relationship);
    }
    
    public function getTermRelationshipByTermTaxonomyId($id) {
        return $this->getByKey($id);
    }
    
}
