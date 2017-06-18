<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends MY_Controller{
	public function index(){
		//echo base_url('styles/admin/');
		$this->load->view('admin/index.html');
	}
	public function find(){
		$this->load->view('admin/find.html');
	}
}
?>