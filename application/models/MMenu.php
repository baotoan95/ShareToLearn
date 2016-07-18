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
            "mn_meta_value" => $menu->getMeta()
        );
        return $this->insert($data);
    }
    
    public function getMenus() {
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
            $menu[] = new EMenuItem($menuItem['mn_id'], $menuItem['mn_name'], 
                    $menuItem['mn_slug'], $menuItem['mn_parent'], $menuItem['mn_meta_value']);
        }
        return $menu;
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
    public function generateMenu($menuItems, $config, $parentId = 0, $html = '') {
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
            $html = ($parentId == 0) ? "" : "<{$config['tag_container_name']} class='dd-list sub-menu'>";
            foreach ($subMenu as $item) {
                // Parse meta value to get id and type of menu item
                $meta = json_decode($item->getMeta(), TRUE);
                $html .= "<li class='dd-item' data-id='{$meta['id']}-{$meta['type']}'>"
                            . "<{$config['tag_name']} class='dd-handle' href='" . $item->getSlug() . "'>" .
                                $item->getName() . 
                                        // If client side (tag name is <a>) then don't add type
                                        (($config['tag_name'] != 'a') ? " [" . strtoupper($meta['type']) . "]" : "")
                            . "</{$config['tag_name']}>" .
                              $this->generateMenu($menuItems, $config, $item->getId(), $html) .
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
            var_dump($menuItem) . "<br/>";
            $parent = $this->mMenu->addMenuItem($menuItem);
            // If have any child: recursive
            if(array_key_exists('children', $item)) {
                echo "child<br/><br/><br/>";
                $this->store($item['children'], $parent);
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
        // Create meta value for menuItem {"id":"id","type":"type"}
        $meta_value = '{"id":"' . trim($data[0]) . '","type":"' . trim($data[1]) . '"}';
        switch (trim($data[1])) {
            case 'post':
                $post = $this->mPost->getPostById($data[0]);
                return new EMenuItem(0, $post->getTitle(), base_url() . 
                        $post->getGuid() . '-' . $post->getId() . '.html', $parentId, $meta_value);
            case 'page':
                $post = $this->mPost->getPostById($data[0]);
                return new EMenuItem(0, $post->getTitle(), base_url() . 
                        $post->getGuid() . '.html', $parentId, $meta_value);
            case 'navigation': 
                $post = $this->mPost->getPostById($data[0]);
                return new EMenuItem(0, $post->getTitle(), $post->getGuid(), $parentId, $meta_value);
            case 'category': 
                $category = $this->mCategory->getCategoryById($data[0]);
                return new EMenuItem(0, $category->getName(), base_url() . 
                        'the-loai/' . $category->getSlug(), $parentId, $meta_value);
        }
    }
}
