<?php

defined('BASEPATH') OR exit('No direct script access allowed');

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
        $this->load->library('form_validation');
        $this->load->helper(array('json','site'));
    }
    
    public function index(){
        $this->load->view('admin/index');
    }
   
    public function listData(){
        if($this->form_validation->run('adminList') === FALSE){
            $error = $this->form_validation->error('start') AND ajaxJson($error,300);
            $error = $this->form_validation->error('limit') AND ajaxJson($error,300);
        }
        $page['start']      = (int)$this->input->post('start');
        $page['limit']      = (int)$this->input->post('limit');
        $params['page']     = $page;
        $params['user_name']= trim($this->input->post('name',true));
        $params['status']   = $this->input->post('status');
        $authList           = $this->adminInfo->getList($params);
        die(json_encode($authList));
    }

    public function update(){        
        if($this->form_validation->run('adminUpdate') === FALSE){
            $error = $this->form_validation->error('id') AND ajaxJson($error,300);
            $error = $this->form_validation->error('true_name') AND ajaxJson($error,300);
            $error = $this->form_validation->error('mobile') AND ajaxJson($error,300);
           // $error = $this->form_validation->error('email') AND ajaxJson($error,300);
        }
        $adminInfo['admin_id']          = (int)$this->input->post('id');
        $adminInfo['true_name']         = $this->input->post('true_name',true);
        $adminInfo['mobile']            = $this->input->post('mobile',true);
        $adminInfo['email']             = $this->input->post('email',true);
        $row = $this->adminInfo->update($adminInfo);
        $adminRow = $this->adminUpdate();
        if($row || $adminRow){
            ajaxJson('更新成功！');
        }else{
            ajaxJson('更新失败',300);
        }
    }
    
    public function adminUpdate(){
        $adminInfo['id']                = (int)$this->input->post('id');
        $adminInfo['user_name']         = $this->input->post('user_name',true);
        $adminInfo['password']          = $this->input->post('password',true);
        $rePassword                     = $this->input->post('repassword',true);
        
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
        if($this->form_validation->run('adminUpdate') === FALSE){
            $error = $this->form_validation->error('order_by') AND ajaxJson($error,300);
            $error = $this->form_validation->error('status') AND ajaxJson($error,300);
        }
        $adminInfo['admin_id']              = $this->adminAdd();
        if($adminInfo['admin_id']){
            $adminInfo['true_name']         = $this->input->post('true_name',true);
            $adminInfo['mobile']            = $this->input->post('mobile',true);
            $adminInfo['email']             = $this->input->post('email',true);
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
        $userName       = $this->input->post('user_name',true);
        $password       = $this->input->post('password',true);
        $rePassword     = $this->input->post('repassword',true);
        if($rePassword !== $password){
            return false;
        }
        $admin['user_name']     = $userName;
        $admin['password']      = password($password);
        $admin['last_ip']       = $this->input->ip_address();
        $admin['order_by']      = (int)$this->input->post('order_by');
        $admin['status']        = (int)$this->input->post('status');
        $insertId = $this->admin->add($admin);
        return $insertId;
    }
    
    public function remove(){
        $ids        = $this->input->post('ids');
        $idArr      = explode(',', $ids);
        $delRows    = $this->adminInfo->del(array('idArr'=>$idArr));
        if($delRows){
            ajaxJson('删除成功！最新id为'.$newId);
        }else{
            ajaxJson('删除失败',300);
        }
    }
   
        
    /**
     * 该用户的权限信息
     */
    public function authTree(){
        $this->load->view('admin/authTree');
    }
    /**
     * 该用户的权限信息
     */
    public function treeData(){
        $this->load->model('AuthModel','auth');
        $this->load->model('AdminAuthModel','adminAuth');
        $this->load->helpers('bui');
        $roleParams['admin_id']      = $this->input->get('adminId');#用户id
        $selectAuth                    = $this->adminAuth->getAllByAdminId($roleParams);
        $authAll                         = $this->auth->getAll();
        $tree                             = createBUITree($authAll,$selectAuth);
        die(json_encode($tree));
    }
    
    /**
     *  为用户添加权限
     */
    public function addAuth(){
        $authList = $this->input->post('auths');
        $adminId    = $this->input->post('adminId');
        
        $this->load->model('AdminAuthModel','adminAuth');
         if(empty($authList)){
            $this->adminAuth->delAuth(array('admin_id'=>$adminId));#删除这个角色下的所有用户
            ajaxJson('已删除该角色的所有人员',300);
        }
        $this->adminAuth->delAuth(array('admin_id'=>$adminId));#先删除这个角色下的所有用户
        $adminArr = array();
        foreach ($authList as $authKey => $auth){
            $adminArr[$authKey]['admin_id']             = $adminId;
            $adminArr[$authKey]['auth_id']            = $auth;
            $adminArr[$authKey]['create_time']      = time();
            $adminArr[$authKey]['update_time']      = time();
            $adminArr[$authKey]['create_id']        = $this->userInfo['id'];
            $adminArr[$authKey]['update_id']      = $this->userInfo['id'];
        }
        $success = $this->adminAuth->addAuthList($adminArr);
        if($success > 0){
            ajaxJson('为该用户添加权限成功');
        }else{
            ajaxJson('为该用户添加权限失败',300);
        }
    }
}
