<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Solve_model extends CI_Model{
	public function embrace($info){
        $this->db->insert('express_info',$info);
	}
	public function add($info2){
		$this->db->insert('express_location',$info2);
	}
	public function send($info,$text){
		$this->db->update('express_info',$info,array('express_num' => $text));
	}
	public function move($text){
		$this->db->delete('express_location',array('express_num' => $text));
	}
}
?>