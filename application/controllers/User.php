<?php

/**
 * Description of User
 *
 * @author BaoToan
 */
class User extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->model('EUser');

        $this->load->model('mUser');
    }

    public function newUser() {
        $data = array(
            "content" => "admin/user",
            "title" => "Thêm người dùng"
        );
        $this->load->view('admin/template/main', $data);
    }

    public function addUser() {
        // Validation form
        $this->form_validation->set_rules('username', 'Tên tài khoản', 'required');
        $this->form_validation->set_rules('password', 'Mật khẩu', 'required');
        $this->form_validation->set_rules('fullname', 'Họ và tên', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required');
        // Default data will have response to client
        $data = array(
            "content" => "admin/user",
            "title" => "Thêm người dùng"
        );
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('admin/template/main', $data);
            return;
        }

        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $fullname = $this->input->post('fullname');
        $avatar = $this->input->post('avatar');
        $desc = $this->input->post('desc');
        $bio = $this->input->post('bio');
        $email = $this->input->post('email');
        $phone = $this->input->post('phone');
        $facebook = $this->input->post('facebook');
        $skype = $this->input->post('skype');
        $google = $this->input->post('google');
        $role = $this->input->post('role');

        $key = generateRandomString(20);
        $user = new EUser(0, $username, $password, $fullname, $avatar, $desc, $bio, $email, $phone, $facebook, $skype, $google, $key, 0, $role, $non_blocked = 1);

        if ($this->mUser->addUser($user)) {
            $this->session->set_flashdata('flash_message', 'Đã thêm một người dùng thành công');
            header("Location: " . base_url() . "user/users");
        } else {
            $this->session->set_flashdata('flash_error', 'Tên tài khoản đã tồn tại');
        }
        $this->load->view('admin/template/main', $data);
    }
    
    public function users() {
        $search = $this->input->get('search', TRUE);
        $role = $this->input->get('role', TRUE);
        $segment = $this->input->get('p', TRUE);
        
        if(empty($role) || $role = 'all') {
            $role = array("admin", "writer", "customer");
        }
        // Config pagination
        $config["base_url"] = base_url() . "user";
        $config["prefix"] = "users?role=" . (is_array($role) ? "all" : $role) .
                "&search=$search&p=$segment";
        $config["per_page"] = 2;
        $config["cur_page"] = empty($segment) ? 0 : $segment;
        
        $limitCofig = array(
            "records" => $config["per_page"],
            "begin" => $search
        );
        $result = $this->mUser->getUsers($limitCofig, $role, $search);
        $config["total_rows"] = $result["total"];
        
        $this->load->library('pagination');
        $pagination = pagination($config, $this->pagination);
        
        $count = $this->mUser->countByRoles();
        
        $data = array(
            "title" => "Danh sách người dùng",
            "content" => "admin/users",
            "users" => $result["users"],
            "total" => $result["total"],
            "links" => $pagination,
            "count" => $count
        );
        $this->load->view('admin/template/main', $data);
    }
    
    public function editUser($user_id) {
        $user = $this->mUser->getUserById($user_id);
        $data = array(
            "title" => "Cập nhật người dùng",
            "content" => "admin/user",
            "user" => $user
        );
        $this->load->view('admin/template/main', $data);
    }
    
    public function updateUser() {
        // Validation form
        $this->form_validation->set_rules('username', 'Tên tài khoản', 'required');
        $this->form_validation->set_rules('password', 'Mật khẩu', 'required');
        $this->form_validation->set_rules('fullname', 'Họ và tên', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required');
        // Default data will have response to client
        $data = array(
            "content" => "admin/user",
            "title" => "Cập nhật người dùng"
        );
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('admin/template/main', $data);
            return;
        }

        $username = trim($this->input->post('username'));
        $password = trim($this->input->post('password'));
        $fullname = trim($this->input->post('fullname'));
        $avatar = $this->input->post('avatar');
        $desc = trim($this->input->post('desc'));
        $bio = trim($this->input->post('bio'));
        $email = $this->input->post('email');
        $phone = $this->input->post('phone');
        $facebook = $this->input->post('facebook');
        $skype = $this->input->post('skype');
        $google = $this->input->post('google');
        $role = $this->input->post('role');
        $id = $this->input->post('id');
        $blocked = $this->input->post('blocked');
        $actived = $this->input->post('actived');

        $key = generateRandomString(20);
        $user = new EUser($id, $username, $password, $fullname, $avatar, $desc, 
                $bio, $email, $phone, $facebook, $skype, $google, $key, $actived, $role, $blocked);
        
        
        if ($this->mUser->updateUser($user)) {
            $this->session->set_flashdata('flash_message', 'Cập nhật thành công');
            header("Location: " . base_url() . "user/users");
        } else {
            $this->session->set_flashdata('flash_error', 'Cập nhật không thành công');
        }
        $this->load->view('admin/template/main', $data);
    }
            

}
