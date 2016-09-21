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
    
    public function logOut(){
        $this->load->helper('cookie');
        delete_cookie('uid', '', '/');
        delete_cookie('ukey', '', '/');
        delete_cookie('pkey', '', '/');
        redirect('/Login','refresh');
    }
}
