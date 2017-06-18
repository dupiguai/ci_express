<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Search_model extends CI_Model{
	public function search_sid($sid){
		$data = $this->db->get_where('staff',array('sid' => $sid))->result_array();
		return $data;
	}
	public function search_address($text){
		$data = $this->db->get_where('express_info',array('express_num' => $text))->result_array();
		return $data;
	}
	public function search_all($location){
		$data = $this->db->get_where('express_location',array('location' => $location))->result_array();
		return $data;
	}
}
?>