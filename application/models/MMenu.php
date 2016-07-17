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
            "mn_parent" => $menu->getParent(),
            "mn_type" => $menu->getType()
        );
        return $this->insert($data);
    }
    
    public function getMenus() {
        $menuTemps = $this->getAll();
        $menu = array();
        foreach($menuTemps as $menuItem) {
            $menu[] = new EMenuItem($menuItem['mn_id'], $menuItem['mn_name'], 
                    $menuItem['mn_slug'], $menuItem['mn_parent'], $menuItem['mn_type']);
        }
        return $menu;
    }
    
    public function getSubsItemsByParent($parentId) {
        $this->db->where('mn_parent', $parentId);
        $menuItems = $this->db->get($this->_table['table_name'])->result_array();
        $menu = array();
        foreach($menuItems as $item) {
            $menu[] = new EMenuItem($menuItem['mn_id'], $menuItem['mn_name'], 
                    $menuItem['mn_slug'], $menuItem['mn_parent'], $menuItem['mn_type']);
        }
        return $menu;
    }
    
    public function generateMenu($menuItems, $config, $parentId = 0, $html = '') {
        // Create a temp list
        $cmtTemps = $menuItems;
        // GET list sub comment by parentId search in comments list
        $subCmts = array();
        for ($i = 0; $i < count($cmtTemps); $i ++) {
            // If found: remove it from $comments and add to subCmts
            if ($menuItems[$i]->getParent() == $parentId) {
                unset($menuItems[$i]);
                $subCmts[] = $cmtTemps[$i];
            }
        }
        $menuItems = array_values($menuItems);
        
        // Add list sub comment to html and recursive
        if(empty($subCmts)) {
            return "";
        } else {
            $html = ($parentId == 0) ? "" : "<{$config['tag_container_name']} class='dd-list'>";
            foreach ($subCmts as $cmt) {
                $html .= "<li class='dd-item' data-id='{$cmt->getId()}-{$cmt->getType()}'><{$config['tag_name']} class='dd-handle'>" .
                        $cmt->getName() . "</{$config['tag_name']}>" .
                                $this->generateMenu($menuItems, $config, $cmt->getId(), $html) .
                            "</li>";
            }
            return $html. (($parentId == 0) ? "" : "</{$config['tag_container_name']}>");
        }
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
        switch (trim($data[1])) {
            case 'post':
            case 'page':
            case 'navigation': 
                $post = $this->mPost->getPostById($data[0]);
                return new EMenuItem(0, $post->getTitle(), $post->getGuid(), $parentId, trim($data[1]));
            case 'category': 
                $category = $this->mCategory->getCategoryById($data[0]);
                return new EMenuItem(0, $category->getName(), $category->getSlug(), $parentId, trim($data[1]));
        }
    }
}
