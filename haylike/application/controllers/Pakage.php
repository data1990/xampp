<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pakage extends CI_Controller {

	
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
        }
        if(isset($this->session->userdata['logged_in']) && $this->session->userdata['logged_in']['rule'] =='admin'){
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
            if($this->session->userdata['logged_in']['rule'] !='admin')
            {
                // || $layid != 1
                redirect('/thongtin', 'location');
            }else{
                $query = $this->db->select('package.id, package.price, package.max, member.name,member.user_name')
                                    ->from('package')->join('member','package.id_ctv = member.id_ctv')->where('package.type', 'LIKE')->get();
                foreach($query->result() as $row)
                {
                    $dulieu[]= array(
                                    'id' => $row->id,
                                    'name'   => $row->name,
                                    'user_name'   => $row->user_name,
                                    'max'   => $row->max,
                                    'price'   => $row->price,

                                    );
                }
                if(isset($dulieu))
                {
                    $this->data['vippakage'] = $dulieu;
                }
                $this->load->view('header',$this->data);
                $this->load->view('pakage/listpakagelike',$this->data);
                $this->load->view('footer');
            }
        }
    }
    public function listcmt()
    {
        if (!isset($this->session->userdata['logged_in'])) 
        {
            redirect('/dangnhap', 'location');
        }else{
            if($this->session->userdata['logged_in']['rule'] !='admin')
            {
                // || $layid != 1
                redirect('/thongtin', 'location');
            }else{
                $query = $this->db->select('package.id, package.price, package.max, member.name,member.user_name')
                                    ->from('package')->join('member','package.id_ctv = member.id_ctv')->where('package.type', 'CMT')->get();
                foreach($query->result() as $row)
                {
                    $dulieu[]= array(
                                    'id' => $row->id,
                                    'name'   => $row->name,
                                    'user_name'   => $row->user_name,
                                    'max'   => $row->max,
                                    'price'   => $row->price,

                                    );
                }
                if(isset($dulieu))
                {
                    $this->data['vippakage'] = $dulieu;
                }
                $this->load->view('header',$this->data);
                $this->load->view('pakage/listpakagecmt',$this->data);
                $this->load->view('footer');
            }
        }
    }
    public function listshare()
    {
        if (!isset($this->session->userdata['logged_in'])) 
        {
            redirect('/dangnhap', 'location');
        }else{
            if($this->session->userdata['logged_in']['rule'] !='admin')
            {
                // || $layid != 1
                redirect('/thongtin', 'location');
            }else{
                $query = $this->db->select('package.id, package.price, package.max, member.name,member.user_name')
                                    ->from('package')->join('member','package.id_ctv = member.id_ctv')->where('package.type', 'SHARE')->get();
                foreach($query->result() as $row)
                {
                    $dulieu[]= array(
                                    'id' => $row->id,
                                    'name'   => $row->name,
                                    'user_name'   => $row->user_name,
                                    'max'   => $row->max,
                                    'price'   => $row->price,

                                    );
                }
                if(isset($dulieu))
                {
                    $this->data['vippakage'] = $dulieu;
                }
                $this->load->view('header',$this->data);
                $this->load->view('pakage/listpakagecmt',$this->data);
                $this->load->view('footer');
            }
        }
    }
    public function dellikepak()
    {
        $layid=$this->uri->segment('2');
        $ctv = $this->db->select('id_ctv')->where('id', $layid)->where('type', 'LIKE')->get('package');
            foreach($ctv->result() as $row)
            {
                $id_ctv = $row->id_ctv;
               
            } 
        if($this->session->userdata['logged_in']['rule'] !='admin')
        {
            if($id_ctv != $this->session->userdata['logged_in']['userid']){
                $this->session->set_flashdata('error', 'bug');
                redirect('/listpakagelike', 'location');
            }else{
                $noti = $this->db->delete('package', array('id' => $layid));
                $this->session->set_flashdata('error', 'delok');
                redirect('/listpakagelike', 'location');
            }
            
        }else{
                $noti = $this->db->delete('package', array('id' => $layid));
                $this->session->set_flashdata('error', 'delok');
                redirect('/listpakagelike', 'location');
        }
    }
    public function delcmtpak()
    {
        $layid=$this->uri->segment('2');
        $ctv = $this->db->select('id_ctv')->where('id', $layid)->where('type', 'CMT')->get('package');
            foreach($ctv->result() as $row)
            {
                $id_ctv = $row->id_ctv;
               
            } 
        if($this->session->userdata['logged_in']['rule'] !='admin')
        {
            if($id_ctv != $this->session->userdata['logged_in']['userid']){
                $this->session->set_flashdata('error', 'bug');
                redirect('/listpakagelike', 'location');
            }else{
                $noti = $this->db->delete('package', array('id' => $layid));
                $this->session->set_flashdata('error', 'delok');
                redirect('/listpakagelike', 'location');
            }
            
        }else{
                $noti = $this->db->delete('package', array('id' => $layid));
                $this->session->set_flashdata('error', 'delok');
                redirect('/listpakagelike', 'location');
        }
    }
    public function delsharepak()
    {
        $layid=$this->uri->segment('2');
        $ctv = $this->db->select('id_ctv')->where('id', $layid)->where('type', 'SHARE')->get('package');
            foreach($ctv->result() as $row)
            {
                $id_ctv = $row->id_ctv;
               
            } 
        if($this->session->userdata['logged_in']['rule'] !='admin')
        {
            if($id_ctv != $this->session->userdata['logged_in']['userid']){
                $this->session->set_flashdata('error', 'bug');
                redirect('/listpakagelike', 'location');
            }else{
                $noti = $this->db->delete('package', array('id' => $layid));
                $this->session->set_flashdata('error', 'delok');
                redirect('/listpakagelike', 'location');
            }
            
        }else{
                $noti = $this->db->delete('package', array('id' => $layid));
                $this->session->set_flashdata('error', 'delok');
                redirect('/listpakagelike', 'location');
        }
    }
    public function delreacpak()
    {
        $layid=$this->uri->segment('2');
        $ctv = $this->db->select('id_ctv')->where('id', $layid)->where('type', 'REACTION')->get('package');
            foreach($ctv->result() as $row)
            {
                $id_ctv = $row->id_ctv;
               
            } 
        if($this->session->userdata['logged_in']['rule'] !='admin')
        {
            if($id_ctv != $this->session->userdata['logged_in']['userid']){
                $this->session->set_flashdata('error', 'bug');
                redirect('/listpakagelike', 'location');
            }else{
                $noti = $this->db->delete('package', array('id' => $layid));
                $this->session->set_flashdata('error', 'delok');
                redirect('/listpakagelike', 'location');
            }
            
        }else{
                $noti = $this->db->delete('package', array('id' => $layid));
                $this->session->set_flashdata('error', 'delok');
                redirect('/listpakagelike', 'location');
        }
    }
}