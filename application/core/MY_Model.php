<?php

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
    public function getKv($k = 'id',$v = 'name'){
        if(!isset($params['is_del'])){
            $params['is_del'] = 0;
        }
        $query = $this->db->where($params)->select($k.','.$v)->get(static::TABLE_NAME);
        $data = $query->result_array();
        $kv = array();
        if(!empty($data)){
            foreach ($data as $key => $value) {
                $kv[$value[$k]] = $value[$v];
           }           
        }
        return $kv;
    }
    /**
     * 删除用户（慎用）
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
        echo $this->db->last_query();
        return $this->db->affected_rows();
    }
}
