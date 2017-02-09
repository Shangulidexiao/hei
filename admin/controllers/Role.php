<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/* 
 * 角色控制器
 * @date    2016-11-6
 * @author    hj<18335831710@163.com>
 */

class Role extends MY_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->model('RoleModel','role');
        $this->load->helpers('json');
    }
    /**
     * 角色列表
     */
    public function index(){
        $this->load->view('role/index');
    }
   
    /**
     * 角色列表的数据
     */
    public function listData(){
        $page['start']              = (int)$this->input->get_post('start');
        $page['limit']              = (int)$this->input->get_post('limit');
        $params['page']             = $page;
        $params['name']             = $this->input->get_post('name',true);
        $params['id']               = $this->input->get_post('id');
        $params['status']           = $this->input->get_post('status');
        $roleList                   = $this->role->getList($params);
        die(json_encode($roleList));
    }

    /**
     * 更新角色
     */
    public function update(){
        $update['id']               = (int)$this->input->post('id');
        $update['order_by']         = (int)$this->input->post('order_by');
        $update['name']             = $this->input->post('name',true);
        $update['status']           = (int)$this->input->post('status');
        $row                        = $this->role->update($update);
        if($row){
            ajaxJson('更新成功！');
        }else{
            ajaxJson('更新失败',300);
        }
    }

    /**
     * 添加角色
     */
    public function add(){
        $add['order_by']        = (int)$this->input->post('order_by');
        $add['name']            = $this->input->post('name',true);
        $add['status']          = (int)$this->input->post('status');
        $newId                  = $this->role->add($add);
        if($newId){
            ajaxJson('添加成功！最新id为'.$newId);
        }else{
            ajaxJson('添加失败',300);
        }
    }

    /**
     * 删除角色
     */
    public function remove(){
        $ids        = $this->input->post('ids');
        $idArr      = explode(',', $ids);
        $delRows    = $this->role->del(array('idArr'=>$idArr));
        if($delRows){
            ajaxJson('删除成功！最新id为'.$newId);
        }else{
            ajaxJson('删除失败',300);
        }
    }
    
    /**
     * 角色添加人员的列表
     */
    public function adminList(){
        $roleParams['role_id']          = (int)$this->input->get('roleId');#角色id
        $roleAdmin['admins']            = $this->admin->getList();#所有管理员的列表
        $roleAdmin['roleAdmins']        = array();
        $roleAdmins                     = $this->roleAdmin->getList($roleParams);#此角色下的管理员
        foreach ($roleAdmins as $adminOne) {
            $roleAdmin['roleAdmins'][] = $adminOne['admin_id'];
        }
        $isAllSelect = count($roleAdmin['admins']) === count($roleAdmin['roleAdmins']);
        $roleAdmin['isAllSelect']   = $isAllSelect;
        $this->load->view('role/adminList',$roleAdmin);
    }
    
    /**
     * 为角色添加人员
     */
    public function addAdmin(){
        $adminList  = $this->input->post('admin');
        $roleId     = (int)$this->input->post('roleId');
        if(empty($adminList)){
            $this->roleAdmin->delAdmin(array('role_id'=>$roleId));#先删除这个角色下的所有用户
            ajaxJson('已删除该角色的所有人员',300);
        }
        $this->roleAdmin->delAdmin(array('role_id'=>$roleId));#先删除这个角色下的所有用户
        $adminArr = array();
        foreach ($adminList as $adminKey => $admin){
            $adminArr[$adminKey]['role_id']          = $roleId;
            $adminArr[$adminKey]['admin_id']         = $admin;
            $adminArr[$adminKey]['create_time']      = time();
            $adminArr[$adminKey]['update_time']      = time();
            $adminArr[$adminKey]['create_id']        = $this->userInfo['id'];
            $adminArr[$adminKey]['update_id']        = $this->userInfo['id'];
        }
        $success = $this->roleAdmin->addAdminList($adminArr);
        if($success > 0){
            ajaxJson('为该角色添加人员成功');
        }else{
            ajaxJson('为该角色添加人员',300);
        }
    }
    
    /**
     * 该角色的权限信息
     */
    public function authTree(){
        $this->load->model('AuthModel','auth');
        $this->load->helpers('bui');
        $roleParams['role_id']          = (int)$this->input->get('roleId');#角色id
        $selectAuth                     = $this->roleAuth->getAllByRoleId($roleParams);
        $authAll                        = $this->auth->getAll();
        $tree                           = createBUITree($authAll,$selectAuth);
        $this->load->view('role/authTree');
    }
    /**
     * 该角色的权限信息
     */
    public function treeData(){
        $this->load->model('AuthModel','auth');
        $this->load->helpers('bui');
        $roleParams['role_id']          = (int)$this->input->get('roleId');#角色id
        $selectAuth                     = $this->roleAuth->getAllByRoleId($roleParams);
        $authAll                        = $this->auth->getAll();
        $tree                           = createBUITree($authAll,$selectAuth);
        die(json_encode($tree));
    }
    
    /**
     *  为角色添加权限
     */
    public function addAuth(){
        $authList       = $this->input->post('auths');
        $roleId         = (int)$this->input->post('roleId');
         if(empty($authList)){
            $this->roleAuth->delAuth(array('role_id'=>$roleId));#删除这个角色下的所有权限
            ajaxJson('已删除该角色的所有人员',300);
        }
        $this->roleAuth->delAuth(array('role_id'=>$roleId));#删除这个角色下的所有权限
        $adminArr = array();
        foreach ($authList as $authKey => $auth){
            $adminArr[$authKey]['role_id']              = $roleId;
            $adminArr[$authKey]['auth_id']              = (int)$auth;
            $adminArr[$authKey]['create_time']          = time();
            $adminArr[$authKey]['update_time']          = time();
            $adminArr[$authKey]['create_id']            = $this->userInfo['id'];
            $adminArr[$authKey]['update_id']            = $this->userInfo['id'];
        }
        $success = $this->roleAuth->addAuthList($adminArr);
        if($success > 0){
            ajaxJson('为该角色添加权限成功');
        }else{
            ajaxJson('为该角色添加权限失败',300);
        }
    }
}
