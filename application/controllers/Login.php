<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	/**
         * 登录类
	 */
	public function index()
	{
		$this->load->view('login/login');
	}
}
