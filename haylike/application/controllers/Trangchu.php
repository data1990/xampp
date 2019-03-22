<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Trangchu extends CI_Controller {

	
	public function __construct()
    {
        parent::__construct();
        $this->load->model('login_model');
       
    }
	public function index()
	{
        if (isset($this->session->userdata['logged_in'])) 
        {
            redirect('/thongtin', 'location');
        }else{
    		$this->load->view('header');
    		$this->load->view('trangchu');
    		$this->load->view('footer');
        }
	}
	public function login()
	{
		$this->load->library('form_validation');
        
        $this->form_validation->set_rules('user_name', 'user_name', 'required|max_length[128]|trim');
        $this->form_validation->set_rules('password', 'password', 'required|max_length[32]');
        
        if($this->form_validation->run() == FALSE)
        {
            $this->index();
            $this->session->set_flashdata('error', 'Test');
        }
        else
        {
        	$username=$this->input->post('user_name');
        	$password=$this->input->post('password');

        	//if($this->login_model->checkcapcha(trim($this->input->post('g-recaptcha-response'))))
        	//{
        		//$this->session->set_flashdata('error', 'Bạn đã xác nhận capcha Google');
        		//$checkcp=true;
        		$result=$this->login_model->userlogin($username,$password);
                $check = $this->db->select('status')->where('user_name',$username)->limit(1)->get('member');
                foreach($check->result() as $row)
                {
                    $status = $row->status;
                }
                //echo $result;
        		if(!empty($result))
        		{
                    if($status == 0)
                    {
                        $this->session->set_flashdata('error', 'ActiveAcc');  
                        $this->index();
                    }elseif($status == -1)
                    {
                        $this->session->set_flashdata('error', 'LockAcc');  
                        $this->index();
                    }else
                    {
                        foreach ($result->result() as $row)
                        {
                            $sessionlogin=array(
                                'userid' => $row->id_ctv,
                                'username' =>$row->user_name,
                                'name'  => $row->name,
                                'name'  => $row->name,
                                'fbid'  =>  $row->profile,
                                'rule'  =>  $row->rule,
                                'money' => $row->bill,
                                'payment' =>    $row->payment,
                            );
                        }
                        $this->session->set_userdata('logged_in', $sessionlogin);
                        $content = "<b>$username</b> vừa đăng nhập với IP <b>".$this->get_user_ip()."</b></b>"; 
                        $history = array(
                                                'content'   => $content,
                                                'id_ctv'    =>  $this->session->userdata['logged_in']['userid'], 
                                                'time'      => time(),
                                                'type'      => 10,
                                            );
                        $his = $this->login_model->insertdb('history',$history);
                        if($his)
                        {
                            //echo "<script>swal('Đăng Nhập Thành Công!','Hệ Thống Xử Lý Trong 5s...','success');</script>"; 
                            $this->session->set_flashdata('error', 'LoginOk');
                            $this->index();
                            //die('<meta http-equiv=refresh content="5; URL=thongtin">'); 
                            //redirect('/thongtin', 'location');
                        }
                    }
        		
        	}else
        	{
        		$this->session->set_flashdata('error', 'CapchaError');	
        		$this->index();
        	}
        	


        }
        //$this->load->view('header');
		//$this->load->view('trangchu');
	}
	public function dangky()
	{
		$this->load->view('header');
		$this->load->view('register');
		$this->load->view('footer');
	}
	public function register()
	{
        $this->load->library('form_validation');
        $this->form_validation->set_rules('name', 'name', 'required|max_length[128]|trim');
        $this->form_validation->set_rules('sdt', 'Số điện thoại', 'trim|required|xss_clean');
        $this->form_validation->set_rules('user_name', 'user_name', 'required|max_length[128]|trim');
        $this->form_validation->set_rules('password', 'password', 'required|max_length[32]|trim');
        $this->form_validation->set_rules('profile','profile', 'required|max_length[32]|trim');
        if($this->form_validation->run() == FALSE)
        {
            $this->dangky();
            $this->session->set_flashdata('error', 'Test');
        }
        else
        {
            $username = $this->input->post('user_name');
            $fbid = $this->input->post('profile');
            $password = $this->input->post('password');
            $duoimail = $this->input->post('email_type');
            $mail = $this->input->post('prefix');
            $email = $mail . '@'. $duoimail;
            $sdt = $this->input->post('sdt');
            $name = $this->input->post('name');
            $bill = '1000';
            $status = '0';
            $code = substr(md5(time() + rand(0, 9)), 0, 8);
            if($this->login_model->checkname($username))
            {
                $this->dangky();
                $this->session->set_flashdata('error', 'username');
            }elseif($this->login_model->checkfbid($fbid))
            {
                $this->dangky();
                $this->session->set_flashdata('error', 'facebook');
            }elseif($this->login_model->checkmail($email)){
                $this->dangky();
                $this->session->set_flashdata('error', 'email');
            }else{
                $reg = array(
                            'user_name'     => $username,
                            'password'      => md5($password),
                            'name'          => '',
                            'phone'         => $sdt,
                            'email'         => $email,
                            'profile'       => $fbid,
                            'bill'          => $bill,
                            'status'        => 0,
                            'code'          => $code,
                            'rule'          => 'member',
                            'num_id'        => 0,
                            'baomat'        => 0,
                            );
                $query = $this->login_model->insertdb('member',$reg);
                if($query){
                    $this->session->set_flashdata('error', 'OK');
                    $this->dangky();
                }
            }
        }
	}

	public function thoat()
    {
        $sessionArray = array('userid' 	=> '',
	        				'username' 	=> '',	        				
	        				'name'		=> '',
	        				'name'		=> '',
	        				'fbid'		=> '',
	        				'rule'		=> '',
	        				'money'		=> '',
	        				'payment' 	=> '',                                );
        $this->session->unset_userdata('logged_in', $sessionArray);
        redirect('');
    }
    public function napthe()
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
            $this->load->view('header',$this->data);
            $this->load->view('napthe',$this->data);
            $this->load->view('footer');
    }
    public function get_user_ip(){ 
                if(!empty($_SERVER['HTTP_CLIENT_IP'])){ 
                  //ip from share internet 
                  $ip = $_SERVER['HTTP_CLIENT_IP']; 
                }elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){ 
                  //ip pass from proxy 
                  $ip = $_SERVER['HTTP_X_FORWARDED_FOR']; 
                }else{ 
                  $ip = $_SERVER['REMOTE_ADDR']; 
                } 
                  return $ip; 
    } 
}
