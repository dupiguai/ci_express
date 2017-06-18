<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Modify_model extends CI_Model{
	public function change_psc($info,$sid){
		$this->db->update('staff',$info,array('sid' => $sid));
	}
}
?>