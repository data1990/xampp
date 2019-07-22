<?php
class Home extends MY_controller
{
	
	function __construct()
	{
		# code...
		parent::__construct();
	}
	function index()
	{
		$data = array();
		$data['temp'] ='quantri/main';
		$this->load->view('quantri/index',$data);
	}
	function logout()
	{
		if($this->session->userdata('login'))
		{
			$this->session->unset_userdata('login');
			redirect(quantri_url('login/index'));

		}
	}
}
?>