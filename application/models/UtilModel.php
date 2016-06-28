<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of UtilModel
 *
 * @author BaoToan
 */
class UtilModel {
    protected $_table;
    
    public function __construct() {
        parent::__construct();
    }
    
    public function getByKey($id) {
        $this -> db -> where(_table['primary_key'], $id);
        return $this -> db -> get(_table['table_name']);
    }
}
