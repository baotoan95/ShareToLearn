<?php

/**
 * Description of ConfigModel
 *
 * @author BaoToan
 */
class MOption extends BaseModel {
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
