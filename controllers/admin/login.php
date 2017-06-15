<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller{
	public function index(){
		$this->load->view('admin/login.html');
	}

	public function code(){
		$conf['name'] = 'verify_code'; //作为配置参数  
		$this->load->library('captcha_code',$conf);
		$this->captcha_code->show();
	}

	public function login_in(){
		$code = $this->input->post('passcode');
		if($code!=$_SESSION['verify_code'])
		{
			$this->session->sess_destroy();
			exit("验证码错误!");
		}
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$this->load->model('admin_model','admin');
		$data = $this->admin->check($username);
		if(!$data||$data[0]['password']!=md5($password))
		{
			exit("用户名或密码错误!");
		}
		else{
			$sessionData = array(
				'username' => $data[0]['name'],
				'sid' => $data[0]['sid']
				);
			$this->session->set_userdata($sessionData);
		}
	}
	public function logout(){
		$this->session->sess_destroy();
		redirect('admin/login');
	}
}