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
    	return $this->db->select('access_token')->limit($limit)->get($table);
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
		            	/*$message = $post->message ? $post->message : "NULL";
						if (preg_match('/#l_\d{1,}/', $message, $match)) {
							$rl = str_replace('#l_', '', $match[0]);
							if ($rl < $limitLike) {
								$limitLike = $rl;
							} else {
								echo 'ID_POST: <b>'.$sttID.'</b>||FBID: <b>'.$userid.'</b>||FBNAME:<b style="color: blue;">'.$name.'</b>||Số Like Yêu Cầu: <b style="color: red;">'.$limitLike.'</b>||Trạng Thái: <b style="color: red;">HashTag Vượt Quá Số Like Cho Phép</b><br />';
							}
						}*/
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
	                            'typeReact' => explode('|', $camxuc),
							    'access_token' => $TOKEN
							);
						
						}

	        		}
	        	
	    	}
	    	$this->facebook_model->autolike($post_data);
    	}
    	}
    }
}