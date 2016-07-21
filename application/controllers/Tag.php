<?php

/**
 * Description of Tag
 *
 * @author BaoToan
 */
class Tag extends CI_Controller {
    public function __construct() {
        parent::__construct();
        
        $this->load->model('ETag');
        
        $this->load->model('MTag');
    }
    
    public function tags() {
        $segment = trim($this->input->get('p', TRUE));
        $search = trim($this->input->get('search', TRUE));
        
        // Config pagination
        $config = array();
        $config['base_url'] = base_url() . "tag";
        $config['prefix'] = "tags?p=";
        $config['per_page'] = 20;
        $config['cur_page'] = $segment;
        
        $limitConfig = array(
            "records" => $config['per_page'],
            "begin" => $segment
        );
        $this->load->library("pagination");
        $result = $this->MTag->getTags($limitConfig, $search);
        $config["total_rows"] = $result['total'];
        $data = array(
            "title" => "Tags",
            "content" => "admin/tags",
            "tags" => $result['tags'],
            "links" => pagination($config, $this->pagination),
            "total" => $result['total']
        );
        $this->load->view('admin/template/main', $data);
    }
    
    public function newTag() {
        $name = $this->input->post('name');
        $slug = $this->input->post('slug');
        $desc = $this->input->post('desc');
        
        $tag = new ETag(0, $name, $desc, $slug);
        $tag_id = $this->MTag->addTag($tag);
        
        if($tag_id) {
            echo json_encode($this->MTag->getTagById($tag_id));
        } else {
            echo "failure";
        }
    }
    
    public function deleteTag() {
        $tag_id = $this->input->post('tag_id');
        if($this->MTag->deleteTag($tag_id)) {
            echo "success";
        } else {
            echo "failure";
        }
    }
    
    public function editTag($tag_id) {
        $tag = $this->MTag->getTagById($tag_id);
        $data = array(
            "tag" => $tag,
            "title" => "Cập nhật tag",
            "content" => "admin/tag"
        );
        $this->load->view('admin/template/main', $data);
    }
    
    public function updateTag() {
        $id = $this->input->post('id');
        $name = $this->input->post('name');
        $slug = $this->input->post('slug');
        $desc = $this->input->post('desc');
        $count = $this->input->post('count');
        
        $tag = new ETag($id, $name, $desc, $slug, $count);
        $tag_id = $this->MTag->updateTag($tag);
        
        if($tag_id) {
            $this->session->set_flashdata('flash_message', 'Cập nhật thành công');
            header('Location: ' . base_url() . 'tag/tags', TRUE, 301);
        } else {
            $data = array(
                "tag" => $tag,
                "title" => "Cập nhật tag",
                "content" => "admin/tag"
            );
            $this->session->set_flashdata('flash_error', 'Cập nhật thất bại');
            $this->load->view('admin/template/main', $data);
        }
    }
}
