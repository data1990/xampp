<?php
class Home extends My_baiviet
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('baiviet_model');
		$this->load->model('member_model');
	}
	public function index()
	{
		$data = array();

		$list = $this->baiviet_model->get_list_limit(6);
		$data['list'] = $list;
		$data['temp'] ='trangchu/main';
		$this->load->view('trangchu/index',$data);
	}
	function xembai()
	{
		$data = array();
		$this->load->model('danhmuc_model');
		$idbv = $this->uri->segment(1);
		//echo $idbv;
		$row = $this->baiviet_model->get_info_column('slug',$idbv);
		$listcm = $this->danhmuc_model->get_info($row->idcm);
		$list = $this->baiviet_model->get_list();
		$data['list'] = $list;
		$data['chuyenmuc'] = $listcm->tencm;
		$data['row'] = $row;
		$data['temp'] ='trangchu/xembai';
		$this->load->view('trangchu/index',$data);	
	}
	function tintuc()
	{
		$data = array();
		$this->load->model('danhmuc_model');
		$idbv = $this->uri->segment(1);
		
		
		$listcm = $this->danhmuc_model->get_info_column('slug',$idbv);

		$list = $this->baiviet_model->get_list_column('idcm',$listcm->id);
		//print_r($list);
		$data['list'] = $list;
		$data['chuyenmuc'] = $listcm->tencm;
		//$data['row'] = $list;
		$data['temp'] ='trangchu/tintuc';
		$this->load->view('trangchu/index',$data);	
	}
	function checklogin()
	{
		//echo 'test';
		$output = array('error' => false);

		$username = $_POST['username'];
		$password = $_POST['password'];
		$data = array('username' => $username,'password' => md5($password));
		$data = $this->member_model->check_exists($data);

		if($data){
			$this->session->set_userdata('user', $username);
			$output['message'] = 'Đang đăng nhập. Vui lòng chờ...';
		}
		else{
			$output['error'] = true;
			$output['message'] = 'Tên đăng nhập hoặc mật khẩu không đúng !';
		}
		echo json_encode($output); 
	}
	function logoutuser()
	{
		
			$this->session->unset_userdata('user');
			redirect(base_url());

		
	}
}
?>