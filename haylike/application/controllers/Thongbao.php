<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Thongbao extends CI_Controller {

	
	public function __construct()
    {
        parent::__construct();
        $this->load->model('login_model');
        $this->load->model('facebook_model');
        $this->load->library('form_validation');
        $this->load->helper('form');
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
			if($this->session->userdata['logged_in']['rule'] == 'admin' && $this->session->userdata['logged_in']['userid'] != 1)
			{
				$query = $this->db->select('id, content, time, status')->where('id_ctv',$this->session->userdata['logged_in']['userid'])->get('noti');
				foreach($query->result() as $row)
	            {
	            	$dulieu[] = array(
	                                    'id'    => $row->id,
	                                    'time' => $row->time,
	                                    'status'   => $row->status,
	                                    'content'   => $row->content,

	                                );
	            }
			}else{
				$query = $this->db->select('noti.id, noti.content, noti.time, noti.status, member.name,member.user_name')->from('noti')->join('member','noti.id_ctv = member.id_ctv')->get();
				foreach($query->result() as $row)
	            {
	            	$dulieu[] = array(
	                                    'id'    => $row->id,
	                                    'time' => $row->time,
	                                    'status'   => $row->status,
	                                    'name'  => $row->name,
	                                    'user_name'   => $row->user_name,
	                                    'content'   => $row->content,

	                                );
	            }
			}
			
            if(isset($dulieu))
            {
                $this->data['dulieu'] = $dulieu;
            }
			$this->load->view('header',$this->data);
			$this->load->view('listthongbao',$this->data);
			$this->load->view('footer');
		}
	}
	public function xoathongbao()
	{
		$layid=$this->uri->segment('2');
            $ctv = $this->db->select('id_ctv')->where('id', $layid)->get('noti');
            foreach($ctv->result() as $row)
            {
                $id_ctv = $row->id_ctv;
               
            }        
            if($this->session->userdata['logged_in']['rule'] !='admin')
            {
            	if($id_ctv != $this->session->userdata['logged_in']['userid'])
            	{
            		$this->session->set_flashdata('error', 'loixoa');
            		redirect('/listthongbao', 'location');
            	}else
            	{
            		$noti = $this->db->delete('noti', array('id' => $layid));
            		if($noti){
            			$this->session->set_flashdata('error', 'xoaok');
            			redirect('/listthongbao', 'location');
            		}
            	}
            }else{
            	$noti = $this->db->delete('noti', array('id' => $layid));
        		if($noti){
        			$this->session->set_flashdata('error', 'xoaok');
        			redirect('/listthongbao', 'location');
        		}
            }
            if($this->session->userdata['logged_in']['rule'] =='admin' && $this->session->userdata['logged_in']['userid'] ==1){
            	$noti = $this->db->delete('noti');
        		if($noti){
        			$this->session->set_flashdata('error', 'xoaok');
        			redirect('/listthongbao', 'location');
        		}
            }
	}
}