<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Token extends CI_Controller {

	
	public function __construct()
    {
        parent::__construct();
        $this->load->model('login_model');
        $this->load->model('facebook_model');
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
	        	$this->data['like'] = $this->login_model->counttable('tokenlike');
	        	$this->data['cmt'] = $this->login_model->counttable('tokencmt');
	        	$this->data['sub'] = $this->login_model->counttable('autosub');
	        	$this->data['share'] = $this->login_model->counttable('autoshare');
		    	//$this->data['count_expires'] = 0;
		    	$this->load->view('header',$this->data);
				$this->load->view('addtoken',$this->data);
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
		$gd = $this->input->post('gender');
		$gender = isset($gd) ? $gd : 'undefined';
		$name = urldecode($this->input->post('name'));
		$checkuid = $this->db->where('user_id',$uid)->get($tb);
		if($checkuid->num_rows() > 0)
		{
			$this->session->set_flashdata('error', 'khongcoid');
			$this->index();
		}else{
			if($tb == 'autocmt'){
				$data = array(
							'user_id'	=> $uid,
							'name'		=> $name,
							'access_token'	=>	$token,
							'gender'	=> $gender,
				);
			}else{
				$data = array(
							'user_id'	=> $uid,
							'name'		=> $name,
							'access_token'	=>	$token,
							
						);
			}
			$query = $this->login_model->insertdb($tb,$data);
			if($query)
			{
				echo 'success';
				
			}
		}
    }
    public function deltoken()
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
	        	
	        	$this->data['like'] = $this->login_model->counttable('tokenlike');
	        	$this->data['cmt'] = $this->login_model->counttable('tokencmt');
	        	$this->data['sub'] = $this->login_model->counttable('autosub');
	        	$this->data['share'] = $this->login_model->counttable('autoshare');
		    	//$this->data['count_expires'] = 0;
		    	$this->load->view('header',$this->data);
				$this->load->view('delltoken',$this->data);
				$this->load->view('footer');
			}else{
				redirect('/thongtin', 'location');
			}
	    	
		}
    }

    public function gettokendb()
    {
    	$table = $this->input->post('table');
    	//echo $table;
		//$token = $this->input->post('token');
		$gettoken = $this->login_model->gettoken($table);
		$dellok = 0;
		$dellfail = 0;
		foreach ($gettoken->result() as $row)
        	{
        		$tokensv[] = $row->access_token;
        	}
        return $tokensv;
    }
    public function deltokendb()
    {
    	$table = $this->input->post('table');
    	
    }
}