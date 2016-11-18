<?php

/**
 *  CodeIgniter 
 *  BUI的公用函数
 * @author Han Jian <18335831710@163.com>
 * @date 2016-11-18 18:59:48 
 */

defined('BASEPATH') OR exit('No direct script access allowed');

 /*[ 
          {text : '1',id : '1',checked : true,children: [{text : '11',id : '11'}]},
          {text : '2',id : '2',expanded : true,children : [
              {text : '21',id : '21',children : [{text : '211',id : '211'},{text : '212',id : '212'}]},
              {text : '22',id : '22'}
          ]},
          {text : '3',id : '3'},
          {text : '4',id : '4'}
        ];
  */
if ( ! function_exists('createBUITree'))
{
    function createBUITree(ARRAY $params=array(),ARRAY $selected=array()){
        if(empty($params)){
            return array();
        }
        $menuFirst = array();
        $menuSecond = array();
        #生成顶级菜单
        foreach ($params as $k1 => $v1) {
            if($v1['parent_id'] === '0'){
                $v1['text']     = $v1['name'];
                unset($params[$k1],$v1['name'],$v1['parent_id']);
                $menuFirst[] = $v1;
            }
        }
        
        #生成二级菜单
        foreach ($menuFirst as $k2 => $v2) {
            foreach ($params as $k3 => $v3) {
                if($v3['parent_id'] === $v2['id']){
                    $menuSecond[$v2['id']][] = $v3;
                    unset($params[$k3]);
                }
            }
        }
        
        #生成三级菜单
        $menuArr = array();
        foreach ($menuSecond as $k4 => $v4) {
            $menuSecondArr = array();#二级菜单 临时数组格式
            foreach ($v4 as $k5 => $v5) {
                $subMenuArr = array();#三级菜单 临时数组格式
                foreach ($params as $k6 => $v6) {
                    if($v6['parent_id'] === $v5['id']){
                        $subMenuArr[] = array(
                            'id'    =>  $v6['id'],      #页面唯一标识
                            'text'  => $v6['name'],     #三级菜单名字
                        );
                        
                        unset($params[$k6]);
                    }
                }
                $menuSecondArr[] = array('text'=>$v5['name'],'items'=>$subMenuArr);
            }
            
            #菜单数组
            $menuArr[] = array(
                'id'    => $k4,             #一级菜单的id 页面的唯一标识
                'children'  => $menuSecondArr   #一级菜单下的菜单数组
            );
        }
        die(json_encode($menuArr));
    }
}
