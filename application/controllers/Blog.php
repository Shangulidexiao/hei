<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/* 
 * 权限控制器
 * @date    2017-01-13
 * @author    hj<18335831710@163.com>
 */

class Blog extends MY_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->model('AuthModel','auth');
        $this->load->helpers('json');
    }
    
    public function index(){
        $blog['categoryJson'] = json_encode(array('cd'=>'dd'));
        $this->load->view('blog/index',$blog);
    }
   
    public function listData(){
        $page['start']          = (int)$this->input->get_post('start');
        $page['limit']          = (int)$this->input->get_post('limit');
        $params['page']         = $page;
        $params['name']         = $this->input->get_post('name',true);
        $params['parent_id']    = $this->input->get_post('parent_id');
        $params['status']       = $this->input->get_post('status');
        $authList               = $this->auth->getList($params);
        die(json_encode($authList));
    }

    public function update(){
        $update['id']           = (int)$this->input->post('id');
        $update['parent_id']    = (int)$this->input->post('parent_id');
        $update['order_by']     = (int)$this->input->post('order_by');
        $update['url']          = $this->input->post('url',true);
        $update['name']         = $this->input->post('name',true);
        $update['icon']         = $this->input->post('icon',true);
        $update['status']       = (int)$this->input->post('status');
        $update['is_show']      = (int)$this->input->post('is_show');
        $row                    = $this->auth->update($update);
        if($row){
            ajaxJson('更新成功！');
        }else{
            ajaxJson('更新失败',300);
        }
    }

    public function add(){
        $add['parent_id']     = (int)$this->input->post('parent_id');
        $add['order_by']      = (int)$this->input->post('order_by');
        $add['url']           = $this->input->post('url',true);
        $add['name']          = $this->input->post('name',true);
        $add['icon']          = $this->input->post('icon',true);
        $add['status']        = (int)$this->input->post('status');
        $newId                = $this->auth->add($add);
        if($newId){
            ajaxJson('添加成功！最新id为'.$newId);
        }else{
            ajaxJson('添加失败',300);
        }
    }

    public function remove(){
        $ids        = $this->input->post('ids');
        $idArr      = explode(',', $ids);
        $delRows    = $this->auth->del(array('idArr'=>$idArr));
        if($delRows){
            ajaxJson('删除成功！最新id为'.$newId);
        }else{
            ajaxJson('删除失败',300);
        }
    }
}
