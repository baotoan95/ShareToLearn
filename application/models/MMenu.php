<?php
require_once 'Base_Model.php';
/**
 * Description of MMenu
 *
 * @author BaoToan
 */
class MMenu extends Base_Model {
    public function __construct() {
        parent::__construct();
        // Import class
        $this->load->model('EMenuItem');
        
        // Set default value
        $this->set_table('menu', 'mn_id');
        
        $this->load->model('MPost');
        $this->load->model('MCategory');
    }
    
    /**
     * 
     * @param object $menu
     * @return int index of record just inserted
     */
    public function addMenuItem($menu) {
        $data = array(
            "mn_name" => $menu->getName(),
            "mn_slug" => $menu->getSlug(),
            "mn_parent" => $menu->getParent(),
            "mn_meta_value" => $menu->getMeta(),
            "mn_order" => $menu->getOrder()
        );
        return $this->insert($data);
    }
    
    public function getMenu() {
        $menuTemps = $this->getAll();
        $menu = array();
        foreach($menuTemps as $menuItem) {
            $menu[] = new EMenuItem($menuItem['mn_id'], $menuItem['mn_name'], 
                    $menuItem['mn_slug'], $menuItem['mn_parent'], $menuItem['mn_meta_value']);
        }
        return $menu;
    }
    
    public function getSubsItemsByParent($parentId) {
        $this->db->where('mn_parent', $parentId);
        $menuItems = $this->db->get($this->_table['table_name'])->result_array();
        $menu = array();
        foreach($menuItems as $item) {
            $menu[] = new EMenuItem($item['mn_id'], $item['mn_name'], 
                    $item['mn_slug'], $item['mn_parent'], $item['mn_meta_value']);
        }
        return $menu;
    }
    
    public function haveChild($parentId) {
        $this->db->select('count(mn_id) as count');
        $this->db->where('mn_parent', $parentId);
        return intval($this->db->get($this->_table['table_name'])->row_array()['count']) > 0;
    }
    
    /**
     * 
     * @param array $menuItems List of EMenuItem
     * @param array $config includes tag_name: tag name before menuItem name. 
     *                               tag_container_name: tag name before tag_name
     * @param int $parentId
     * @param string $html
     * @return string
     */
    public function generateMenuMng($menuItems, $parentId = 0, $html = '') {
        // Create a temp list
        $menuTemps = $menuItems;
        // GET list sub comment by parentId search in comments list
        $subMenu = array();
        for ($i = 0; $i < count($menuTemps); $i ++) {
            // If found: remove it from $comments and add to subCmts
            if ($menuItems[$i]->getParent() == $parentId) {
                unset($menuItems[$i]);
                $subMenu[] = $menuTemps[$i];
            }
        }
        $menuItems = array_values($menuItems);
        
        // Add list sub comment to html and recursive
        if(empty($subMenu)) {
            return "";
        } else {
            // Sort subMenu by order desc
            usort($subMenu, function($a, $b) {
                return $a > $b;
            });
            $html = ($parentId == 0) ? "" : "<ol class='dd-list sub-menu'>";
            foreach ($subMenu as $item) {
                // Parse meta value to get id and type of menu item
                $meta = json_decode($item->getMeta(), TRUE);
                $html .= "<li class='dd-item dd3-item' data-id='{$meta['id']}-{$meta['type']}'>"
                            . "<div class='dd-handle dd3-handle'>Drag</div>"
                            . "<div class='dd3-content'>" . $item->getName() . " [" . strtoupper($meta['type']) . "]"
                            . "<a class='pull-right del-mnItem' title='Delete'>X</a>"
                            . "</div>" .
                              $this->generateMenuMng($menuItems, $item->getId(), $html) .
                          "</li>";
            }
            return $html. (($parentId == 0) ? "" : "</ol>");
        }
    }
    
    public function generateMainMenu($menuItems, $parentId = 0, $html = '') {
        // Create a temp list
        $menuTemps = $menuItems;
        // GET list sub comment by parentId search in comments list
        $subMenu = array();
        for ($i = 0; $i < count($menuTemps); $i ++) {
            // If found: remove it from $comments and add to subCmts
            if ($menuItems[$i]->getParent() == $parentId) {
                unset($menuItems[$i]);
                $subMenu[] = $menuTemps[$i];
            }
        }
        $menuItems = array_values($menuItems);
        
        // Add list sub comment to html and recursive
        if(empty($subMenu)) {
            return "";
        } else {
            // Sort subMenu by order desc
            usort($subMenu, function($a, $b) {
                return $a > $b;
            });
            $html = ($parentId == 0) ? "" : "<ul>";
            foreach ($subMenu as $item) {
                // Parse meta value to get id and type of menu item
                $meta = json_decode($item->getMeta(), TRUE);
                
                $haveChild = $this->haveChild($item->getId());
                $html .= "<li " . ($haveChild ? (($parentId == 0) ? "class='dropdown'" : "class='has-children dropdown'") : "") . ">";
                $html .= "<a href='{$item->getSlug()}' " . ($haveChild ? (($parentId == 0) ? "class='dropdown-toggle' data-toggle='dropdown' data-hover='dropdown'" : "") : "") . ">{$item->getName()}</a>";
                $html .= $haveChild ? "<div " . (($parentId == 0) ? "class='dropdown-menu default-dropdown' style='opacity: 1; display: none;'" : "class='dropdown-menu default-dropdown'") . ">" : "";
                $html .= $this->generateMainMenu($menuItems, $item->getId(), $html);
                $html .= $haveChild ? "</div>" : "";
                $html .= "</li>";
            }
            return $html. (($parentId == 0) ? "" : "</ul>");
        }
    }
    
    /**
     * Just use for delete menu
     * @param int $parentId
     */
    public function deleteMenu() {
        $menu = $this->getMenu();
        foreach($menu as $item) {
            $this->deleteMenuItem($item->getId());
        }
    }
    
    public function getMenuItem($id) {
        $this->db->where('mn_id', $id);
        $item = $this->db->get($this->_table['table_name'])->row_array();
        if(empty($item)) {
            return NULL;
        } else {
            return new EMenuItem($item['mn_id'], $item['mn_name'], 
                    $item['mn_slug'], $item['mn_parent'], $item['mn_meta_value']);
        }
    }
    
    public function deleteMenuItem($id) {
        $menuItem = $this->getMenuItem($id);
        $this->db->trans_start();
        $this->db->where('mn_id', $id);
        $this->db->delete($this->_table['table_name']);
        $this->db->trans_complete();
        if($this->db->trans_status() == TRUE) {
            $meta = json_decode($menuItem->getMeta(), TRUE);
            if($meta['type'] == 'navigation') {
                $this->MPost->deletePost($meta['id']);
            }
        }
    }
    
    /**
     * 
     * @param array $menu
     */
    public function addMenu($menu) {
        // Delete all
        $this->db->where('mn_id > ', 0);
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
        $order = 0;
        foreach($menuItems as $item) {
            $menuItem = $this->createMenuItemByType($item['id'], $parentId, $order);
            $parent = $this->addMenuItem($menuItem);
            $order++;
            // If have any child: recursive
            if(array_key_exists('children', $item)) {
                $this->store($item['children'], $parent);
            }
        }
    }
    
    /**
     * 
     * @param string $str structure: id-type
     * @return object EMenuItem
     */
    private function createMenuItemByType($str, $parentId, $order) {
        $data = explode("-", $str); // GET id and type
        // Create meta value for menuItem {"id":"id","type":"type"}
        $meta_value = '{"id":"' . trim($data[0]) . '","type":"' . trim($data[1]) . '"}';
        switch (trim($data[1])) {
            case 'post':
                $post = $this->MPost->getPostById($data[0]);
                return new EMenuItem(0, $post->getTitle(), base_url() . 
                        $post->getGuid() . '-' . $post->getId() . '.html', $parentId, $meta_value, $order);
            case 'page':
                $post = $this->MPost->getPostById($data[0]);
                return new EMenuItem(0, $post->getTitle(), base_url() . 
                        $post->getGuid() . '.html', $parentId, $meta_value, $order);
            case 'navigation': 
                $post = $this->MPost->getPostById($data[0]);
                return new EMenuItem(0, $post->getTitle(), $post->getGuid(), $parentId, $meta_value, $order);
            case 'category': 
                $category = $this->MCategory->getCategoryById($data[0]);
                return new EMenuItem(0, $category->getName(), base_url() . 
                        'the-loai/' . $category->getSlug(), $parentId, $meta_value, $order);
        }
    }
}
