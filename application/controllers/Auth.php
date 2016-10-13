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
        $page['start'] = $this->input->get_post('start',1);
        $page['limit'] = $this->input->get_post('limit',1);
        $params['page'] = $page;
        $params['name'] = $this->input->get_post('name','');
        $params['parent_id'] = $this->input->get_post('parent_id','');
        $params['status'] = $this->input->get_post('status',-1);
        $authList = $this->auth->getList($params);
        
        die(json_encode($authList));
    }
}
