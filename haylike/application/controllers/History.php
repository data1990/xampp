<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class History extends CI_Controller {

	
	public function __construct()
    {
        parent::__construct();
        $this->load->model('login_model');
        $this->load->model('facebook_model');
        $this->load->library('form_validation');
       $this->load->helper('form');
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
			if($this->session->userdata['logged_in']['rule'] != 'admin')
			{
				$lichsu = $this->db->select('id, content, time')->where(array('id_ctv'=>$this->session->userdata['logged_in']['userid'],'type' =>0))->get('history');
				$taikhoan = $this->db->select('id, content, time')->where(array('id_ctv'=>$this->session->userdata['logged_in']['userid'],'type' =>1))->get('history');
				$sodu = $this->db->select('id, content, time')->where(array('id_ctv'=>$this->session->userdata['logged_in']['userid'],'type' =>2))->get('history');
				$gift = $this->db->select('id, content, time')->where(array('id_ctv'=>$this->session->userdata['logged_in']['userid'],'type' =>3))->get('history');
				$login = $this->db->select('id, content, time')->where(array('id_ctv'=>$this->session->userdata['logged_in']['userid'],'type' =>10))->get('history');
			}elseif($this->session->userdata['logged_in']['rule'] == 'admin' && $this->session->userdata['logged_in']['userid'] != 1){
				$lichsu = $this->db->select('id, content, time')->where(array('id_ctv'=>$this->session->userdata['logged_in']['userid'],'type' =>0,'id_ctv' > 0))->get('history');
				$taikhoan = $this->db->select('id, content, time')->where(array('id_ctv'=>$this->session->userdata['logged_in']['userid'],'type' =>1,'id_ctv' > 0))->get('history');
				$sodu = $this->db->select('id, content, time')->where(array('id_ctv'=>$this->session->userdata['logged_in']['userid'],'type' =>2,'id_ctv' > 0))->get('history');
				$gift = $this->db->select('id, content, time')->where(array('id_ctv'=>$this->session->userdata['logged_in']['userid'],'type' =>3,'id_ctv' > 0))->get('history');
				$login = $this->db->select('id, content, time')->where(array('id_ctv'=>$this->session->userdata['logged_in']['userid'],'type' =>10,'id_ctv' > 0))->get('history');
			}else{
				$lichsu = $this->db->select('id, content, time')->where('type', 0)->get('history');
				$taikhoan = $this->db->select('id, content, time')->where('type' , 1)->get('history');
				$sodu = $this->db->select('id, content, time')->where('type' ,2)->get('history');
				$gift = $this->db->select('id, content, time')->where('type' ,3)->get('history');
				$login = $this->db->select('id, content, time')->where('type' ,10)->get('history');
			}
		}
		foreach($lichsu->result() as $row)
        {
        	$lichsu1[] = array(
                                'id'    => $row->id,
                                'content' => $row->content,
                                'time'  => $row->time,
                            );
        }
	    foreach($taikhoan->result() as $row)
        {
        	$taikhoan1[] = array(
                                'id'    => $row->id,
                                'content' => $row->content,
                                'time'  => $row->time,
                            );
        }
        foreach($sodu->result() as $row)
        {
        	$sodu1[] = array(
                                'id'    => $row->id,
                                'content' => $row->content,
                                'time'  => $row->time,
                            );
        }
        foreach($gift->result() as $row)
        {
        	$gift1[] = array(
                                'id'    => $row->id,
                                'content' => $row->content,
                                'time'  => $row->time,
                            );
        }
        foreach($login->result() as $row)
        {
        	$login1[] = array(
                                'id'    => $row->id,
                                'content' => $row->content,
                                'time'  => $row->time,
                            );
        }
        
		if(isset($lichsu1)){$this->data['lichsu'] = $lichsu1;}
		if(isset($taikhoan1)){$this->data['taikhoan'] = $taikhoan1;};
		if(isset($sodu1)){$this->data['sodu'] = $sodu1;}
		if(isset($gift1)){$this->data['gift'] = $gift1;}
		if(isset($login1)){$this->data['login'] = $login1;}
		$this->load->view('header',$this->data);
		$this->load->view('history/history',$this->data);
		$this->load->view('footer');
	}
}