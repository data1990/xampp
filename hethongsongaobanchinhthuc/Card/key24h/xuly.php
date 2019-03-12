<link rel="stylesheet" href="../../bootstrap/toastr.css"> 
<script type="text/javascript" src="../../bootstrap/toastr.min.js"></script> 


<?php 
session_start(); 
$now = getdate(); 


    include '../../_config.php';
	include 'card_charging_api.php';  
     
        // Api config 
    $config = array(); 
    $config['PartnerID']    = '56584456'; // Được cung cấp trong mục Tích Hợp API trên KEY24H 
    $config['PartnerKey']   = '43tg4545v'; // Được cung cấp trong mục Tích Hợp API trên KEY24H  

    // Call lib 
    try { 
        $api = new Card_charging_api($config); 
    } 
    catch (Card_charging_Exception $e) { 
        exit($e->getMessage()); 
    } 

    $users      = $_POST['txtuser']; 
    $key        = $_POST['key']; //loai the cua nha mang 
    $code       = $_POST['code']; // ma the 
    $serial     = $_POST['serial']; //serial the 
    $request_id = time(); //Mã tự sinh trong mỗi giao dịch và không giống nhau (Chúng tôi sẽ lưu lại mã này để đối chiếu khi có khiếu nại) 
     
    $res = $api->check_card($key, $code, $serial, $request_id); 

$getuser = mysqli_fetch_assoc(mysqli_query($vtasystem, "SELECT * FROM `account` WHERE `username`='".$users."'")); 

if(empty($code) || empty($serial)){ 
    echo '<script>toastr.error("Mã thẻ hoặc số seri không thể trống!!", "Thông báo lỗi");</script>';  

    exit(); 
} 
if(strlen($code) < 8 || strlen($serial) < 8 || strlen($code) > 20 || strlen($serial) > 20){ 
    echo '<script>toastr.error("Độ dài mã thẻ hoặc số seri không hợp lệ.", "Thông báo lỗi");</script>';  
    exit(); 
} 

    //thành công 
    if(isset($res->status) && $res->status == '0') 
    { 
        $amount     = $res->amount; //mệnh giá thẻ 
        $key        = $res->key; //Loại thẻ 
        $serial     = $res->serial; //serial 
        $code       = $res->code; //mã thẻ 
        $request_id =  $res->amount; //request_id ma đối tác gửi sang 
        $transid    = $res->transid; //mã giao dịch bên key24h.com 
        $timex = date('d/m/Y - H:i:s', time());
        $xu = $amount;

    if($type = 'agency'){
            $add = "UPDATE member SET bill = bill + $xu WHERE user_name='$user'";
    }else if($type = 'freelancer'){
            $add = "UPDATE member SET bill = bill + $xu WHERE user_name='$user'";
    }else if($type = 'member'){
            $add = "UPDATE member SET bill = bill + $xu WHERE user_name='$user'";
    }else if($type = 'admin'){
            $add = "UPDATE member SET bill = bill + $xu WHERE user_name='$user'";
    }
            if(mysqli_query($conn, $add)){
                $content = "<b>$user</b> ( <b>$name</b> ) vừa nạp thành công thẻ <b>$mang</b> mệnh giá <b>".number_format($amount)."</b> VNĐ thành công và được cộng  <b>".number_format($xu)." </b> VNĐ vào tài khoản vip. Mã giao dịch <b>$transid</b>";
                $time = time();
                $his = "INSERT INTO history(content, time, id_ctv,type) VALUES('$content','$time','$id',2)";
                if(mysqli_query($conn, $his)){
                    $noti = "INSERT INTO noti(content, time, id_ctv) VALUES('$content','$time','$idctv')";
                    if(mysqli_query($conn, $noti)){
                        echo '<script>swal(
                                    "Thông báo!",
                                    "Nạp Thẻ Thành Công!! Mệnh giá ' . number_format($amount) . ' VNĐ.",
                                    "success"
                                );</script>';
            $fp = fopen("napthethanhcong.txt","a+");
            $noidung = "Ma the: $code, Seri: $serial, Loai the : $key, Username: $user, Menh gia: $amount, So du duoc cong: $xu, Ma giao dich: $transid, Thoi gian: $timex \n";
            fwrite($fp, $noidung);
            fclose($fp);
                                            }
                }
            }
    } 
    //có lỗi 
    else 
    { 
        $thongbao = isset($res->message) ? $res->message : 'Nạp Thẻ Không Thành Công'; 
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