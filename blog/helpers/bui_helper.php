<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 *  CodeIgniter 
 *  BUI的公用函数
 * @author Han Jian <18335831710@163.com>
 * @date 2016-11-18 18:59:48 
 */

defined('BASEPATH') OR exit('No direct script access allowed');

if(!function_exists('createBUITree')){
    function createBUITree(ARRAY $params=array(),ARRAY $selected=array()){
        $selectIds        = array();
        if(!empty($selected)){
            foreach ($selected as $value) {
                $selectIds[] = $value['auth_id'];
            }
        }
        $root = getPSon(0,$params,$selectIds);
        $tree = array();
        foreach ($root[0] as $key => $value) {
            if(isset($root[$value['id']])){
                 $children = makeTree($value['id'],$root);
                if(!empty($children)){
                    $value['children'] = $children;
                }
                $tree[] = $value;
            }
        }
        return $tree;
    }
}

if(!function_exists('makeTree')){
    function makeTree($parentId,$root){
        $makeTree = array();
        foreach ($root[$parentId] as $key => $value) {
            if(isset($root[$value['id']])){
                $children = makeTree($value['id'],$root);
                if(!empty($children)){
                   $value['children'] = $children;
                }
            }
            $makeTree[] = $value;
        }
        return $makeTree;
    }
}


/**
 * 让子节点先找到自己的一级父节点
 */
if(!function_exists('getPSon')){
    function getPSon($parentId='0',ARRAY $params=array(),ARRAY $selected=array()){
        $tree = array();
        foreach ($params as $key => $value) {
            if(in_array($value['id'], $selected)){
                    $value['checked']     = true;
                }else{
                    $value['checked']     = false;
                }
                $tree[$value['parent_id']][] = array(
                    'id'=>$value['id'],
                    'text'=>$value['name'],
                    'checked'=>$value['checked'],
                );
        }
        return $tree;
        
    }
}