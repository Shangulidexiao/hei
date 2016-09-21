<?php

/* 
 * 后台首页
 * @date    2016-09-15
 * @author    hj<18335831710@163.com>
 */

class Index extends MY_Controller {
    
    public function __construct() {
        parent::__construct();
    }
    
    public function index(){
        $this->load->helper('url');
        $data = array('admin'=>$this->userInfo);
        $this->load->view('templates/header',$data);
        $this->load->view('templates/script',$data);
        $this->load->view('templates/footer',$data);
    }
    
    public function panel(){
        $this->load->helper('url');
        $data = array('admin'=>$this->userInfo);
        $this->load->view('index/index',$data);
    }
   
}
