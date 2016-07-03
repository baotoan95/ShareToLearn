<?php

/**
 * Description of Category
 *
 * @author BaoToan
 */
class Category extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('mCategory');
    }
    
    public function index() {
        echo count($this->mCategory->getCategories()) . "<br/>";
        echo $this->mCategory->getCategoriesBox(0);
    }
    
    public function addCategory() {
        $hasParentBox = $this->input->post('hasParentBox');
        $name = $this->input->post('newcate');
        $parent = $this->input->post('parent_cate');
        $category = new ECategory(0, trim($name), '', '', trim($parent));
        $category_id = $this->mCategory->addCategory($category, 'category');
        if($category_id) {
            $newcate = $this->mCategory->getCategoryById($category_id);
            $categoriesParentBox = $this->mCategory->getCategoriesParentBox(0);
            // If required parentBox then return array include cateBox and parentBox
            if($hasParentBox) {
                $data = array(
                    "category" => json_encode((array)$newcate),
                    "categoriesParentBox" => $categoriesParentBox
                );
                echo json_encode($data);
            } else {
                echo json_encode((array)$newcate);
            }
        } else {
            echo 'failure';
        }
    }
}
