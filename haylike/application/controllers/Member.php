<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Member extends CI_Controller {

	
	public function __construct()
    {
        parent::__construct();
        $this->load->model('login_model');
        if(isset($this->session->userdata['logged_in']))
        {
        	$this->data['count_like'] = $this->login_model->countlike($this->session->userdata['logged_in']['userid']);
			$this->data['count_like2'] = $this->login_model->countlikeexp2($this->session->userdata['logged_in']['userid']);
	    	$this->data['count_noti'] = $this->login_model->countnoti($this->session->userdata['logged_in']['userid']);
	    	$this->data['count_his'] = $this->login_model->counthis($this->session->userdata['logged_in']['userid']);
	    	$this->data['count_expires'] = $this->login_model->countexp($this->session->userdata['logged_in']['userid']);
	    	$this->data['count_cmt'] = $this->login_model->countcmtexp($this->session->userdata['logged_in']['userid']);
	    	$this->data['count_reaction'] = $this->login_model->countreactionexp($this->session->userdata['logged_in']['userid']);
	    	$this->data['idctv'] = $this->session->userdata['logged_in']['userid'];
        }
        if(isset($this->session->userdata['logged_in']) && $this->session->userdata['logged_in']['rule'] =='admin'){
	    	$this->data['count_gift'] = $this->login_model->countgift($this->session->userdata['logged_in']['rule'],$this->session->userdata['logged_in']['userid']);
            $this->data['count_cou'] = $this->login_model->countcou();
            $this->data['count_agency'] = $this->login_model->countagency($this->session->userdata['logged_in']['rule'],$this->session->userdata['logged_in']['userid']);
            $this->data['count_ctv'] = $this->login_model->countctv($this->session->userdata['logged_in']['rule'],$this->session->userdata['logged_in']['userid']);
            $this->data['count_member'] = $this->login_model->countmember();
        }
    }
    public function index()
    {
    	if (!isset($this->session->userdata['logged_in'])) 
    	{
	    	redirect('/dangnhap', 'location');
		}else{
			if($this->session->userdata['logged_in']['rule'] == 'admin')
			{
				$query = $this->db->where('rule' , 'member')->get('member');
				foreach($query->result() as $row)
	            {
	            	$dulieu[] = array(
	                                    'id_ctv'    => $row->id_ctv,
	                                    'num_id' 	=> $row->num_id,
	                                    'status'   	=> $row->status,
	                                    'rule'  	=> $row->rule,
	                                    'status'   	=> $row->status,
	                                    'baomat'   	=> $row->baomat,
	                                    'name'  	=> $row->name,
	                                    'user_name' => $row->user_name,
	                                    'profile'  	=> $row->profile,
	                                    'bill'  	=> $row->bill,
	                                    'payment'	=> $row->payment,	
	                                    'email'		=> $row->email,
	                                );
	            }
	            if(isset($dulieu))
	            {
	                $this->data['member'] = $dulieu;
	            }
				$this->load->view('header',$this->data);
				$this->load->view('member/member',$this->data);
				$this->load->view('footer');
			}else{
				redirect('/thongtin', 'location');
			}
	    	
		}
    }
    public function kichhoat()
    {
    	$layid=$this->uri->segment('2');
    	
    	$data = array('status' => 1);
    	$query = $this->login_model->updatedb('member',$data,'id_ctv',$layid);
    	if($query)
    	{
            $getinfo = $this->db->where('id_ctv',$layid)->get('member');
                foreach($getinfo->result() as $row)
                {
                    $name = $row->id_ctv;
                    $user_name = $row->user_name;
                }
                $uname = $this->session->userdata['logged_in']['username'];
                $cnt = "CTV <b>{$name} ({$user_name})</b> vừa được <b>$uname</b> kích hoạt!!";
                $noti = array(
                                'content'   => $cnt,
                                'time'      => time(),
                                'id_ctv'    => $this->session->userdata['logged_in']['userid'],
                                );
                $not = $this->login_model->insertdb('noti',$noti);

    		$this->session->set_flashdata('error', 'kichhoatok');
    		redirect('/member', 'location');
    	}else{
    		$this->session->set_flashdata('error', 'kichhoatfail');
    		redirect('/member', 'location');
    	}
    }
    public function khoaacc()
    {
        $layid=$this->uri->segment('2');
        
        $data = array('status' => -1);
        $query = $this->login_model->updatedb('member',$data,'id_ctv',$layid);
        if($query)
        {
            $getinfo = $this->db->where('id_ctv',$layid)->get('member');
                foreach($getinfo->result() as $row)
                {
                    $name = $row->id_ctv;
                    $user_name = $row->user_name;
                }
                $uname = $this->session->userdata['logged_in']['username'];
                $cnt = "<b>$uname</b> đã <b>  Khóa</b> tài khoản của đại lý <b>{$name} ({$user_name})</b>";
                $noti = array(
                                'content'   => $cnt,
                                'time'      => time(),
                                'id_ctv'    => $this->session->userdata['logged_in']['userid'],
                                );
                $not = $this->login_model->insertdb('noti',$noti);

            $this->session->set_flashdata('error', 'khoaaccok');
            redirect('/member', 'location');
        }else{
            $this->session->set_flashdata('error', 'khoaaccfail');
            redirect('/member', 'location');
        }
    }
    public function mokhoa()
    {
        $layid=$this->uri->segment('2');
        
        $data = array('status' => 1);
        $query = $this->login_model->updatedb('member',$data,'id_ctv',$layid);
        if($query)
        {
            $getinfo = $this->db->where('id_ctv',$layid)->get('member');
                foreach($getinfo->result() as $row)
                {
                    $name = $row->id_ctv;
                    $user_name = $row->user_name;
                }
                $uname = $this->session->userdata['logged_in']['username'];
                $cnt = "<b>$uname</b> đã <b> Mở Khóa</b> tài khoản của Đại lí <b>{$name} ({$user_name})</b>";
                $noti = array(
                                'content'   => $cnt,
                                'time'      => time(),
                                'id_ctv'    => $this->session->userdata['logged_in']['userid'],
                                );
                $not = $this->login_model->insertdb('noti',$noti);
            $this->session->set_flashdata('error', 'mokhoaok');
            redirect('/member', 'location');
        }else{
            $this->session->set_flashdata('error', 'mokhoafail');
            redirect('/member', 'location');
        }
    }
}