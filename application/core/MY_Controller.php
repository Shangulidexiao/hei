<?php

/* 
 * 后台自定义控制器基类
 */

class MY_Controller extends CI_Controller {
    
    public $userInfo;
    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $isLogin = $this->isLogin();
        if($isLogin === FALSE){
            redirect('/Login','refresh');
        }
        $uid = $this->input->cookie('uid');
        $this->load->model('AdminModel','admin');
        $this->userInfo = $this->admin->getOne(array('user_name'=>$uid));
        $this->menu();
    }
    
    public function isLogin(){
        $uid = $this->input->cookie('uid');
        $ukey = $this->input->cookie('ukey');
        $pkey = $this->input->cookie('pkey');
        
        $adminKey = md5(PKEY . $ukey . $uid);
        if($pkey !== $adminKey){
            return FALSE;
        }else{
            return TRUE;
        }
    }
    
    public function menu(){
        $this->load->model('MenuModel','menu');
        $menu = $menuAll = $this->menu->getMenuAll();
        $menuFirst = array();
        $menuSecond = array();
        $menuThird = array();
        #生成顶级菜单
        foreach ($menu as $k1 => $v1) {
            if($v1['parent_id'] === '0'){
                $menuFirst[] = $v1;
                unset($menu[$k1]);
            }
        }
        #生成二级菜单
        foreach ($menuFirst as $k2 => $v2) {
            foreach ($menu as $k3 => $v3) {
                if($v3['parent_id'] === $v2['id']){
                    $menuSecond[$v2['id']][] = $v3;
                    unset($menu[$k3]);
                }
            }
        }
        #生成三级菜单
        foreach ($menuSecond as $k4 => $v4) {
            $menuSecondArr = array();#二级菜单 临时数组格式
            foreach ($v4 as $k5 => $v5) {
                $subMenuArr = array();#三级菜单 临时数组格式
                foreach ($menu as $k6 => $v6) {
                    if($v6['parent_id'] === $v5['id']){
                        $menuThird[] = $v6;
                        $subMenuArr[] = array(
                            'id'    =>  $v6['id'],      #页面唯一标识
                            'text'  => $v6['name'],     #三级菜单名字
                            'href'  => $v6['url']       #三级菜单链接
                        );
                        unset($menu[$k6]);
                    }
                }
                $menuSecondArr[] = array('text'=>$v5['name'],'items'=>$subMenuArr);
            }
            
            #菜单数组
            $menuArr[] = array(
                'id'    => $k4,             #一级菜单的id 页面的唯一标识
                'menu'  => $menuSecondArr   #一级菜单下的菜单数组
            );
        }
        $this->load->vars(array('menuFirst'=>$menuFirst));
        $this->load->vars(array('menuJson'=>json_encode($menuArr)));
    }
    public function logOut(){
        $this->load->helper('cookie');
        delete_cookie('uid', '', '/');
        delete_cookie('ukey', '', '/');
        delete_cookie('pkey', '', '/');
        redirect('/Login','refresh');
    }
}
