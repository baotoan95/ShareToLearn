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

        $this->load->model('mComment');
    }

    public function addComment() {
        $website = $this->input->post('website');
        $author = $this->input->post('name');
        $email = $this->input->post('email');
        $content = $this->input->post('content');
        $postId = $this->input->post('postId');
        $parent = $this->input->post('parent');

        $comment = new EComment(0, $postId, $author, $email, $website, 1, date('y-m-d H:i:s'), 'pending', 'comment', $content, $parent);
        $comment->setPrev_status('pending');

        if ($this->mComment->addComment($comment)) {
            echo "success";
        } else {
            echo "failure";
        }
    }

    public function reply() {
        $id = $this->input->post('id');
        $content = $this->input->post('content');

        // Create sub comment from parent comment
        $comment = $this->mComment->getCommentById($id);
        $comment->setDate(date('y-m-d H:i:s'));
        $comment->setContent($content);
        // SET parent two level
        $comment->setParent($comment->getParent() != 0 ? $comment->getParent() : $id);
        $comment->setAuthor('Admin');
        $comment->setEmail('support@admin.com');
        $comment->setPrev_status('');

        if ($this->mComment->addComment($comment)) {
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
            "per_page" => 2,
            "cur_page" => $segment,
            "base_url" => base_url() . "comment",
            "prefix" => "comments?p="
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
        $result = $this->mComment->getComments($condition, $limitConfig);
        $config['total_rows'] = $result['total'];

        // Init data response to client
        $data = array(
            "title" => "Danh sách phản hồi",
            "content" => "admin/comments",
            "count" => $this->mComment->countByStatus(),
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

        if ($this->mComment->deleteComment($cmt_id)) {
            echo json_encode($this->mComment->countByStatus());
        } else {
            echo 'failure';
        }
    }

    public function editComment($cmtId) {
        $comment = $this->mComment->getCommentById($cmtId);
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

        if ($this->mComment->updateComment($comment)) {
            $this->session->set_flashdata('flash_message', 'Cập nhật thành công.');
            header('Location: ' . base_url() . 'comment/comments', 301);
        } else {
            $this->session->set_flashdata('flash_message', 'Cập nhật chưa thành công, vui lòng điền đầy đủ thông tin và thử lại.');
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
        $comment = $this->mComment->getCommentById($cmtId);

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
            if ($this->mComment->updateComment($comment)) {
                echo json_encode($this->mComment->countByStatus());
            } else {
                echo "failure";
            }
        } else {
            if ($this->mComment->updateComment($comment)) {
                $this->session->set_flashdata('flash_message', 'Đã di chuyển tới thùng rác');
            } else {
                $this->session->set_flashdata('flash_error', 'Thao tác thất bại');
            }
            header('Location: ' . base_url() . 'comment/comments', 301);
        }
    }

}
