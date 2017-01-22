<?php

/* 
 * 后台博客分类MODEL类
 */

class CategoryModel extends MY_Model {
    
    const TABLE_NAME = 'category';
    public function __construct() {
        parent::__construct();
    }
    
    public function add(ARRAY $params=array()){
        if(empty($params) || empty($params['name'])){
           return false; 
        }
        $params['add_time'] = empty($params['add_time']) ? time() : $params['add_time'];
        $this->db->insert(self::TABLE_NAME,$params);
        return $this->db->insert_id();
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
        $query['rows'] = $this->db->order_by('order_by','DESC')->get(self::TABLE_NAME)->result_array();
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

