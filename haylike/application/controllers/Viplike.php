<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Viplike extends CI_Controller {

	
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
    public function addviplike()
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
        	$this->data['pakagecheck']=$this->login_model->pakagecheck();
        	$this->load->view('header',$this->data);
			$this->load->view('addviplike',$this->data);
			$this->load->view('footer');
        	
		}
    
	}
	public function addlikedb()
	{
		$han=$this->input->post('han');
		$goi=$this->input->post('goi');
		$han=$this->input->post('han');
		$name = $this->input->post('name');
		$rule=$this->session->userdata['logged_in']['rule'];
		$coupon = $this->input->post('coupon');
		$fbid =$this->input->post('user_id');
		$likes = $this->input->post('likes');
		$limitpost = '10';
		$list_type = $this->input->post('type');
    	$type = implode("\n", $list_type);
		$start = time();
		if(empty($list_type))
		{

			$this->session->set_flashdata('error', 'like');
			$this->addviplike();
		}
		$pakagemin=$this->db->select_min('price')->where('type','LIKE')->limit(1)->get('package');
		foreach ($pakagemin->result() as $row)
    	{
    		$minpakage = $row->price;
    	}
		if($han < 0 || $han > 12 || $goi < $minpakage)
		{
			
			$this->session->set_flashdata('error', 'bug');
			$this->addviplike();
			
		}else{
			$checklikesv1 = $this->login_model->checkfbidlike($fbid,'vip');
			$checklikesv2 = $this->login_model->checkfbidlike($fbid,'vipsv2');
			if(!empty($checklikesv1)){
				$this->session->set_flashdata('error', 'tontai1');
				$this->addviplike();
			}
			if(!empty($checklikesv2)){
				$this->session->set_flashdata('error', 'tontai1');
				$this->addviplike();
			}
			
			$end = $start + $han * 30 * 86400 - 28800;
			$price = $han * $goi;
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
            switch ($likes) {
            	case 1:
            		# code...
            		$like = 10;
            		break;
            	case 2:
            		# code...
            		$like = 30;
            		break;
            	case 3:
            		# code...
            		$like = 50;
            		break;
            	case 4:
            		# code...
            		$like = 100;
            		break;
            	
            	default:
            		$like = 0;
            		# code...
            		break;
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
           // echo $this->session->userdata['logged_in']['userid'];
            if($money - $price >=0)
            {
            	$data = array(
            				'user_id'	=>	$fbid, 
            				'name'		=>	$name, 
            				'han'		=>	$han, 
            				'start'		=>	$start, 
            				'end'		=>	$end, 
            				'likes'		=>	$like, 
            				'max_like'	=>	$like, 
            				'id_ctv'	=>	$this->session->userdata['logged_in']['userid'], 
            				'pay'		=>	$price,
            				'type'		=>	$type, 
            				'limitpost'	=>	$limitpost,
            				);
            	$query = $this->login_model->insertdb('vip',$data);echo 'ok';
            	if($query)
            	{
            		$xdata = array('num_id' => 'num_id+1','payment' =>$payment +$price,'bill' => $money - $price);
            		$query1 = $this->login_model->updatedb('member',$xdata,'id_ctv',$this->session->userdata['logged_in']['userid']);
            		if($query1)
            		{
            			$uname=$this->session->userdata['logged_in']['username'];
            			if(!empty($coupon))
            			{

            				$content = "<b>".$uname."</b> vừa thêm VIP Cảm Xúc cho ID <b>".$fbid."</b> tại sever 1. Thời hạn <b>$han</b> tháng, gói <b>".$like."</b> CX, Loại CX: ".$type.", Sử dụng mã giảm giá <b>".$coupon."(".$sale_off." %) tổng thanh toán <b>" . number_format($price) . " VNĐ </b>";
            			}else{
            				$content = "<b>".$uname."</b> vừa thêm VIP Cảm Xúc cho ID <b>".$fbid."</b> tại sever 1. Thời hạn <b>$han</b> tháng, gói <b>".$like."</b> CX, Loại CX: ".$type.", tổng thanh toán <b>" . number_format($price) . " VNĐ </b>";
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
							$this->addviplike();
            			}
            		}
            		
            	}
            }else{
            	//echo "<script>swal('Số tiền trong tài khoản bạn còn thiếu!',' vui lòng nạp thêm để mua ','error');</script>";
            	$this->session->set_flashdata('error', 'money');
							$this->addviplike();
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
		$pakagemin=$this->db->select_min('price')->where('type','LIKE')->limit(1)->get('package');
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
	public function checkid()
	{
	  // if(isset($this->input->post('link')) && isset($this->input->post('type'))) {
		    $loaitype = $this->input->post('loaitype');
		    // $profile = $_POST['link'];
		    $profile = $this->input->post('link');
		    if(strpos($profile, 'https', 0) === false){
		        echo "<code>Link Facebook phải bắt đầu với giao thức <kbd>https://</kbd> và hỗ trợ các domain <kbd>m.facebook.com, mbasic.facebook.com, www.facebook.com</kbd></code>";
		    }else{
		        if($loaitype == 'person'){
		            $fields = "url=".$profile;
		            $result = $this->getID('https://findmyfbid.com', $fields);
		            $uid = json_decode($result, true);
		            if(isset($uid['id'])){
		            	$string = str_replace('E+1', '', $uid['id']);
		            	$string = preg_replace('/[^0-9\-]/', '', $string);
		                echo "<code>Thành công. ID của bạn là <kbd>".$string."</kbd> bạn copy vào UserID nhé";
		            }else{
		                echo "<code>Lỗi không thể lấy được ID, vui lòng kiểm tra lại Link đã nhập</code>";
		            }
		        }else if($loaitype == 'page'){
		            $fields = "url=".$profile;
		            $string = str_replace('E+1', '', $uid['id']);
		            	$string = preg_replace('/[^0-9\-]/', '', $string);
		            $uid = json_decode($result, true);
		            if(isset($uid['id'])){
		            	$string = preg_replace('/[^0-9\-]/', '', $uid['id']);
		                echo "<code>Thành công. ID của bạn là <kbd>".$string."</kbd>";
		            }else{
		                echo "<code>Lỗi không thể lấy được ID, vui lòng kiểm tra lại Link đã nhập</code>";
		            }
		        }
		    }
	//	}
	}
	public function getID($url, $fields){
	    $ch = curl_init();
	    curl_setopt($ch, CURLOPT_URL, $url);
	    curl_setopt($ch, CURLOPT_POST, 1);
	    curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
	    curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chorme/62.0/3202.94 Safari/537.36");
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	    return curl_exec($ch);
	    curl_close($ch);

	}
    public function listvip()
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
            $rule = $this->session->userdata['logged_in']['rule'];
            if($rule != 'admin'){
                $query = $this->db->select('id,user_id, name, han, likes, max_like, start, end, pay,type')
                                ->where('id_ctv',$this->session->userdata['logged_in']['userid'])
                                ->get('vip');

            }elseif($rule == 'admin' && $this->session->userdata['logged_in']['userid'] !=1){
                
            }
            $this->load->view('header',$this->data);
            $this->load->view('viplike',$this->data);
            $this->load->view('footer');
        }
    }

}