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
        $this->load->view('auth/index');
    }
   
    public function listData(){
        $params['name'] = $this->input->get('name',-1);
        $params['parent_id'] = $this->input->get('parent_id',-1);
        $params['status'] = $this->input->get('status',-1);
        $authList = $this->auth->getList($params);
        die(json_encode($authList));
    }
}
