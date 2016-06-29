<?php

/**
 * Description of UtilModel
 *
 * @author BaoToan
 */
class BaseModel extends CI_Model {

    private $_table;

    public function __construct() {
        parent::__construct();
        $this->load->library('database');
    }

    /**
     * @required set info of table before use this model
     * @param string $table_name
     * @param string $primary_key
     * @return void
     */
    public function set_table($table_name, $primary_key) {
        $this->_table['table_name'] = $table_name;
        $this->_table['primary_key'] = $primary_key;
    }

    public function get_table() {
        return $this;
    }

    public function getByKey($id) {
        $this->db->where($this->_table['primary_key'], $id);
        return $this->db->get($this->_table['table_name'])->result_array();
    }

    public function insert($data) {
        return $this->db->insert($this->_table['table_name'], $data);
    }

    public function getAll() {
        return $this->db->get($this->_table['table_name'])->result_array();
    }

    public function getLimit($record = 10, $begin = 0) {
        $this->db->limit($record, $begin);
        return $this->db->get($this->_table['table_name'])->result_array();
    }

    public function get($fields) {
        $this->db->select(implode(",", $fields));
        return $this->db->get($this->_table['table_name'])->result_array();
    }

    public function delete($id) {
        $this->db->where($this->_table['primary_key'], $id);
        return $this->db->delete($this->_table['table_name']);
    }

    public function update($object) {
        $this->db->where($this->_table['primary_key'], $object[$this->_table['primary_key']]);
        return $this->db->update($this->_table['table_name'], $object);
    }

    public function executeQuery($query) {
        return $this->db->query($query)->result_array();
    }

    public function count($condition) {
        $this->db->where($condition);
        return $this->db->count_all_results($this->_table['table_name'], FALSE);
    }

}
