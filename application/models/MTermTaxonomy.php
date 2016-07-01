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
    
}
