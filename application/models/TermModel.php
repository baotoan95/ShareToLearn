<?php

/**
 * Description of TermModel
 *
 * @author BaoToan
 */
class TermModel extends BaseModel {
    public function __construct() {
        parent::__construct();
        $this->set_table('terms', 't_id');
    }

    public function addTerm($term) {
        $this->insert($term);
    }
    
    public function deleteTerm($id) {
        $this->delete($id);
    }
    
    public function updateTerm($term) {
        $this->update($term);
    }
    
    public function getTermById($id) {
        return $this->get(array('t_id' => $id));
    }
    
    public function getTermBySlug($slug) {
        return $this->get(array('t_slug' => $id));
    }
}
