<?php

/* 
 * 后台首页
 */

class Index extends MY_Controller {
    
    public function __construct() {
        parent::__construct();
    }
    
    public function index(){
        $this->load->helper('url');
        $data = array('admin'=>$this->userInfo);
        $this->load->view('index/index',$data);
    }
    
}
