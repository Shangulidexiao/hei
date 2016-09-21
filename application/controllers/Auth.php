<?php

/* 
 * 权限控制器
 * @date    2016-09-15
 * @author    hj<18335831710@163.com>
 */

class Auth extends MY_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->model('AuthModel','auth');
    }
    
    public function index(){
        $authList = $this->auth->getList();
        $auth['data'] = json_encode($authList);
        $this->load->view('auth/index',$auth);
    }
   
}
