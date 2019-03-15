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
        		if(!empty($result))
        		{
        			foreach ($result->result() as $row)
                	{
	        			$sessionlogin=array(
	        				'userid' => $row->id_ctv,
	        				'username' =>$row->user_name,
	        				'name'	=> $row->name,
	        				'name'	=> $row->name,
	        				'fbid'	=>	$row->profile,
	        				'rule'	=>	$row->rule,
	        				'money'	=> $row->bill,
	        				'payment' =>	$row->payment,
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
                        redirect('/thongtin', 'location');
                    }
        			
        		//}else{
        		//	$this->session->set_flashdata('error', 'Login');
        		//	$this->index();
        		//}
        		//$this->index();
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
