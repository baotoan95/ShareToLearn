<?php

require_once 'Base_Model.php';

/**
 * Description of MUser
 *
 * @author BaoToan
 */
class MUser extends Base_Model {

    public function __construct() {
        parent::__construct();
        $this->set_table('users', 'u_id');
        
        $this->load->model('EUser');

        $this->load->model('mPost');
    }

    public function addUser($user) {
        $data = array(
            "u_username" => $user->getUsername(),
            "u_password" => $user->getPassword(),
            "u_fullname" => $user->getFull_name(),
            "u_avatar" => $user->getAvatar(),
            "u_desc" => $user->getDesc(),
            "u_bio" => $user->getBio(),
            "u_email" => $user->getEmail(),
            "u_phone" => $user->getPhone(),
            "u_facebook" => $user->getFacebook(),
            "u_skype" => $user->getSkype(),
            "u_google" => $user->getGoogle(),
            "u_key" => $user->getKey(),
            "u_actived" => $user->getActived(),
            "u_role" => $user->getRole(),
            "u_non_blocked" => $user->getNon_Blocked()
        );
        return $this->insert($data);
    }

    /**
     * 
     * @param array $limitConfig (records, begin)
     * @param string $role 
     * @param string $username
     */
    public function getUsers($limitConfig = array(), $role = NULL, $username = NULL) {
        $this->db->select('SQL_CALC_FOUND_ROWS *', FALSE);
        // Condition
        if ($role != NULL) {
            $this->db->where_in('u_role', $role);
        }
        if ($username != NULL) {
            $this->db->group_start();
            $this->db->or_like('u_username', $username, 'before');
            $this->db->like('u_username', $username);
            $this->db->or_like('u_username', $username, 'after');
            $this->db->group_end();
        }
        if (count($limitConfig) == 2) {
            $this->db->limit($limitConfig['records'], $limitConfig['begin']);
        }
        // Execute query
        $data = $this->db->get($this->_table['table_name'])->result_array();
        $total = $this->db->query('select FOUND_ROWS() as count')->row()->count;

        $users = array();
        foreach ($data as $user) {
            $users[] = new EUser($user['u_id'], $user['u_username'], $user['u_password'], 
                    $user['u_fullname'], $user['u_avatar'], $user['u_desc'], $user['u_bio'], 
                    $user['u_email'], $user['u_phone'], $user['u_facebook'], $user['u_skype'], 
                    $user['u_google'], $user['u_key'], $user['u_actived'], $user['u_role'], $user['u_non_blocked'],
                    $this->mPost->countPostByUserId($user['u_id']));
        }

        return array(
            "users" => $users,
            "total" => $total
        );
    }
    
    public function getUserById($user_id) {
        $rs = $this->getByKey($user_id);
        $user = new EUser($rs['u_id'], $rs['u_username'], $rs['u_password'], 
                    $rs['u_fullname'], $rs['u_avatar'], $rs['u_desc'], $rs['u_bio'], 
                    $rs['u_email'], $rs['u_phone'], $rs['u_facebook'], $rs['u_skype'], 
                    $rs['u_google'], $rs['u_key'], $rs['u_actived'], $rs['u_role'], $rs['u_non_blocked'],
                    $this->mPost->countPostByUserId($user_id));
        return $user;
    }
    
    public function countByRoles() {
        $this->db->select("u_role as name, count(u_role) as value");
        $this->db->group_by("u_role");
        $count = $this->db->get($this->_table['table_name'])->result_array();
        
        $total = 0;
        $result = array();
        foreach($count as $c) {
            $result[$c['name']] = $c['value'];
            $total += intval($c['value']);
        }
        $result['total'] = $total;
        return $result;
    }
    
    public function updateUser($user) {
        $data = array(
            "u_id" => $user->getId(),
            "u_username" => $user->getUsername(),
            "u_password" => $user->getPassword(),
            "u_fullname" => $user->getFull_name(),
            "u_avatar" => $user->getAvatar(),
            "u_desc" => $user->getDesc(),
            "u_bio" => $user->getBio(),
            "u_email" => $user->getEmail(),
            "u_phone" => $user->getPhone(),
            "u_facebook" => $user->getFacebook(),
            "u_skype" => $user->getSkype(),
            "u_google" => $user->getGoogle(),
            "u_key" => $user->getKey(),
            "u_actived" => $user->getActived(),
            "u_role" => $user->getRole(),
            "u_non_blocked" => $user->getNon_Blocked()
        );
        return $this->update($data);
    }

}