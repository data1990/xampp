<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Member extends CI_Controller {

	
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
				$query = $this->db->where('rule' !='agency')->get('member');
				foreach($query->result() as $row)
	            {
	            	$dulieu[] = array(
	                                    'id_ctv'    => $row->id_ctv,
	                                    'num_id' => $row->num_id,
	                                    'status'   => $row->status,
	                                    'rule'  => $row->rule,
	                                    'status'   => $row->status,
	                                    'baomat'   => $row->baomat,
	                                    'name'  => $row->name,
	                                    'user_name' => $row->user_name,
	                                    'profile'  => $row->profile,
	                                    'bill'  => $row->bill,
	                                    'payment'  => $row->payment,	                                    
	                                );
	            }
	            if(isset($dulieu))
	            {
	                $this->data['member'] = $dulieu;
	            }
				$this->load->view('header',$this->data);
				$this->load->view('member',$this->data);
				$this->load->view('footer');
			}else{
				redirect('/thongtin', 'location');
			}
	    	
		}
    }
}