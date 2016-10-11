<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
        
	/**
         * 登录类
	 */
	public function index()
	{
            $login['captcha'] =$this->captcha();
            $this->load->helper(array('form','url','site'));
            $this->load->view('login/login',$login);
	}
        
	public function doLogin()
	{
            $this->load->model('AdminModel','admin');
	}
        
        public function doAdd(){
            $this->load->library('encryption');
            $this->load->model('AdminModel','admin');
            $this->load->helper('site');
            $userName = $this->input->post('userName');
            $password = $this->input->post('password');

            $admin['user_name'] = $userName;
            $admin['password'] = password($password);
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
            $this->load->helper('site');
            $adminUdate['password'] = password('madison');
            $adminUdate['id'] = 6;
            $this->admin->update($adminUdate);
        }
        
        public function doTest(){
            $this->load->library('session');
            echo $this->session->captcha;
        }
        
        public function doAc(){
            $this->load->model('AdminModel','admin');
            $this->load->library('form_validation');
            $this->load->helper(array('json','site'));
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
                $this->load->library('session');
                $sessionCaptcha = $this->session->captcha;
                if(strtolower($captcha) !== strtolower($sessionCaptcha)){
                    ajaxJson('登录失败,验证码不正确',300);
                }
                $admin = $this->admin->getOne(array('user_name'=>$userName));
                if(isset($admin['password']) && checkPassword($password, $admin['password'])){
                    $this->input->set_cookie('uid',$admin['user_name'],3600*24,'','/','','',TRUE);
                    $this->input->set_cookie('ukey', UKEY,3600*24,'','/','','',TRUE);
                    $this->input->set_cookie('pkey', md5(PKEY . UKEY . $admin['user_name']),3600*24,'','/','','',TRUE);
                    ajaxJson('登录成功');
                }else{
                    ajaxJson('登录失败,用户名或密码不正确',300);
                }
            }
            exit();
        }
        
        public function captcha(){
            $this->load->helper('captcha');
            $this->load->library('session');
            $vals = array(
                'img_path'  => 'public/captcha/',
                'img_url'   => 'http://hei.xiaohei.com/public/captcha/',
                'font_path' => 'public/css/fonts/georgia.ttf',
                'img_width' => 90,
                'img_height'    => 37,
                'expiration'    => 7200,
                'word_length'   => 4,
                'font_size' => 16,
                'img_id'    => 'captchaImg',
                'pool'      => '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ',

                // White background and border, black text and red grid
                'colors'    => array(
                    'background' => array(255, 255, 255),
                    'border' => array(204,204,204),
                    'text' => array(0, 0, 0),
                    'grid' => array(34,139,34)
                )
            );
            $cap = create_captcha($vals);
            if($cap){
                $this->session->set_userdata(array('captcha'=>$cap['word']));
            }
            return isset($cap['image']) ? $cap['image'] : '';
        }
        
        
}
