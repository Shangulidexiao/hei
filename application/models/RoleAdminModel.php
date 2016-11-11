<?php

/**
 *  CodeIgniter 
 *  角色人员
 * @author Han Jian <18335831710@163.com>
 * @date 2016-11-9 18:56:24 
 */

class RoleAdminModel extends MY_Model {
    
    const TABLE_NAME = 'admin_role';
    
    public function __construct() {
        parent::__construct();
    }
    

    public function getList(ARRAY $params=array()){
        $query = $this->db->where($params)->select('admin_id')->get(self::TABLE_NAME);
        return $query->result_array();
    }
}

