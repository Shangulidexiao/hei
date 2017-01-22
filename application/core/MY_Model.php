<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 *  CodeIgniter - Model
 * 网站公用Model
 * @author Han Jian <18335831710@163.com>
 * @date 2016-10-12 12:50:19
 */

class MY_Model extends CI_Model{
     
    /**
     *  获取这个表的键值对
     * @param type $key
     * @param type $value
     * @return ARRAY 这个表id和名字的键值对
     */
    public function getKv(ARRAY $params = array(),$k = 'id',$v = 'name',$limit=20){
        if(!isset($params['is_del'])){
            $params['is_del'] = 0;
        }
        if(is_array($params) && !empty($params)){
            $query = $this->db->where($params)->select($k.','.$v)->get(static::TABLE_NAME,$limit);
        }else{
            $query = $this->db->select($k.','.$v)->get(static::TABLE_NAME,$limit);
        }
        $data = $query->result_array();
        $kv = array();
        if(!empty($data)){
            foreach ($data as $value) {
                $kv[$value[$k]] = $value[$v];
           }           
        }
        return $kv;
    }
    /**
     * 根据条件获得一条数据
     * @param array $params
     * @return array
     */
    public function getOne(ARRAY $params=array(),$select='*'){
        if(is_array($params) && !empty($params)){
            $query = $this->db->where($params)->select($select)->get(static::TABLE_NAME,1);
        }else{
            $query = $this->db->select($select)->get(static::TABLE_NAME,1);
        }
        return $query->row_array();
    }
    /**
     * 
     * @param array $params where
     * @param type $select 要查询的字段
     * @return type
     */
    public function getAll(ARRAY $params=array(),$select = '*'){
        if(!isset($params['is_del'])){
            $this->db->where('is_del',0);
        }else{
            $this->db->where('is_del',(int)$params['is_del']);
        }
        $query = $this->db->where($params)->select($select)->get(static::TABLE_NAME);
        return $query->result_array();
    }
    /**
     * 更新数据
     * @param array $params
     * @return boolean
     */
    public function update(ARRAY $params=array()){
        if(empty($params) || empty($params['id'])){
            return false;
        }
        $id = $params['id'];
        unset($params['id']);
        $this->db->where('id',$id)->update(static::TABLE_NAME,$params);
        return $this->db->affected_rows();
    }
    /**
     * 删除（慎用）
     * @param array $params
     * @return boolean
     */
    public function delete(ARRAY $params=array()){
        if($params['idArr'] && is_array($params['idArr']) && !empty($params['idArr'])){
            $this->db->or_where_in('id',$params['idArr'])->delete(static::TABLE_NAME);
            return $this->db->affected_rows();
        }
        if(empty($params) || empty($params['id'])){
            return false;
        }
        $this->db->where($params)->delete(static::TABLE_NAME);
        return $this->db->affected_rows();
    }
    /**
     * 假删除
     * @param array $params
     * @return boolean
     */
    public function del(ARRAY $params=array()){
        $delArr['is_del'] = 1;
        if($params['idArr'] && is_array($params['idArr']) && !empty($params['idArr'])){
            $this->db->or_where_in('id',$params['idArr'])->update(static::TABLE_NAME,$delArr);
            return $this->db->affected_rows();
        }
        if(empty($params) || empty($params['id'])){
            return false;
        }
        $this->db->where($params)->update(static::TABLE_NAME,$delArr);
        return $this->db->affected_rows();
    }
}
