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

        $this->load->model('MUser');
        $this->load->model('MPost');
    }
    
    public function profile() {
        $user = $this->MUser->getUserById($this->session->userdata['cur_user']['id']);
        $data = array(
            "title" => "Update user",
            "content" => "admin/user",
            "user" => $user,
            "action" => "updateUser"
        );
        $this->load->view('admin/template/main', $data);
    }
    
    public function logout() {
        // Destroy user info
        $this->session->unset_userdata('cur_user');
        // Destroy list allowed read protected post
        $this->session->unset_userdata('passPosts');
        header('Location: ' . base_url() . 'user/login', 301);
    }
    
    public function login() {
        // Logged in
        if($this->session->userdata('cur_user')) {
           header('Location: ' . base_url() . 'AdminRedirect', 301);
            return;
        }
        $this->load->view('admin/login');
    }
    
    /**
     * Check login, password post
     */
    public function checkLogin() {
        $action = $this->input->get('action');
        $password = $this->input->post('password');
        
        // Preperation data response to client
        $data = array();
            
        if($action == 'passpost') {
            $postId = $this->input->post('id');
            $post = $this->MPost->getPostById($postId);
            // If post does not existed: redirect to index page
            if(NULL == $post) {
                header('Location: ' . base_url());   
                return;
            }
            // Check password post
            if($post->getPassword() == '' || $post->getPassword() == $password) {
                // Allowed is a array of metadata post_id:password
                $allowed = $this->session->userdata('passPosts') == NULL ? array() : $this->session->userdata('passPosts');
                $allowed[$post->getId()] = $post->getPassword();
                $this->session->set_userdata('passPosts', $allowed);
            }
            header('Location: ' . base_url() . $post->getGuid() . '-' . $post->getId() . '.html');
        } else {
            // Check form input
            $this->form_validation->set_rules('username', 'Username', 'required');
            $this->form_validation->set_rules('password', 'Password', 'required');
            
            // Validation form
            if($this->form_validation->run() == FALSE) {
                $this->load->view('admin/login');
                return;
            }
            
            $username = $this->input->post('username');
            
            // GET user by username and password in DB
            $user = $this->MUser->getUser($username, $password);
            if(NULL == $user) {
                // User does not exist
                $this->session->set_flashdata('flash_error', 'Username or password incorrect');
                header('Location: ' . base_url() . 'user/login', 301);
            } else {
                // Login successful
                $userdata = array(
                    "id" => $user->getId(),
                    "fullName" => $user->getFull_name(),
                    "avatar" => $user->getAvatar()
                );
                $this->session->set_userdata('cur_user', $userdata);
                header('Location: ' . base_url() . 'AdminRedirect', 301);
            }
        }
    }
    
    private function upload_image($image, $dis, $config = array()) {
        $config["upload_path"] = $dis;
        $config["allowed_types"] = "gif|png|jpg|jpeg";
        $config["max_size"] = "900";
        $this->load->library("upload", $config);
        if (!$this->upload->do_upload($image)) {
            echo $this->upload->display_errors();
            return FALSE;
        } else {
            return $this->upload->data()["file_name"];
        }
    }

    public function newUser() {
        $data = array(
            "content" => "admin/user",
            "title" => "Add user",
            "action" => "addUser"
        );
        $this->load->view('admin/template/main', $data);
    }

    public function addUser() {
        // Validation form
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_rules('fullname', 'Fullname', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required');
        // Default data will have response to client
        $data = array(
            "content" => "admin/user",
            "title" => "Add user"
        );
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('admin/template/main', $data);
            return;
        }

        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $fullname = $this->input->post('fullname');
        $desc = $this->input->post('desc');
        $bio = $this->input->post('bio');
        $email = $this->input->post('email');
        $phone = $this->input->post('phone');
        $facebook = $this->input->post('facebook');
        $skype = $this->input->post('skype');
        $google = $this->input->post('google');
        $role = $this->input->post('role');
        
        $avatar = "user.jpg";

        $key = generateRandomString(20);
        $user = new EUser(0, $username, $password, $fullname, $avatar, $desc, $bio, $email, $phone, $facebook, $skype, $google, $key, 0, $role, $non_blocked = 1);
        
        // When have request change avatar then update it
        if ($_FILES['avatar']['error'] == 0) {
            // Upload avatar
            $avatar = $this->upload_image('avatar', './assets/upload/images/avatars');
            if (!$avatar) { // Upload fail
                $this->session->set_flashdata('flash_error', 'Ops! please chose a picture with condition below'
                    . '<br/>Condition:'
                    . '<ul>'
                    . '<li>Extension: png/jpg/gif</li>'
                    . '<li>Quantity: not too 900kb</li>'
                    . '</ul>');
                $this->load->view('admin/template/main', $data);
                return;
            }
            $user->setAvatar($avatar);
        }

        if ($this->MUser->addUser($user)) {
            $this->session->set_flashdata('flash_message', 'Add successful');
            header("Location: " . base_url() . "user/users");
        } else {
            $this->session->set_flashdata('flash_error', 'Username is existed');
        }
        $this->load->view('admin/template/main', $data);
    }
    
    public function users() {
        $search = $this->input->get('search', TRUE);
        $role = $this->input->get('role', TRUE);
        $segment = $this->input->get('p', TRUE);
        
        if(empty($role) || $role == 'all') {
            $role = array("admin", "writer", "customer");
        }
        // Config pagination
        $config["base_url"] = base_url() . "user";
        $config["prefix"] = "users?role=" . (is_array($role) ? "all" : $role) .
                "&search=$search&p=$segment";
        $config["per_page"] = 20;
        $config["cur_page"] = empty($segment) ? 0 : $segment;
        
        $limitCofig = array(
            "records" => $config["per_page"],
            "begin" => $search
        );
        $result = $this->MUser->getUsers($limitCofig, $role, $search);
        $config["total_rows"] = $result["total"];
        
        $this->load->library('pagination');
        $pagination = pagination($config, $this->pagination);
        
        $count = $this->MUser->countByRoles();
        
        $data = array(
            "title" => "Users",
            "content" => "admin/users",
            "users" => $result["users"],
            "total" => $result["total"],
            "links" => $pagination,
            "count" => $count
        );
        $this->load->view('admin/template/main', $data);
    }
    
    public function editUser($user_id) {
        $user = $this->MUser->getUserById($user_id);
        $data = array(
            "title" => "Update user",
            "content" => "admin/user",
            "user" => $user,
            "action" => "updateUser"
        );
        $this->load->view('admin/template/main', $data);
    }
    
    public function updateUser() {
        // Validation form
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_rules('fullname', 'Fullname', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required');
        // Default data will have response to client
        $data = array(
            "content" => "admin/user",
            "title" => "Update user",
            "action" => "updateUser"
        );
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('admin/template/main', $data);
            return;
        }

        $username = trim($this->input->post('username'));
        $password = trim($this->input->post('password'));
        $fullname = trim($this->input->post('fullname'));
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
        $avatar = $this->MUser->getUserById($id)->getAvatar();
        
        $key = generateRandomString(20);
        $user = new EUser($id, $username, $password, $fullname, $avatar, $desc, 
                $bio, $email, $phone, $facebook, $skype, $google, $key, $actived, $role, $blocked);
        
        // When have request change avatar then update it
        if ($_FILES['avatar']['error'] == 0) {
            // Upload avatar
            $avatar = $this->upload_image('avatar', './assets/upload/images/avatars');
            if (!$avatar) { // Upload fail
                $this->session->set_flashdata('flash_error', 'Ops! please chose a picture with condition below'
                    . '<br/>Condition:'
                    . '<ul>'
                    . '<li>Extension: png/jpg/gif</li>'
                    . '<li>Quantity: not too 900kb</li>'
                    . '</ul>');
                $this->load->view('admin/template/main', $data);
                return;
            }
            $user->setAvatar($avatar);
        }
        
        if ($this->MUser->updateUser($user)) {
            $this->session->set_flashdata('flash_message', 'Update successful');
            header("Location: " . base_url() . "user/users");
        } else {
            $this->session->set_flashdata('flash_error', 'Update fail');
        }
        $this->load->view('admin/template/main', $data);
    }
            

}
