<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Search extends CI_Controller{
	public function find(){
		$num = $this->input->post('user');
        print_r($num);
		$this->load->model('search_model','search');
        $data = $this->search->search_address($num);
        if(count($data)){
            $arr = array('address' => $data[0]['express_address'],'expressnum' => $num);
        }else{
        	$arr = array('address' => '0');
        }
        $this->load->view('index/serch.php',$arr);
	}
}
?>