<?php

/**
 * Description of MStatistic
 *
 * @author BaoToan
 */
class MStatistic extends Base_Model {
    public function __construct() {
        parent::__construct();
        $this->load->model('EStatistic');
        
        $this->set_table('statistic', 'stt_date');
    }
    
    public function increaseViewForDate($date) {
        $isExist = $this->db->query("select stt_date from statistic where stt_date = '$date'")->row();
        if(!$isExist) {
            $data = array(
                "stt_date" => $date,
                "stt_count" => 0
            );
            $this->insert($data);
        }
        
        $this->db->query("update statistic set stt_count = (stt_count + 1) where stt_date = '$date'");
    }
    
    public function getStatisticByDate($date) {
        $this->db->where('stt_date', $date);
        $this->db->limit(1, 0);
        $rs = $this->db->get($this->_table['table_name'])->row_array();
        // Count total
        $total = $this->db->query('select sum(stt_count) as count from statistic')->row();
        $total = $total ? $total->count : 0;
        $yesterday = $this->db->query("select stt_count as count from statistic stt where stt_date = SUBDATE(STR_TO_DATE('$date', '%Y-%m-%d'),INTERVAL 1 DAY)")->row();
        $yesterday = $yesterday ? $yesterday->count : 0;
        if(empty($rs)) {
            return new EStatistic(date('H:i:s'), 0, $total, $yesterday);
        }
        return new EStatistic($rs['stt_date'], $rs['stt_count'], $total, $yesterday);
    }
}
