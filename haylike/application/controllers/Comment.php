<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Comment extends CI_Controller {

	
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
			$this->load->view('cmt/addcmt',$this->data);
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
            if(isset($dulieu)){
                $this->data['dulieu'] = $dulieu;
            }
            
            $this->load->view('header',$this->data);
            $this->load->view('cmt/listcmt',$this->data);
            $this->load->view('footer');
        }
	}
	public function delcmt()
    {
        $layid=$this->uri->segment('2');
        $ctv = $this->db->select('id_ctv,user_id, end')->where('id', $layid)->get('vipcmt');
            foreach($ctv->result() as $row)
            {
                $id_ctv = $row->id_ctv;
                $user_id = $row->user_id;
                $end = $row->end;
               
            } 
        if($this->session->userdata['logged_in']['rule'] !='admin')
        {
            if($id_ctv != $this->session->userdata['logged_in']['userid']){
                $this->session->set_flashdata('error', 'bug');
                redirect('/listpakagelike', 'location');
            }elseif($end > time()){
                $this->session->set_flashdata('error', 'time');
                redirect('/listpakagelike', 'location');
            }else{
                $noti = $this->db->delete('vipcmt', array('id' => $layid));
                $xdata = array('num_id' => 'num_id-1');
                    $query1 = $this->login_model->updatedb('member',$xdata,'id_ctv',$this->session->userdata['logged_in']['userid']);
                    if($query)
                    {
                        $uname=$this->session->userdata['logged_in']['username'];
                        $content = "<b>".$uname."</b> vừa xóa VIP CMT ID <b>".$user_id."</b> tại sever 1.";
                        
                        $history = array(
                                            'content'   => $content,
                                            'id_ctv'    =>  $this->session->userdata['logged_in']['userid'], 
                                            'time'      => time(),
                                            'type'      => 0,
                                        );
                        $his = $this->login_model->insertdb('history',$history);
                        if($his){
                            $this->session->set_flashdata('error', 'delok');
                            redirect('/listpakagelike', 'location');
                        }
                    }
                
            }
            
        }else{
                $noti = $this->db->delete('vipcmt', array('id' => $layid));
                $xdata = array('num_id' => 'num_id-1');
                    $query1 = $this->login_model->updatedb('member',$xdata,'id_ctv',$this->session->userdata['logged_in']['userid']);
                    if($query)
                    {
                        $uname=$this->session->userdata['logged_in']['username'];
                        $content = "<b>".$uname."</b> vừa xóa VIP CMT ID <b>".$user_id."</b> tại sever 1.";
                        
                        $history = array(
                                            'content'   => $content,
                                            'id_ctv'    =>  $this->session->userdata['logged_in']['userid'], 
                                            'time'      => time(),
                                            'type'      => 0,
                                        );
                        $his = $this->login_model->insertdb('history',$history);
                        if($his){
                            $this->session->set_flashdata('error', 'delok');
                            redirect('/listpakagelike', 'location');
                        }
                    }
        }
    }
    public function update()
    {
        if (!isset($this->session->userdata['logged_in'])) 
        {
            redirect('/dangnhap', 'location');
        }
        $layid=$this->uri->segment('2');
        $query = $this->db->where('id',$layid)->get('vipcmt');
        foreach($query->result() as $row)
            {
                $dulieu[] = array(
                                    'id_ctv'    => $row->id_ctv,
                                    'noi_dung' => $row->noi_dung,
                                    'max_cmt'   => $row->max_cmt,
                                    'gender'  => $row->gender,
                                    'hash_tag'   => $row->hash_tag,
                                    'cmts' => $row->cmts,
                                    'sticker'=>$row->sticker,
                                    'name'  => $row->name,
                                    'user_id'   => $row->user_id,
                                );

            }
        $this->data['dulieu'] = $dulieu;
        $this->data['pakagecheck']=$this->login_model->pkgcheck('CMT');

        $this->form_validation->set_rules('gender', 'Giới tính', 'trim|required|min_length[4]|xss_clean');
        $this->form_validation->set_rules('hashtag', 'Hashtag', 'trim|required|xss_clean');
        $this->form_validation->set_rules('name', 'Họ Tên', 'trim|required|xss_clean');
        $this->form_validation->set_rules('cmt', 'Số CMT', 'trim|required|xss_clean');
        $this->form_validation->set_rules('noi_dung', 'Nội dung', 'trim|required|xss_clean');
        $this->form_validation->set_rules('user_id', 'User ID', 'trim|required|xss_clean');
        $this->form_validation->set_rules('max_cmt', 'Max CMT', 'trim|required|xss_clean');
        $this->form_validation->set_rules('sticker', 'Sticker', 'trim|required|xss_clean');
        if($this->form_validation->run())
        {
            $changemoney = 0;
            $gender = $this->input->post('gender');
            $hashtag = '#'.$this->input->post('hashtag');
            $name = $this->input->post('name');
            $cmt = $this->input->post('cmt');
            $noidung = $this->input->post('noi_dung');
            $user_id = $this->input->post('user_id');
            $max_cmt = $this->input->post('max_cmt');
            $sticker = $this->input->post('sticker');
            $uname=$this->session->userdata['logged_in']['username'];
            $query = $this->db->where('id',$layid)->get('vipcmt');
            foreach($query->result() as $row)
                {
                    $maxcmt = $row->max_cmt;
                    $pay = $row->pay;
                }
                $getmoney = $this->db->where('max', $max_cmt) ->get('package');
                foreach($getmoney->result() as $mn)
                {
                    $checkmoney = $mn->price;
                }
            if( $cmt <= $maxcmt)
            {
                $checkmn = $this->login_model->getmoney($this->session->userdata['logged_in']['userid']);
                if(!empty($checkmn)){
                    foreach ($checkmn->result() as $row) {
                        $money = $row->bill;
                        $payment = $row->payment;
                        //echo  print_r($checkmn);
                        # code...
                    }
                } 
                if($pay < $checkmoney && $money - ($checkmoney-$pay) >=0)
                    {
                        $changemoney = 1;
                        $upmoney = array('payment' =>$payment +($checkmoney-$pay),'bill' => $money - ($checkmoney-$pay));
                        $query = $this->login_model->updatedb('member',$upmoney,'id_ctv',$this->session->userdata['logged_in']['userid']);
                        $sessionlogin = $this->session->userdata['logged_in'];
                        $sessionlogin['money'] = $money - ($checkmoney-$pay);
                        $this->session->set_userdata('logged_in', $sessionlogin);
                    }else{
                        $this->session->set_flashdata('error', 'money');
                    }
                if($this->session->userdata['logged_in']['rule'] != 'admin' || $this->session->userdata['logged_in']['userid'] != 1)
                {
                    if($changemoney == 1){
                        $xdata = array('user_id' => $user_id,'name' =>$name,'cmts' => $cmt, 'noi_dung'=>$noidung,'gender'=>$gender,'hash_tag'=>$hashtag,'sticker'=>$sticker,'pay' =>$checkmoney);
                    }else{
                        $xdata = array('user_id' => $user_id,'name' =>$name,'cmts' => $cmt, 'noi_dung'=>$noidung,'gender'=>$gender,'hash_tag'=>$hashtag,'sticker'=>$sticker);
                    }
                    
                    $content = "<b>$uname</b> vừa cập nhật VIP CMT ID <b>$layid</b>, Tên: <b>$name</b>, Số CMT / Cron: <b>$cmt</b> CMTs, Giới tính: <b>$gender</b>, Hashtag: <b>$hashtag</b>";
                    $query1 = $this->login_model->updatedb('vip',$xdata,'id',$this->session->userdata['logged_in']['userid']);
                }else{
                    if($changemoney == 1){
                        $xdata = array('user_id' => $user_id,'name' =>$name,'cmts' => $cmt, 'noi_dung'=>$noidung,'gender'=>$gender,'hash_tag'=>$hashtag,'sticker'=>$sticker, 'max_cmt'=>$max_cmt ,'pay' =>$checkmoney);
                    }else{
                        $xdata = array('user_id' => $user_id,'name' =>$name,'cmts' => $cmt, 'noi_dung'=>$noidung,'gender'=>$gender,'hash_tag'=>$hashtag,'sticker'=>$sticker, 'max_cmt'=>$max_cmt);
                    }
                    
                    $content = "<b>$uname</b> vừa cập nhật VIP CMT ID <b>$layid</b> = > <b> $user_id</b>, Tên: <b>$name</b>, Số CMT / Cron: <b>$cmt</b> CMTs,  Giới tính: <b>$gender</b>, Hashtag: <b>$hashtag</b>";
                    $query1 = $this->login_model->updatedb('vipcmt',$xdata,'id',$this->session->userdata['logged_in']['userid']);
                }
                if($query1){

                    $history = array(
                                                'content'   => $content,
                                                'id_ctv'    =>  $this->session->userdata['logged_in']['userid'], 
                                                'time'      => time(),
                                                'type'      => 0,
                                            );
                    $his = $this->login_model->insertdb('history',$history);
                    if($his){
                                $this->session->set_flashdata('error', 'updateok');
                                redirect('/listcmt', 'location');
                            }
                }
            }
        }


        $this->load->view('header',$this->data);
        $this->load->view('cmt/update',$this->data);
        $this->load->view('footer');
    }
}