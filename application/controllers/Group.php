<?php

/**
 *  CodeIgniter 
 *  组控制器
 * @author Han Jian <18335831710@163.com>
 * @date 2016-11-6 16:51:49 
 */


class Group extends MY_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->model('GroupModel','group');
        $this->load->helpers('json');
    }
    
    public function index(){
        $this->load->view('group/index');
    }
   
    public function listData(){
        $page['start']          = $this->input->get_post('start');
        $page['limit']          = $this->input->get_post('limit');
        $params['page']         = $page;
        $params['name']         = $this->input->get_post('name');
        $params['parent_id']    = $this->input->get_post('parent_id');
        $params['status']       = $this->input->get_post('status');
        $roleList               = $this->group->getList($params);
        die(json_encode($roleList));
    }

    public function update(){
        $update['id']         = $this->input->post('id');
        $update['order_by']   = $this->input->post('order_by');
        $update['name']       = $this->input->post('name');
        $update['status']     = $this->input->post('status');
        $row                  = $this->group->update($update);
        if($row){
            ajaxJson('更新成功！');
        }else{
            ajaxJson('更新失败',300);
        }
    }

    public function add(){
        $add['parent_id']     = $this->input->post('parent_id');
        $add['order_by']      = $this->input->post('order_by');
        $add['name']          = $this->input->post('name');
        $add['status']        = $this->input->post('status');
        $newId                = $this->group->add($add);
        if($newId){
            ajaxJson('添加成功！最新id为'.$newId);
        }else{
            ajaxJson('添加失败',300);
        }
    }

    public function remove(){
        $ids        = $this->input->post('ids');
        $idArr      = explode(',', $ids);
        $delRows    = $this->group->del(array('idArr'=>$idArr));
        if($delRows){
            ajaxJson('删除成功！最新id为'.$newId);
        }else{
            ajaxJson('删除失败',300);
        }
    }
}
