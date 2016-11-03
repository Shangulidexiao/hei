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
        $this->load->helpers('json');
    }
    
    public function index(){
        $this->load->view('auth/index');
    }
   
    public function listData(){
        $page['start'] = $this->input->get_post('start');
        $page['limit'] = $this->input->get_post('limit');
        $params['page'] = $page;
        $params['name'] = $this->input->get_post('name');
        $params['parent_id'] = $this->input->get_post('parent_id');
        $params['status'] = $this->input->get_post('status');
        $authList = $this->auth->getList($params);
        die(json_encode($authList));
    }

    public function update(){
        $update['id']  = $this->input->post('id');
        $update['parent_id']  = $this->input->post('parent_id');
        $update['order_by']   = $this->input->post('order_by');
        $update['url']        = $this->input->post('url');
        $update['name']       = $this->input->post('name');
        $update['icon']       = $this->input->post('icon');
        $update['status']     = $this->input->post('status');
        $row = $this->auth->update($update);
        if($row){
            ajaxJson('更新成功！');
        }else{
            ajaxJson('更新失败',300);
        }
    }

    public function add(){
        $add['parent_id']     = $this->input->post('parent_id');
        $add['order_by']      = $this->input->post('order_by');
        $add['url']           = $this->input->post('url');
        $add['name']          = $this->input->post('name');
        $add['icon']          = $this->input->post('icon');
        $add['status']        = $this->input->post('status');
        $newId = $this->auth->add($add);
        if($newId){
            ajaxJson('添加成功！最新id为'.$newId);
        }else{
            ajaxJson('添加失败',300);
        }
    }

    public function remove(){
        var_dump($this->input->post('id'));
    }
}
