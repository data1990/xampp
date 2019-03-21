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
	    	$this->data['count_gift'] = $this->login_model->countgift($this->session->userdata['logged_in']['rule'],$this->session->userdata['logged_in']['userid']);
            $this->data['count_cou'] = $this->login_model->countcou();
            $this->data['count_agency'] = $this->login_model->countagency($this->session->userdata['logged_in']['rule'],$this->session->userdata['logged_in']['userid']);
            $this->data['count_ctv'] = $this->login_model->countctv($this->session->userdata['logged_in']['rule'],$this->session->userdata['logged_in']['userid']);
            $this->data['count_member'] = $this->login_model->countmember();
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
				$this->load->view('token/addtoken',$this->data);
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
				$this->load->view('token/delltoken',$this->data);
				$this->load->view('footer');
			}else{
				redirect('/thongtin', 'location');
			}
	    	
		}
    }

    public function gettokendb()
    {
    	$table = $this->input->post('table');
		//$gettoken = $this->login_model->gettoken($table);
		$gettoken = $this->db->select('access_token')->get($table);
		$tokensv = array();
		foreach ($gettoken->result() as $row)
        	{
        		$tokensv[] = $row->access_token;
        	}
        echo json_encode($tokensv);

    }
    public function deltokendb()
    {
    	$table = $this->input->post('table');
    	$tokendie = $this->input->post('token_die');
    	
    	$query = $this->login_model->delmultitoken($tokendie,$table);
    	if($query){
    		$return['msg'] = 'Đã xoá thành công Token Die';
    		$return['soluong'] = $query;
    		echo json_encode($return);
    	}else{
    		$return['error'] = 1;
    		$return['msg'] = 'Đã xảy ra lỗi';
    		echo json_encode($return);
    	}
    }
    public function xoatokendie()
    {
    	$table = $this->input->post('table');
    	$gettoken = $this->db->select('access_token')->get($table);
    	$dem=0;
		$tokensv = array();
		foreach ($gettoken->result() as $row)
        	{
        		$check = json_decode($this->login_model->auto('https://graph.facebook.com/me?access_token='.$row->access_token),true);
        		if(!$check['id'])
		    	{
		    		$xoa = $this->db->delete($table, array('access_token' => $row->access_token));
		    		if($xoa)
		    		{
		    			$dem++;
		    		}
		    	}
        	}
        	
        	$this->session->set_flashdata('error', 'Ok');
        	$this->session->set_flashdata('dem', $dem);
        	
			$this->deltoken();
        	//return $dem;
    }
    public function deltoken1()
    {
    	$table = $this->input->post('table');
    	$token = $this->input->post('access_token');
    	$check = json_decode($this->login_model->auto('https://graph.facebook.com/me?access_token='.$token),true);
    	$return['xoaok'] = 0;
    	echo $token;echo $table;
    	if(!$check['id'])
    	{
    		$this->db->delete($table, array('access_token' => $token));

    		echo 'success';
    	}
    	//echo json_encode($return);
    }
    public function testtoken()
    {
    	$table = $this->input->post('table');
		$gettoken = $this->login_model->gettoken($table);
		foreach ($gettoken->result() as $row)
        	{
        		$tokensv[] = $row->access_token;
        	}
        	$this->data['tokensv'] = $tokensv;

        	$this->deltoken();
    }

}