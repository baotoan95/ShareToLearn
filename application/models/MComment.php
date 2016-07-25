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
        
        $this->load->model('MPost');
        $this->load->model('MUser');
    }
    
    public function addComment($comment) {
        $data = array(
            "cmt_post_id" => $comment->getPostId(),
            "cmt_author" => $comment->getAuthor(),
            "cmt_website" => $comment->getWebsite(),
            "cmt_email" => $comment->getEmail(),
            "cmt_user" => $comment->getUser(),
            "cmt_date" => $comment->getDate(),
            "cmt_status" => $comment->getStatus(),
            "cmt_type" => $comment->getType(),
            "cmt_content" => $comment->getContent(),
            "cmt_parent" => $comment->getParent(),
            "cmt_prev_status" => $comment->getPrev_status()
        );
        // Reduce amount comment for post
        if($comment->getPostId() != 0) {
            $this->MPost->adjustCountComments($comment->getPostId(), '+');
        }
        return $this->insert($data);
    }
    
    public function deleteComment($cmtId) {
        $comment = $this->getCommentById($cmtId);
        $this->db->where('cmt_id', $cmtId);
        $this->db->or_where('cmt_parent', $cmtId);
        
        // Reduce amount comment for post
        if($comment->getPostId() != 0) {
            $this->MPost->adjustCountComments($comment->getPostId(), '-');
        }
        return $this->db->delete($this->_table['table_name']);
    }
    
    public function getCommentById($cmtId) {
        $cmtTemp = $this->getByKey($cmtId);
        if(!empty($cmtTemp)) {
            $user = $this->MUser->getUserById($cmtTemp['cmt_user']);
            $comment = new EComment($cmtTemp['cmt_id'], $cmtTemp['cmt_post_id'], 
                        $cmtTemp['cmt_author'], $cmtTemp['cmt_email'], $cmtTemp['cmt_website'], $user, 
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
        if(array_key_exists('type', $condition) && $condition['type'] != '' && $condition['type'] != 'all') {
            $this->db->where('cmt_type', $condition['type']);
        }
        if(array_key_exists('status', $condition) && $condition['status'] != '' && $condition['status'] != 'all') {
            $this->db->where('cmt_status', $condition['status']);
        } else {
            $status = array("pending", "approved");
            $this->db->where_in('cmt_status', $status);
        }
        if(array_key_exists('search', $condition) && $condition['status'] != '') {
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
            $user = $this->MUser->getUserById($item['cmt_user']);
            $comment = new EComment($item['cmt_id'], $item['cmt_post_id'], 
                    $item['cmt_author'], $item['cmt_email'], $item['cmt_website'], $user, 
                    $item['cmt_date'], $item['cmt_status'], $item['cmt_type'], 
                    $item['cmt_content'], $item['cmt_parent']);
            $comment->setPrev_status($item['cmt_prev_status']);
            $comment->setPost($this->MPost->getPostById($item['cmt_post_id']));
            $comments[] = $comment;
        }
        return array(
            "comments" => $comments,
            "total" => $count
        );
    }
    
    public function countByStatus($status = '') {
        if($status == '') {
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
        } else {
            $count = $this->db->query("select count(cmt_id) as count from comments where cmt_status = '$status'")->row();
            return $count ? $count->count : 0;
        }
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
    
    public function getCommentsByPostId($postId) {
        $this->db->where('cmt_post_id', $postId);
        $this->db->where('cmt_status', 'approved');
        $this->db->where('cmt_type', 'comment');
        $this->db->order_by('cmt_date', 'DESC');
        $data = $this->db->get($this->_table['table_name'])->result_array();
        
        $comments = array(); // Store result
        foreach($data as $item) {
            $user = $this->MUser->getUserById($item['cmt_user']);
            $comment = new EComment($item['cmt_id'], $item['cmt_post_id'], 
                    $item['cmt_author'], $item['cmt_email'], $item['cmt_website'], $user, 
                    $item['cmt_date'], $item['cmt_status'], $item['cmt_type'], 
                    $item['cmt_content'], $item['cmt_parent']);
            $comment->setPrev_status($item['cmt_prev_status']);
            $comments[] = $comment;
        }
        
        return $comments;
    }
    
//    public function generateCommentLevel($comments, $parentId, $level, $html = '') {
//        // Create a temp list
//        $cmtTemps = $comments;
//        // GET list sub comment by parentId search in comments list
//        $subCmts = array();
//        for ($i = 0; $i < count($cmtTemps); $i ++) {
//            // If found: remove it from $comments and add to subCmts
//            if ($comments[$i]->getParent() == $parentId) {
//                unset($comments[$i]);
//                $subCmts[] = $cmtTemps[$i];
//            }
//        }
//        $comments = array_values($comments);
//        
//        // Add list sub comment to html and recursive
//        if(empty($subCmts)) {
//            return "";
//        } else {
//            $html = ($parentId == 0 ? "" : '<ul class = "children">');
//            foreach ($subCmts as $cmt) {
//                if($cmt->getParent() == 0) {
//                    $level = 0;
//                }
//                $html .=
//                            '<li id="cmt_'. $cmt->getId() .'" class="depth-' . $level .'">' .
//                                '<div class="author-avatar"><img alt="" src ="' .
//                                base_url() . "assets/upload/images/avatars/" . 
//                                    ((NULL == $cmt->getUser()) ? "user.jpg" : $cmt->getUser()->getAvatar()) . '"/>' .
//                                '</div>' .
//                                '<div class="comment-author"><a>' . $cmt->getAuthor() . '</a></div>' .
//                                '<div class="comment-date">' . $cmt->getDate() . '</div>' .
//                                '<div class="comment-text"><p>' . $cmt->getContent() . '</p></div>' .
//                                '<div class="comment-reply"><a class="comment-reply-link" rel="nofollow" href="' . $cmt->getId() . '">reply</a></div>' .
//                                $this->generateCommentLevel($comments, $cmt->getId(), ++$level, $html) .
//                            '</li>';
//                $level--;
//            }
//            return $html .= ($parentId == 0 ? "" : "</ul>");
//        }
//    }
    
    
    
    public function generateCommentLevel($comments, $parentId, $level, $html = '') {
        // Create a temp list
        $cmtTemps = $comments;
        // GET list sub comment by parentId search in comments list
        $subCmts = array();
        for ($i = 0; $i < count($cmtTemps); $i ++) {
            // If found: remove it from $comments and add to subCmts
            if ($comments[$i]->getParent() == $parentId) {
                unset($comments[$i]);
                $subCmts[] = $cmtTemps[$i];
            }
        }
        $comments = array_values($comments);
        
        // Add list sub comment to html and recursive
        if(empty($subCmts)) {
            return "";
        } else {
            $html = ($parentId == 0 ? "" : '<ul>');
            foreach ($subCmts as $cmt) {
                if($cmt->getParent() == 0) {
                    $level = 0;
                }
                $html .=    '<li id="cmt_'. $cmt->getId() .'">' .
                                '<div class="item">' .
                                    '<a href="#" class="image"><img src="' .
                                    base_url() . "assets/upload/images/avatars/" . 
                                    ((NULL == $cmt->getUser()) ? "user.jpg" : $cmt->getUser()->getAvatar()) . '"></a>' .
                                    '<div class="comment">' .
                                        '<div class="info">' .
                                            '<h2><a>' . $cmt->getAuthor() . '</a></h2>' .
                                            '<span class="legend-default"><i class="fa fa-clock-o"></i>' . $cmt->getDate() . '</span>' .
                                            '<span class="nr"></span>' .
                                        '</div>' .
                                        '<p>' .
                                            $cmt->getContent() .
                                            '<a href="' . $cmt->getId() . '" class="reply-link">Reply</a>' .
                                        '</p>' .
                                    '</div>' .
                                '</div>' .
                                $this->generateCommentLevel($comments, $cmt->getId(), ++$level, $html) .
                            '</li>';
                $level--;
            }
            return $html .= ($parentId == 0 ? "" : "</ul>");
        }
    }
    
}
