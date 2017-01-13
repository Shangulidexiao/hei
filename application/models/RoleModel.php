<?php

/**
 *  CodeIgniter 
 *  角色模型
 * @author Han Jian <18335831710@163.com>
 * @date 2016-11-6 16:04:46 
 */

class RoleModel extends MY_Model {
    
    const TABLE_NAME = 'role';
    public function __construct() {
        parent::__construct();
    }
    
    public function add(ARRAY $params=array()){
        if(empty($params) || empty($params['name'])){
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
        if($params['id'] !== ''){
            $this->db->where('id',(int)$params['id']);
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
        if(!isset($params['is_del'])){
            $this->db->where('is_del',0);
        }else{
            $this->db->where('is_del',(int)$params['is_del']);
        }
        #列表
        $query['rows'] = $this->db->order_by('order_by','DESC')->get(self::TABLE_NAME)->result_array();
        return $query;
    }
    
    public function getListNum(ARRAY $params=array()){
        if(!empty($params['name'])){
            $this->db->like('name',$params['name']);
        }
        if($params['id'] !== ''){
            $this->db->where('id',(int)$params['id']);
        }
        if($params['status'] !== ''){
            $this->db->where('status',(int)$params['status']);
        }
        return $this->db->count_all_results(self::TABLE_NAME);
    }
    

}
