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

    public function getCategoriesBox($parentId) {
        $categories = $this->getCategoriesByParent($parentId);
        // If not have any child return "" (it is condition to stop recursive)
        if ($categories) {
            $html = "<ul>";
            foreach ($categories as $category) {
                $html .= "<li id='cate_" . $category->getId() . "'>" .
                            "<div class='checkbox'>" .
                            "<label>" .
                            "<input type='checkbox' name='categories[]' value='" .
                            $category->getId() . "'>" . $category->getName() .
                            "</label>" .
                            "</div>" . $this->getCategoriesBox($category->getId()) .
                        "</li>";
            }
            return $html .= "</ul>";
        }
        return "";
    }

    // Create select category parent (in post view)
    function getCategoriesParentBox($parentId = 0, $space = "", $trees = "") {
        $categories = $this->getCategoriesByParent($parentId);
        foreach ($categories as $category) {
            $trees .= "<option value='" . $category->getId() . "'>" . $space . $category->getName() . "</option>" .
                    $this->getCategoriesParentBox($category->getId(), $space . '&nbsp;&nbsp;&nbsp;--&nbsp;&nbsp;');
        }
        return $trees;
    }

    public function getCategoryById($id) {
        $term = $this->mTerm->getTermById($id);
        return new ECategory(intval($term['t_id']), $term['t_name'], $term['t_slug'], $term['tt_desc'], intval($term['tt_parent']));
    }

    public function getCategoriesByParent($parentId) {
        $terms = $this->mTerm->getTermByParent($parentId);
        $categories = array();
        foreach ($terms as $term) {
            $categories[] = new ECategory(intval($term['t_id']), $term['t_name'], $term['t_slug'], $term['tt_desc'], intval($term['tt_parent']));
        }
        return $categories;
    }

    public function getCategories() {
        $terms = $this->mTerm->getTermsByTaxonomy('category');
        $categories = array();
        foreach ($terms as $term) {
            $categories[] = new ECategory(intval($term['t_id']), $term['t_name'], $term['t_slug'], $term['tt_desc'], intval($term['tt_parent']));
        }
        return $categories;
    }

    public function addCategory($category) {
        return $this->mTerm->addTerm($category, 'category');
    }

    public function addCategories($categories) {
        return $this->mTerm->addTerms($categories, 'category');
    }

}
