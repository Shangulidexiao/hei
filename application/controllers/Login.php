<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
        
	/**
         * 登录类
	 */
	public function index()
	{
            $this->load->helper(array('form','url'));
            $this->load->view('login/login');
	}
        
	public function doLogin()
	{
		$this->load->model('AdminModel','admin');
	}
        
        public function doAdd(){
                $this->load->library('encryption');
                $this->load->model('AdminModel','admin');
                $userName = $this->input->post('userName');
                $password = $this->input->post('password');
                
                $admin['user_name'] = $userName;
                $admin['password'] = password_hash($password, PASSWORD_BCRYPT );
                $admin['last_ip'] = $this->input->ip_address();
                $insertId = $this->admin->add($admin);
                if($insertId){
                    echo 'add success';
                }else{
                    echo 'add faild';
                }
        }
        
        public function doUpdate(){
            $this->load->model('AdminModel','admin');
            $adminUdate['password'] = password_hash('madison', PASSWORD_BCRYPT );
            $adminUdate['id'] = 6;
            $this->admin->update($adminUdate);
        }
        
        public function doTest(){
            $this->load->model('AdminModel','admin');
            $admin = $this->admin->getOne(array('id'=>6));
            if(password_verify('madison1', $admin['password'])){
                echo 'success';
            }else{
                echo 'falid';
            }
        }
        
        public function doAc(){
            $this->load->model('AdminModel','admin');
            $this->load->library('form_validation');
            $this->load->helper('json');
            $userName = $this->input->post('userName');
            $password = $this->input->post('password');
            $captcha = $this->input->post('captcha');
            $rules = array(
                array(
                    'field' => 'userName',
                    'label' => '用户名',
                    'rules' => 'trim|required|min_length[5]|max_length[16]'
                ),
                array(
                    'field' => 'password',
                    'label' => '密码',
                    'rules' => 'trim|required|min_length[6]'
                ),
                array(
                    'field' => 'captcha',
                    'label' => '验证码',
                    'rules' => 'trim|required|exact_length[4]'
                ),
            );
            $this->form_validation->set_rules($rules);
            $this->form_validation->set_error_delimiters('','');
            
            if($this->form_validation->run() === FALSE){
                $error = $this->form_validation->error('userName') AND ajaxJson($error,300);
                $error = $this->form_validation->error('password') AND ajaxJson($error,300);
                $error = $this->form_validation->error('captcha') AND ajaxJson($error,300);
            }else{
                $admin = $this->admin->getOne(array('user_name'=>$userName));
                if(isset($admin['password']) && password_verify($password, $admin['password'])){
                    $this->input->set_cookie('uid',$admin['user_name'],3600*24,'xiaohei.com','/','','',TRUE);
                    $this->input->set_cookie('ukey', UKEY,3600*24,'xiaohei.com','/','','',TRUE);
                    $this->input->set_cookie('pkey', md5(PKEY . UKEY . $admin['user_name']),3600*24,'xiaohei.com','/','','',TRUE);
                    ajaxJson('登录成功');
                }else{
                    ajaxJson('登录失败,用户名或密码不正确');
                }
            }
            exit();
        }
}
