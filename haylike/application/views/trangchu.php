       
<div class="row">
<div class="col-md-12">
    <!-- Horizontal Form -->
    <div class="box box-info wow fadeIn">
        <div class="box-header with-border">
            <h3 class="box-title">ĐĂNG NHẬP HỆ THỐNG</h3>
        </div>
        <form class="form-horizontal" method="post" action="dangnhap">
            <div class="box-body">
                <div class="input-group">
                    <span class="input-group-addon">Tài khoản</span>
                    <input type="text" class="form-control" id="user_name" name="user_name" value="" placeholder="Tài khoản hoặc địa chỉ Email" data-toggle="tooltip" title="Tài khoản hoặc địa chỉ email" required autofocus>
                </div>
                <br />
                
                <div class="input-group">
                    <span class="input-group-addon">Mật khẩu</span>
                    <input type="password" class="form-control" name="password" id="password" placeholder="Password" data-toggle="tooltip" title="Nhập mật khẩu" required>
                </div>
                
                <br />
                <div class="input-group">
                    <div class="g-recaptcha" data-sitekey="<?php echo $this->config->item('google_key') ?>"></div> 
                    
                </div>
                
                
                
                <!--<center>-->
                    <?php 
                        $error = $this->session->flashdata('error');
                        if($error=='Login'){
                            echo "<script>swal('Đăng Nhập Không Thành Công!','Sai tên đăng nhập hoặc mật khẩu.','error');</script>";
                        }elseif($error=='CapchaError'){
                        echo "<script>swal('Captcha không đúng!','Nhập captcha đê','error');</script>";
                    } ?>
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
</div>        </div>

<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark" style="height: 100%;background-image: linear-gradient(rgb(53, 92, 125), rgb(108, 91, 123), rgb(192, 108, 132));">
<div class="row" style="margin: 10px 10px">
<img src="https://graph.facebook.com/4/picture/picture?type=large" class="profile-user-img-vta img-responsive img-circle" alt="User Image">
</div>
<div class="row" style="margin: 10px 10px">
 <a class="btn btn-primary form-control" href="#">      </a>
</div>
<div class="row" style="margin: 10px 10px">
 <a class="btn btn-primary form-control" href="#"> VNĐ
  </a>
</div>
<div class="row" style="margin: 10px 10px">
    <a class="btn btn-primary form-control" href="/index.php?vip=Change_Info">Đổi thông tin</a>
</div>
<div class="row" style="margin: 10px 10px">
    <a class="btn btn-primary form-control" href="/index.php?vip=Change_Pass">Đổi mật khẩu</a>
</div>
<div class="row" style="margin: 10px 10px">
    <a class="btn btn-danger form-control" onclick="logouts()">Thoát</a>
</div>
</aside>
<div class="control-sidebar-bg"></div>
<!--Start of Tawk.to Script-->
<script type="text/javascript">
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/5adc81c75f7cdf4f05336b0f/default';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
</script>
<!--End of Tawk.to Script-->
