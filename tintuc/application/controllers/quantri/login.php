<?php
class Login extends My_controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('thanhvien_model');
	}
	function index()
	{
		$data['title'] = 'Đăng nhập';
		if($this->input->post())
		{
			$this->form_validation->set_rules('login','Đăng nhập','callback_checklogin');
			if($this->form_validation->run()) {
				//echo '12312312';
				$username=$this->input->post('username');
				$this->session->set_userdata('login',$username);
				redirect(quantri_url('index.html'));
			}else{
				$this->session->flashdata('thongbao','Sai tên đăng nhập hoặc mật khẩu !');
			}
		}
		$this->load->view('quantri/login');
	}
	function checklogin()
	{
		
		$username = $this->input->post('username');
		$password = md5($this->input->post('pass'));
		$where = array('username' =>$username,'password'=>$password);
		if($this->thanhvien_model->check_exists($where))
		{
			return true;
		}else{

			
			return false; 
			
		}

	}
}
?>