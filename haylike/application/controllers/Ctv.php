<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ctv extends CI_Controller {

	
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
	    	$this->load->library('form_validation');
       $this->load->helper('form');
    }
    public function index()
    {
    	if (!isset($this->session->userdata['logged_in'])) 
    	{
	    	redirect('/dangnhap', 'location');
		}
			
	    	$result = $this->login_model->settingcheck();
	    	foreach ($result->result() as $row)
        	{
        		$this->data['viplike'] = $row->viplike;
        		$this->data['viplike2'] = $row->viplike2;
        	}
        	$this->form_validation->set_rules('user_name', 'Tên đăng nhập', 'trim|required|min_length[4]|xss_clean');
	    	$this->form_validation->set_rules('password', 'Mật khẩu', 'trim|required|xss_clean');
	    	$this->form_validation->set_rules('password2', 'Nhập lại mật khẩu', 'trim|required|matches[password]|xss_clean');
	    	$this->form_validation->set_rules('name', 'Họ Tên', 'trim|required|xss_clean');
	    	$this->form_validation->set_rules('sdt', 'Số điện thoại', 'trim|required|xss_clean');
	    	$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|xss_clean');
	    	$this->form_validation->set_rules('profile', 'ID Facebook', 'trim|required|xss_clean');
	    	$this->form_validation->set_rules('money', 'Số tiền', 'trim|numeric|xss_clean');
	    	if($this->form_validation->run())
	       	{
	       		$user_name = $this->input->post('user_name');
                $password = $this->input->post('password');
                $name = $this->input->post('name');
                $sdt = $this->input->post('sdt');
                $email = $this->input->post('email');
                $idfb = $this->input->post('profile');
                $money = $this->input->post('money');
                $freelancer = $this->input->post('freelancer');
                $checkmn = $this->login_model->getmoney($this->session->userdata['logged_in']['userid']);
                if(!empty($checkmn)){
                    foreach ($checkmn->result() as $row) {
                        $sodu = $row->bill; 
                        $payment = $row->payment;                       
                    }
                } 
                if(!$this->checkusername($user_name))
	                {
	                	$this->session->set_flashdata('error', 'usename');
	                }elseif(!$this->checkreg('email',$email))
	                {
	                	$this->session->set_flashdata('error', 'email');
	                }elseif(!$this->checkreg('profile',$idfb))
	                {
	                	$this->session->set_flashdata('error', 'fbid');
	                }elseif($money < 0){
	                	$this->session->set_flashdata('error', 'money');
	                }elseif($sodu - $money < 0){
                        $this->session->set_flashdata('error', 'nomoney');
                    }
                    else{
	                    	$code = substr(md5(time() + rand(0, 9)), 0, 8);
		                    if(isset($freelancer) && $this->session->userdata['logged_in']['rule'] == 'admin')
		                    {
		                    	$data = array(
			                					'user_name' => $user_name,
			                					'password'	=> md5($password),
			                					'name'		=> $name,
			                					'phone'		=> $sdt,
			                					'email'		=> $email,
			                					'profile'	=> $idfb,
			                					'bill'		=> $money,
			                					'status'	=> 0,
			                					'code'		=> $code,
			                					'rule'		=> 'freelancer',
			                					'id_agency'	=> -1,
			                					'num_id'	=> 0,
			                				);
		                    	$uname = $this->session->userdata['logged_in']['username'];
		                    	$content = "<b>$uname</b> vừa tạo tài khoản <b>CTV không vốn: $name ( $user_name )</b>";
		                    }elseif($this->session->userdata['logged_in']['rule'] == 'admin'){
		                    	$data = array(
			                					'user_name' => $user_name,
			                					'password'	=> md5($password),
			                					'name'		=> $name,
			                					'phone'		=> $sdt,
			                					'email'		=> $email,
			                					'profile'	=> $idfb,
			                					'bill'		=> $money,
			                					'status'	=> 0,
			                					'code'		=> $code,
			                					'rule'		=> 'freelancer',
			                					'id_agency'	=> 0,
			                					'num_id'	=> 0,
			                				);
		                    	$datapay = array('payment' => $payment + $money);
		                    	$content = "<b>$uname</b> vừa tạo tài khoản <b>CTV: $name ( $user_name ) .</b>Số dư tài khoản <b>".number_format($money)."</b> VNĐ";
		                    }elseif($this->session->userdata['logged_in']['rule'] == 'agency'){
		                    	$data = array(
			                					'user_name' => $user_name,
			                					'password'	=> md5($password),
			                					'name'		=> $name,
			                					'phone'		=> $sdt,
			                					'email'		=> $email,
			                					'profile'	=> $idfb,
			                					'bill'		=> $money,
			                					'status'	=> 0,
			                					'code'		=> $code,
			                					'rule'		=> 'freelancer',
			                					'id_agency'	=> $this->session->userdata['logged_in']['userid'],
			                					'num_id'	=> 0,
			                				);
		                    	$content = "<b>$uname</b> vừa tạo tài khoản <b>CTV: $name ( $user_name ) .</b>Số dư tài khoản <b>".number_format($money)."</b> VNĐ";
		                    }
		                    $query = $this->login_model->insertdb('member',$data);
		                    if($query)
		                	{
		                		
		                		$chagemoney = array(
		                						'bill' => $sodu - $money,
		                						);

		                		$query1 = $this->login_model->updatedb('member',$chagemoney,'id_ctv',$this->session->userdata['logged_in']['userid']);
		                		if($query1)
		                		{
		                			$uname = $this->session->userdata['logged_in']['username'];
		                			
		                			$history = array(
	            								'content'	=> $content,
	            								'id_ctv'	=>	$this->session->userdata['logged_in']['userid'], 
	            								'time'		=> time(),
	            								'type'		=> 1,
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
			$this->load->view('addctv',$this->data);
			$this->load->view('footer');
			
    }
    public function checkusername($username)
    {
        $query = $this->db->where('user_name',$username)
                            ->limit(1)
                            ->get('member');
        if ($query->num_rows() !== 1)
            {
                return true;
                
            }else{
                
                return false;
            }
    }
    public function checkreg($row,$dieukien)
    {
    	$query = $this->db->where($row,$dieukien)
                            ->limit(1)
                            ->get('member');
        if ($query->num_rows() !== 1)
            {
                return true;
                
            }else{
                
                return false;
            }
    }
    public function danhsachctv()
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
        }
        if($this->session->userdata['logged_in']['rule'] == 'admin')
        {
        	$list = $this->db->where('rule','freelancer')->get('member');
        }elseif($this->session->userdata['logged_in']['rule'] == 'admin')
        {
        	$list = $this->db->where('id_agency',$this->session->userdata['logged_in']['userid'])->get('member');
        }
        
        foreach($list->result() as $row)
            {
            	$dulieu[] = array(
                                    'id_ctv'    => $row->id_ctv,
                                    'num_id' => $row->num_id,
                                    'status'   => $row->status,
                                    'name'  => $row->name,
                                    'user_name'   => $row->user_name,
                                    'profile'   => $row->profile,
                                    'email'  => $row->email,
                                    'bill' => $row->bill,
                                    'payment'  => $row->payment,
                                    
                                );
            }
            if(isset($dulieu)){
            	$this->data['danhsachdaily'] = $dulieu;
            }
        
        // load giao diện
	    	$this->load->view('header',$this->data);
			$this->load->view('listctv',$this->data);
			$this->load->view('footer');
    }
    public function kichhoat()
    {
    	$layid=$this->uri->segment('2');
    	
    	$data = array('status' => 1);
    	$query = $this->login_model->updatedb('member',$data,'id_ctv',$layid);
    	if($query)
    	{
    		$this->session->set_flashdata('error', 'kichhoatok');
    		redirect('/listctv', 'location');
    	}else{
    		$this->session->set_flashdata('error', 'kichhoatfail');
    		redirect('/listctv', 'location');
    	}
    }
    public function khoaacc()
    {
        $layid=$this->uri->segment('2');
        
        $data = array('status' => -1);
        $query = $this->login_model->updatedb('member',$data,'id_ctv',$layid);
        if($query)
        {
            $this->session->set_flashdata('error', 'khoaaccok');
            redirect('/listctv', 'location');
        }else{
            $this->session->set_flashdata('error', 'khoaaccfail');
            redirect('/listctv', 'location');
        }
    }
    public function mokhoa()
    {
        $layid=$this->uri->segment('2');
        
        $data = array('status' => 1);
        $query = $this->login_model->updatedb('member',$data,'id_ctv',$layid);
        if($query)
        {
            $this->session->set_flashdata('error', 'mokhoaok');
            redirect('/listctv', 'location');
        }else{
            $this->session->set_flashdata('error', 'mokhoafail');
            redirect('/listctv', 'location');
        }
    }
    public function capnhat()
    {
    	if (!isset($this->session->userdata['logged_in'])) 
    	{
	    	redirect('/dangnhap', 'location');
		}
    	$layid=$this->uri->segment('2');
    	$daily = $this->db->where('id_ctv',$layid)->get('member');
    	foreach($daily->result() as $row)
            {
            	$dulieu[] = array(
            						'id_ctv'	=> $layid,
                                    'phone'  => $row->phone,
                                    'user_name'   => $row->user_name,
                                    'profile'   => $row->profile,
                                    'email'  => $row->email,
                                    'bill' => $row->bill,
                                    'name'  => $row->name,
                                    
                                );
            }
            $this->data['dulieu'] = $dulieu;
            $this->load->view('header',$this->data);
			$this->load->view('capnhatctv',$this->data);
			$this->load->view('footer');
    }
    public function update()
    {
        if (!isset($this->session->userdata['logged_in'])) 
        {
            redirect('/dangnhap', 'location');
        }
        $layid=$this->uri->segment('2');
        $name = $this->input->post('name');
        $sdt = $this->input->post('phone');
        $fbid = $this->input->post('profile');
        $data = array(
                'name'      => $name,
                'phone'     =>  $phone,
                'profile'   => $profile,
        );
        $query1 = $this->login_model->updatedb('member',$data,'id_ctv',$layid);
        if($query1){
                $uname = $this->session->userdata['logged_in']['username'];
            $content = "<b>$uname</b> vừa cập nhật thông tin tài khoản của CTV <b>{$x['name']}</b> | Tên: <b>$name</b>, Phone: <b>$sdt</b>, ID FB: <b>$profile</b>";
            $history = array(
                                            'content'   => $content,
                                            'id_ctv'    =>  $this->session->userdata['logged_in']['userid'], 
                                            'time'      => time(),
                                            'type'      => 1,
                                        );
                                $his = $this->login_model->insertdb('history',$history);
                                if($his)
                                {
                                    $this->session->set_flashdata('error', 'susscess');
                                    redirect('/listctv', 'location');
                                }
        }
    }
    public function xoactv()
    {

    	$layid=$this->uri->segment('2');
    	if(($this->session->userdata['logged_in']['rule'] !='admin' ) && ($this->session->userdata['logged_in']['rule'] !='agency' || $this->session->userdata['logged_in']['rule'] !='admin'))
    	{
    		// || $layid != 1
    		redirect('/listctv', 'location');
    	}else{
    		
    		$ctv = $this->db->select('user_name, name, rule,id_agency')->where('id_ctv', $layid)->get('member');
	    	foreach($ctv->result() as $row)
	    	{
	    		$name = $row->name;
	    		$u_name = $row->user_name;
	    		$r1 = $row->rule;
	    		$idagency = $row->id_agency;
	    	}
	    	if($this->session->userdata['logged_in']['rule'] != 'admin')
	    	{
	    		if($idagency != $this->session->userdata['logged_in']['userid']){
	    			$this->session->set_flashdata('error', 'loi');
	    			redirect('/listctv', 'location');
	    		}else{
	    			
	    			$noti = $this->db->delete('noti', array('id_ctv' => $layid));
	    			$his =  $this->db->delete('history', array('id_ctv' => $layid));
	    			$mem = $this->db->delete('member', array('id_ctv' => $layid));
	    			$uname = $this->session->userdata['logged_in']['username'];
	    			if($mem){
	    				$content = "<b>$uname</b> vừa xóa CTV <b>$name ( $u_name )</b>";
                    	
                    	$history = array(
	            								'content'	=> $content,
	            								'id_ctv'	=>	$this->session->userdata['logged_in']['userid'], 
	            								'time'		=> time(),
	            								'type'		=> 1,
	            							);
	            					$his = $this->login_model->insertdb('history',$history);
	            					if($his){
	            						$this->session->set_flashdata('error', 'xoaok');
	    								redirect('/listctv', 'location');
	            					}
	    			}
	    		}
	    	}else{
	    		$noti = $this->db->delete('noti', array('id_ctv' => $layid));
	    		$his =  $this->db->delete('history', array('id_ctv' => $layid));
	    		$mem = $this->db->delete('member', array('id_ctv' => $layid));
	    		$uname = $this->session->userdata['logged_in']['username'];
	    		if($mem){
	    				$content = "<b>$uname</b> vừa xóa CTV <b>$name ( $u_name )</b>";
                    	
                    	$history = array(
	            								'content'	=> $content,
	            								'id_ctv'	=>	$this->session->userdata['logged_in']['userid'], 
	            								'time'		=> time(),
	            								'type'		=> 1,
	            							);
	            					$his = $this->login_model->insertdb('history',$history);
	            					if($his){
	            						$this->session->set_flashdata('error', 'xoaok');
	    								redirect('/listctv', 'location');
	            					}
	    			}
	    	}
	    	
    	}
    	
    }
}