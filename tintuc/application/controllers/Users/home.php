<?php
class Home extends MY_controller
{
	
	function __construct()
	{
		parent::__construct();
		//$this->load->model('baiviet_model');
		$this->load->model('users_model');
	}
	function index()
	{
		$data = array();
		//$list = $this->danhmuc_model->get_list();
		//$data['list'] = $list;
		$list = $this->users_model->get_list();
		$data['title'] = 'Danh sách User';
		$data['list'] = $list;
		$data['temp'] ='quantri/users/xemuser';
		$this->load->view('quantri/index',$data);
	}
	function taouser()
	{
		$data = array();
		//$list = $this->danhmuc_model->get_list();
		//$data['list'] = $list;
		$list = $this->users_model->get_list();
		$data['title'] = 'Tạo User';
		$data['list'] = $list;
		$data['temp'] ='quantri/users/taouser';
		$this->load->view('quantri/index',$data);
	}
	function banneduser()
	{
		$id = $this->uri->segment(3);
		$input = array('banned' => 1);
		$this->users_model->update($id,$input);
		
		$this->session->flashdata('thongbao','Banned thành công !');
		redirect(quantri_url('users.html'));
	}
	function unbanneduser()
	{
		$id = $this->uri->segment(3);
		$input = array('banned' => 0);
		$this->users_model->update($id,$input);
		
		$this->session->flashdata('thongbao','Banned thành công !');
		redirect(quantri_url('users.html'));
	}
}