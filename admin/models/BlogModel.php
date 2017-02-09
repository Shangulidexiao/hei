<?php

/* 
 * 后台博客MODEL类
 */

class BlogModel extends MY_Model {
    
    const TABLE_NAME = 'blog';
    public function __construct() {
        parent::__construct();
    }
    
    public function add(ARRAY $params=array()){
        if(empty($params) || empty($params['title'] || empty($params['content']))){
           return false; 
        }
        $params['order_by'] = empty($params['order_by']) ? 0 : $params['order_by'];
        $params['create_time'] = empty($params['create_time']) ? time() : $params['create_time'];
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
        $params['update_time'] = empty($params['update_time']) ? time() : $params['update_time'];
        $this->db->where('id',$id)->update(self::TABLE_NAME,$params);
        return $this->db->affected_rows();
    }
    
    
    public function getList($params = array()){
        #总行数
        $query['results'] = $this->getListNum($params);
        if(!empty($params['title'])){
            $this->db->like('title',$params['title']);
        }
        if(!empty($params['blog_name'])){
            $this->db->like('blog_name',$params['blog_name']);
        }
        if(!empty($params['user_id'])){
            $this->db->where('user_id',(int)$params['user_id']);
        }
        if(!empty($params['category_id'])){
            $this->db->where('category_id',(int)$params['category_id']);
        }
        if($params['status'] !== ''){
            $this->db->where('status',(int)$params['status']);
        }
        if($params['delete'] !== ''){
            $this->db->where('is_del',(int)$params['delete']);
        }else{
            $this->db->where('is_del',0);
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

        if(!empty($params['title'])){
            $this->db->like('title',$params['title']);
        }
        if(!empty($params['blog_name'])){
            $this->db->like('blog_name',$params['blog_name']);
        }
        if(!empty($params['user_id'])){
            $this->db->where('user_id',(int)$params['user_id']);
        }
        if(!empty($params['category_id'])){
            $this->db->where('category_id',(int)$params['category_id']);
        }
        if($params['status'] !== ''){
            $this->db->where('status',(int)$params['status']);
        }
        if($params['delete'] !== ''){
            $this->db->where('is_del',(int)$params['delete']);
        }else{
            $this->db->where('is_del',0);
        }
        return $this->db->count_all_results(self::TABLE_NAME);
    }
}

