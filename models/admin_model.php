<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_model extends CI_Model{
	public function check($username){
		$data = $this->db->get_where('staff',array('id'=>md5($username)))->result_array();
		return $data;
	}

}
?>