<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Login_model extends CI_Model
{
	/*--------- Check Capcha Google -----------*/
	function checkcapcha($capcha)
	{
		$userIp=$this->input->ip_address();
     
        $secret = $this->config->item('google_secret');
   
        $url="https://www.google.com/recaptcha/api/siteverify?secret=".$secret."&response=".$capcha."&remoteip=".$userIp;
 
        $ch = curl_init(); 
        curl_setopt($ch, CURLOPT_URL, $url); 
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
        $output = curl_exec($ch); 
        curl_close($ch);      
         
        $status= json_decode($output, true);
 
        if ($status['success']) {
            return true;
        }else{
            //$this->session->set_flashdata('flashError', 'Sorry Google Recaptcha Unsuccessful!!');
            return false;
        }
	}
	/*--------- End Check Capcha Google -----------*/
	/*--------- Login System -----------*/
	function userlogin($username, $password)
	{
		//$this->db->select('*');
		//$this->db->from('member');
		//$this->db->where('user_name',$username);
		//$this->db->where('password',md5($password));
		$query = $this->db->where('user_name',$username)
							->where('password',md5($password))
							->limit(1)
							->get('member');
		
		if($query->num_rows() ==1)
		{
			
				return $query;
			
			
		}else{
			return false;
		}
	}
	function checkuser($username)
	{
		//$query = $this->db->select('status')->where('');
	}
	function countlike($userid)
	{
		$query = $this->db->get_where('vip',array('id_ctv' =>$userid));
		return $query->num_rows();
	}
	function countnoti($userid)
	{
		$query = $this->db->get_where('noti',array('id_ctv' =>$userid));
		return $query->num_rows();
	}
	function counthis($userid)
	{
		$query = $this->db->get_where('history',array('id_ctv' =>$userid));
		return $query->num_rows();
	}
	function countgift($userid)
	{
		$query = $this->db->get_where('gift',array('id_ctv' =>$userid));
		return $query->num_rows();
	}
	// Lấy ngày của từng userid
	function countlikeexp($userid)
	{
		$query = $this->db->select('end')
							->where('id_ctv',$userid)
							->get('vip');
		return $query->num_rows();
	}
	function countlikeexp2($userid)
	{
		$query = $this->db->select('end')
							->where('id_ctv',$userid)
							->get('vipsv2');
		return $query->num_rows();
	}
	function countcmtexp($userid)
	{
		$query = $this->db->select('end')->where('id_ctv' ,$userid)->get('vipcmt');
		return $query->num_rows();
	}
	function countreactionexp($userid)
	{
		$query = $this->db->select('end')->where('id_ctv' ,$userid)->get('vipreaction');
		return $query->num_rows();
	}
	function countexp($userid)
	{
		$expires_time = time();
		$queryvip = $this->db->get_where('vip',array('id_ctv' =>$userid,'end - $expires_time'<=480000));
		$queryvipcmt = $this->db->get_where('vipcmt',array('id_ctv' =>$userid,'end - $expires_time'<=480000));
		$queryvipreaction = $this->db->get_where('vipreaction',array('id_ctv' =>$userid,'end - $expires_time'<=480000));
		return $queryvip->num_rows() + $queryvipcmt->num_rows() + $queryvipreaction->num_rows();
	}
	function settingcheck()
	{
		return $this->db->where('id',1)->get('setting');
	}
	function pakagecheck()
	{
		return $this->db->select('max, price') ->where('type','LIKE')->order_by('price ASC')->get('package');
	}
	function pakagechecklike($price)
	{
		$query = $this->db->select('max') ->where(array('type'=>'LIKE','price'=>$price))->get('package');
		return $query;
	}
	function cmtpakagecheck()
	{
		return $this->db->select('max, price') ->where('type','CMT')->order_by('price ASC')->get('package');
	}
	function pakagecheckcmt($price)
	{
		return $this->db->select('max, price') ->where('type','CMT')->where('price',$price)->limit(1)->get('package');
	}
	function couponcheck($giftcode)
	{
		$query= $this->db->select('sale_off, code, min_price')->where('code',$giftcode)->group_by('sale_off,code,min_price')->get('coupon');
		if($query->num_rows() ==1)
		{
			return $query;
		}else{
			return false;
		}
	}
	function checkfbidlike($fbid,$svlike)
	{
		$query = $this->db->where('user_id',$fbid)->get($svlike);
		if($query->num_rows() ==1)
		{
			return $query;
		}else{
			return false;
		}
	}
	function checkcmtid($fbid)
	{
		$query = $this->db->where('user_id',$fbid)->get('vipcmt');
		if($query->num_rows() ==1)
		{
			return $query;
		}else{
			return false;
		}
	}
	function getmoney($userid)
	{
		$query = $this->db->where('id_ctv',$userid)->get('member');
		if($query->num_rows() ==1)
		{
			return $query;
		}else{
			return false;
		}
	}
	function insertdb($table,$data)
	{
		return $this->db->insert($table,$data);
	}
	function updatedb($table,$data,$dieukien1,$dieukien2)
	{
		$query = $this->db->where($dieukien1,$dieukien2)->update($table,$data);
		if($query > 0 )
		{
			return true;
		}else{
			return false;
		}
	}
	function chatfuel($id,$text)
	{
		$botid = "";
		$blockid = "";
		$TOKENCHATFUEL = "";
		$api_url = "https://api.chatfuel.com/bots/$botid/users/$id/send?chatfuel_token=$TOKENCHATFUEL&chatfuel_block_id=$blockid&noti=$text";
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $api_url); 
		curl_setopt($ch, CURLOPT_HEADER, false);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
		curl_setopt($ch, CURLOPT_POST, true); 
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
		$response = curl_exec($ch); 
		curl_close($ch); 
		return $response;
	}
	function counttable($table)
	{
		$query = $this->db->get($table);
		return $query->num_rows();
	}
	function delltable($table,$tablename,$idtable)
	{
		$query = $this->db->delete($table, array($tablename => $idtable));
		return $query;
	}
	function gettoken($table)
	{
		$query = $this->db->get($table);
		return $query;
	}
	function delmultitoken($tokendie,$table)
	{
		$dem = 0;
		foreach ($tokendie as $key => $value) {
			$check = json_decode($this->login_model->auto('https://graph.facebook.com/me?access_token='.$value),true);
	    	
	    	if(!$check['id'])
	    	{
	    		$query = $this->db->delete($table, array('access_token' => $value));
	    		if($query){ $dem++;}
	    	}
			//$this->db->delete($table, array('access_token' => $value));
			# code...
		}
		return $dem;
	}
	function auto($url)
	{
		$ch = curl_init();
		curl_setopt_array($ch, array(
		      CURLOPT_CONNECTTIMEOUT => 5,
		      CURLOPT_RETURNTRANSFER => true,
		      CURLOPT_URL            => $url,
		      )
		   );
		$result = curl_exec($ch);
		curl_close($ch);
		return $result;
	}
}