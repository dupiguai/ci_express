<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller{
	public function index(){
		//echo base_url().'styles/index/';
        $this->load->view('index/search.html');
	}
}
?>