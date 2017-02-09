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
        if(!isset($params['is_del'])){
            $params['is_del'] = 0;
        }
        $query = $this->db->where($params)->select('admin_id')->get(self::TABLE_NAME);
        return $query->result_array();
    }
    
    public function getRoleIds(ARRAY $params=array()){
        if(!isset($params['is_del'])){
            $params['is_del'] = 0;
        }
        $query = $this->db->where($params)->select('role_id')->get(self::TABLE_NAME);
        $result = $query->result_array();
        $return = array();
        foreach ($result as $key => $value) {
            $return[]=$value['role_id'];
        }
        return $return;
    }
    public function addAdminList(ARRAY $params=array()){
        if(empty($params)){
            return false;
        }
        $this->db->insert_batch(self::TABLE_NAME,$params);
        return $this->db->affected_rows();
    }
    
    public function delAdmin(ARRAY $params=array()){
        if(!isset($params['role_id'])){
            return;
        }
        $this->db->where(array('role_id'=>$params['role_id']))
                 ->update(self::TABLE_NAME,array('is_del'=>1));
        return $this->db->affected_rows();
    }
}

