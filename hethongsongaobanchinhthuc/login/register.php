<?php
defined('COPYRIGHT') OR exit('hihi');
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
       echo "<script>alert('Hãy xác nhận captcha để đăng nhập');location.href='index.php?vip=Register';</script>";
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
                    $sql = "INSERT INTO member(user_name, password, name, phone, email, profile, bill, status, code,rule,num_id)  VALUES('$user_name','$password','$hoten','$sdt','$email','$id','$bill','1','$code','member',0)";
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
                            echo "<p class='alert alert-success'> Đăng kí thành công. Chúng tôi đã gửi 1 liên kết kích hoạt tài khoản đến email <b>$email</b> của bạn. Vui lòng đăng nhập kiểm tra Hộp thư đến ( <b>hoặc hòm thư Spam</b> ) và click vào liên kết trong email để kích hoạt tài khoản. Chú ý: <b> Trong vòng 12-24h kể từ khi đăng kí , nếu không kích hoạt Email, tài khoản của bạn trên hệ thống sẽ bị xóa!!</b>Nếu có vấn đề gì xảy xa trong quá trình tạo tài khoản và đăng nhập, vui lòng liên hệ Admin. Xin cảm ơn!</p><script>setTimeout(function(){ window.location  = 'index.php'; }, 30000);</script>";
                        }
                    }else{
                        if($type == 'member'){
                            echo "<p class='alert alert-success'> Đăng kí thành công. Vui lòng đăng nhập và nạp tiền để sử dụng dịch vụ. Trong 3 ngày, nếu tài khoản của bạn không có bất kì hoạt động thanh toán nào trên web, tài khoản của bạn sẽ bị <b>Khóa</b></p><script>setTimeout(function(){ window.location  = 'index.php?vip=Login'; }, 25000);</script>";
                        }else{
                            echo "<p class='alert alert-success'> Đăng kí thành công. Vui lòng liên hệ với <a href=//fb.com/1941732149410907 target=_blank><b>Admin</b></a>  để nạp tiền và kích hoạt tài khoản của bạn. Chú ý trong vòng <b>24h-72h</b> kể từ khi đăng kí, nếu bạn <b>không liên hệ với chúng tôi</b> để <b> nạp tiền và kích hoạt</b>, <b>tài khoản của bạn sẽ bị xóa!</b></p><script>setTimeout(function(){ window.location  = 'index.php'; }, 30000);</script>";
                        }
                    }
                }
            }
       }
   }
}
if($getsetting['dangki'] == 'on'){
?>
<div class="row">
    <div class="col-md-12">
        <!-- Horizontal Form -->
        <div class="box box-info wow fadeIn">
            <div class="box-header with-border">
                <h3 class="box-title">Đăng kí tài khoản</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" action="#" method="post">
                <div class="box-body">
                    <div class="form-group">
                        <label for="profile" class="col-sm-2 control-label">ID Facebook: <font color="red">*</font></label>

                        <div class="col-sm-10">
                            <input type="number" class="form-control" id="profile" value="<?php echo isset($_POST['profile']) ? $_POST['profile'] : ''; ?>" name="profile" placeholder="10000xxxxxxxx" required>
                            <?php echo isset($loi['profile']) ? $loi['profile'] : ''; ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="username" class="col-sm-2 control-label">Tài khoản:  <font color="red">*</font></label>

                        <div class="col-sm-10">
                            <input type="text" minlength="4" class="form-control" id="user_name" value="<?php echo isset($_POST['user_name']) ? $_POST['user_name'] : ''; ?>" name="user_name" placeholder="Nhập tên tài khoản" required>
                            <?php echo isset($loi['user_name']) ? $loi['user_name'] : ''; ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="password" class="col-sm-2 control-label">Mật khẩu: <font color="red">*</font></label>

                        <div class="col-sm-10">
                            <input type="text" minlength="6" class="form-control" id="password" name="password" placeholder="Password" required>
                        </div>
                    </div>
                    <?php /*
                    <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">Họ tên:</label>

                        <div class="col-sm-10">
                            <input type="text" minlength="2" class="form-control" value="<?php echo isset($_POST['name']) ? $_POST['name'] : ''; ?>" id="name" name="name" placeholder="Nhập Họ và tên thật" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <!--<label for="phone" class="col-sm-2 control-label">Số điện thoại:</label>-->

                        <div class="col-sm-10" style="display:none">
                            <input type="number" class="form-control" id="sdt"  value="0123456789" name="sdt" placeholder="Số điện thoại" required>
                            <?php echo isset($loi['sdt']) ? $loi['sdt'] : ''; ?>
                        </div>
                    </div>*/
                    ?>
                    <div class="form-group">
                        <label for="email" class="col-sm-2 control-label">Email (Chỉ nhập tên email trước dấu @): <font color="red">*</font></label>

                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="email" value="<?php echo isset($_POST['prefix']) ? $_POST['prefix'] : ''; ?>" name="prefix" placeholder="vd: vtasystem@gmail.com thì chỉ nhập vtasystem" required style="width:70%;display:inline">
                            <select class="form-control" name="email_type" style="width:150px;display:inline">
                            	<option value="gmail.com">@gmail.Com</option>
                            	<option value="yahoo.com">@yahoo.Com</option>
                            	<option value="yahoo.com.vn">@yahoo.Com.VN</option>
                            	<option value="hotmail.com">@hotmail.Com</option>
                            	
                            </select><br /><code>Ví dụ: vtasystem@gmail.com thì chỉ nhập vtasystem. Nhập chính xác Email để lấy lại Mật khẩu khi quên!</code>
                            <?php echo isset($loi['email']) ? $loi['email'] : ''; ?>
                            <?php echo isset($loi['email_type']) ? $loi['email_type'] : ''; ?>
                        </div>
                    </div>
                <?php /*
                    <div class="form-group">
                        <label for="profile" class="col-sm-2 control-label">Loại tài khoản?:</label>

                        <div class="col-sm-10">
                            <select name="type" class="form-control">
                            <option value="member" <?php echo (isset($_POST['type']) && $_POST['type'] == 'member') ? 'selected' : ''; ?>>Member thường</option>
                            <option value="freelancer" <?php echo (isset($_POST['type']) && $_POST['type'] == 'freelancer') ? 'selected' : ''; ?>>Cộng tác viên - Vốn Min 500K</option>
                            <option value="agency" <?php echo (isset($_POST['type']) && $_POST['type'] == 'agency') ? 'selected' : ''; ?>>Đại lí - Vốn Min 1 Triệu</option>
                            </select>
                        </div>
                    </div>*/
                    ?>

                </div>
                <!-- /.box-body -->
               <div class="box-footer">
                        <center>
                            <h3><font color="red">*</font> : Bắt buộc nhập đúng!</h3>
                            <div class="g-recaptcha" data-sitekey="6LdBSSoUAAAAAAq4adHH9YScPerV0pWgJS4hWOD8"></div>
                        </center>
                    <a href="index.php?vip=Login" class="btn btn-success pull-left">Đăng Nhập</a>
                    <button type="submit" name="submit" class="btn btn-info pull-right">Đăng kí tài khoản</button>
                </div>
                <!-- /.box-footer -->
            </form>
        </div>
    </div>
</div>
<?php 
}else{
?>    
<div class="row">
    <div class="col-md-12">
        <!-- Horizontal Form -->
        <div class="box box-info wow fadeIn">
            <div class="box-header with-border">
                <h3 class="box-title">ĐÓNG ĐĂNG KÝ</h3>
            </div>
            <div class="panel body">
                <center>
                    <b>
                        <p>Bạn cần đăng ký tài khoản vui lòng liên hệ 0919.257.664</p>
                        <p>Facebook <a href="https://www.facebook.com/100009580369715" target="_blank">Vũ Tiến Anh</a></p>
                    </b>
                </center>
            </div>
            </div>
    </div>
</div>
<?php 
}
?>