<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Thongtin extends CI_Controller {

	
	public function __construct()
    {
        parent::__construct();
        $this->load->model('login_model');
        
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
            $query = $this->db->where('id_ctv',$this->session->userdata['logged_in']['userid'])->get('member');
            foreach($query->result() as $row)
            {
                
                $dulieu[] = array(
                                'user_name'     => $row->user_name,
                                'email'         => $row->email,
                                'profile'       => $row->profile,
                                'name'          => $row->name,
                                'phone'         => $row->phone,
                                );
            }
            if(isset($dulieu))
                {
                    $this->data['info'] = $dulieu;
                }

            

            $this->load->view('header',$this->data);
            $this->load->view('updateinfo',$this->data);
            $this->load->view('footer');
        }
    }
    public function updateinfo()
    {
            $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|xss_clean');
            $this->form_validation->set_rules('name', 'Họ Tên', 'trim|required|xss_clean');
            $this->form_validation->set_rules('profile', 'ID Facebook', 'trim|required|xss_clean');
            $this->form_validation->set_rules('sdt', 'Số điện thoại', 'trim|required|xss_clean');         
                $name = $this->input->post('name');
                $sdt = $this->input->post('sdt');
                $email = $this->input->post('email');
                $idfb = $this->input->post('profile');
                $update = array(
                                'name'      =>  $name,
                                'phone'       => $sdt,
                                
                                'profile'   => $idfb,
                                );

                $query1 = $this->login_model->updatedb('member',$update,'id_ctv',$this->session->userdata['logged_in']['userid']);
                if($query1)
                { 
                    
                    $user_name = $this->session->userdata['logged_in']['username'];
                    $content = "<b>{$user_name}</b> vừa cập nhật thông tin tài khoản của mình, Tên: <b>$name</b>, Phone: <b>$sdt</b>, ID FB: <b>$profile</b>";
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
                        redirect('/updateinfo', 'location');
                    }
                }
    }
    public function changepass()
    {
        if (!isset($this->session->userdata['logged_in'])) 
        {
            redirect('/dangnhap', 'location');
        }else{
            
           
            $this->load->view('header',$this->data);
            $this->load->view('changepass',$this->data);
            $this->load->view('footer');
        }
    }
    public function updatepass()
    {
        $this->form_validation->set_rules('old_pass', 'Mật khẩu cũ', 'trim|required|xss_clean');
        $this->form_validation->set_rules('new_pass1', 'Mật khẩu mới', 'trim|required|xss_clean');
        $this->form_validation->set_rules('new_pass2', 'Nhập lại mật khẩu', 'trim|required|matches[new_pass1]|xss_clean');
        $passcu = $this->input->post('old_pass');
        $passmoi = $this->input->post('new_pass1');
        $pass1 = $this->input->post('new_pass2');
        $getpass= $this->db->select('password')->where('id_ctv',$this->session->userdata['logged_in']['userid'])->get('member');
        foreach($getpass->result() as $row)
        {
            $passold = $row->password;
        }
        if($passold == md5($passcu))
        {
            if($passmoi == $pass1)
            {
                $pass= array('password',md5($passmoi));
                $query1 = $this->login_model->updatedb('member',$pass,'id_ctv',$this->session->userdata['logged_in']['userid']);
                if($query1){
                    $user_name = $this->session->userdata['logged_in']['username'];
                    $content = "<b>$uname</b> vừa thay đổi mật khẩu của mình.";
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
                        //$this->changepass();
                        redirect('/changepass', 'location');
                    }
                }
            }else{
                $this->session->set_flashdata('error', 'loipassmoi');
                //$this->changepass();
                redirect('/changepass', 'location');
            }
        }else{
            $this->session->set_flashdata('error', 'passcu');
                //$this->changepass();
            redirect('/changepass', 'location');
        }
        
    }
}