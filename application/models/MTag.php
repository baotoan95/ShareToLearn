<?php

/**
 * Description of TagModel
 *
 * @author BaoToan
 */
class MTag extends BaseModel {
    public function __construct() {
        parent::__construct();
        $this->load->model('termModel');
        $this->load->model('termTaxonomyModel');
    }
    
    public function addTags($tags = array()) {
        
    }
}
