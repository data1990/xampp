<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Daily extends CI_Controller {

	
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
                    $checkmn = $this->login_model->getmoney($this->session->userdata['logged_in']['userid']);
                            if(!empty($checkmn)){
                                foreach ($checkmn->result() as $row) {
                                    $sodu = $row->bill;
                                    $payment = $row->payment;
                                    //echo  print_r($checkmn);
                                    # code...
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
	                	$daily = array(
	                					'user_name' => $user_name,
	                					'password'	=> md5($password),
	                					'name'		=> $name,
	                					'phone'		=> $sdt,
	                					'email'		=> $email,
	                					'profile'	=> $idfb,
	                					'bill'		=> $money,
	                					'status'	=> 0,
	                					'code'		=> $code,
	                					'rule'		=> 'agency',
	                				);
	                	$query = $this->login_model->insertdb('member',$daily);
	                	if($query)
	                	{
	                		
	                		$chagemoney = array(
	                						'bill' => $sodu - $money,
	                						);

	                		$query1 = $this->login_model->updatedb('member',$chagemoney,'id_ctv',$this->session->userdata['logged_in']['userid']);
	                		if($query1)
	                		{
	                			$uname = $this->session->userdata['logged_in']['username'];
	                			$content = "<b>$uname</b> vừa tạo tài khoản <b>Đại Lí: $name ( $user_name )</b>. Số dư tài khoản <b>".number_format($money)." </b> VNĐ";
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


	       // load giao diện
	    	$this->load->view('header',$this->data);
			$this->load->view('daily/themdaily',$this->data);
			$this->load->view('footer');
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
    public function danhsachdaily()
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
        $list = $this->db->where('rule','agency')->get('member');
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
            if(isset($dulieu))
            {
                $this->data['danhsachdaily'] = $dulieu;
            }
        
        // load giao diện
	    	$this->load->view('header',$this->data);
			$this->load->view('daily/listdaily',$this->data);
			$this->load->view('footer');
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
    		redirect('/listdaily', 'location');
    	}else{
    		$this->session->set_flashdata('error', 'kichhoatfail');
    		redirect('/listdaily', 'location');
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
            redirect('/listdaily', 'location');
        }else{
            $this->session->set_flashdata('error', 'khoaaccfail');
            redirect('/listdaily', 'location');
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
            redirect('/listdaily', 'location');
        }else{
            $this->session->set_flashdata('error', 'mokhoafail');
            redirect('/listdaily', 'location');
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
                                    'phone'  => $row->phone,
                                    'user_name'   => $row->user_name,
                                    'profile'   => $row->profile,
                                    'email'  => $row->email,
                                    'bill' => $row->bill,
                                    'name'  => $row->name,
                                    'id_ctv' => $layid,
                                    
                                );
            }
            $this->data['dulieu'] = $dulieu;
            $this->load->view('header',$this->data);
			$this->load->view('daily/capnhatdaily',$this->data);
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
            $content = "<b>$uname</b> vừa cập nhật thông tin tài khoản của Đại lí <b>{$x['name']}</b> | Tên: <b>$name</b>, Phone: <b>$sdt</b>, ID FB: <b>$profile</b>";
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
                                }
        }
    }
    public function xoadaily()
    {

        $layid=$this->uri->segment('2');
        if($this->session->userdata['logged_in']['rule'] !='admin')
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
                    $noti = $this->db->delete('noti', array('id_ctv' => $layid));
                    $his =  $this->db->delete('history', array('id_ctv' => $layid));
                    $mem = $this->db->delete('member', array('id_ctv' => $layid));
                    $uname = $this->session->userdata['logged_in']['username'];
                    if($mem){
                        $content = "<b>$uname</b> vừa xóa Đại Lý <b>$name ( $u_name )</b>";
                        
                        $history = array(
                                                'content'   => $content,
                                                'id_ctv'    =>  $this->session->userdata['logged_in']['userid'], 
                                                'time'      => time(),
                                                'type'      => 1,
                                            );
                                    $his = $this->login_model->insertdb('history',$history);
                                    if($his){

                                        $this->session->set_flashdata('error', 'xoaok');
                                        redirect('/listdaily', 'location');
                                    }
                    }
               
            
        }
        
    }
}