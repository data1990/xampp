<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Exp extends CI_Controller {

	
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
			
	    	$result = $this->login_model->settingcheck();
	    	foreach ($result->result() as $row)
        	{
        		$this->data['viplike'] = $row->viplike;
        		$this->data['viplike2'] = $row->viplike2;
        	}
        	$time = time();
        	if($this->session->userdata['logged_in']['rule']!= 'admin') {
        		$qlike = $this->db->where(array('end-$time' <= 480000,'id_ctv' => $this->session->userdata['logged_in']['userid']))->get('vip');
        		$qlike2 = $this->db->where(array('end-$time' <= 480000,'id_ctv' => $this->session->userdata['logged_in']['userid']))->get('vipsv2');
        		$qcmt = $this->db->where(array('end-$time' <= 480000,'id_ctv' => $this->session->userdata['logged_in']['userid']))->get('vipcmt');
        		$qreaction = $this->db->where(array('end-$time' <= 480000,'id_ctv' => $this->session->userdata['logged_in']['userid']))->get('vipreaction');
        		
        	}else if ($this->session->userdata['logged_in']['rule'] == 'admin' && $this->session->userdata['logged_in']['userid'] != 1 ) {
        		$qlike = $this->db->where(array('end-$time' <= 480000,'id_ctv' > 0))->get('vip');
        		$qlike2 = $this->db->where(array('end-$time' <= 480000,'id_ctv' > 0))->get('vipsv2');
        		$qcmt = $this->db->where(array('end-$time' <= 480000,'id_ctv' > 0))->get('vipcmt');
        		$qreaction = $this->db->where(array('end-$time' <= 480000,'id_ctv' > 0))->get('vipreaction');

        	}else{
        		$qlike = $this->db->where('end-$time' <= 480000)->get('vip');
        		$qlike2 = $this->db->where('end-$time' <= 480000)->get('vipsv2');
        		$qcmt = $this->db->where('end-$time' <= 480000)->get('vipcmt');
        		$qreaction = $this->db->where('end-$time' <= 480000)->get('vipreaction');
        	}
        	if($qlike->num_rows()>0){
        	foreach($qlike->result() as $row)
            {
                $listlike[] = array(
                                    'id'    => $row->id,
                                    'start' => $row->start,
                                    'han'   => $row->han,
                                    'type'  => $row->type,
                                    'end'   => $row->end,
                                    'pay'   => $row->pay,
                                    'ctv_name'  => $row->name,
                                    'likes' => $row->likes,
                                    'max_like'  => $row->max_like,
                                    'name'  => $row->name,
                                    'user_name' => $row->user_name,
                                    'user_id'   => $row->user_id,
                                );
            }
             $this->data['listlike'] = $listlike;
            
        	}
            if($qlike2->num_rows()>0){
            foreach($qlike2->result() as $row)
            {
                $listlike2[] = array(
                                    'id'    => $row->id,
                                    'start' => $row->start,
                                    'han'   => $row->han,
                                    'type'  => $row->type,
                                    'end'   => $row->end,
                                    'pay'   => $row->pay,
                                    'ctv_name'  => $row->name,
                                    'likes' => $row->likes,
                                    'max_like'  => $row->max_like,
                                    'name'  => $row->name,
                                    'user_name' => $row->user_name,
                                    'user_id'   => $row->user_id,
                                );
            }
            $this->data['listlike2'] = $listlike2;
        	}
            if($qcmt->num_rows()>0){
            foreach($qcmt->result() as $row)
            {
                $listcmt[] = array(
                                    'id'    => $row->id,
                                    'start' => $row->start,
                                    'han'   => $row->han,
                                    'end'   => $row->end,
                                    'pay'   => $row->pay,
                                    'cmts'	=> $row->cmts,
                                    'max_cmt'	=> $row->max_cmt,
                                    'ctv_name'  => $row->name,  
                                    'gender'	=> $row->gender,
                                    'name'  => $row->name,
                                    'user_name' => $row->user_name,
                                    'user_id'   => $row->user_id,
                                    'rule'	=> $row->rule,
                                );
            }
            $this->data['listcmt'] = $listcmt;
        	}
            if($qreaction->num_rows()>0){
            foreach($qreaction->result() as $row)
            {
                $listre[] = array(
                                    'id'    => $row->id,
                               //     'start' => $row->start,
                                    'han'   => $row->han,
                                    'end'   => $row->end,
                                    'pay'   => $row->pay,
                                    'cmts'	=> $row->cmts,
                                    'max_cmt'	=> $row->max_cmt,
                                    'ctv_name'  => $row->name,  
                                    'gender'	=> $row->gender,
                                    'name'  => $row->name,
                                    'user_name' => $row->user_name,
                                    'user_id'   => $row->user_id,
                                    'rule'	=> $row->rule,
                                );
            }
            $this->data['listre'] = $listre;
        	}
           
            
            
	    	//$this->data['count_expires'] = 0;
	    	$this->load->view('header',$this->data);
			$this->load->view('exp',$this->data);
			$this->load->view('footer');
		}
    }
}