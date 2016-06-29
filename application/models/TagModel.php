<?php

/**
 * Description of TagModel
 *
 * @author BaoToan
 */
class TagModel extends BaseModel {
    public function __construct() {
        parent::__construct();
        $this->set_table('terms', 't_id');
    }
    
    public function getTag($fields, $slug) {
        return $this->get(array("t_slug" => $slug), $fields);
    }
    
    public function addTerm($tags = array()) {
        echo $tags[0];
        for($i = 0; $i < count($tags); $i++) {
            $this->db->trans_start();
            $this->db->from($this->_table['table_name']);
            $this->db->join('term_taxonomy', 'term_taxonomy.tt_term_id = terms.t_id');
            $this->db->where('tt_term_id', $tags[$i]);
            if($this->db->count_all_results() == 0) {
                $tag = array(
                    "t_name" => $tags[$i],
                    "t_slug" => convert_vi_to_en($tags[$i])
                );
                $this->insert($tag);
                $term_taxonomy = array(
                    "tt_term_id" => $tags[$i],
                    "tt_taxonomy_name" => "tag",
                    "tt_desc" => "tag",
                    "tt_parent" => 0,
                    "tt_count" => 0
                );
                $this->insert($term_taxonomy);
            }
            $this->db->trans_complete();
        }
    }
}
