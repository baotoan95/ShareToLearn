<?php

require_once 'Base_Model.php';

/**
 * Description of CategoryModel
 *
 * @author BaoToan
 */
class MCategory extends Base_Model {

    function __construct() {
        parent::__construct();
        $this->load->model('MTerm');
    }

    // Create select category parent (in post view)
    function getCategoriesParentBox($parentId = 0, $space = "", $categoryIdsNeeedSelect = array(), $trees = "") {
        $categories = $this->getCategoriesByParent($parentId);
        foreach ($categories as $category) {
            $trees .= "<option value='" . $category->getId() . "' " .
                    (in_array($category->getId(), $categoryIdsNeeedSelect) ? "selected" : "") . ">" 
                    . $space . $category->getName() . "</option>" .
                    $this->getCategoriesParentBox($category->getId(), 
                            $space . '&nbsp;&nbsp;&nbsp;--&nbsp;&nbsp;', $categoryIdsNeeedSelect);
        }
        return $trees;
    }

    public function getCategoryById($id) {
        $term = $this->MTerm->getTermById($id);
        return new ECategory(intval($term['t_id']), $term['t_name'], $term['t_slug'], 
                $term['tt_desc'], intval($term['tt_parent']), intval($term['tt_count']));
    }

    public function getCategoriesByParent($parentId) {
        $terms = $this->MTerm->getTermByParent($parentId, 'category');
        $categories = array();
        foreach ($terms as $term) {
            $categories[] = new ECategory(intval($term['t_id']), $term['t_name'], 
                    $term['t_slug'], $term['tt_desc'], intval($term['tt_parent']), 
                    intval($term['tt_count']));
        }
        return $categories;
    }

    /**
     * 
     * @param array $limitConfig Config for pagination (records, begin)
     * @param string $cate_name Category name
     * @return array list of category result and total result before limit
     */
    public function getCategories($limitConfig = array(), $cate_name = '') {
        $result = $this->MTerm->getTermsByTaxonomy('category', $limitConfig, $cate_name);
        
        // GET list term
        $terms = array_key_exists('terms', $result) ? $result['terms'] : $result;
        $categories = array();
        foreach ($terms as $term) {
            $categories[] = new ECategory(intval($term['t_id']), $term['t_name'], 
                    $term['t_slug'], $term['tt_desc'], intval($term['tt_parent']), 
                    intval($term['tt_count']));
        }
       
        return array(
            "categories" => $categories,
            // If require limit Then get total before limit, else count all result
            "total" => array_key_exists('total', $result) ? $result['total'] : count($categories)
        );
    }
    
    public function getCategoriesByIds($ids) {
        $categories = array();
        foreach($ids as $id) {
            $categories[] = $this->getCategoryById($id);
        }
        return $categories;
    }

    public function addCategory($category) {
        return $this->MTerm->addTerm($category, 'category');
    }
    
    public function deleteCategory($category_id) {
        return $this->MTerm->deleteTermById($category_id);
    }
    
    public function updateCategory($category) {
        return $this->MTerm->updateTerm($category);
    }

}
