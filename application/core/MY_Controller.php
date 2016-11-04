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
        foreach ($menu as $k1 => $v1) {
            if($v1['parent_id'] === '0'){
                $menuFirst[] = $v1;
                unset($menu[$k1]);
            }
        }
        
        foreach ($menuFirst as $k2 => $v2) {
            foreach ($menu as $k3 => $v3) {
                if($v3['parent_id'] === $v2['id']){
                    $menuSecond[] = $v3;
                    unset($menu[$k3]);
                }
            }
        }

        $menuArr = array();
        $subMenuArr = array();
        foreach ($menuSecond as $k4 => $v4) {
            foreach ($menu as $k5 => $v5) {
                if($v5['parent_id'] === $v4['id']){
                    $menuThird[] = $v5;
                    $subMenuArr[$k5]['id'] = $v5['id'];
                    $subMenuArr[$k5]['text'] = $v5['name'];
                    $subMenuArr[$k5]['href'] = $v5['url'];
                    unset($menu[$k5]);
                }
            }
            $menuArr[$k4]['id'] = $v4['id'];
            $menuArr[$k4]['menu'][] = array('text'=>$v4['name'],'items'=>array_values($subMenuArr));
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
