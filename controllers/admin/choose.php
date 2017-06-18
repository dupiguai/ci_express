<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Choose extends MY_Controller{
	public function find()
	{
		$this->load->view('admin/find.html');
	}
	public function update()
	{
		$this->load->view('admin/update.html');
	}
	public function receive()
	{
		$this->load->view('admin/receive.html');
	}
	public function send()
	{
		$this->load->view('admin/send.html');
	}
	public function accept()
	{
		$this->load->view('admin/accept.html');
	}
    public function search()
    {
    	$sid = $this->session->userdata('sid');
    	$this->load->model('search_model','search');
    	$info = $this->search->search_sid($sid);
    	$location = $info[0]['location'];
    	$data = $this->search->search_all($location);
    	$arr = array();
    	for($i=0;$i<count($data);$i++)
    	{
            $arr[] = $data[$i]['express_num'];
    	}
    	$send['num'] = $arr;
        $this->load->view('admin/search.php',$send);
    }
    public function modify()
    {
    	$this->load->view('admin/change.html');
    }
    public function change()
    {
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
		$sid = $this->session->userdata('sid');
		$opsc = $arr[1];
		$npsc = $arr[2];
		$cnpsc = $arr[3];
		if($npsc!==$cnpsc)
		{
			exit('两次密码不相等，请重新输入!');
		}
		else{
			$this->load->model('search_model','search');
			$psc = $this->search->search_sid($sid);
            if(md5($opsc)!=$psc[0]['password'])
            {
            	exit('密码不正确!');
            }
            else{
            	$this->load->model('modify_model','modify');
            	$info = array(
            		'password' => md5($npsc)
            		);
            	$this->modify->change_psc($info,$sid);
            	echo '修改成功!';
            }
		}
    }
}
?>