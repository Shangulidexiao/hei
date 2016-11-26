<?php

/**
 *  CodeIgniter 
 *  BUI的公用函数
 * @author Han Jian <18335831710@163.com>
 * @date 2016-11-18 18:59:48 
 */

defined('BASEPATH') OR exit('No direct script access allowed');

if ( ! function_exists('createBUITree'))
{
    function createBUITree(ARRAY $params=array(),ARRAY $selected=array()){
        if(empty($params)){
            return array();
        }
        createTree('0',$params,$selected);
        $menuFirst      = array();
        $selectIds        = array();
        if(!empty($selected)){
            foreach ($selected as $value) {
                $selectIds[] = $value['auth_id'];
            }
        }
        
        #生成顶级菜单
        foreach ($params as $k1 => $v1) {
            if($v1['parent_id'] === '0'){
                $v1['text']     = $v1['name'];
                if(in_array($v1['id'], $selectIds)){
                    $v1['checked']     = true;
                }
                unset($params[$k1],$v1['name'],$v1['parent_id']);
                $menuFirst[$v1['id']]       = $v1;
            }
        }
        $menuArr = $menuFirst;
        #生成二级菜单
        foreach ($menuFirst as $k2 => $v2) {
            $son                                    = getSonTree($v2['id'], $params, $selectIds);
            foreach ($son as $v3) {
                $subSon                           = getSonTree($v3['id'], $params, $selectIds);
                $son[$v3['id']]['children'] = array_values($subSon);
            }
            $menuArr[$k2]['children']      = array_values($son);
        }
        
       return array_values($menuArr);
    }
}


if ( ! function_exists('getSonTree'))
{
      /**
     *  得到子树
     * @param type $pid 父id
     * @param array $params 所有所有枝叶
     * @param array $selected 被选择的枝叶
     * @return boolean
     */
    function getSonTree($pid,ARRAY $params=array(),ARRAY $selected=array()){
         $tree = array();
        foreach ($params as $key => $value) {
            if(in_array($value['id'], $selected)){
                    $value['checked']     = true;
                }
            if($pid === $value['parent_id']){
                $value['text']      = $value['name'];
                unset($value['parent_id'],$value['name']);
                $tree[$value['id']] = $value;
            }
        }
        return $tree;
    }
}

if(!function_exists('createTree')){
    function createTree($parentId='0',ARRAY $params=array(),ARRAY $selected=array()){
        
        $root['children'] = getSonTree($parentId,$params,$selected);
        if(empty($tree)){
            return $tree;
        }
        foreach ($tree as $tk => $tv) {
            createTree($tv['id'],$params,$selected);
        }
    }
}