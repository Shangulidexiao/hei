<?php

/**
 *  CodeIgniter 
 *  后台人员信息
 * @author Han Jian <18335831710@163.com>
 * @date 2016-11-6 18:56:24 
 */

class AdminInfoModel extends MY_Model {
    
    const TABLE_NAME = 'admin';
    const TABLE_NAME_INFO = 'admin_info';
    
    public function __construct() {
        parent::__construct();
    }
    
    public function add(ARRAY $params=array()){
        if(empty($params)){
           return false; 
        }
        $params['status'] = empty($params['status']) ? 0 : $params['status'];
        $this->db->insert(self::TABLE_NAME_INFO,$params);
        return $this->db->insert_id();
    }
    
    public function update(ARRAY $params=array()){
        if(empty($params) || empty($params['admin_id'])){
            return false;
        }
        $admin_id = $params['admin_id'];
        unset($params['admin_id']);
        
        $this->db->where('admin_id',$admin_id)->update(self::TABLE_NAME_INFO,$params);
        return $this->db->affected_rows();
    }
    
    /**
     * 列表
     */
    public function getList($params = array()){
        #总行数
        $query['results'] = $this->getListNum($params);
        
        if(!empty($params['user_name'])){
            $this->db->like('user_name',$params['user_name']);
        }
        if($params['status'] !== ''){
            $this->db->where('hei_admin.status',(int)$params['status']);
        }
        if(isset($params['page']['start']) && $params['page']['start'] > 0 ){
            $this->db->limit($params['page']['limit'],$params['page']['start']);
            //unset($params['page']);
        }else{
            $this->db->limit($params['page']['limit']);
        }
        $this->db->join(self::TABLE_NAME,'hei_admin.id = hei_admin_info.admin_id', 'right');
        
        #列表
        $query['rows'] = $this->db->select('hei_admin_info.*,hei_admin.user_name,hei_admin.order_by,hei_admin.status,hei_admin.id')
                ->order_by('order_by','DESC')
                ->get(self::TABLE_NAME_INFO)
                ->result_array();
        
        return $query;
    }
    
    /**
     * 计算列表总数
     */
    public function getListNum(ARRAY $params=array()){
        if(!empty($params['user_name'])){
            $this->db->like('user_name',$params['user_name']);
        }
        if($params['status'] !== ''){
            $this->db->where('status',(int)$params['status']);
        }
        return $this->db->count_all_results(self::TABLE_NAME);
    }
    

}

