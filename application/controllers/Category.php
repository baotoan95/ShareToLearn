<?php

/**
 * Description of Category
 *
 * @author BaoToan
 */
class Category extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('termModel');
    }
    
    public function addCategory() {
        $category = array(
            "t_name" => get_data_by_post('newcate'),
            "t_slug" => convert_vi_to_en(get_data_by_post('newcate'), true)
        );
        $parent = get_data_by_post('parent_cate');
        $this->termModel->addTerm($category, 'category');
    }
}
