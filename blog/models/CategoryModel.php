<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CategoryModel extends CI_Model{
    const TABLE_NAME = 'category';
    
    public function getMenu(array $param=array()){
       $results =  $this->db->select('id,name')
               ->where(array('is_common'=>1))
               ->get(self::TABLE_NAME)
               ->result_array();
       if(empty($results)){
           return array();
       }
       foreach ($results as $cate){
           $kv[$cate['id']] = $cate['name'];
       }
       return  $kv;
    }
}
