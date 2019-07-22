<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reaction extends CI_Controller {

	
	public function __construct()
    {
        parent::__construct();
        $this->load->model('login_model');
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
		}
        $query = $this->db->where('type','REACTION')->order_by('price ASC')->get('package');
        $this->data['dulieu'] = $query;
        $st = $this->db->get('idsticker');        
        $this->data['sticker'] = $query;
        $this->load->view('header',$this->data);
        $this->load->view('reaction/addreaction',$this->data);
        $this->load->view('footer');
    }
    public function addreaction()
    {
        if (!isset($this->session->userdata['logged_in'])) 
        {
            redirect('/dangnhap', 'location');
        }
        $han=$this->input->post('han');
        $goi=$this->input->post('goi');
        $fbid =$this->input->post('user_id');
        $name = $this->input->post('name');
        $cus = $this->input->post('custom');
        $cmt = $this->input->post('cmt');
        $noidungs = $this->input->post('noidung');
        $noidung = isset($noidungs) ? $noidungs : 'NULL';
        $rule=$this->session->userdata['logged_in']['rule'];
        $st = $this->input->post('sticker');
        $sticker = isset($st) ? $st : 0;
        $type = $this->input->post('type');
        $token = $this->input->post('token');
        $start = time();
        $end = $start + $han * 30 * 86400;
        $price = $han * $goi;
        //$pakagemin=$this->db->select_min('price')->where('type','REACTION')->get('package');
        $pakagemin=$this->db->select_min('price')->where('type','REACTION')->limit(1)->get('package');
        foreach ($pakagemin->result() as $row)
        {
            $minpakage = $row->price;
        }
        $pakagemax=$this->db->select_max('price')->where('type','REACTION')->limit(1)->get('package');
        foreach ($pakagemin->result() as $row)
        {
            $max_reactions = $row->price;
        }
        if($han < 0 || $han > 12 || $goi < $minpakage)
        {
            
            $this->session->set_flashdata('error', 'bug');
            $this->index();
            
        }else{
            $checklikesv1 = $this->login_model->checkfbidlike($fbid,'vipreaction');
            if(!empty($checklikesv1)){
                $this->session->set_flashdata('error', 'tontai');
                $this->index();
            }
            if ($rule == 'agency') {
                $price -= $price * 10 / 100;
            } else if ($rule == 'freelancer') {
                $price -= $price * 5 / 100;
            }
            if (isset($coupon)) {
                $checkgift=$this->login_model->couponcheck($coupon);
                if(!empty($checkgift))
                {
                    foreach ($checkgift->result() as $row)
                    {
                        if($row->min_price <= $han * $goi)
                        {
                            $price -= $price * $row->sale_off / 100;
                            $sale_off = $row->sale_off;
                        }
                        
                    }
                }
            } 
            // end coupon
            $checkmn = $this->login_model->getmoney($this->session->userdata['logged_in']['userid']);
            if(!empty($checkmn)){
                foreach ($checkmn->result() as $row) {
                    $money = $row->bill;
                    $payment = $row->payment;
                    //echo  print_r($checkmn);
                    # code...
                }
            } 
            $mlike = $this->login_model->pakagecheckreaction($goi);
            foreach($mlike->result() as $row)
            {
                $maxlike = $row->max;
            }
            if($money - $price >=0)
            { 
                $data = array(
                            'user_id'   =>  $fbid, 
                            'name'      =>  $name, 
                            'han'       =>  $han, 
                            'start'     =>  $start, 
                            'end'       =>  $end, 
                            'limit_react'     =>  $max_reactions, 
                            'id_ctv'    =>  $this->session->userdata['logged_in']['userid'], 
                            'pay'       =>  $price,
                            'type'      =>  $type, 
                            'access_token'=> $token,
                            'custom'    =>  $cus,
                            'noidung'       => $noidung,
                            'cmt'           => $cmt,
                            'sticker'       => $sticker,

                            );
                $query = $this->login_model->insertdb('vipreaction',$data);
                if($query)
                {
                    $xdata = array('num_id' => 'num_id+1','payment' =>$payment +$price,'bill' => $money - $price);
                    $query1 = $this->login_model->updatedb('member',$xdata,'id_ctv',$this->session->userdata['logged_in']['userid']);
                    if($query1)
                    {
                        $uname=$this->session->userdata['logged_in']['username'];
                        if(!empty($coupon))
                        {
                            $content = "<b>$uname</b> vừa thêm VIP REACTION cho ID <b>$uid</b>. Thời hạn <b>$han</b> tháng, gói <b>$max_reactions</b> Reactions / Cron, Sử dụng mã giảm giá <b>".$coupon."(".$sale_off." %) tổng thanh toán <b>" . number_format($price) . " VNĐ </b>";
                        }else{
                            $content = "<b>".$uname."</b> vừa thêm VIP REACTION cho ID <b>".$fbid."</b>. Thời hạn <b>$han</b> tháng, MAX <b>$max_reactions</b> Reactions / Cron, tổng thanh toán <b>" . number_format($price) . " VNĐ </b>";
                        }
                        $history = array(
                                            'content'   => $content,
                                            'id_ctv'    =>  $this->session->userdata['logged_in']['userid'], 
                                            'time'      => time(),
                                            'type'      => 0,
                                        );
                        $his = $this->login_model->insertdb('history',$history);
                        if($his)
                        {
                            // thêm thông báo vào đây chưa code xong
                            $sessionlogin = $this->session->userdata['logged_in'];
                            $sessionlogin['money'] = $money - $price;
                            $this->session->set_userdata('logged_in', $sessionlogin);
                            $this->session->set_flashdata('error', 'susscess');
                            $this->index();
                        }
                    }
                    
                }
            }else{
                //echo "<script>swal('Số tiền trong tài khoản bạn còn thiếu!',' vui lòng nạp thêm để mua ','error');</script>";
                $this->session->set_flashdata('error', 'money');
                            $this->index();
            }

        }
        $this->load->view('header',$this->data);
        $this->load->view('reaction/addreaction',$this->data);
        $this->load->view('footer');
    }
    public function check()
    {
        $token = $this->input->post('token');
        $me = json_decode(file_get_contents('https://graph.fb.me/me?access_token='.$token),true);
        if($me['id']){
            $app = json_decode(file_get_contents('https://graph.fb.me/app?access_token='.$token),true);
            if($app['id'] == '6628568379' || $app['id'] == '350685531728'){
                $id = $me['id'];
                $name = $me['name'];
                echo $id.'_'.$name;
            }else{
                echo "Vui lòng sử dụng Token Full quyền để cài đặt VIP!!_Vui lòng sử dụng Token Full quyền để cài đặt VIP!!_";
            }
        }else{
            echo "Token hết hạn hoặc không hợp lệ!!_Token hết hạn hoặc không hợp lệ!!";
        }
    }
    public function changemoneylike()
    {
        $han=$this->input->post('han');
        $goi=$this->input->post('goi');
        $han=$this->input->post('han');
        $rule=$this->session->userdata['logged_in']['rule'];
        $coupon = $this->input->post('coupon');
        $pakagemin=$this->db->select_min('price')->where('type','REACTION')->limit(1)->get('package');
        foreach ($pakagemin->result() as $row)
        {
            $minpakage = $row->price;
        }
        
        if($han < 0 || $han > 12 || $goi < $minpakage){
            echo 'Không hợp lệ, chú định bug à, quên mẹ cái mùa xuân ấy đê :)))';
            
        }else{
            $price = $han * $goi;
            if ($rule == 'agency') {
                $price -= $price * 10 / 100;
            } else if ($rule == 'freelancer') {
                $price -= $price * 5 / 100;
            }
            if (!isset($coupon)) {
                echo number_format($price) . ' VNĐ';
                
            } else if (isset($coupon)) {
                $checkgift=$this->login_model->couponcheck($coupon);
                if(!empty($checkgift))
                {
                    foreach ($checkgift->result() as $row)
                    {
                        if($row->min_price <= $han * $goi)
                        {
                            $price -= $price * $row->sale_off / 100;
                            $result = array(
                                            'status' => 'OK',
                                            'price' => number_format($price) . ' VNĐ',
                                            'sale_off' => $cop['sale_off'],
                                            'code' => $_POST['coupon'],
                                            'msg' => 'Bạn đã áp dụng thành công mã giảm giá '. $coupon . ' và được giảm ' .$row->sale_off. '% tổng giá trị đơn hàng'
                                        );
                        }else {
                        $result = array(
                            'status' => 'cc',
                            'min_price' => $cop['min_price'],
                            'error_msg' => 'Mã khuyến mại này chỉ áp dụng cho đơn hàng có giá trị tối thiểu là: '.number_format($row->min_price).' VNĐ'
                        );
                        }
                    }
                }else{
                    $result = array(
                    'status' => 'Fail',
                    'error_msg' => 'Vui lòng nhập đúng định dạng, phân biệt chữ hoa chữ thường Hoặc mã khuyến mại không tồn tại, đã hết hạn, hoặc không được áp dụng cho dịch vụ này!!!'
                );
                }
                echo json_encode($result);
            }
            
        }
    }
    public function listreaction()
    {
        if (!isset($this->session->userdata['logged_in'])) 
        {
            redirect('/dangnhap', 'location');
        }
        $rule = $this->session->userdata['logged_in']['rule'];
        $idctv = $this->session->userdata['logged_in']['userid'];
        if($rule != 'admin')
        {
            $query = $this->db->select('id,user_id, name, han, limit_react, type, start, end, pay,access_token')->where('id_ctv', $idctv)->get('vipreaction');
        }elseif($rule == 'admin' && $idctv != 1){
            $query = $this->db->select('id, user_id, vipreaction.name, han, limit_react, type, start, end, pay, member.name AS ctv_name, member.user_name,rule,access_token')->from('vipreaction')->join('member','vipreaction.id_ctv = member.id_ctv')->where('vipreaction.id_ctv' > 0)->get();
        }else{
            $query = $this->db->select('id, user_id, vipreaction.name, han, limit_react, type, start, end, pay, member.name AS ctv_name, member.user_name,rule,access_token')->from('vipreaction')->join('member','vipreaction.id_ctv = member.id_ctv')->get();
             //$query = $this->db->from('vipreaction')->join('member','vipreaction.id_ctv = member.id_ctv')->get();
        }
        //$query = $this->db->get('vipreaction');
        
        foreach($query->result() as $row)
            {
                $dulieu[] = array(
                                    'id'    => $row->id,
                                    'user_id'   => $row->user_id,
                                    'name'  => $row->name,
                                    'start' => $row->start,
                                    'han'   => $row->han,
                                    'type'  => $row->type,
                                    'end'   => $row->end,
                                    'pay'   => $row->pay,
                                    'rule'  => $row->rule,
                                    'token'  => $row->access_token,
                                    'ctv_name'  => $row->ctv_name,
                                    'user_name' => $row->user_name,
                                    
                                );
            }
            
            if(isset($dulieu))
            {
                $this->data['dulieu'] = $dulieu;
            }
        $this->data['dulieu'] = $query;
        $st = $this->db->get('idsticker');        
        $this->data['sticker'] = $query;
        $this->load->view('header',$this->data);
        $this->load->view('reaction/listreaction',$this->data);
        $this->load->view('footer');
    }
    public function update()
    {
        if (!isset($this->session->userdata['logged_in'])) 
        {
            redirect('/dangnhap', 'location');
        }
        $layid=$this->uri->segment('2');
        $query = $this->db->where('id',$layid)->get('vipreaction');
        foreach($query->result() as $row)
            {
                $user_id= $row->user_id;
                $token =  $row->access_token;
                $dulieu[] = array(
                                    'access_token'    => $row->access_token,
                                    'user_id' => $row->user_id,
                                    'name'   => $row->name,
                                    'type'  => $row->type,
                                    'custom'   => $row->custom,
                                    'noidung'   => $row->noidung,
                                    
                                );
            }
        $me = json_decode(file_get_contents('https://graph.fb.me/me?access_token='.$token.'&fields=id&method=get'),true);
        $tokenstt = '';
        if(isset($me['id']) && $me['id'] == $user_id){
            $this->data['tokenstt'] = '<font color="green">Token Live</font>';
        }else if(!isset($me['id'])){
            $this->data['tokenstt'] = '<font color="red">Token DIE</font>';
        }else if(isset($me['id']) && $me['id'] != $user_id){
            $this->data['tokenstt'] = '<font color="blue">Token Live nhưng không khớp với VIP ID</font>';
        }
        $this->data['dulieu'] = $dulieu;
        $this->data['pakagecheck']=$this->login_model->pkgcheck('REACTION');
        /*$this->form_validation->set_rules('access_token', 'Access Token', 'trim|required|xss_clean');
        $this->form_validation->set_rules('user_id', 'User ID', 'trim|required|xss_clean');
        $this->form_validation->set_rules('name', 'Họ tên', 'trim|required|xss_clean');
        $this->form_validation->set_rules('custom', 'Đối tượng thả cảm xúc', 'trim|required|xss_clean');
        $this->form_validation->set_rules('type[]', 'Cảm xúc', 'trim|required|xss_clean');
        */

        $this->load->view('header',$this->data);
        $this->load->view('reaction/update',$this->data);
        $this->load->view('footer');
    }
}