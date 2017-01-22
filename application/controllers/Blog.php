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
        $this->load->model('BlogModel','blog');
        $this->load->helpers('json');
    }
    
    public function index(){
        #获取分类列表的kv
        $this->load->model('CategoryModel','category');
        $blog['categoryJson'] = json_encode($this->category->getkv());
        $this->load->view('blog/index',$blog);
    }
   
    public function listData(){
        $page['start']          = (int)$this->input->post('start');
        $page['limit']          = (int)$this->input->post('limit');
        $params['page']         = $page;
        $params['title']        = $this->input->post('title',true);
        $params['blog_name']    = $this->input->post('blog_name',true);
        $params['user_name']    = $this->input->post('user_name',true);
        $params['category_id']      = (int)$this->input->post('cate_id');
        $params['status']       = $this->input->post('status');
        $params['delete']       = $this->input->post('delete');
        $blogList               = $this->blog->getList($params);
        die(json_encode($blogList));
    }

    public function showTpl(){
        $this->load->helper('form');
        $this->load->model('CategoryModel','category');
        $blogId = $this->input->get('blogId');
        $blog = $this->blog->getOne(array('id'=>(int)$blogId));
        if(!$blog){
            $blog['title'] = '';
            $blog['content'] = '';
            $blog['keywords'] = '';
            $blog['description'] = '';
            $blog['status'] = 0;
            $blog['is_visable'] = 0;
            $blog['is_comment'] = 0;
            $blog['category_id'] = 0;
            $blog['order_by'] = 0;
            $blog['read_num'] = 0;
        }
        $blogArr['blog'] = $blog;
        $blogArr['statusKv'] = array(0=>'正常',1=>'禁用');
        $blogArr['commentKv'] = array(0=>'允许',1=>'不允许');
        $blogArr['visableKv'] = array(0=>'可见',1=>'不可见');
        $blogArr['categoryKv'] = $this->category->getkv();
        $this->load->view('/blog/add',$blogArr);
    }
    public function saveBlog(){
        $blogArr['id'] = (int)$this->input->post('id');
        $this->load->library('form_validation');
        if(empty($blogArr['id'])){
            if($this->form_validation->run('blog') === FALSE){
                redirect('/Blog/showTpl');
            }
            $this->add();
        }else{
            if($this->form_validation->run('blog') === FALSE){
                redirect('/Blog/showTpl?blogId='.$blogArr['id']);
            }
            $this->update();
        }
    }
    private function update(){
        
        $update['title']           = $this->input->post('title',true);
        $update['content']         = $this->input->post('content',true);
        $update['keywords']        = $this->input->post('keywords',true);
        $update['description']     = $this->input->post('description',true);
        $update['category_id']     = (int)$this->input->post('category_id');
        $update['is_comment']       = (int)$this->input->post('is_comment');
        $update['is_visable']       = (int)$this->input->post('is_visable');
        $update['order_by']        = (int)$this->input->post('order_by');
        $update['status']          = (int)$this->input->post('status');
        $update['id']              = (int)$this->input->post('id');
        $row                       = $this->blog->update($update);
        $this->load->helper('url');
        redirect('/Blog/showTpl?blogId='.$update['id']);
    }

    private function add(){
        $add['title']           = $this->input->post('title',true);
        $add['content']         = $this->input->post('content',true);
        $add['keywords']        = $this->input->post('keywords',true);
        $add['description']     = $this->input->post('description',true);
        $add['category_id']     = (int)$this->input->post('category_id');
        $add['is_comment']       = (int)$this->input->post('is_comment');
        $add['is_visable']       = (int)$this->input->post('is_visable');
        $add['order_by']        = (int)$this->input->post('order_by');
        $add['status']          = (int)$this->input->post('status');
        $newId                  = $this->blog->add($add);
        $this->load->helper('url');
        redirect('/Blog/showTpl?blogId='.$newId);
    }

    public function remove(){
        $ids        = $this->input->post('ids');
        $idArr      = explode(',', $ids);
        $delRows    = $this->blog->del(array('idArr'=>$idArr));
        if($delRows){
            ajaxJson('删除成功！');
        }else{
            ajaxJson('删除失败',300);
        }
    }
}
