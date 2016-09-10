<?php

/* 
 * 后台自定义控制器基类
 */

class MY_Controller extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->isLogin();
    }
    
    public function isLogin(){
        echo 'success';
    }
}
