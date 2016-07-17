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
    
    public function getMenus() {
        $menuTemps = $this->getAll();
        $menu = array();
        foreach($menuTemps as $menuItem) {
            $menu[] = new EMenuItem($menuItem['mn_id'], $menuItem['mn_name'], 
                    $menuItem['mn_slug'], $menuItem['mn_parent']);
        }
        return $menu;
    }
    
    /**
     * 
     * @param array $menu
     */
    public function addMenu($menu) {
        // Delete all
        $this->db->where('mn_id > 0');
        $this->db->delete($this->_table['table_name']);
        // Store new menu
        $this->store($menu);
    }
    
    /**
     * Store Menu into DB
     * @param array $menuItems Each item iclude id(id-type) and children (if -optional)
     * @param int $parentId
     */
    public function store($menuItems, $parentId = 0) {
        foreach($menuItems as $item) {
            $menuItem = $this->createMenuItemByType($item['id'], $parentId);
            var_dump($menuItem);
            $parent = $this->mMenu->addMenuItem($menuItem);
            // If have any child: recursive
            if(array_key_exists('children', $item)) {
                echo "child<br/>";
                $this->store($item['children'], $parent);
            } else {
                $parentId = 0;
            }
        }
    }
    
    /**
     * 
     * @param string $str structure: id-type
     * @return object EMenuItem
     */
    private function createMenuItemByType($str, $parentId) {
        $data = explode("-", $str); // GET id and type
        switch ($data[1]) {
            case 'post':
            case 'page':
            case 'navigation': 
                $post = $this->mPost->getPostById($data[0]);
                return new EMenuItem(0, $post->getTitle(), $post->getGuid(), $parentId);
            case 'category': 
                $category = $this->mCategory->getCategoryById($data[0]);
                return new EMenuItem(0, $category->getName(), $category->getSlug(), $parentId);
        }
    }
}
