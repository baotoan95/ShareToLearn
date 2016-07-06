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
        $this->load->model('mTerm');
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
        $term = $this->mTerm->getTermById($id);
        return new ECategory(intval($term['t_id']), $term['t_name'], $term['t_slug'], $term['tt_desc'], intval($term['tt_parent']));
    }

    public function getCategoriesByParent($parentId) {
        $terms = $this->mTerm->getTermByParent($parentId, 'category');
        $categories = array();
        foreach ($terms as $term) {
            $categories[] = new ECategory(intval($term['t_id']), $term['t_name'], $term['t_slug'], $term['tt_desc'], intval($term['tt_parent']));
        }
        return $categories;
    }

    public function getCategories($limitConfig = array(), $term_name = '') {
        $result = $this->mTerm->getTermsByTaxonomy('category', $limitConfig, $term_name);
        $categories = array();
        foreach ($result['terms'] as $term) {
            $categories[] = new ECategory(intval($term['t_id']), $term['t_name'], $term['t_slug'], $term['tt_desc'], intval($term['tt_parent']));
        }
        return array(
            "categories" => $categories,
            "total" => intval($result['total'])
        );
    }

    public function addCategory($category) {
        return $this->mTerm->addTerm($category, 'category');
    }

}
