<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/* 
 * 后台自定义控制器基类
 */

class MY_Controller extends CI_Controller {
    
    public $userInfo;
    public $authUrl;
    public $authIds;
    
    /**
     * 初始化系统信息
     */
    public function __construct() {
        parent::__construct();

        #判断登录和初始化用户信息
        $isLogin = $this->isLogin();
        if($isLogin === FALSE){
            redirect('/Login','refresh');
        }
        $uid = $this->input->cookie('uid');
        $this->userInfo = $this->admin->getOne(array('user_name'=>$uid));
        #根据角色和人员取出菜单的id
        $roleIds = $this->roleAdmin->getRoleIds(array('admin_id'=>$this->userInfo['id']));
        $roleAuthIds = $this->roleAuth->getAuths(array('roleIds'=>$roleIds));
        $adminAuthIds = $this->adminAuth->getAuths(array('adminId'=>$this->userInfo['id']));
        $this->authIds = array_values($roleAuthIds+$adminAuthIds);
        #用户菜单和权限
        $this->menu();
        $this->isAuth();
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
        $menu = $menuAll = $this->getMenus();
        $menuFirst = $menuSecond  =  array();
        
        #生成顶级菜单
        foreach ($menu as $k1 => $v1) {
            if($v1['parent_id'] === '0' && $v1['is_show']==='1'){
                $menuFirst[] = $v1;
                unset($menu[$k1]);
            }
        }
        #生成二级菜单
        foreach ($menuFirst as $k2 => $v2) {
            foreach ($menu as $k3 => $v3) {
                if($v3['parent_id'] === $v2['id']  && $v3['is_show']==='1'){
                    $menuSecond[$v2['id']][] = $v3;
                    unset($menu[$k3]);
                }
            }
        }
        #生成三级菜单
        $menuArr = array();
        foreach ($menuSecond as $k4 => $v4) {
            $menuSecondArr = array();#二级菜单 临时数组格式
            $flag = false;
            foreach ($v4 as $k5 => $v5) {
                $subMenuArr = array();#三级菜单 临时数组格式
                foreach ($menu as $k6 => $v6) {
                    if($v6['parent_id'] === $v5['id']){
                        if($v6['is_show'] == 1){
                            $subMenuArr[] = array(
                                'id'    =>  $v6['id'],      #页面唯一标识
                                'text'  => $v6['name'],     #三级菜单名字
                                'href'  => $v6['url']       #三级菜单链接
                            );
                        }
                        unset($menu[$k6]);
                    }
                }
                $menuSecondArr[] = array('text'=>$v5['name'],'collapsed'=>$flag,'items'=>$subMenuArr);
                $flag = true;
            }
            
            #菜单数组
            $menuArr[] = array(
                'id'        => $k4,             #一级菜单的id 页面的唯一标识
                'menu'      => $menuSecondArr   #一级菜单下的菜单数组
            );
        }
        
        $this->load->vars(array('menuFirst'=>$menuFirst));
        $this->load->vars(array('menuJson'=>json_encode($menuArr)));
    }
    
    /**
     *  得到用户的所有权限|有子权限就一定会有父权限
     * @return array
     */
    protected function getMenus(){
        #拥有子权限一定拥有父权限
        $menu = $this->menu->getMenuAll();
        $menuKv = array();
        $menuArr = array();
        foreach ($menu as $k => $v){
            if(in_array($v['id'], $this->authIds)){
                $menuArr[$v['id']] = $v;
            }
            $menuKv[$v['id']] = $v;
        }
        return $this->getPraentAuth($menuArr,$menuKv);
    }
    
    private function getPraentAuth($menu,$menuAll){
        if(empty($menu) || empty($menuAll)){
            return array();
        }
        foreach ($menu as  $v) {
            #一级父亲
            $pid1 = $v['parent_id'];
            if($pid1==0 || in_array($pid1, $menu)){
                continue;
            }
            $menu[$menuAll[$pid1]['id']] = $menuAll[$pid1];
            
            #二级父亲
            $pid2 = $menuAll[$pid1]['parent_id'];
            if ($pid2 == 0 || in_array($pid2, $menu)) {
                continue;
            }
            $menu[$menuAll[$pid2]['id']] = $menuAll[$pid2];
            
            #顶级父亲
            $pid3 = $menuAll[$pid2]['parent_id'];
            if ($pid3 == 0 || in_array($pid3, $menu)) {
                continue;
            }
            $menu[$menuAll[$pid3]['id']] = $menuAll[$pid3];
            
        }
        
        return $menu;
    }
    
    

    /**
     * 判断是否有权限
     */
    protected function isAuth(){
        $class      = $this->router->fetch_class();
        $method     = $this->router->fetch_method();
        $auth       = strtolower('/'.$class.'/'.$method);
        $authArrs = $this->menu->getMenuByAuth(array('authIds'=>$this->authIds));
        foreach ($authArrs as $authArr){
            $this->authUrl[$authArr['id']] = strtolower($authArr['url']);
        }
        $noAuth = array('/index/logout');#不需要权限认证
        if(is_array($this->authUrl) && !in_array($auth, $this->authUrl)){
            if(in_array($auth, $noAuth)){
                return;
            }
            //die('没有权限呢');
        }
    }

    /**
     * 用户登出
     */
    public function logOut(){
        $this->load->helper('cookie');
        delete_cookie('uid', '', '/');
        delete_cookie('ukey', '', '/');
        delete_cookie('pkey', '', '/');
        redirect('/Login','refresh');
    }
}
