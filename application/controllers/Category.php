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
    
    public function addCategory() {
        $name = $this->input->post('newcate');
        $parent = $this->input->post('parent_cate');
        $categories = array(new ECategory(0, trim($name), '', '', trim($parent)));
        if($this->mCategory->addCategories($categories, 'category')) {
            echo 'success';
        } else {
            echo 'failure';
        }
    }
}
