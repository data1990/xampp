<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Comment extends CI_Controller {

	
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
	    	//$this->data['count_expires'] = 0;
	    	$this->load->view('header',$this->data);
			$this->load->view('viplike',$this->data);
			$this->load->view('footer');
		}
    }
    public function addcmt()
    {
    	if (!isset($this->session->userdata['logged_in'])) 
    	{
	    	redirect('/dangnhap', 'location');
		}else{
			
	    	$result = $this->login_model->settingcheck();
	    	foreach ($result->result() as $row)
        	{
        		$this->data['vipcmt'] = $row->vipcmt;
        		//$this->data['vipcmt2'] = $row->vipcmt2;
        	}
	    	//$this->data['count_expires'] = 0;
	    	$this->session->set_flashdata('error', '');
	    	$this->data['cmtpakagecheck'] = $this->login_model->cmtpakagecheck();
	    	$this->load->view('header',$this->data);
			$this->load->view('addcmt',$this->data);
			$this->load->view('footer');
		}
    }
    public function addcmntdb()
    {
    	$han=$this->input->post('han');
		$goi=$this->input->post('goi');
		$han=$this->input->post('han');
		$name = $this->input->post('name');
		$sticker = $this->input->post('sticker');
		$hashtag = "#".$this->input->post('hashtag');
        $gender = $this->input->post('gender');
        $fbid =$this->input->post('user_id');
        $rule=$this->session->userdata['logged_in']['rule'];
        $cmt = $this->input->post('cmt');
        $noidung = trim(htmlspecialchars($this->input->post('noi_dung')));
        $start = time();
        $pakagemin=$this->db->select_min('price')->where('type','CMT')->limit(1)->get('package');
        foreach ($pakagemin->result() as $row)
    	{
    		$minpakage = $row->price;
    	}
        if($han < 0 || $han > 12 || $goi < $minpakage)
		{
			
			$this->session->set_flashdata('error', 'bug');
			$this->addcmt();
			
		}else{
			$checkcmt = $this->login_model->checkcmtid($fbid);
			if(!empty($checkcmt)){
				$this->session->set_flashdata('error', 'tontai1');
				$this->addcmt();
			}
			$price = $han * $goi;
			$end = $start + $han * 30 * 86400;
			if($rule == 'agency'){
                    $price -= $price * 10 / 100;
            }else if($rule == 'freelancer'){
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
            $mlike = $this->login_model->pakagecheckcmt($goi);
            echo 'OK';
           // print_r($mlike->result());
            foreach($mlike->result() as $row)
            {
                $maxlike = $row->max;
            } 
            $checkmn = $this->login_model->getmoney($this->session->userdata['logged_in']['userid']);
            if(!empty($checkmn)){
            	foreach ($checkmn->result() as $row) {
            		$money = $row->bill;
            		$payment = $row->payment;
            		//echo  print_r($checkmn);
            		# code...
            	}
            } 
            if($money - $price >=0)
            {
            	$data = array(
            				'user_id'	=>	$fbid, 
            				'name'		=>	$name, 
            				'han'		=>	$han, 
            				'start'		=>	$start, 
            				'end'		=>	$end, 
            				'cmts'		=>	$cmt, 
            				'max_cmt'	=>	$maxlike, 
            				'id_ctv'	=>	$this->session->userdata['logged_in']['userid'], 
            				'pay'		=>	$price,
            				'noi_dung'		=>	$noidung, 
            				'hash_tag'	=>	$hashtag,
            				'gender'	=> $gender,
            				'sticker'	=> $sticker,
            				);
            	$query = $this->login_model->insertdb('vipcmt',$data);
            	if($query)
            	{
            		$xdata = array('num_id' => 'num_id+1','payment' =>$payment +$price,'bill' => $money - $price);
            		$query1 = $this->login_model->updatedb('member',$xdata,'id_ctv',$this->session->userdata['logged_in']['userid']);
            		if($query1)
            		{
            			$uname=$this->session->userdata['logged_in']['username'];
            			if(!empty($coupon))
            			{

            				$content = "<b>".$uname."</b> vừa thêm VIP CMT cho ID <b>".$fbid."</b>. Thời hạn <b>$han</b> tháng, gói <b>".$maxlike."</b> CMT, Sử dụng mã giảm giá <b>".$coupon."(".$sale_off." %) tổng thanh toán <b>" . number_format($price) . " VNĐ </b>";
            			}else{
            				$content = "<b>".$uname."</b> vừa thêm VIP CMT cho ID <b>".$fbid."</b>. Thời hạn <b>$han</b> tháng, gói <b>".$maxlike."</b> CMT, tổng thanh toán <b>" . number_format($price) . " VNĐ </b>";
            			}
            			$history = array(
            								'content'	=> $content,
            								'id_ctv'	=>	$this->session->userdata['logged_in']['userid'], 
            								'time'		=> time(),
            								'type'		=> 0,
            							);
            			$his = $this->login_model->insertdb('history',$history);
            			if($his)
            			{
            				// thêm thông báo vào đây chưa code xong
                            $sessionlogin = $this->session->userdata['logged_in'];
                            $sessionlogin['money'] = $money - $price;
                            $this->session->set_userdata('logged_in', $sessionlogin);
            				$this->session->set_flashdata('error', 'susscess');
							$this->addcmt();
            			}
            		}
            	}
            }else{
            	//echo "<script>swal('Số tiền trong tài khoản bạn còn thiếu!',' vui lòng nạp thêm để mua ','error');</script>";
            	$this->session->set_flashdata('error', 'money');
							$this->addcmt();
            }

		}
    }
    public function changemoneylike()
	{
		$han=$this->input->post('han');
		$goi=$this->input->post('goi');
		$han=$this->input->post('han');
		$rule=$this->session->userdata['logged_in']['rule'];
		$coupon = $this->input->post('coupon');
		$pakagemin=$this->db->select_min('price')->where('type','CMT')->limit(1)->get('package');
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
	public function listcmt()
	{
		if (!isset($this->session->userdata['logged_in'])) 
        {
            redirect('/dangnhap', 'location');
        }else{
            $rule = $this->session->userdata['logged_in']['rule'];
            if($rule != 'admin'){
                $query = $this->db->select('id,user_id, name, han, cmts, max_cmt, start, end, pay,gender')
                                ->where('id_ctv',$this->session->userdata['logged_in']['userid'])
                                ->get('vipcmt');

            }elseif($rule == 'admin' && $this->session->userdata['logged_in']['userid'] !=1){
                $query = $this->db->from('vipcmt')->join('member','vipcmt.id_ctv = member.id_ctv')->where('vipcmt.id_ctv' > 0)->get();
            }else{
                $query = $this->db->from('vipcmt')->join('member','vipcmt.id_ctv = member.id_ctv')->get();
            }
            //print_r($query->result());
            foreach($query->result() as $row)
            {
                $dulieu[] = array(
                                    'id'    => $row->id,
                                    'start' => $row->start,
                                    'han'   => $row->han,
                                    'end'   => $row->end,
                                    'pay'   => $row->pay,
                                    'cmts'	=> $row->cmts,
                                    'max_cmt'	=> $row->max_cmt,
                                    'ctv_name'  => $row->name,  
                                    'gender'	=> $row->gender,
                                    'name'  => $row->name,
                                    'user_name' => $row->user_name,
                                    'user_id'   => $row->user_id,
                                    'rule'	=> $row->rule,
                                );
            }
            $this->data['dulieu'] = $dulieu;
            $this->load->view('header',$this->data);
            $this->load->view('listcmt',$this->data);
            $this->load->view('footer');
        }
	}
}