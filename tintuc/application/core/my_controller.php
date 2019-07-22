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
		if($controller !='login' && !$user)
		{
			redirect(quantri_url('login/index'));
		}
		if($controller =='login' && $user)
		{
			redirect(quantri_url('home/index'));
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