<?php

/**
 * Description of MMenu
 *
 * @author BaoToan
 */
class MMenu extends Base_Model {
    public function __construct() {
        parent::__construct();
        $this->set_table('menu', 'mn_id');
    }
    
    public function addMenuItem($menu) {
        $data = array(
            "mn_name" => $menu->getName(),
            "mn_slug" => $menu->getSlug(),
            "mn_parent" => $menu->getParent()
        );
        return $this->insert($data);
    }
}
