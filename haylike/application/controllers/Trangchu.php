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
        			
        			redirect('/thongtin', 'location');
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
        $this->load->view('header');
            $this->load->view('napthe');
            $this->load->view('footer');
    }

}
