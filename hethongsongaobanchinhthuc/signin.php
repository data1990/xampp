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
    if(!empty(trim($_POST['captcha']))){
        $captcha = $_POST['captcha'];
        if($captcha == $_SESSION['captcha']){
              function get_user_ip(){ 
                if(!empty($_SERVER['HTTP_CLIENT_IP'])){ 
                  //ip from share internet 
                  $ip = $_SERVER['HTTP_CLIENT_IP']; 
                }elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){ 
                  //ip pass from proxy 
                  $ip = $_SERVER['HTTP_X_FORWARDED_FOR']; 
                }else{ 
                  $ip = $_SERVER['REMOTE_ADDR']; 
                } 
                  return $ip; 
                } 
            $user_name = htmlspecialchars(addslashes($_POST['user_name']));
            $get = "SELECT email, code FROM member WHERE user_name='$user_name'";
            $result = mysqli_query($conn, $get);
            $x = mysqli_fetch_assoc($result);
            $email = $x['email'];
            $code = $x['code'];
            $password = htmlspecialchars(addslashes(md5($_POST['password'])));

                $sql = "SELECT COUNT(*), status, id_ctv, rule, password FROM member WHERE (user_name = " . "'$user_name'" . " OR email = " . "'$user_name'" . ") AND password = " . "'$password' GROUP BY status, id_ctv, rule, password";
                $c = mysqli_query($conn, $sql);
                $check = mysqli_fetch_assoc($c);
                if ($check['COUNT(*)'] == 1) {
                    if ($check['status'] == -1) {
                        echo "<script>alert('Tài khoản của bạn đã bị khóa. Liên hệ Admin để được hỗ trợ!'); window.location = 'index.php';</script>";
                    } else {
                        if ($check['status'] == 1) {
                            $id_ctv = $check['id_ctv'];
                            $rule = $check['rule'];
                            $pass = $check['password'];
                            $status = $check['status'];

                            $_SESSION['login'] = 'ok';
                            $_SESSION['id_ctv'] = $id_ctv;
                            $_SESSION['rule'] = $rule;
                            $_SESSION['pass'] = $pass;
                            $_SESSION['status'] = $status;
                            $_SESSION['user_name'] = $user_name;

                            /*Get thông tin và gửi về tn facebook*/
                            $ip = get_user_ip();
                            $getinfo = mysqli_query($conn, "SELECT idbot FROM member WHERE id_ctv = $id_ctv");
                            $infouser = mysqli_fetch_assoc($getinfo);
                            $id = $infouser['idbot'];
                            sendnoti($id,'Bạn vừa đăng nhập tài khoản tại địa chỉ:'.$ip);
                            /*End Get Thông Tin và gửi về tn facebook*/

                            $content = "<b>$user_name</b> vừa đăng nhập với IP <b>".get_user_ip()."</b></b>";   
                            $time = time();
                            $his = "INSERT INTO history(content,id_ctv,time, type) VALUES('$content','$id_ctv', '$time',10)";
                            if (mysqli_query($conn, $his)) {
                            echo "<script>alert('Đăng Nhập Thành Công!');window.location='index.php';</script>";
                            //die('<meta http-equiv=refresh content="0; URL=/index.php">'); 
                            }
                                                        // }
                        } else if ($check['status'] == 0) {
                            if($check['rule'] == 'member'){
                            // echo "<p class='alert alert-danger'> Tài khoản của bạn chưa được kích hoạt. Vui lòng click vào liên kết chúng tôi gửi vào Email đăng kí của bạn của bạn để kích hoạt. Chưa nhận được Email ? <a href='https://hethongsongao.com/index.php?vip=ResendEmail&email=$email&code=$code'> <b>Gửi lại Email kích hoạt</b></a></p>";
                              // echo "<p class='alert alert-danger'> Tài khoản của bạn chưa được kích hoạt. Vui lòng liên hệ <a href='//fb.com/nguyenthilannhiloveahihi' target='_blank'>Admin</a> để nạp tiền Đại Lí và kích hoạt tài khoản!!</p>";  
                            echo "<script>alert('Tài khoản của bạn chưa được kích hoạt.');window.location='//fb.com/nguyenthilannhiloveahihi';</script>";
                            }else{
                            echo "<script>alert('Tài khoản của bạn chưa được kích hoạt.');window.location='//fb.com/nguyenthilannhiloveahihi';</script>";
                              // echo "<p class='alert alert-danger'> Tài khoản của bạn chưa được kích hoạt. Vui lòng liên hệ <a href='//fb.com/nguyenthilannhiloveahihi' target='_blank'>Admin</a> để nạp tiền Đại Lí và kích hoạt tài khoản!!</p>";  
                            }
                        }
                    }
                }else {
                    echo "<script>alert('Đăng Nhập Không Thành Công! Sai tên đăng nhập hoặc mật khẩu.');window.location='signin.php';</script>";
                }
            
        }else{
            echo "<script>alert('Captcha không đúng. Nhìn kĩ lại đê');window.location='signin.php';</script>";
        }
    }else{
        echo "<script>alert('Vui lòng nhập captcha');window.location='signin.php';</script>";
    }
}
                            //func

?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="utf-8"/>    <title>Đăng nhập</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Đăng nhập để bắt đầu">
    <link href="//fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic"
          rel="stylesheet">
    <link rel="stylesheet" href="../bootstrap/login.css?ver=5.1.1"/>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css"> 
        <script src="https://code.jquery.com/jquery-1.12.0.min.js"></script>  
        <link href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.6.7/sweetalert2.min.css" rel="stylesheet" /> 
        <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.6.7/sweetalert2.min.js"></script> 
</head>
<body class="hold-transition login-page">
<div class="login-box">
    <div class="login-logo">
        <a href="/"><img src="<?php echo $getsetting['logo']; ?>" alt="<?php echo $getsetting['title']; ?>"/></a>
    </div>
    <!-- /.login-logo -->
    <div class="login-box-body">
        
        
<p class="login-box-msg">Đăng nhập để bắt đầu</p>

<form method="post" accept-charset="utf-8" id="signin-form" action="#">

<div class="form-group text  required">
    <input type="text" class="form-control" required="required" id="user_name" name="user_name" value="<?php echo isset($_POST['user_name']) ? $_POST['user_name'] : ''; ?>" placeholder="Tài khoản hoặc địa chỉ Email"/ required autofocus>
</div>
<div class="form-group password  required">
    <input type="password" name="password" id="password" placeholder="Password" class="form-control" required="required"/>
</div>
<div class="form-group password  required">
    <span class="input-group-addon"><img src="../login/captcha.php" alt="Captcha" /></span>
    <input type="text" class="form-control" name="captcha" id="captcha" placeholder="Nhập mã xác nhận" data-toggle="tooltip" title="Nhập mã xác nhận vào đây" required>
</div>
<button class="btn btn-primary btn-block btn-flat btn-captcha" type="submit" name="submit">Đăng nhập</button>

<div class="social-auth-links text-center">
    <p>- HOẶC -</p>

    
            <a class="btn btn-block btn-social btn-twitter" href="#">
            <i class="fa fa-twitter"></i> Đăng nhập qua Twitter        </a>
    
            <a class="btn btn-block btn-social btn-google" href="#">
            <i class="fa fa-google-plus"></i> Đăng nhập qua Google        </a>
    
</div>

<a href="index.php?vip=Recover">Tôi đã quên mật khẩu</a>
<br>
    <a href="signup.php"
       class="text-center">Đăng ký tài khoản mới</a>


    </div>
    <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<footer>
    <div class="container text-center">
            </div>
</footer>
<script src="../bootstrap/login.js?ver=5.1.1"></script>
</body>
</html>