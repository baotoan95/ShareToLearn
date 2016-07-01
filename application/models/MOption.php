<?php
require_once 'Base_Model.php';
/**
 * Description of ConfigModel
 *
 * @author BaoToan
 */
class MOption extends Base_Model {
    public function __construct() {
        parent::__construct();
        $this->set_table('options', 'o_name');
    }
    
    public function updateOption($option) {
        return $this->update($option);
    }
    
    public function getOption($option_name) {
        return $this->get(array("o_name" => $option_name));
    }
    
    public function getOptions() {
        return $this->getAll();
    }
}
