<?php

/**
 * Description of UtilModel
 *
 * @author BaoToan
 */
class BaseModel extends CI_Model {

    protected $_table = array();

    public function __construct() {
        parent::__construct();
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

    /**
     * @param object $id (primary key)
     * @return record have primary key is $id
     */
    public function getByKey($id) {
        $this->db->where($this->_table['primary_key'], $id);
        return $this->db->get($this->_table['table_name'])->result_array();
    }

    /**
     * @param array $data
     * @return number Id of current record
     */
    public function insert($data) {
        $this->db->insert($this->_table['table_name'], $data);
        return $this->db->insert_id();
    }

    /**
     * @return array records in current table
     */
    public function getAll() {
        return $this->db->get($this->_table['table_name'])->result_array();
    }

    /**
     * @param int $record
     * @param int $begin
     * @return array records in current table limit 0, 10
     */
    public function getLimit($record = 10, $begin = 0) {
        $this->db->limit($record, $begin);
        return $this->db->get($this->_table['table_name'])->result_array();
    }

    /**
     * @param array $condition
     * @param array $fields
     * @return array records with brove fields
     */
    public function get($condition, $fields) {
        $this->db->select($fields);
        $this->db->where($condition);
        return $this->db->get($this->_table['table_name'])->result_array();
    }

    /**
     * @param primary key $id
     * @return true if delete success, else...
     */
    public function delete($id) {
        $this->db->where($this->_table['primary_key'], $id);
        return $this->db->delete($this->_table['table_name']);
    }

    /**
     * @param array data of $object
     * @return true if update success, else...
     */
    public function update($object) {
        $this->db->where($this->_table['primary_key'], $object[$this->_table['primary_key']]);
        return $this->db->update($this->_table['table_name'], $object);
    }

    /**
     * @param string $query
     * @return result of query after it executed
     */
    public function executeQuery($query) {
        return $this->db->query($query)->result_array();
    }

    /**
     * @param array $condition
     * @return int (number of result matches to brove condition)
     */
    public function count($condition) {
        $this->db->where($condition);
        return $this->db->count_all_results($this->_table['table_name'], FALSE);
    }

}
