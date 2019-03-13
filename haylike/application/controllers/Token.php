<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Token extends CI_Controller {

	
	public function __construct()
    {
        parent::__construct();
        $this->load->model('login_model');
        $this->data['count_like'] = $this->login_model->countlike($this->session->userdata['logged_in']['userid']);
			$this->data['count_like2'] = $this->login_model->countlikeexp2($this->session->userdata['logged_in']['userid']);
	    	$this->data['count_noti'] = $this->login_model->countnoti($this->session->userdata['logged_in']['userid']);
	    	$this->data['count_his'] = $this->login_model->counthis($this->session->userdata['logged_in']['userid']);
	    	$this->data['count_expires'] = $this->login_model->countexp($this->session->userdata['logged_in']['userid']);
	    	$this->data['count_cmt'] = $this->login_model->countcmtexp($this->session->userdata['logged_in']['userid']);
	    	$this->data['count_reaction'] = $this->login_model->countreactionexp($this->session->userdata['logged_in']['userid']);
	    	$this->data['idctv'] = $this->session->userdata['logged_in']['userid'];
    }
    public function index()
    {
    	if (!isset($this->session->userdata['logged_in'])) 
    	{
	    	redirect('/dangnhap', 'location');
		}else{
			if($this->session->userdata['logged_in']['rule'] == 'admin')
			{
				$result = $this->login_model->settingcheck();
		    	foreach ($result->result() as $row)
	        	{
	        		$this->data['viplike'] = $row->viplike;
	        		$this->data['viplike2'] = $row->viplike2;
	        	}
		    	//$this->data['count_expires'] = 0;
		    	$this->load->view('header',$this->data);
				$this->load->view('viplike',$this->data);
				$this->load->view('footer');
			}else{
				redirect('/thongtin', 'location');
			}
	    	
		}
    }
    public function addtoken()
    {
    	$tb = $this->input->post('tb');
		$token = $this->input->post('t');
		$uid = $this->input->post('uid');
		$gender = isset($this->input->post('gender')) ? $this->input->post('gender') : 'undefined';
		$name = urldecode($this->input->post('name'));
		$checkuid = $this->db->where('user_id',$uid)->get($tb);
		if($checkuid->num_rows() > 0)
		{
			$this->session->set_flashdata('error', 'khongcoid');
		}else{
			if($tb == 'autocmt'){
				$data = array(
							'user_id'	=> $uid,
							'name'		=> $name,
							'access_token'	=>	$token,
							'gender'	=> $gender,
				);
			}else{
				$data
			}
		}
    }
}