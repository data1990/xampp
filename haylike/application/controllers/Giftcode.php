<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Giftcode extends CI_Controller {

	
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
			if($this->session->userdata['logged_in']['rule'] == 'admin')
			{
				$result = $this->login_model->settingcheck();
		    	foreach ($result->result() as $row)
	        	{
	        		$this->data['viplike'] = $row->viplike;
	        		$this->data['viplike2'] = $row->viplike2;
	        	}
	        	$this->data['code'] = $this->random_code();
	        	$this->form_validation->set_rules('code', 'Gift Code', 'trim|required|min_length[4]|xss_clean');
	        	$this->form_validation->set_rules('billing', 'Số tiền', 'trim|numeric|xss_clean');
	        	if($this->form_validation->run())
	       		{
	       			$code = $this->input->post('code');
	       			$money = $this->input->post('billing');
	       			$gc = $this->db->get('gift');
		        	foreach($gc->result() as $row)
	            	{
	            		if($code == $row->code)
	            		{
	            			$this->session->set_flashdata('error', 'code');

	            		}
	            	}
	            	if($money < 0)
            		{
            			$this->session->set_flashdata('error', 'money');
            		}else{
            			$checkmn = $this->login_model->getmoney($this->session->userdata['logged_in']['userid']);
                        if(!empty($checkmn)){
                            foreach ($checkmn->result() as $row) {
                                $sodu = $row->bill;
                                $payment = $row->payment;
                                //echo  print_r($checkmn);
                                # code...
                            }
                        }
                        if($sodu - $money > 0)
                        {
                        	$chagemoney = array('bill' => $sodu - $money);
                        	$query1 = $this->login_model->updatedb('member',$chagemoney,'id_ctv',$this->session->userdata['logged_in']['userid']);
                        	if($query1)
                        	{
                        		$gift = array(
                        						'code'		=> $code,
                        						'billing'	=> $money,
                        						'status'	=> 0,
                        						'id_ctv'	=> $this->session->userdata['logged_in']['userid'],
                        						);
                        		$codegift = $this->login_model->insertdb('gift',$gift);
                        		$uname = $this->session->userdata['logged_in']['username'];
                        		$content = "<b>$uname</b> vừa thêm Gift Code <b>$code</b> trị giá <b>".number_format($money)."</b> VNĐ";
                        		$history = array(
            								'content'	=> $content,
            								'id_ctv'	=>	$this->session->userdata['logged_in']['userid'], 
            								'time'		=> time(),
            								'type'		=> 3,
            							);
            					$his = $this->login_model->insertdb('history',$history);
            					if($his)
            					{
            						$this->session->set_flashdata('error', 'susscess');
            					}
                        	}
                        }
            		}
	       		}
		    	//$this->data['count_expires'] = 0;
		    	$this->load->view('header',$this->data);
				$this->load->view('addgiftcode',$this->data);
				$this->load->view('footer');
			}else{
				redirect('/thongtin', 'location');
			}
	    	
		}
    }
    public function listcode()
    {
    	if (!isset($this->session->userdata['logged_in'])) 
    	{
	    	redirect('/dangnhap', 'location');
		}else{
				if($this->session->userdata['logged_in']['rule'] != 'admin')
				{
					redirect('/thongtin', 'location');
				}
				if($this->session->userdata['logged_in']['rule'] =='admin')
				{
					$query = $this->db->select('gift.id, gift.code, billing, gift.status, member.name, user_name')->from('gift')->join('member','gift.id_ctv = member.id_ctv')->get();
				}else{
					$query = $this->db->select('gift.id, gift.code, billing, gift.status, member.name, user_name')->from('gift')->join('member','gift.id_ctv = member.id_ctv')->where('member.id_ctv', $this->session->userdata['logged_in']['userid'])->get();
				}
				
				foreach($query->result() as $row)
	            {

	            	$dulieu[] = array(
	                                    'id'    => $row->id,
	                                    'status' => $row->status,
	                                    'code'  => $row->code,
	                                    'billing'   => $row->billing,
	                                    'user_name'   => $row->user_name,
	                                    'name'  => $row->name,
	                                );
	            }
	            if(isset($dulieu))
	            {
	            	$this->data['dulieu'] = $dulieu;
	            }
				$this->load->view('header',$this->data);
				$this->load->view('giftcode/listgiftcode',$this->data);
				$this->load->view('footer');
			}
    }
    public function random_code()
    {
    	$length = 15;
    	$characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
	    $charactersLength = strlen($characters);
	    $randomString = '';
	    for ($i = 0; $i < $length; $i++) {
	        $randomString .= $characters[rand(0, $charactersLength - 1)];
	    }
	    return $randomString;
    }
    public function xoagiftcode()
    {

    }
}