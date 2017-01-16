<?php

/**
 *  CodeIgniter 
 *  角色权限
 * @author Han Jian <18335831710@163.com>
 * @date 2016-11-17 23:49:24 
 */

class RoleAuthModel extends MY_Model {
    
    const TABLE_NAME = 'role_auth';
    
    public function __construct() {
        parent::__construct();
    }
    

    public function getAllByRoleId(ARRAY $params=array()){
        if(!isset($params['is_del'])){
            $params['is_del'] = 0;
        }
        $query = $this->db->where($params)->select('auth_id')->get(self::TABLE_NAME);
        return $query->result_array();
    }
    
    public function getAuths(ARRAY $params=array()){
        if(!isset($params['roleIds'])){
            return array();
        }
        $this->db->where('is_del',0);
        $query = $this->db->where_in('role_id',$params['roleIds'])->select('auth_id')->get(self::TABLE_NAME);
        $result = $query->result_array();
        $return = array();
        foreach ($result as $key => $value) {
            if(!isset($return[$value['auth_id']])){
                $return[$value['auth_id']] = $value['auth_id'];
            }
        }
        return $return;
    }
    public function addAuthList(ARRAY $params=array()){
        if(empty($params)){
            return false;
        }
        $this->db->insert_batch(self::TABLE_NAME,$params);
        return $this->db->affected_rows();
    }
    
    public function delAuth(ARRAY $params=array()){
        if(!isset($params['role_id'])){
            return;
        }
        $this->db->where(array('role_id'=>$params['role_id']))
                 ->delete(self::TABLE_NAME);
        return $this->db->affected_rows();
    }
}

