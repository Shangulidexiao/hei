<?php

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
    
    public function index(){
        $this->load->view('role/index');
    }
   
    public function listData(){
        $page['start'] = $this->input->get_post('start');
        $page['limit'] = $this->input->get_post('limit');
        $params['page'] = $page;
        $params['name'] = $this->input->get_post('name');
        $params['id'] = $this->input->get_post('id');
        $params['status'] = $this->input->get_post('status');
        $roleList = $this->role->getList($params);
        die(json_encode($roleList));
    }

    public function update(){
        $update['id']         = $this->input->post('id');
        $update['order_by']   = $this->input->post('order_by');
        $update['name']       = $this->input->post('name');
        $update['status']     = $this->input->post('status');
        $row = $this->role->update($update);
        if($row){
            ajaxJson('更新成功！');
        }else{
            ajaxJson('更新失败',300);
        }
    }

    public function add(){
        $add['order_by']      = $this->input->post('order_by');
        $add['name']          = $this->input->post('name');
        $add['status']        = $this->input->post('status');
        $newId = $this->role->add($add);
        if($newId){
            ajaxJson('添加成功！最新id为'.$newId);
        }else{
            ajaxJson('添加失败',300);
        }
    }

    public function remove(){
        $ids = $this->input->post('ids');
        $idArr = explode(',', $ids);
        $delRows = $this->role->del(array('idArr'=>$idArr));
        if($delRows){
            ajaxJson('删除成功！最新id为'.$newId);
        }else{
            ajaxJson('删除失败',300);
        }
    }
    
    public function adminList(){
        
        $roleParams['role_id'] = $this->input->get('roleId');#角色id
        
        $this->load->model('RoleAdminModel','roleAdmin');
        
        $roleAdmin['admins'] = $this->admin->getList();#所有管理员的列表
        $roleAdmin['roleAdmins'] = $this->roleAdmin->getList($roleParams);#此角色下的管理员
        
        $this->load->view('role/adminList',$roleAdmin);
    }
    
    public function addAdmin(){
        
    }
}
