<link rel="stylesheet" href="../../bootstrap/toastr.css"> 
<script type="text/javascript" src="../../bootstrap/toastr.min.js"></script> 

<?php 
    session_start(); 
    $now = getdate(); 
    include '../../_config.php';

    $user       = $_POST['user'];
    $type       = $_POST['rulex'];
    $issuer        = $_POST['key']; //loai the cua nha mang
    $code       = $_POST['code']; // ma the
    $seri     = $_POST['serial']; //serial the
$param = array("username" => "vutienanh2901@gmail.com",
                     "password"=>"nhianhbn123",
                     "remember"=>"true");                                                                  
$param = json_encode($param); 
PuaruVN("https://ws.doithenhanh.com/portal/login",$param);
$ketqua = json_decode(curl("https://ws.doithenhanh.com/portal/login",$param),true);
$token = $ketqua['token']['value'];

//{"provider":"vtt","serial":"10000478249232","pin":"017101039317112"}

$param = array("provider" => "$issuer",
                     "serial"=>"$seri",
                     "pin"=>"$code");                                                                  
$param = json_encode($param); 
//exit;
$ketqua = json_decode(curl("https://ws.doithenhanh.com/portal/charge",$param,$token),true);
if($ketqua['code'] == '0')
{
    preg_match("#thẻ (.+?) đ#is", $ketqua['message'],$puaru);
   $menhgia = (int)str_replace(",", "", $puaru[1]);
   // echo json_encode(array('status' =>"thanhcong" , 'msg' =>"".$ketqua['message']."", 'menhgia' =>$menhgia));
       if($type = 'agency'){
            $add = "UPDATE member SET bill = bill + $menhgia WHERE user_name='$user'";
    }else if($type = 'freelancer'){
            $add = "UPDATE member SET bill = bill + $menhgia WHERE user_name='$user'";
    }else if($type = 'member'){
            $add = "UPDATE member SET bill = bill + $menhgia WHERE user_name='$user'";
    }else if($type = 'admin'){
            $add = "UPDATE member SET bill = bill + $menhgia WHERE user_name='$user'";
    }
               if(mysqli_query($conn, $add)){
                $content = "<b>$user</b> ( <b>$name</b> ) vừa nạp thành công thẻ <b>$mang</b> mệnh giá <b>".number_format($menhgia)."</b> VNĐ thành công và được cộng  <b>".number_format($menhgia)." </b> VNĐ vào tài khoản vip. Mã giao dịch <b>$transid</b>";
                $time = time();
                $his = "INSERT INTO history(content, time, id_ctv,type) VALUES('$content','$time','$id',2)";
                if(mysqli_query($conn, $his)){
                    $noti = "INSERT INTO noti(content, time, id_ctv) VALUES('$content','$time','$id')";
                    if(mysqli_query($conn, $noti)){
                        echo "<script>alert('Nạp tiền thành công!!! Cảm ơn $name đã sử dụng dịch vụ tại HETHONGSONGAO!!');window.location='/index.php?vip=Nap_The';</script>";
                    }
                }
            }
            $fp = fopen("napthethanhcong.txt","a+");
            $noidung = "Ma the: $code, Seri: $serial, Loai the : $key, Username: $user, Menh gia: $amount, So du duoc cong: $xu, Ma giao dich: $transid, Thoi gian: $timex \n";
            fwrite($fp, $noidung);
            fclose($fp);

            echo '<script>swal(
                        "Thông báo!",
                        "Nạp Thẻ Thành Công!! Mệnh giá ' . number_format($amount) . ' VNĐ.",
                        "success"
                    );</script>';
    } 
else
{
  // echo json_encode(array('status' =>"thatbai" , 'msg' =>$ketqua['message']));
        $thongbao = $ketqua['message']; 
        $fp = fopen("napthethatbai.txt","a+");
        $noidung = "Ma the: $code, Seri: $serial, Loai the : $key, Username: $user, Thoi gian: $timex \n";
        fwrite($fp, $noidung);
        fclose($fp);
        echo '<script>swal(
                            "Thông báo!",
                            "'.$thongbao.'",
                            "error"
                        );</script>';

}
function curl($site,$data,$token=""){
    $datapost = curl_init();
    $head[] = "Content-Type:application/json";
    $head[]= "x-access-token:".$token;

    curl_setopt($datapost, CURLOPT_URL, $site);
    curl_setopt($datapost, CURLOPT_TIMEOUT, 40000);
    curl_setopt($datapost, CURLOPT_HTTPHEADER, $head);
    curl_setopt($datapost, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/66.0.3359.181 Safari/537.36');
    curl_setopt($datapost, CURLOPT_POST, TRUE);
    curl_setopt($datapost, CURLOPT_POSTFIELDS, $data);    
    curl_setopt($datapost, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($datapost, CURLOPT_SSL_VERIFYHOST, FALSE);
    curl_setopt($datapost, CURLOPT_SSL_VERIFYPEER, FALSE);    
    curl_setopt($datapost, CURLOPT_FOLLOWLOCATION, TRUE);
    ob_start();
    return curl_exec ($datapost);
    ob_end_clean();
    curl_close ($datapost);
    unset($datapost); 
}
?>