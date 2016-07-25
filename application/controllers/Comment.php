<?php

/**
 * Description of Commnet
 *
 * @author BaoToan
 */
class Comment extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->model('EComment');

        $this->load->model('MComment');
    }

    public function addComment() {
        // Validation form
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('content', 'Content', 'required');
        
        if($this->form_validation->run() == FALSE) {
            echo validation_errors();
            return;
        }
        
        $website = htmlentities($this->input->post('website'));
        $author = htmlentities($this->input->post('name'));
        $email = htmlentities($this->input->post('email'));
        $content = htmlentities($this->input->post('content'));
        $postId = intval($this->input->post('postId'));
        $parent = intval($this->input->post('parent'));
        $type = htmlentities($this->input->post('type'));
        $user = 0;
        
        if($this->session->userdata('cur_user')) {
            $user = $this->session->userdata('cur_user')['id'];
        }
        
        $comment = new EComment(0, $postId, $author, $email, $website, $user, date('y-m-d H:i:s'), 'pending', $type, $content, $parent);
        $comment->setPrev_status('pending');
        
        $id_last_insert = $this->MComment->addComment($comment); // Get id after insert
        if ($id_last_insert) {
            $this->session->set_userdata('count_discussion_unapproved', $this->MComment->countByStatus('pending'));
            echo $id_last_insert;
        } else {
            echo "failure";
        }
    }

    /**
     * Just for admin
     */
    public function reply() {
        $id = $this->input->post('id');
        $content = $this->input->post('content');

        // Create sub comment from parent comment
        $comment = $this->MComment->getCommentById($id);
        $comment->setDate(date('y-m-d H:i:s'));
        $comment->setContent($content);
        // SET parent two level
        $comment->setParent($comment->getParent() != 0 ? $comment->getParent() : $id);
        $comment->setAuthor('Admin');
        $comment->setEmail('support@admin.com');
        $comment->setPrev_status('');

        if ($this->MComment->addComment($comment)) {
            echo json_encode($comment);
        } else {
            echo "failure";
        }
    }

    public function comments() {
        // Load pagination library
        $this->load->library('pagination');
        // GET request from client
        $status = $this->input->get('status', TRUE);
        $type = $this->input->get('type', TRUE);
        $segment = $this->input->get('p', TRUE);
        $search = $this->input->get('search', TRUE);

        // Config pagination
        $config = array(
            "per_page" => 20,
            "cur_page" => $segment,
            "base_url" => base_url() . "comment",
            "prefix" => "comments?status=$status&type=$type&search=$search&p="
        );

        $condition = array(
            "status" => $status,
            "type" => $type,
            "search" => $search
        );
        $limitConfig = array(
            "records" => $config['per_page'],
            "begin" => $segment
        );
        // GET result from DB by conditions and limit result
        $result = $this->MComment->getComments($condition, $limitConfig);
        $config['total_rows'] = $result['total'];

        // Init data response to client
        $data = array(
            "title" => "Discussion",
            "content" => "admin/comments",
            "count" => $this->MComment->countByStatus(),
            "comments" => $result['comments'],
            "total" => $result['total'],
            "links" => pagination($config, $this->pagination), // Init pagination helper
            "type" => $type,
            "search" => $search,
            "status" => $status
        );
        $this->load->view('admin/template/main', $data);
    }

    public function deleteComment() {
        $cmt_id = $this->input->post('id');

        if ($this->MComment->deleteComment($cmt_id)) {
            echo json_encode($this->MComment->countByStatus());
        } else {
            echo 'failure';
        }
    }

    public function editComment($cmtId) {
        $comment = $this->MComment->getCommentById($cmtId);
        $data = array(
            "content" => "admin/comment",
            "comment" => $comment
        );
        $this->load->view('admin/template/main', $data);
    }

    public function updateComment() {
        // Init data for new comment object to update
        $comment = new EComment();
        $comment->setId($this->input->post('id'));
        $comment->setAuthor($this->input->post('author'));
        $comment->setEmail($this->input->post('email'));
        $comment->setContent($this->input->post('content'));
        $comment->setStatus($this->input->post('status'));
        $comment->setDate(date('y-m-d H:i:s'));

        if ($this->MComment->updateComment($comment)) {
            $this->session->set_flashdata('flash_message', 'Update successful');
            header('Location: ' . base_url() . 'comment/comments', 301);
        } else {
            $this->session->set_flashdata('flash_message', 'Update fail, please fill all fields required.');
            $data = array(
                "content" => "admin/comment",
                "comment" => $comment
            );
            $this->load->view('admin/template/main', $data);
        }
    }

    public function changeStatus() {
        $cmtId = $this->input->get('id', TRUE);
        $status = $this->input->get('status', TRUE);
        $comment = $this->MComment->getCommentById($cmtId);

        $statusAccepted = array("pending", "approved", "spam", "trash"); // List status accepted
        // Request change status
        if (in_array($status, $statusAccepted)) {
            // Prevous status just be pending or approved
            if($comment->getStatus() != 'spam' && $comment->getStatus() != 'trash') {
                $comment->setPrev_status($comment->getStatus());
            }
            $comment->setStatus($status);
        } else if($status == 'restore') { // Request restore status
            $comment->setStatus($comment->getPrev_status());
        }

        // Check request is ajax and update comment
        if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) &&
                !empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&
                strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
            if ($this->MComment->updateComment($comment)) {
                echo json_encode($this->MComment->countByStatus());
            } else {
                echo "failure";
            }
        } else {
            if ($this->MComment->updateComment($comment)) {
                $this->session->set_flashdata('flash_message', 'Moved to trash');
            } else {
                $this->session->set_flashdata('flash_error', 'Manipulation fail');
            }
            header('Location: ' . base_url() . 'comment/comments', 301);
        }
    }

}
