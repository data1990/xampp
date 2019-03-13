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
}