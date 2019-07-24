<?php
class My_controller extends CI_Controller
{
	function __construct()
	{
		parent:: __construct();
		$this->ktdangnhap();
	}
	private function ktdangnhap()
	{
		$controller =$this->uri->segment(2);
		
		$user = $this->session->userdata('login');
		if($controller !='dangnhap.html' && !$user)
		{
			redirect(quantri_url('dangnhap.html'));
		}
		if($controller =='dangnhap.html' && $user)
		{
			redirect(quantri_url('index.html'));
		}
	}
}
class My_baiviet extends CI_Controller
{
	function __construct()
	{
		parent:: __construct();
		
	}
}
?>