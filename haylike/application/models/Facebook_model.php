<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Facebook_model extends CI_Model
{
	function checktoken($token)
	{
		//$url = "https://graph.fb.me/me?access_token=".$token."&method=get&fields=id";
		$url = 'https://graph.fb.me/me/?access_token='.$token;
		$json = json_decode(file_get_contents($url));
		if($json->error){
			return 0;
		}elseif ($json->id) return 1;
		
	}
	function getpost($fbid, $token)
	{
		$start_day_time = $this->count_time_to_current_in_day(date("d/m/Y")) - 7200;
	$link='https://graph.facebook.com/' . $fbid . '/feed?fields=id,likes,message&since=' . $start_day_time . '&until=' . time() . '&access_token=' . $token . '&limit=20';
	$getPost = json_decode(file_get_contents('https://graph.facebook.com/' . $fbid . '/feed?fields=id,likes,message&since=' . $start_day_time . '&until=' . time() . '&access_token=' . $token . '&limit=20'));
		if ($getPost->data[0]->id) {
			return $getPost->data;
		}
		return 0;
	}
	function count_time_to_current_in_day($now){
	    $date = DateTime::createFromFormat("d/m/Y", $now);
	    $year = $date->format("Y");
	    $month = $date->format("m");
	    $day = $date->format("d");
	    $dt = $day . "-" . $month . "-" . $year . " 00:00:00";
	    $d = new DateTime($dt, new DateTimeZone('Asia/Ho_Chi_Minh'));
	    return $d->getTimestamp();
	}
	function autolike($data)
	{
		$sttID = $data['id'];
		$camxuc=$data['typeReact'];
		$tk=$data['access_token'];
		
		foreach($tk as $tokenlike)
		{
			if(empty($camxuc)){
				$action='LOVE';
			}else
			{
				$action=$camxuc[array_rand($camxuc,1)];
			}
			$like = "https://graph.facebook.com/".$sttID."/reactions?type=".$action."&access_token=".$tokenlike."&method=post";
			$ch = curl_init();
			curl_setopt ($ch, CURLOPT_URL, $like);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER,false);
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST,false);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION,true);
			$page = curl_exec($ch);
			curl_close($ch);
		}
	}
	function count_react($postid,$token)
	{
		$get_json = json_decode(file_get_contents('https://graph.facebook.com/v2.10/'.$postid.'/reactions?summary=true&access_token='.$token),true);
	    if($get_json['summary']['total_count']){
	        return $get_json['summary']['total_count'];
	    } else {
	        return 0;
	    }
	}
}