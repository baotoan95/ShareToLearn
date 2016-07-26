<?php

/**
 * Description of MUserOnline
 *
 * @author BaoToan
 */
class MUserOnline extends Base_Model {
    
    private $timeOut = 900;
    
    public function __construct() {
        parent::__construct();
        
        $this->set_table('user_online', 'uol_user_ip');
        
        $this->load->model('MStatistic');
    }
    
    /**
     * Increase statistic if have new visitor 
     * or update user_online if visitor is old
     * Delete all visitors have timeout
     * @return int
     */
    public function countUserOnline() {
        // Delete all visitor have timeout
        $this->db->where("(" . time() . " - uol_time) >", $this->timeOut);
        $this->db->delete($this->_table['table_name']);
        
        // Insert a visitor if new or update if existed and it in a session
        $isExist = $this->db->query("select uol_user_ip from user_online "
                . "where uol_user_ip = '{$_SERVER['REMOTE_ADDR']}' "
                . "and (" . time() . " - uol_time) < " . $this->timeOut)->row();
        $data = array(
            "uol_user_ip" => $_SERVER['REMOTE_ADDR'],
            "uol_time" => time()
        );
        if($isExist) {
            $this->update($data);
        } else {
            $this->MStatistic->increaseViewForDate(date('Y-m-d'));
            $this->insert($data);
        }
        
        // Get total user online
        $count = $this->db->query('select count(uol_user_ip) as count from user_online')->row();
        return $count ? $count->count : 1;
    }
}
