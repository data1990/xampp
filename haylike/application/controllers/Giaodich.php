<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Giaodich extends CI_Controller {

	
	public function __construct()
    {
        parent::__construct();
        $this->load->model('login_model');
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
				$query = $this->db->order_by('user_name ASC')->get('member');
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
	                $this->data['dulieu'] = $dulieu;
	            }
	            $this->form_validation->set_rules('user_name', 'Tên đăng nhập', 'trim|required|min_length[4]|xss_clean');
	            $this->form_validation->set_rules('money', 'Số tiền', 'trim|numeric|xss_clean');
	            if($this->form_validation->run())
	       		{
	       			$user_name = $this->input->post('user_name');
	       			$money = $this->input->post('money');
	       			$checkmn = $this->db->where('user_name', $user_name)->get('member');
                            if(!empty($checkmn)){
                                foreach ($checkmn->result() as $row) {
                                    $sodu = $row->bill;
                                }
                            } 
	       			$chagemoney = array(
	                						'bill' => $sodu + $money,
	                						);

	                		$query1 = $this->login_model->updatedb('member',$chagemoney,'user_name',$user_name);
	                		if($query1){
	                			$uname = $this->session->userdata['logged_in']['username'];
	                			$content = "<b>$uname</b> vừa cộng <b>".number_format($money)." VNĐ</b> cho tài khoản <b>$user_name</b>";
	                			$chuyentien = array(
	                								'user_name' => $user_name,
	                								'thoigian'	=> time(),
	                								'money'		=> $money,
	                								'id_ctv'	=> $uname,
	                							);
	                			$this->login_model->insertdb('chuyentien',$chuyentien);
	                			$history = array(
            								'content'	=> $content,
            								'id_ctv'	=>	$this->session->userdata['logged_in']['userid'], 
            								'time'		=> time(),
            								'type'		=> 2,
            							);
            					$his = $this->login_model->insertdb('history',$history);
            					if($his)
            					{
            						$this->session->set_flashdata('error', 'susscess');
            					}
	                		}
	       		}
				$this->load->view('header',$this->data);
				$this->load->view('money/congtien',$this->data);
				$this->load->view('footer');
			}else{
				redirect('/thongtin', 'location');
			}
	    	
		}
    }
    public function capnhattien()
    {
    	if (!isset($this->session->userdata['logged_in'])) 
    	{
	    	redirect('/dangnhap', 'location');
		}else{
			if($this->session->userdata['logged_in']['rule'] == 'admin')
			{
				$query = $this->db->order_by('user_name ASC')->get('member');
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
	                $this->data['dulieu'] = $dulieu;
	            }
	            $this->form_validation->set_rules('user_name', 'Tên đăng nhập', 'trim|required|min_length[4]|xss_clean');
	            $this->form_validation->set_rules('money', 'Số tiền', 'trim|numeric|xss_clean');
	            if($this->form_validation->run())
	       		{
	       			$user_name = $this->input->post('user_name');
	       			$money = $this->input->post('money');
	       			 
	       			$chagemoney = array(
	                						'bill' => $money,
	                						);

	                		$query1 = $this->login_model->updatedb('member',$chagemoney,'user_name',$user_name);
	                		if($query1){
	                			$uname = $this->session->userdata['logged_in']['username'];
	                			$content = "<b>$uname</b> vừa cập nhật số dư của <b>$user_name</b> thành <b>".number_format($money)." </b>VNĐ";
	                			$history = array(
            								'content'	=> $content,
            								'id_ctv'	=>	$this->session->userdata['logged_in']['userid'], 
            								'time'		=> time(),
            								'type'		=> 2,
            							);
	                			$chuyentien = array(
	                								'user_name' => $user_name,
	                								'thoigian'	=> time(),
	                								'money'		=> $money,
	                								'id_ctv'	=> $uname,
	                							);
	                			$this->login_model->insertdb('chuyentien',$chuyentien);
            					$his = $this->login_model->insertdb('history',$history);
            					if($his)
            					{
            						$this->session->set_flashdata('error', 'susscess');
            					}
	                		}
	       		}
				$this->load->view('header',$this->data);
				$this->load->view('money/capnhattien',$this->data);
				$this->load->view('footer');
			}else{
				redirect('/thongtin', 'location');
			}
	    	
		}
    }
    public function chuyentien()
    {
    	if (!isset($this->session->userdata['logged_in'])) 
    	{
	    	redirect('/dangnhap', 'location');
		}else{
			if($this->session->userdata['logged_in']['rule'] == 'admin')
			{
				$rule = $this->session->userdata['logged_in']['rule'];
				$id = $this->session->userdata['logged_in']['userid'];
				if($rule == 'admin' && $id ==1)
				{
					$query = $this->db->order_by('user_name ASC')->get('member');
				}elseif($rule == 'admin' && $id !=1)
				{
					$query = $this->db->where('id_ctv' > 0)->order_by('user_name ASC')->get('member');
				}elseif($rule == 'agency')
				{
					$query = $this->db->where('id_agency', $id )->order_by('user_name ASC')->get('member');
				}
				
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
	                $this->data['dulieu'] = $dulieu;
	            }
	            $this->form_validation->set_rules('user_name', 'Tên đăng nhập', 'trim|required|min_length[4]|xss_clean');
	            $this->form_validation->set_rules('money', 'Số tiền', 'trim|numeric|xss_clean');
	            if($this->form_validation->run())
	       		{
	       			$user_name = $this->input->post('user_name');
	       			$money = $this->input->post('money');
	       			$checkmn = $this->login_model->getmoney($this->session->userdata['logged_in']['userid']);
	                if(!empty($checkmn)){
	                    foreach ($checkmn->result() as $row) {
	                        $sodu = $row->bill;
	                        $payment = $row->payment;
	                        
	                    }
	                }
	                $getidmember = $this->db->select('id_ctv,bill')->where('user_name',$user_name)->get('member');
	                foreach ($getidmember->result() as $row) {
	                	$idmember = $row->id_ctv;
	                	$tienmember= $row->bill;
	                }
	                if($sodu - $money >0)
	                {
	                	$chagemoney = array(
	                						'bill' => $sodu - $money,
	                						);

                		$query1 = $this->login_model->updatedb('member',$chagemoney,'id_ctv',$this->session->userdata['logged_in']['userid']);
                		if($query1)
                		{
                			$themtien = $this->db->set('bill',$tienmember+$money)->where('user_name', $user_name)->update('member');
                			if($themtien)
                			{
                				$uname = $this->session->userdata['logged_in']['username'];
	                			$content = "<b>$uname</b> vừa chuyển <b>" . number_format($money) . " VNĐ</b> cho tài khoản <b>$user_name</b>";
	                			$history = array(
            								'content'	=> $content,
            								'id_ctv'	=>	$this->session->userdata['logged_in']['userid'], 
            								'time'		=> time(),
            								'type'		=> 2,
            							);
	                			$chuyentien = array(
	                								'user_name' => $user_name,
	                								'thoigian'	=> time(),
	                								'money'		=> $money,
	                								'id_ctv'	=> $uname,
	                							);
	                			$this->login_model->insertdb('chuyentien',$chuyentien);
            					$his = $this->login_model->insertdb('history',$history);
            					if($his)
            					{
            						$c = "CTV <b>$user_name</b> vừa được <b>$uname</b> chuyển <b>" . number_format($money) . " VNĐ vào tài khoản";
            						$noti = array(
            								'content'	=> $content,
            								'id_ctv'	=>	$idmember, 
            								'time'		=> time(),
            								
            							);
            						$noti1 = $this->login_model->insertdb('noti',$noti);
            						if($noti1)
            						{
            							$this->session->set_flashdata('error', 'susscess');
            						}
            						
            					}
                			}
                		}
                		

	                }
	       		}

	        	$this->load->view('header',$this->data);
				$this->load->view('money/capnhattien',$this->data);
				$this->load->view('footer');
			}else{
				redirect('/thongtin', 'location');
			}
	    	
		}
    }
    public function top10money()
    {
    	if (!isset($this->session->userdata['logged_in'])) 
    	{
	    	redirect('/dangnhap', 'location');
		}else{
				$query = $this->db->where('payment' != 0)
									->where('user_name' != 'admin')
									->order_by('payment DESC')
									->limit(10)
									->get('member');
				foreach($query->result() as $row)
				{
					$dulieu[]= array(
									'user_name' => $row->user_name,
									'payment'	=> $row->payment,
									);
				}
				if(isset($dulieu))
	            {
	                $this->data['doanhthu'] = $dulieu;
	            }
				
    			$this->load->view('header',$this->data);
				$this->load->view('topdoanhthu',$this->data);
				$this->load->view('footer');
			}
    }
}