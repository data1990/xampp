<?php
ob_start();
session_start();
define('COPYRIGHT', 'VTADEPTRAI');
date_default_timezone_set('Asia/Ho_Chi_Minh');
include '_config.php';
include 'Mailer/PHPMailerAutoload.php';
include 'login/function/active.php';
if(strpos($_SERVER['QUERY_STRING'], '=')){
$pattern = '#=(.*)#';
$str = $_SERVER['QUERY_STRING'];
preg_match($pattern, $str, $matches);
if(strpos($matches[1], '%27') === false){
// todo something
}else{
echo "<script>alert('Tuổi lồn nhé');window.location='http://xvideos.com';</script>";
}
}
if (isset($_POST['submit'])) {
    $type = 'member';
    $pass = $_POST['password'];
    $user_name = htmlspecialchars(addslashes($_POST['user_name']));
    $password = htmlspecialchars(addslashes(md5($_POST['password'])));
    // $hoten = htmlspecialchars(addslashes($_POST['name']));
    $sdt = htmlspecialchars(addslashes($_POST['sdt']));
    $email = htmlspecialchars(addslashes($_POST['prefix'].'@'.$_POST['email_type']));
    $profile = htmlspecialchars(addslashes($_POST['profile']));
    $bill = '1000';
    $status = '0';
    $code = substr(md5(time() + rand(0, 9)), 0, 8);

   $captcha;
   if (isset($_POST['g-recaptcha-response'])) {
       $captcha = $_POST['g-recaptcha-response'];
   }
   if (!$captcha) {
       echo "<script>alert('Hãy xác nhận captcha để đăng nhập');location.href='signup.php';</script>";
   } else {
       $secret_key = '6LdBSSoUAAAAAMNA5dr40HUZct7xl_3NXmD2tJX9';
       $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=".$secret_key."&response=" . $captcha . "&remoteip=" . $_SERVER['REMOTE_ADDR']);
       if ($response.success == false) {
           echo "<script>alert('Captcha không hợp lệ');location.href='index.php?vip=Register';</script>";
       } else {
            $loi = array();
                $get = "SELECT user_name, email, profile,phone FROM member";
            $result = mysqli_query($conn, $get);
            while ($x = mysqli_fetch_assoc($result)) {
                if ($x['user_name'] == $_POST['user_name']) {
                    $loi['user_name'] = "<font color='red'>Đã có người sử dụng username này!</font>";
                }
                if ($x['email'] == $_POST['prefix'].'@'.$_POST['email_type']) {
                    $loi['email'] = "<font color='red'>Đã có người sử dụng email này!</font>";
                }
                if ($x['profile'] == $_POST['profile']) {
                    $loi['profile'] = "<font color='red'>Đã có người sử dụng userid này!</font>";
                }
            }
            $email_type = array('gmail.com','yahoo.com','hotmail.com','yahoo.com.vn');
            if(!in_array($_POST['email_type'], $email_type)){
                $loi['email_type'] = "<font color='red'>Vui lòng chọn 1 trong số các loại Email được cho phép!</font>";
            }
            $idfb = json_decode(file_get_contents('https://getfbid.com/api?url='.$profile),true);
            if (empty($loi)) {
                if($idfb['error'] == 0 && isset($idfb['id']) && isset($idfb['name'])){
                    $hoten = $idfb['name'];
                    $id = $idfb['id'];
                    $sql = "INSERT INTO member(user_name, password, name, phone, email, profile, bill, status, code,rule,num_id,baomat)  VALUES('$user_name','$password','$hoten','$sdt','$email','$id','$bill','1','$code','member',0,0)";
                }else {
                    $loi['profile'] = "<font color='red'>IDFB Của Bạn Sai Hoặc Không Tồn Tại!!!</font>";
                }
                $active = false;
                if (mysqli_query($conn, $sql)) {
                    if($type == 'member' && $active == true){
                        $query = "SELECT code FROM member WHERE user_name='$user_name'";
                        $result = mysqli_query($conn, $query);
                        $c = mysqli_fetch_assoc($result);
                        $code = $c['code'];
                        $subject = 'Vui lòng xác minh địa chỉ email của bạn';
                        $bcc = 'hethongsongao.com - VIP Like Account Active';
                        $noi_dung = "Xin chào <b>$hoten</b>!<br /><br /> Cảm ơn bạn đã đăng kí tài khoản thành viên tại hệ thống VIP Facebook Auto <b>https://hethongsongao.com</b><br /><br />Vui lòng click vào liên kết : <a href='https://hethongsongao.com/index.php?vip=Confirm&email=$email&code=$code' target='_blank'><span style='background:yellow; color:red'>https://hethongsongao.com/index.php?vip=Confirm&email=$email&code=$code</span></a> để kích hoạt tài khoản của bạn. <br /><br />Thông tin đăng nhập của bạn sau khi kích hoạt thành công:<br /><br />Tài khoản: <b>$user_name</b><br />Mật khẩu: <b>$pass</b><br /><br />Vui lòng bảo mật thông tin này, nếu quên mật khẩu bạn có thể sử dụng địa chỉ email này để lấy lại.<br /><br />Xin cảm ơn và hậu tạ!<br/><br/>Đội ngũ <b>hethongsongao.com</b>";
                        if (sendDS($email, $hoten, $subject, $noi_dung, $bcc)) {
                            echo "<script>alert('Đăng kí thành công. Chúng tôi đã gửi 1 liên kết kích hoạt tài khoản đến email <b>$email</b> của bạn. Vui lòng đăng nhập kiểm tra Hộp thư đến ( <b>hoặc hòm thư Spam</b> ) và click vào liên kết trong email để kích hoạt tài khoản. Chú ý: <b> Trong vòng 12-24h kể từ khi đăng kí , nếu không kích hoạt Email, tài khoản của bạn trên hệ thống sẽ bị xóa!!</b>Nếu có vấn đề gì xảy xa trong quá trình tạo tài khoản và đăng nhập, vui lòng liên hệ Admin. Xin cảm ơn!');window.location='signin.php';</script>";

                            // echo "<p class='alert alert-success'> Đăng kí thành công. Chúng tôi đã gửi 1 liên kết kích hoạt tài khoản đến email <b>$email</b> của bạn. Vui lòng đăng nhập kiểm tra Hộp thư đến ( <b>hoặc hòm thư Spam</b> ) và click vào liên kết trong email để kích hoạt tài khoản. Chú ý: <b> Trong vòng 12-24h kể từ khi đăng kí , nếu không kích hoạt Email, tài khoản của bạn trên hệ thống sẽ bị xóa!!</b>Nếu có vấn đề gì xảy xa trong quá trình tạo tài khoản và đăng nhập, vui lòng liên hệ Admin. Xin cảm ơn!</p><script>setTimeout(function(){ window.location  = 'index.php'; }, 30000);</script>";
                        }
                    }else{
                        if($type == 'member'){
                        echo "<script>alert('Đăng kí thành công. Vui lòng đăng nhập và nạp tiền để sử dụng dịch vụ. Trong 3 ngày, nếu tài khoản của bạn không có bất kì hoạt động thanh toán nào trên web, tài khoản của bạn sẽ bị <b>Khóa');window.location='signin.php';</script>";

                            // echo "<p class='alert alert-success'> Đăng kí thành công. Vui lòng đăng nhập và nạp tiền để sử dụng dịch vụ. Trong 3 ngày, nếu tài khoản của bạn không có bất kì hoạt động thanh toán nào trên web, tài khoản của bạn sẽ bị <b>Khóa</b></p><script>setTimeout(function(){ window.location  = 'index.php?vip=Login'; }, 25000);</script>";
                        }else{
                        echo "<script>alert('Đăng kí thành công. Vui lòng liên hệ với <a href=//fb.com/1941732149410907 target=_blank><b>Admin</b></a>  để nạp tiền và kích hoạt tài khoản của bạn. Chú ý trong vòng <b>24h-72h</b> kể từ khi đăng kí, nếu bạn <b>không liên hệ với chúng tôi</b> để <b> nạp tiền và kích hoạt</b>, <b>tài khoản của bạn sẽ bị xóa!');window.location='signin.php';</script>";
                            // echo "<p class='alert alert-success'> Đăng kí thành công. Vui lòng liên hệ với <a href=//fb.com/1941732149410907 target=_blank><b>Admin</b></a>  để nạp tiền và kích hoạt tài khoản của bạn. Chú ý trong vòng <b>24h-72h</b> kể từ khi đăng kí, nếu bạn <b>không liên hệ với chúng tôi</b> để <b> nạp tiền và kích hoạt</b>, <b>tài khoản của bạn sẽ bị xóa!</b></p><script>setTimeout(function(){ window.location  = 'index.php'; }, 30000);</script>";
                        }
                    }
                }
            }
       }
   }
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="utf-8"/>    <title>Tạo một tài khoản</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Đăng ký tài khoản mới">
    <link href="//fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic"
          rel="stylesheet">
    <link rel="stylesheet" href="../bootstrap/login.css?ver=5.1.1"/>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css"> 
        <script src="https://code.jquery.com/jquery-1.12.0.min.js"></script>  
        <link href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.6.7/sweetalert2.min.css" rel="stylesheet" /> 
        <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.6.7/sweetalert2.min.js"></script> 
        <script src='https://www.google.com/recaptcha/api.js'></script>

</head>
<body class="hold-transition login-page">

<div class="login-box">
    <div class="login-logo">
        <a href="/"><img src="<?php echo $getsetting['logo']; ?>" alt="<?php echo $getsetting['title']; ?>"/></a>
    </div>
    <!-- /.login-logo -->
    <div class="login-box-body">
        
        
<p class="login-box-msg">Đăng ký tài khoản mới</p>
<?php
if($getsetting['dangki'] == 'on'){
?> 
<form method="post" accept-charset="utf-8" id="signup-form" action="#">
<div class="form-group text  required">
    <input class="form-control"  type="number" placeholder="ID Facebook 10000xxxxxxxx" id="profile" value="<?php echo isset($_POST['profile']) ? $_POST['profile'] : ''; ?>" name="profile" required>
        <?php echo isset($loi['profile']) ? $loi['profile'] : ''; ?>
</div>
<div class="form-group email  required">
   <input type="text" class="form-control" id="email" value="<?php echo isset($_POST['prefix']) ? $_POST['prefix'] : ''; ?>" name="prefix" placeholder="vd: vtasystem@gmail.com thì chỉ nhập vtasystem" required style="width:60%;display:inline">
                            <select class="form-control" name="email_type" style="width:35%;display:inline">
                                <option value="gmail.com">@gmail.Com</option>
                                <option value="yahoo.com">@yahoo.Com</option>
                                <option value="yahoo.com.vn">@yahoo.Com.VN</option>
                                <option value="hotmail.com">@hotmail.Com</option>

                            </select><br /><code>Ví dụ: vtasystem@gmail.com thì chỉ nhập vtasystem. Nhập chính xác Email để lấy lại Mật khẩu khi quên!</code>
                            <?php echo isset($loi['email']) ? $loi['email'] : ''; ?>
                            <?php echo isset($loi['email_type']) ? $loi['email_type'] : ''; ?>
</div>
<div class="form-group text  required">
                            <input type="text" minlength="4" class="form-control" id="user_name" value="<?php echo isset($_POST['user_name']) ? $_POST['user_name'] : ''; ?>" name="user_name" placeholder="Nhập tên tài khoản" required>
                            <?php echo isset($loi['user_name']) ? $loi['user_name'] : ''; ?>
</div>
<div class="form-group password  required">
                            <input type="text" minlength="6" class="form-control" id="password" name="password" placeholder="Password" required>
</div>

                            <div class="g-recaptcha" data-sitekey="6LdBSSoUAAAAAAq4adHH9YScPerV0pWgJS4hWOD8"></div>

<div class="form-group">
    <label>Bằng cách đăng ký, bạn đồng ý với <a href='#' target='_blank'>Điều khoản dịch vụ</a> và <a href='#' target='_blank'>Chính sách bảo mật</a>.</label>
</div>

<button class="btn btn-primary btn-block btn-flat btn-captcha"  type="submit" name="submit">Register</button>
</form>
<div class="social-auth-links text-center">
    <p>- HOẶC -</p>

    
            <a class="btn btn-block btn-social btn-twitter" href="#">
            <i class="fa fa-twitter"></i> Đăng ký qua Twitter        </a>
    
            <a class="btn btn-block btn-social btn-google" href="#">
            <i class="fa fa-google-plus"></i> Đăng ký qua Google        </a>
    
</div>

<a href="signin.php"
   class="text-center">Tôi đã là thành viên</a>

    </div>
    <!-- /.login-box-body -->
</div>
<!-- /.login-box -->
<?php 
}else{
?> 

                <center>
                    <b>
                        <p>Bạn cần đăng ký tài khoản vui lòng liên hệ 0919.257.664</p>
                        <p>Facebook <a href="https://www.facebook.com/100009580369715" target="_blank">Vũ Tiến Anh</a></p>
                    </b>
                </center>
    </div>
    <!-- /.login-box-body -->
</div>
<!-- /.login-box -->
<?php 
}
?>

<footer>
    <div class="container text-center">
            </div>
</footer>
<script src="../bootstrap/login.js?ver=5.1.1"></script>
</body>
</html>
