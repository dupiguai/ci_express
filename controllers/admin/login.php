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
		$private_key='-----BEGIN RSA PRIVATE KEY-----
MIICXAIBAAKBgQC2dWtjFMHKriJb56w/WNOcICDQSH74691pqfwibPDkzdV7xRfN
kwiS0UV+Jy2htyguqsLjRXTaECoMhPoXq1RCXZepnIW9gj+0UcJ2nZ0PKUfVQvd6
1tSAZRGhs/YX18f4qOQnH/Dhz1Jvh99R6MEBapCaklMkStrhGvyK46QRgQIDAQAB
AoGADF6bgCUZGj+B7s8e+1BvUCdRci1oBkIfSZmPkVnnXuuhbHmpKnOsYh+z4WCQ
lGURYVCMU9ISoPH1l9GwDsi7toLE2YiCiqlkDX2vabB4YEwZbnX+SObZq+sMRRAS
6Bv2pFQV4OIiTKYr0pIjjJPH4dBITzhKUl/m2aBXDCzD8y0CQQDgQzlwrvjYVQZF
C76tl38O38QbcpE4bV9D2kqf19jYlFNz4oJt6IuWaWaDZjQP5DMXLOHMyrbbn8/C
lSdEmztHAkEA0Eev4Hgl/FP0w1AitjnzpBLCTrbugjG67ie4FrZ21j/JPAYjr7eg
HrlmPy3/hUn1jfsOpYX4HCGvYe4DsmMg9wJAOj6bY32+GYlzmGkle7ZWBInvR+Wo
e8xEKr4+FWec5RsY1Yclst/rqQP04PmhWeM9ta4tct/PQBkwf2v3h+T9LwJBAMnh
Ik1dx9va+LyzmOGuLEUVVbd8QpR5ZWnfn+SL+YXTj9cZUE/KmW4OYFfO2wQz2spC
1UCFKScDU36FeJnY0aMCQEoIxMGeAjJpc9CUufO9/WQZ1aMRek7VZIRVKquTpGEk
wvmnrsOy3RTN9uoiHEvT3289Dino0KDjqB4mQlJKg0M=
-----END RSA PRIVATE KEY-----';
        $data = file_get_contents('php://input');
        $data2 = urldecode($data);
        $pi_key=openssl_pkey_get_private($private_key);
		//$data = $GLOBALS['HTTP_RAW_POST_DATA'];
		openssl_private_decrypt(base64_decode($data2), $decrypted, $pi_key);
		$arr = explode("#",$decrypted);
		$timestamp = base64_decode($arr[4]);
		$time = time();
		if($time-$timestamp>5)
		{
			$this->session->sess_destroy();
			exit('连接超时!');
		}
		$code = $arr[3];
		if($code!=$_SESSION['verify_code'])
		{
			$this->session->sess_destroy();
			exit("验证码错误!");
		}
		$username = $arr[1];
		$password = $arr[2];
		$this->load->model('admin_model','admin');
		$data = $this->admin->check($username);
		if(!$data||$data[0]['password']!=md5($password))
		{
			$this->session->sess_destroy();
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
		redirect('http://localhost/ci_express/index.php/admin/login');
	}
}