<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 *  CodeIgniter 
 *  后台用户
 * @author Han Jian <18335831710@163.com>
 * @date 2017-2-9 16:47:19 
 */
class Blog extends CI_Controller {
    public function index(){
        //获取菜单
        $this->load->model('CategoryModel','Category');
        $menu = $this->Category->getMenu(array('kv'=>true));
        $data['menu'] = $menu;
        $cateId = $this->input->get('cateId');
        $data['cateId'] = empty($cateId) ? 1 : $cateId;
        $this->load->view('blog/index',$data);
    }
}
