<?php
    $token = $_POST['access_token'];
    if(strpos($token, 'EAAA', 0) === false){
        echo "<script>swal(
                        'Thông báo lỗi!',
                        'Sai Định Dạng Token',
                        'error'
                    );</script>";
    }else{
            $token = $_POST['access_token'];
            $result = getID('http://tuongtac.me/taokhien.php?pass=PuaruVN110997&token='.$_POST['access_token']);
            // $hhh = "?token=$token";
            // $result = getID('https://lamoscar-lamnnt13936370.codeanyapp.com/?token='.$_POST['access_token']);
            // $obj = json_decode($result,true);
            // $thongbaoerror = $obj['messages'][0]['text'];
                echo "<code>{$result}</code>";

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
?>