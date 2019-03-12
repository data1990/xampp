<?php
defined('COPYRIGHT') OR exit('hihi');
if (isset($_GET['email'], $_GET['code'])) {
    $code = $_GET['code'];
    $email = $_GET['email'];
    $get = "SELECT name,COUNT(*) FROM member WHERE email = '$email' AND code = '$code' GROUP BY name";
    $result = mysqli_query($conn, $get);
    $x = mysqli_fetch_assoc($result);
        if($x['COUNT(*)'] == 1){
        $hoten = $x['name'];
        $subject = 'Liên kết kích hoạt tài khoản VIP';
        $bcc = 'HETHONGSONGAO TEAM - VIP Like Account Active';
        $noi_dung = "Xin chào, <b>$hoten</b> !<br /><br />Chúng tôi gửi lại cho bạn liên kết kích hoạt tài khoản : <a href='https://hethongsongao.com/index.php?vip=Confirm&email=$email&code=$code' target='_blank'><span style='background:yellow; color:red'>https://hethongsongao.com/index.php?vip=Confirm&email=$email&code=$code</span></a><br /><br />Đội ngũ <b>HETHONGSONGAO TEAM</b> !";
        if (sendDS($email, $hoten, $subject, $noi_dung, $bcc)) {
            echo "<script>alert('Chúng tôi đã gửi 1 liên kết kích hoạt tài khoản đến địa chỉ Email của bạn. Vui lòng kiểm tra!!');window.location = 'index.php?vip=Login';</script>";
        }
    }else{
        echo "<script>alert('Liên kết không hợp lệ hoặc đã hết hạn'); window.location='trang-chu.html';</script>";
    }
}else{
    header('Location: index.php');
}
?>