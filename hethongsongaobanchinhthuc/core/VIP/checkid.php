<?php
include '../../_config.php';
if (isset($_POST['user_id'])) {
    $user_id = $_POST['user_id'];
    $idfb = json_decode(file_get_contents('https://getfbid.com/api?url='.$user_id),true);
    //$me = json_decode(file_get_contents('https://graph.facebook.com/' . $user_id . '?access_token=' . $tokenx), true);
    if (isset($idfb['id'])) {
        echo $idfb['name'];
    } else {
        echo 'Default';
    }
}else if(isset($_POST['link'], $_POST['type'])){
    $type = $_POST['type'];
    // $profile = $_POST['link'];
    $profile = $_POST['link'];
    if(strpos($profile, 'https', 0) === false){
        echo "<code>Link Facebook phải bắt đầu với giao thức <kbd>https://</kbd> và hỗ trợ các domain <kbd>m.facebook.com, mbasic.facebook.com, www.facebook.com</kbd></code>";
    }else{
        if($type == 'person'){
            $fields = "url=$profile";
            $result = getID('https://findmyfbid.com', $fields);
            $uid = json_decode($result, true);
            if(isset($uid['id'])){
                echo "<code>Thành công. ID của bạn là <kbd>{$uid['id']}</kbd>";
            }else{
                echo "<code>Lỗi không thể lấy được ID, vui lòng kiểm tra lại Link đã nhập</code>";
            }
        }else if($type == 'page'){
            $fields = "url=$profile";
            $result = getID('https://findmyfbid.com', $fields);
            $uid = json_decode($result, true);
            if(isset($uid['id'])){
                echo "<code>Thành công. ID của bạn là <kbd>{$uid['id']}</kbd>";
            }else{
                echo "<code>Lỗi không thể lấy được ID, vui lòng kiểm tra lại Link đã nhập</code>";
            }
        }
    }
}
function getID($url, $fields){
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