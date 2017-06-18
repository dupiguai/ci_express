<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller{
    public function __construct(){
    	parent::__construct();

    	$username = $this->session->userdata('username');
    	$sid = $this->session->userdata('sid');
    	if(!$username||!$sid)
    	{
    		redirect('http://localhost/ci_express/index.php/admin/login');
    	}
    }
}
?>