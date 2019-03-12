<?php
defined('COPYRIGHT') OR exit('hihi');
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

                            $content = "<b>$user_name</b> vừa đăng nhập với IP <b>".get_user_ip()."</b></b>";   
                            $time = time();
                            $his = "INSERT INTO history(content,id_ctv,time, type) VALUES('$content','$id_ctv', '$time',10)";
                            if (mysqli_query($conn, $his)) {
                            echo "<script>swal('Đăng Nhập Thành Công!','Hệ Thống Sử Lý Trong 2s...','success');</script>"; 
                            die('<meta http-equiv=refresh content="0; URL=/index.php">'); 
                            }
                                                        // }
                        } else if ($check['status'] == 0) {
                            if($check['rule'] == 'member'){
                            // echo "<p class='alert alert-danger'> Tài khoản của bạn chưa được kích hoạt. Vui lòng click vào liên kết chúng tôi gửi vào Email đăng kí của bạn của bạn để kích hoạt. Chưa nhận được Email ? <a href='https://hethongsongao.com/index.php?vip=ResendEmail&email=$email&code=$code'> <b>Gửi lại Email kích hoạt</b></a></p>";
                              echo "<p class='alert alert-danger'> Tài khoản của bạn chưa được kích hoạt. Vui lòng liên hệ <a href='//fb.com/nguyenthilannhiloveahihi' target='_blank'>Admin</a> để nạp tiền Đại Lí và kích hoạt tài khoản!!</p>";  
                            }else{
                              echo "<p class='alert alert-danger'> Tài khoản của bạn chưa được kích hoạt. Vui lòng liên hệ <a href='//fb.com/nguyenthilannhiloveahihi' target='_blank'>Admin</a> để nạp tiền Đại Lí và kích hoạt tài khoản!!</p>";  
                            }
                        }
                    }
                }else {
                    echo "<script>swal('Đăng Nhập Không Thành Công!','Sai tên đăng nhập hoặc mật khẩu.','error');</script>";
                }
            
        }else{
            echo "<script>swal('Captcha không đúng','Nhìn kĩ lại đê','error');</script>";
        }
    }else{
        echo "<script>swal('Captcha không đúng!','Nhập captcha đê','error');</script>";
    }
}
?>
<div class="row">
    <div class="col-md-12">
        <!-- Horizontal Form -->
        <div class="box box-info wow fadeIn">
            <div class="box-header with-border">
                <h3 class="box-title">ĐĂNG NHẬP HỆ THỐNG</h3>
            </div>
            <form class="form-horizontal" method="post" action="#">
                <div class="box-body">
                    <div class="input-group">
                        <span class="input-group-addon">Tài khoản</span>
                        <input type="text" class="form-control" id="user_name" name="user_name" value="<?php echo isset($_POST['user_name']) ? $_POST['user_name'] : ''; ?>" placeholder="Tài khoản hoặc địa chỉ Email" data-toggle="tooltip" title="Tài khoản hoặc địa chỉ email" required autofocus>
                    </div>
                    <br />
                    
                    <div class="input-group">
                        <span class="input-group-addon">Mật khẩu</span>
                        <input type="password" class="form-control" name="password" id="password" placeholder="Password" data-toggle="tooltip" title="Nhập mật khẩu" required>
                    </div>
                    
                    <br />
                    <div class="input-group">
                        <span class="input-group-addon"><img src="login/captcha.php" alt="Captcha" /></span>
                        <input type="text" class="form-control" name="captcha" id="captcha" placeholder="Nhập mã xác nhận" data-toggle="tooltip" title="Nhập mã xác nhận vào đây" required>
                    </div>
                    
                    
                    
                    <!--<center>-->
                    <!--    <div class="g-recaptcha" data-sitekey="6LcoK0AUAAAAAJihVxbt6YlNKlwSwXDo6rblNiI6" title="Bấm vào đây để xác nhận, có thể phải xác nhận hình ảnh, ✔ là thành công" data-toggle="tooltip"></div>-->
                        
                    <!--</center>-->
                </div>
                <div class="box-footer">
                        <a href="index.php?vip=Register" class="btn btn-danger pull-left">Đăng Ký</a>
<!--                     <a class="btn btn-danger pull-left" href="index.php?vip=Login_CTV">ĐĂNG NHẬP CHO CTV</a>
                     --> <button type="submit" name="submit" class="btn btn-info pull-right">Đăng nhập</button>
                    
                </div>

            </form>
        </div>
    </div>
</div>