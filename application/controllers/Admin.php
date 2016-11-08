<?php

/**
 *  CodeIgniter 
 *  后台用户
 * @author Han Jian <18335831710@163.com>
 * @date 2016-11-6 18:47:19 
 */
class Admin extends MY_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->model('AdminInfoModel','adminInfo');
        $this->load->helpers('json');
    }
    
    public function index(){
        $this->load->view('admin/index');
    }
   
    public function listData(){
        $page['start']      = $this->input->get_post('start');
        $page['limit']      = $this->input->get_post('limit');
        $params['page']     = $page;
        $params['name']     = $this->input->get_post('name');
        $params['mobile']   = $this->input->get_post('mobile');
        $params['status']   = $this->input->get_post('status');
        $authList           = $this->adminInfo->getList($params);
        die(json_encode($authList));
    }

    public function update(){
        $adminInfo['admin_id']   = $this->input->post('id');
        $adminInfo['true_name']         = $this->input->post('true_name');
        $adminInfo['mobile']            = $this->input->post('mobile');
        $adminInfo['email']             = $this->input->post('email');
        $row = $this->adminInfo->update($adminInfo);
        $adminRow = $this->adminUpdate();
        if($row || $adminRow){
            ajaxJson('更新成功！');
        }else{
            ajaxJson('更新失败',300);
        }
    }
    
    public function adminUpdate(){
        $adminInfo['id']                = $this->input->post('id');
        $adminInfo['user_name']         = $this->input->post('user_name');
        $adminInfo['password']          = $this->input->post('password');
        $rePassword                     = $this->input->post('repassword');
        
        #密码为空不更新密码
        if(empty($adminInfo['password']) && ($adminInfo['password'] !== $rePassword)){
            unset($adminInfo['password']);
        }
        
        #如果更新密码则对密码进行加密
        if(isset($adminInfo['password'])){
            $this->load->library('encryption');
            $this->load->helper('site');
            $adminInfo['password'] = password($adminInfo['password']);
        }
        
        return $this->admin->update($adminInfo);
    }

    public function add(){
        $adminInfo['admin_id'] = $this->adminAdd();
        if($adminInfo['admin_id']){
            $adminInfo['true_name']         = $this->input->post('true_name');
            $adminInfo['mobile']            = $this->input->post('mobile');
            $adminInfo['email']             = $this->input->post('email');
            $newId = $this->adminInfo->add($adminInfo);
            if($newId){
                ajaxJson('添加成功！最新id为'.$newId);
            }else{
                ajaxJson('添加失败',300);
            }
        }
        
    }
    
    public function adminAdd(){
        $this->load->library('encryption');
        $this->load->model('AdminModel','admin');
        $this->load->helper('site');
        $userName       = $this->input->post('user_name');
        $password       = $this->input->post('password');
        $rePassword     = $this->input->post('repassword');
        if($rePassword !== $password){
            return false;
        }
        $admin['user_name']     = $userName;
        $admin['password']      = password($password);
        $admin['last_ip']       = $this->input->ip_address();
        $admin['order_by']      = $this->input->post('order_by');
        $admin['status']        = $this->input->post('status');
        $insertId = $this->admin->add($admin);
        return $insertId;
    }
    
    public function remove(){
        $ids = $this->input->post('ids');
        $idArr = explode(',', $ids);
        $delRows = $this->adminInfo->del(array('idArr'=>$idArr));
        if($delRows){
            ajaxJson('删除成功！最新id为'.$newId);
        }else{
            ajaxJson('删除失败',300);
        }
    }
    
    public function adminList(){
        $this->load->view('admin/list');
    }
}
