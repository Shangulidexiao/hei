<?php

/* 
 * 后台权限MODEL类
 */

class AuthModel extends MY_Model {
    
    const TABLE_NAME = 'auth';
    public function __construct() {
        parent::__construct();
    }
    
    public function add(ARRAY $params=array()){
        if(empty($params) || empty($params['url'])){
           return false; 
        }
        $params['order_by'] = empty($params['order_by']) ? 0 : $params['order_by'];
        $params['create_time'] = empty($params['create_time']) ? time() : $params['create_time'];
        $params['update_time'] = empty($params['update_time']) ? time() : $params['update_time'];
        $params['status'] = empty($params['status']) ? 0 : $params['status'];
        $this->db->insert(self::TABLE_NAME,$params);
        return $this->db->insert_id();
    }
    
    public function update(ARRAY $params=array()){
        if(empty($params) || empty($params['id'])){
            return false;
        }
        $id = $params['id'];
        unset($params['id']);
        if($param['create_id']){
            unset($param['create_id']);
        }
        if($param['create_time']){
            unset($param['create_time']);
        }
        $params['update_time'] = empty($params['update_time']) ? time() : $params['update_time'];
        $this->db->where('id',$id)->update(self::TABLE_NAME,$params);
    }
    
    /**
     * 删除用户（慎用）
     * @param array $params
     * @return boolean
     */
    public function del(ARRAY $params=array()){
        if(empty($params) || empty($params['id'])){
            return false;
        }
        $this->db->where($params)->delete(self::TABLE_NAME);
    }
    
    public function getOne(ARRAY $params=array()){
        if(empty($params['user_name']) && empty($params['id'])){
            return false;
        }
        $query = $this->db->where($params)->get(self::TABLE_NAME,1);
        return $query->row_array();
    }
    
    public function getList($params = array()){
        #总行数
        $query['results'] = $this->getListNum($params);
        
        if(!empty($params['name'])){
            $this->db->like('name',$params['name']);
        }
        if($params['parent_id'] !== ''){
            $this->db->where('parent_id',(int)$params['parent_id']);
        }
        if($params['status'] !== ''){
            $this->db->where('status',(int)$params['status']);
        }
        if(isset($params['page']['start']) && $params['page']['start'] > 0 ){
            $this->db->limit($params['page']['limit'],$params['page']['start']);
            
            //unset($params['page']);
        }else{
            $this->db->limit($params['page']['limit']);
        }
        #列表
        $query['rows'] = $this->db->get(self::TABLE_NAME)->result_array();
        
        return $query;
    }
    
    public function getListNum(ARRAY $params=array()){
        if(!empty($params['name'])){
            $this->db->like('name',$params['name']);
        }
        if($params['parent_id'] !== ''){
            $this->db->where('parent_id',(int)$params['parent_id']);
        }
        if($params['status'] !== ''){
            $this->db->where('status',(int)$params['status']);
        }
        return $this->db->count_all_results(self::TABLE_NAME);
    }
    

}

