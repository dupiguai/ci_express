<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Solve extends MY_Controller{
	public function qrreader(){
		//获取时间
		date_default_timezone_set("Asia/Hong_Kong");
        $arr=getdate();
        $time=$arr['year']."-".$arr['mon']."-".$arr['mday']." ".$arr['hours'].":".$arr['minutes'].":".$arr['seconds'].":".$arr['weekday'];
        //读取二维码信息
		include_once('/Applications/XAMPP/xamppfiles/htdocs/ci_express/php-qr-decoder/lib/QrReader.php');
		$num = $this->input->post('num');
	    $strlocal = '/Applications/XAMPP/xamppfiles/htdocs/ci_express/image/Michael_QRCode.png';//.$num;
	    $qrcode=new QrReader($strlocal);
        $text=$qrcode->text();
	    //echo $text;
	    //return;
		$action = $this->input->post('action');
		$destnation = $this->input->post('destnation');
		//查询员工信息
		$sid = $this->session->userdata('sid');
		$this->load->model('search_model','search');
		$data = $this->search->search_sid($sid);
		$express_name = $data[0]['express_name'];
		$name = $data[0]['name'];
		$phone = $data[0]['phone'];
		$location = $data[0]['location'];
		if($action=='揽件')
		{
			$address="#".$time."#快递已被揽收，".$location."，扫描员".$name;
			$info =  array(
				'express_num' => $text,
				'express_address' => $address,
				'express_name' => $express_name
				);
			$info2 = array(
				'location' => $location,
				'express_num' => $text
				);
            $this->load->model('solve_model','solve');
            $this->solve->embrace($info);
            $this->solve->add($info2);
            echo '揽件完成!';
		}
		else if($action=='派送')
		{
			$this->load->model('search_model','search');
			$data = $this->search->search_address($text);
			$address = $data[0]['express_address'];
			$address .= "#".$time."#快递正在派送中,派送员".$name."，电话：".$phone;
			$info = array(
				'express_address' => $address
				);
			$this->load->model('solve_model','solve');
			$this->solve->send($info,$text);
			$this->solve->move($text);
			echo '派送完成!';
			
		}
		else if($action=='接收')
		{
			$this->load->model('search_model','search');
			$data = $this->search->search_address($text);
			$address = $data[0]['express_address'];
			$address .= "#".$time."#快递已到".$location.",扫描员".$name;
			$info = array(
				'express_address' => $address
				);
            $this->load->model('solve_model','solve');
            $this->solve->send($info,$text);
            $info2 = array(
            	'location' => $location,
            	'express_num' => $text
            	);
            $this->solve->add($info2);
            echo '接收完成!';
		}
		else if($action=='签收')
		{
			$this->load->model('search_model','search');
			$data = $this->search->search_address($text);
			$address = $data[0]['express_address'];
			$address .= "#".$time."#快递已签收";
			$info = array(
				'express_address' => $address
				);
            $this->load->model('solve_model','solve');
            $this->solve->send($info,$text);
            echo '签收完成!';
		}
		else
		{
			$this->load->model('search_model','search');
			$data = $this->search->search_address($text);
			$address = $data[0]['express_address'];
			$address .= "#".$time."#快递已从".$location."发出,扫描员".$name."。正在发往".$destnation;
			$info = array(
				'express_address' => $address
				);
            $this->load->model('solve_model','solve');
            $this->solve->send($info,$text);
            $this->solve->move($text);
            echo '更新完成!';
		}
	}
}
?>