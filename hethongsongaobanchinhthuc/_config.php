<?php
    $conn = mysqli_connect('localhost','','','') or die('Failed');
    mysqli_set_charset($conn, "utf8");	
    $getsetting = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM `setting` WHERE `id`= '1'")); 

	$botid = "";
	$blockid = "";
	$TOKENCHATFUEL = "";
	function sendnoti($id,$text){
	$text = urlencode($text);
	global $botid;
	global $blockid;
	global $TOKENCHATFUEL;
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
?>