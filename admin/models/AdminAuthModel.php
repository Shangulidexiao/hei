<?php

/**
 *  CodeIgniter 
 *  用户权限
 * @author Han Jian <18335831710@163.com>
 * @date 2016-11-28 17:21:24 
 */

class AdminAuthModel extends MY_Model {
    
    const TABLE_NAME = 'admin_auth';
    
    public function __construct() {
        parent::__construct();
    }
    

    public function getAllByAdminId(ARRAY $params=array(),$select='auth_id'){
       return parent::getAll($params,$select);
    }
    
    public function getAuths(ARRAY $params=array()){
        if(!isset($params['adminId'])){
            return array();
        }
        $this->db->where('is_del',0);
        $query = $this->db->where('admin_id',$params['adminId'])->select('auth_id')->get(self::TABLE_NAME);
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
        if(!isset($params['admin_id'])){
            return;
        }
        $this->db->where(array('admin_id'=>$params['admin_id']))
                 ->update(self::TABLE_NAME,array('is_del'=>1));
        return $this->db->affected_rows();
    }
}

