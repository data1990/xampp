<div class="row">
    <div class="col-md-12">
        <!-- Horizontal Form -->
        <div class="box box-info wow fadeIn">
            <div class="box-header with-border">
                <h3 class="box-title">Đăng kí tài khoản</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" action="dang-ky" method="post">
                <div class="box-body">
                    <div class="form-group">
                        <label for="profile" class="col-sm-2 control-label">ID Facebook: <font color="red">*</font></label>
                        <span class="input-group-addon"><a href="#get_uid" data-toggle="modal" style="text-decoration:none; color:red;font-weight:bold; cursor:pointer">Lấy ID</a></span>
                        <div class="col-sm-10">
                            <input type="number" class="form-control" id="profile" value="<?php echo isset($_POST['profile']) ? $_POST['profile'] : ''; ?>" name="profile" placeholder="Nhập ID Facebook ví dụ: 10000xxxxxxxx" required>
                            
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="username" class="col-sm-2 control-label">Tài khoản:  <font color="red">*</font></label>

                        <div class="col-sm-10">
                            <input type="text" minlength="4" class="form-control" id="user_name" value="<?php echo isset($_POST['user_name']) ? $_POST['user_name'] : ''; ?>" name="user_name" placeholder="Nhập tên tài khoản" required>
                            
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="password" class="col-sm-2 control-label">Mật khẩu: <font color="red">*</font></label>

                        <div class="col-sm-10">
                            <input type="text" minlength="6" class="form-control" id="password" name="password" placeholder="Password" required>
                        </div>
                    </div>
                   
                    <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">Họ tên:</label>

                        <div class="col-sm-10">
                            <input type="text" minlength="2" class="form-control" value="" id="name" name="name" placeholder="Nhập Họ và tên thật" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <!--<label for="phone" class="col-sm-2 control-label">Số điện thoại:</label>-->

                        <div class="col-sm-10" style="display:none">
                            <input type="number" class="form-control" id="sdt"  value="0123456789" name="sdt" placeholder="Số điện thoại" required>
                            
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="email" class="col-sm-2 control-label">Email (Chỉ nhập tên email trước dấu @): <font color="red">*</font></label>

                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="email" value="" name="prefix" placeholder="vd: admin@haylike.info thì chỉ nhập admin" required style="width:70%;display:inline">
                            <select class="form-control" name="email_type" style="width:150px;display:inline">
                            	<option value="gmail.com">@gmail.Com</option>
                            	<option value="yahoo.com">@yahoo.Com</option>
                            	<option value="yahoo.com.vn">@yahoo.Com.VN</option>
                            	<option value="hotmail.com">@hotmail.Com</option>
                            	
                            </select><br /><code>Ví dụ: haylike@gmail.com thì chỉ nhập haylike. Nhập chính xác Email để lấy lại Mật khẩu khi quên!</code>
                            
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
                            <div class="g-recaptcha" data-sitekey="<?php echo $this->config->item('google_key') ?>"></div> 
                        </center>
                    <a href="index.php?vip=Login" class="btn btn-success pull-left">Đăng Nhập</a>
                    <button type="submit" name="submit" class="btn btn-info pull-right">Đăng kí tài khoản</button>
                </div>
                <!-- /.box-footer -->
            </form>
        </div>
    </div>
</div>
<!-- Modal get uid -->
<div id="get_uid" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" style="text-align:center">Nhập địa chỉ Facebook cần lấy vào ô bên dưới. Ví dụ: <kbd>https://www.facebook.com/zuck</kbd></h4>
            </div>
            <div class="modal-body">
                <div class="input-group input-lg">
                    <input type="text" class="form-control" id="link_profile" placeholder="Ví dụ: https://www.facebook.com/zuck"  />
                    <span class="input-group-addon" id="check_uid" onclick="getID()" style="color:red; font-weight:bold; cursor:pointer">Lấy  ID</span>
                    <select class="form-control" id="type">
                        <option value="person">Trang cá nhân</option>
                        <option value="page">Trang fanpage</option>
                    </select>
                </div>
                <div style="text-align:center">
                    <span id="result_uid" style="font-size:17px"></span>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
            </div>
        </div>

    </div>
</div>
<script>
function getID() {
        var profile = $('#link_profile').val().trim();
        var type = $('#type').val().trim();
        if (profile != '' && type != '') {
            $('#check_uid').html('<i class="fa fa-spinner fa-spin"></i> Đang lấy ID...');
            
            $.post('getuidfb', {link: profile, loaitype: type}, function (ds) {
                $('#result_uid').html(ds);
                $('#check_uid').html('Lấy ID');
            });
        } else {
            alert('Vui lòng nhập địa chỉ Facebook cần Get ID');
        }  
    }
</script>
<!--<center>-->
<?php 
    $error = $this->session->flashdata('error');
    if($error=='username'){
        echo "<script>swal('Lỗi rồi !','Tên đăng nhập đã tồn tại vui lòng chọn tên khác !','error');</script>";
    }elseif($error=='OK'){
    echo "<script>swal('Đăng ký thành công !','Bạn đã đăng ký thành công, vui lòng liên hệ Admin để kích hoạt tài khoản !','success');</script>";
    }elseif($error=='facebook'){
        echo "<script>swal('Lỗi ','ID Facebook đã tồn tại trong hệ thống !','error');</script>";
        
    }elseif($error=='email'){
        echo "<script>swal('Xảy ra lỗi !','Email đã tồn tại trong hệ thống !','error');</script>";
        
    }elseif($error=='tontai2'){
        echo "<script>swal('Xảy ra lỗi !','User ID này đã tồn tại trên hệ thống tại sever 2','error');</script>";
        
    } elseif($error=='OK'){
        echo "<script>swal('Thành công !','Thêm thành công !','success');</script>";
        
    } elseif($error=='like'){
        echo "<script>swal('Chưa chọn cảm xúc !','Bạn hãy chọn ít nhất 1 cảm xúc nhé !','error');</script>";
        
    } 

    ?>
<!--</center>-->