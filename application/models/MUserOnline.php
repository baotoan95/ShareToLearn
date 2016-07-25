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
    
    public function countUserOnline() {
        // Insert a visitor if new or update if existed
        $isExist = $this->db->query("select uol_user_ip from user_online where uol_user_ip = '{$_SERVER['REMOTE_ADDR']}'")->row();
        $data = array(
            "uol_user_ip" => $_SERVER['REMOTE_ADDR'],
            "uol_time" => time()
        );
        if($isExist) {
            $this->update($data);
        } else {
            $this->MStatistic->increaseViewForDate(date('Y-m-d'));
            echo $this->insert($data);
        }
        
        // Delete all visitor have lost timeout
        $this->db->where("(" . time() . " - uol_time) >", $this->timeOut);
        $this->db->delete($this->_table['table_name']);
        
        // Get total user online
        $count = $this->db->query('select count(uol_user_ip) as count from user_online')->row();
        return $count ? $count->count : 1;
    }
}
