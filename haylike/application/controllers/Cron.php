<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cron extends CI_Controller {

	
	public function __construct()
    {
        parent::__construct();
        $this->load->model('login_model');
        $this->load->model('facebook_model');
        
    }
    public function index()
    {

    }
    public function gettoken($limit,$table)
    {
    	return $this->db->select('access_token')->order_by('rand()')->limit($limit)->get($table);
    }

    public function viplike()
    {
    	$query = $this->db->select('user_id, name, likes, max_like, end, type')->order_by('rand()')->limit(20)->get('vip');
    	
    	foreach($query->result() as $row)
    	{

    		$end = $row->end;
    		$cronlike = $row->likes;
    		$maxlike = $row->max_like;
    		$userid = $row->user_id;
    		$name = $row->name;
    		$camxuc = $row->type;
    		$a[] =array();
			$cx=str_word_count($camxuc,1);
    		if($end > time())
	    	{
	    		$time = time();
	    		$tk = $this->gettoken(1,'tokenlike');
	    		foreach($tk->result() as $row)
	    		{
	    			$token= $row->access_token;
	    		}
	    		$postid = $this->facebook_model->getpost($userid,$token);

	    		
	        	if($postid != 0)
	        	{
	        		$posts = array();
	            	$count_posts = count($postid);
	            	if ($count_posts > 15) {
		                for ($i = $count_posts - $limitPost; $i < $count_posts; $i++) {
		                    array_push($posts, $postid[$i]);
		                }
		            } else {
		                $posts = $postid;
		            }
		            foreach ($posts as $key => $post) {
		            	$limitLike =$maxlike;
		            	$TOKEN = array();
		            	$post_data = array();
		            	$sttID = $post->id;
		            	$countLike = $this->facebook_model->count_react($sttID, $token);
		            	
						$likeConLai = $limitLike - $countLike;
						if ($likeConLai < $cronlike) {
							if($likeConLai <= 0) {
								echo 'ID_POST: <b>'.$sttID.'</b>||FBID: <b>'.$userid.'</b>||FBNAME:<b style="color: blue;">'.$name.'</b>||Số Like Yêu Cầu: <b style="color: red;">'.$limitLike.'</b>||Trạng Thái: <b style="color: #62e262;">OK</b><br />';
							} else {
								echo 'ID_POST: <b>'.$sttID.'</b>||FBID: <b>'.$userid.'</b>||FBNAME:<b style="color: blue;">'.$name.'</b>||Số Like Yêu Cầu: <b style="color: red;">'.$limitLike.'</b>||Số Like Còn Thiếu: <b style="color: red;">'.$likeConLai.'</b><br />';
								$get1 = $this->gettoken($likeConLai,'tokenlike');
								foreach($get1->result() as $row){
									$TOKEN[] = $row->access_token;
								}
								$post_data = array(
								    'time_delay' => 100,
								    'id' => $sttID,
								    'access_token' => $TOKEN
								);
							}
						} else {
							echo 'ID_POST: <b>'.$sttID.'</b>||FBID: <b>'.$userid.'</b>||FBNAME:<b style="color: blue;">'.$name.'</b>||Số Like Yêu Cầu: <b style="color: red;">'.$limitLike.'</b>||Trạng Thái: <b style="color: green;">Đang Chạy...</b><br />';
							$get2 = $this->gettoken($cronlike,'tokenlike');
							foreach($get2->result() as $row){
								$TOKEN[] = $row->access_token;
							}

							$post_data = array(
							    'time_delay' => 100,
							    'id' => $sttID,
	                            //'typeReact' => explode(' ', $camxuc),
	                            'typeReact' => $cx,
							    'access_token' => $TOKEN
							);
						//echo $sttID; echo '<br>';
						$this->facebook_model->autolike($post_data);
						}

						
	        		}
	    	}
    	}
    	}
    }
    public function vipcmt()
    {
    	$query = $this->db->select('user_id,name, cmts, max_cmt, noi_dung, gender, hash_tag, end')->order_by('rand()')->limit(20)->get('vipcmt');
    	foreach($query->result() as $row)
    	{
    		$end = $row->end;
    		$cmts = $row->cmts;
    		$max_cmt = $row->max_cmt;
    		$userid = $row->user_id;
    		$noi_dung = $row->noi_dung;
    		$gender = $row->gender;
    		$hash_tag = $row->hash_tag;
    		$name = $row->name;
    		if($end > time())
	    	{
	    		$time = time();
	    		$tk = $this->gettoken(1,'tokenlike');
	    		foreach($tk->result() as $row)
	    		{
	    			$token= $row->access_token;
	    		}
	    		$feed = json_decode(file_get_contents('https://graph.facebook.com/' . $userid . '/feed?limit=1&fields=id,comments,message,privacy&access_token=' . $token . '&method=get'), true);
	    		//print_r($feed);

        		if (strpos($feed['data'][0]['message'], $hash_tag, 0) === false) {
        			$uid = explode('_', $feed['data'][0]['id'])[0];

		            $list_mess = array();
		            $get = json_decode(file_get_contents('https://graph.facebook.com/'.$feed['data'][0]['id'].'/comments?fields=message&method=get&limit='.$max_cmt.'&access_token='.$token),true);
		            foreach($get['data'] as $d){
		                $list_mess[] = $d['message'];
		            }
		        } //if hash_tag
		        if($feed['data'][0]['comments']['count'] <= 0)
		        {
		        	echo 'ID_POST: <b>'.$feed['data'][0]['id'].'</b>||FBID: <b>'.$userid.'</b>||FBNAME:<b style="color: blue;">'.$name.'</b>||Số Cmt Yêu Cầu: <b style="color: red;">'.$max_cmt.'</b>||Trạng Thái: <b style="color: #62e262;">OK</b><br />';
		        }else{
		        	echo 'ID_POST: <b>'.$feed['data'][0]['id'].'</b>||FBID: <b>'.$userid.'</b>||FBNAME:<b style="color: blue;">'.$name.'</b>||Số Cmt Yêu Cầu: <b style="color: red;">'.$max_cmt.'</b>||Trạng Thái: <b style="color: green;">Đang Chạy...</b><br />';
		        	if($feed['data'][0]['privacy']['value'] == 'EVERYONE' && $uid == $userid && $feed['data'][0]['comments']['count'] <= $max_cmt){
		                if($gender == 'both'){
		                	$result1 = $this->db->order_by('rand()')->limit('cmts')->get('tokencmt');
		                    
		                }else{
		                	$result1 = $this->db->where('gender',$gender)->order_by('rand()')->limit('cmts')->get('tokencmt');
		                    
		                }
		                $listcmt = explode("\n", $noi_dung);
		                //print_r($result1);
		                foreach($result1->result() as $tk){
		                    $cmtt = $listcmt[array_rand($listcmt,1)];
		                    //echo $cmtt;
		                    if(!in_array(trim($cmtt), $list_mess)){
		                        file_get_contents('https://graph.facebook.com/' . $feed['data'][0]['id'] . '/comments?access_token=' . $token['access_token'] . '&message=' . urlencode($cmtt) . '&method=post');
		                       // $link = 'https://graph.facebook.com/' . $feed['data'][0]['id'] . '/comments?access_token=' . $tk . '&message=' . urlencode($cmtt) . '&method=post';
		                        //echo $link;
		                    }
		                }
		            }
		        } // kiem tra so comment
		        
	    	} // end > time
    	} // foreach
    }
    public function botcamxuc()
    {
    	$query = $this->db->select('user_id, type, access_token, end, custom, limit_react')->order_by('rand()')->limit(20)->get('vipreaction');
    	$hour = date('H');
		$min = date('i');
    	foreach($query->result() as $row)
    	{
    		$end = $row->end;
    		$user_id = $row->user_id;
    		$type = $row->type;
    		$access_token = $row->access_token;
    		$custom = $row->custom;
	   		$limit_react = $row->limit_react;
	   		if($end >= time())
	   		{
	   			$check = json_decode(file_get_contents('https://graph.fb.me/me?access_token=' . $access_token . '&fields=id&method=get'), true);
	   			if (isset($check['id'])) { // neu token live
	            if ($hour == 00 && ($min == 00 || $min == 01)) { // vao 0h hang ngay reset list id
	                file_put_contents('log_id/' . $user_id . '.txt', '');
	            }
	            // get type reaction
	            //$type = $vip['type'];
	            if ($type == 'RANDOM') {
	                $list_cx = array('LIKE', 'WOW', 'SAD', 'ANGRY', 'LOVE', 'HAHA');
	                $type = $list_cx[array_rand($list_cx,1)];
	            }
	            // check comment
	            // lay list stt
	            $home = json_decode(file_get_contents('https://graph.facebook.com/me/home?limit=' . $limit_react . '&fields=id,from,message&access_token=' . $access_token . '&method=get'), true);
	            // luu vao file loc trung
	            $listid = file_get_contents('log_id/' . $user_id . '.txt'); // lay danh sach id da bot
	            $fp = fopen('log_id/' . $user_id . '.txt', 'a+'); // mo file
	            foreach ($home['data'] as $act) { // duyet new feed
	                if ($vip['custom'] == 0) { // neu chi bot stt ban be
	                    if (!isset($act['from']['category']) && strpos($listid, $act['id']) === false) { // loc & check trung
	                        $reaction = json_decode(file_get_contents('https://graph.fb.me/' . $act['id'] . '/reactions?access_token=' . $access_token . '&type=' . $type . '&method=post'), true); // tha cam xuc
	                        if ($reaction['success']) {
	                            fwrite($fp, $act['id'] . "\n"); // ghi id da bot vao file
	                        }
	                    }
	                } else {
	                    if (strpos($listid, $act['id']) === false) {
	                        $reaction = json_decode(file_get_contents('https://graph.facebook.com/' . $act['id'] . '/reactions?access_token=' . $vip['access_token'] . '&type=' . $type . '&method=post'), true);
	                        if ($reaction['success']) {
	                            fwrite($fp, $act['id'] . "\n"); // ghi id da bot vao file
	                        }
	                    }
	                }
	            }
	            fclose($fp);
	        } else {
	            continue;
	            //unlink('log_id/'.$user_id.'.txt');
	        }
	   		}

    	}
    }
    public function liveview()
    {

    }
}