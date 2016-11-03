<?php

/**
 *  CodeIgniter 
 * 
 * @author Han Jian <18335831710@163.com>
 * @date 2016-10-19 19:55:27
 */
class MenuModel extends MY_Model {
    
    const TABLE_NAME = 'auth';
    public function __construct() {
        parent::__construct();
    }
    
    public function getMenuAll(ARRAY $params = array()){
        $query = $this->db->get(self::TABLE_NAME)->result_array();
        return $query;
    }
    public function getMenu(ARRAY $params = array()){
        if(empty($params)){
            return false;
        }
        $query = $this->db->get(self::TABLE_NAME)->result_array();
        return $query;
    }
}

