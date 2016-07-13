<?php
require_once 'Base_Model.php';

/**
 * Description of MComment
 *
 * @author BaoToan
 */
class MComment extends Base_Model {
    public function __construct() {
        parent::__construct();
        
        $this->load->model('EComment');
        
        $this->set_table('comments', 'cmt_id');
    }
    
    public function addComment($comment) {
        $data = array(
            "cmt_post_id" => $comment->getPostId(),
            "cmt_author" => $comment->getAuthor(),
            "cmt_website" => $comment->getWebsite(),
            "cmt_email" => $comment->getEmail(),
            "cmt_user_id" => $comment->getUserId(),
            "cmt_date" => $comment->getDate(),
            "cmt_status" => $comment->getStatus(),
            "cmt_type" => $comment->getType(),
            "cmt_content" => $comment->getContent(),
            "cmt_parent" => $comment->getParent()
        );
        return $this->insert($data);
    }
    
    public function deleteComment($cmtId) {
        $this->db->where('cmt_id', $cmtId);
        $this->db->or_where('cmt_parent', $cmtId);
        return $this->db->delete($this->_table['table_name']);
    }
    
    public function getCommentById($cmtId) {
        $cmtTemp = $this->getByKey($cmtId);
        if(!empty($cmtTemp)) {
            $comment = new EComment($cmtTemp['cmt_id'], $cmtTemp['cmt_post_id'], 
                        $cmtTemp['cmt_author'], $cmtTemp['cmt_email'], $cmtTemp['cmt_website'], $cmtTemp['cmt_user_id'], 
                        $cmtTemp['cmt_date'], $cmtTemp['cmt_status'], $cmtTemp['cmt_type'], 
                        $cmtTemp['cmt_content'], $cmtTemp['cmt_parent']);
            $comment->setPrev_status($cmtTemp['cmt_prev_status']);
            return $comment;
        }
        return null;
    }
    
    /**
     * 
     * @param array $condition [type, status, search]
     * @param array $limitConfig [records, begin]
     * @return array list comments was limit and total before limit of them
     */
    public function getComments($condition, $limitConfig) {
        $this->db->select('SQL_CALC_FOUND_ROWS *', FALSE);
        
        // Check condition
        if(isset($condition['type']) && $condition['type'] != '' && $condition['type'] != 'all') {
            $this->db->where('cmt_type', $condition['type']);
        }
        if(isset($condition['status']) && $condition['status'] != '' && $condition['status'] != 'all') {
            $this->db->where('cmt_status', $condition['status']);
        } else {
            $status = array("pending", "approved");
            $this->db->where_in('cmt_status', $status);
        }
        if(isset($condition['search']) && $condition['status'] != '') {
            $this->db->group_start();
            $this->db->like('cmt_content', $condition['search'], 'before');
            $this->db->or_like('cmt_content', $condition['search']);
            $this->db->or_like('cmt_content', $condition['search'], 'after');
            $this->db->group_end();
        }
        $this->db->order_by('cmt_date', 'DESC');
        $this->db->limit($limitConfig['records'], $limitConfig['begin']);
        $data = $this->db->get($this->_table['table_name'])->result_array();
        $count = $this->db->query('select FOUND_ROWS() as count')->row()->count;
        
        $comments = array();
        foreach($data as $item) {
            $comment = new EComment($item['cmt_id'], $item['cmt_post_id'], 
                    $item['cmt_author'], $item['cmt_email'], $item['cmt_website'], $item['cmt_user_id'], 
                    $item['cmt_date'], $item['cmt_status'], $item['cmt_type'], 
                    $item['cmt_content'], $item['cmt_parent']);
            $comment->setPrev_status($item['cmt_prev_status']);
            $comments[] = $comment;
        }
        return array(
            "comments" => $comments,
            "total" => $count
        );
    }
    
    public function countByStatus() {
        $this->db->select('cmt_status as name, count(cmt_id) as value');
        $this->db->group_by("cmt_status");
        $data = $this->db->get($this->_table['table_name'])->result_array();
        
        // Filter data
        $result = array();
        $total = 0;
        foreach($data as $i) {
            $result[$i['name']] = $i['value'];
            if($i['name'] != 'trash' && $i['name'] != 'spam') {
                $total += intval($i['value']);
            }
        }
        $result['total'] = $total;
        return $result;
    }
    
    public function updateComment($comment) {
        $data = array(
            "cmt_id" => $comment->getId(),
            "cmt_author" => $comment->getAuthor(),
            "cmt_email" => $comment->getEmail(),
            "cmt_content" => $comment->getContent(),
            "cmt_status" => $comment->getStatus(),
            "cmt_prev_status" => $comment->getPrev_status(),
            "cmt_date" => $comment->getDate()
        );
        return $this->update($data);
    }
    
}
