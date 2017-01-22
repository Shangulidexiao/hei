<?php

/* 
 * 后台人员MODEL类
 */

class AdminModel extends MY_Model {
    
    const TABLE_NAME = 'admin'; //表名
    
    public function __construct() {
        parent::__construct();
    }
    
    public function add(ARRAY $params=array()){
        if(empty($params) || empty($params['user_name'])){
           return false; 
        }
        $params['last_time']    = empty($params['last_time']) ? time() : $params['last_time'];
        $params['create_time']  = empty($params['create_time']) ? time() : $params['create_time'];
        $this->db->insert(self::TABLE_NAME,$params);
        echo $this->db->last_query();
        return $this->db->insert_id();
    }
    
    public function update(ARRAY $params=array()){
        if(empty($params) || empty($params['id'])){
            return false;
        }
        $id = $params['id'];
        unset($params['id']);
        if(isset($params['create_id'])){
            unset($params['create_id']);
        }
        if(isset($params['create_time'])){
            unset($params['create_time']);
        }
        $params['update_time'] = empty($params['update_time']) ? time() : $params['update_time'];
        $this->db->where('id',$id)->update(self::TABLE_NAME,$params);
        
        return $this->db->affected_rows();
    }
   
    public function getList(ARRAY $params=array()){
        if(!isset($params['is_del'])){
            $this->db->where('is_del',0);
        }else{
            $this->db->where('is_del',(int)$params['is_del']);
        }
        $query = $this->db->where($params)->select('id,user_name')->get(self::TABLE_NAME);
        return $query->result_array();
    }
    
}

