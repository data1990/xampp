<div class="row">
    <div class="col-md-12">
        <!-- Horizontal Form -->
        <div class="box box-info wow fadeIn">
            <div class="box-header with-border">
                <h3 class="box-title">Tạo tài khoản cho Cộng tác viên</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" action="#" method="post">
                <div class="box-body">
                    <div class="form-group">
                        <label for="username" class="col-sm-2 control-label">Tài khoản:</label>

                        <div class="col-sm-10">
                            <input type="text" minlength="4" class="form-control" id="user_name" value="<?php echo set_value('user_name') ?>" name="user_name" placeholder="Tài khoản" required>
                            <?php echo form_error('user_name')?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="password" class="col-sm-2 control-label">Mật khẩu:</label>

                        <div class="col-sm-10">
                            <input type="password" minlength="6" class="form-control" id="password" name="password" placeholder="Password" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="password2" class="col-sm-2 control-label">Nhập lại Mật khẩu:</label>
                        <div class="col-sm-10">
                            <input type="password" minlength="6" class="form-control" id="password2" name="password2" placeholder="Nhập lại password" required>
                            <?php echo form_error('password2')?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">Họ tên:</label>

                        <div class="col-sm-10">
                            <input type="text" minlength="2" class="form-control" value="<?php echo set_value('name') ?>" id="name" name="name" placeholder="Họ và tên" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="phone" class="col-sm-2 control-label">Số điện thoại:</label>

                        <div class="col-sm-10">
                            <input type="number" class="form-control" id="sdt" value="<?php echo set_value('sdt') ?>" name="sdt" placeholder="Số điện thoại" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="email" class="col-sm-2 control-label">Email:</label>

                        <div class="col-sm-10">
                            <input type="email" class="form-control" id="email" value="<?php echo set_value('email') ?>" name="email" placeholder="Địa chỉ Email" required>
                            <?php echo form_error('email')?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="profile" class="col-sm-2 control-label">ID Facebook:</label>

                        <div class="col-sm-10">
                            <input type="number" class="form-control" id="profile" value="<?php echo set_value('profile') ?>" name="profile" placeholder="Nhập user id facebook" required>
                            <?php echo form_error('profile')?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="profile" class="col-sm-2 control-label">Số tiền mặc định(trừ vào số dư của bạn):</label>

                        <div class="col-sm-10">
                            <input type="number" class="form-control" id="money" value="<?php echo set_value('money') ?>" min="1" name="money" placeholder="Nhập số dư của tài khoản sau khi tạo thành công" required>
                        </div>
                    </div>
                    <?php if($this->session->userdata['logged_in']['rule'] == 'admin'){ ?>
                    <div class="form-group">
                        <label for="profile" class="col-sm-2 control-label"></label>

                        <div class="col-sm-10">
                            <input type="checkbox" name="freelancer" /> Không vốn
                        </div>
                    </div>
                    <?php } ?>

                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <button type="submit" name="submit" class="btn btn-info pull-right">Tạo tài khoản</button>
                </div>
                <!-- /.box-footer -->
            </form>
        </div>
    </div>
</div>
<?php 
                        $error = $this->session->flashdata('error');
                        if($error=='usename'){
                            echo "<script>swal('Tên đăng nhập đã tồn tại trong hệ thống','Vui lòng chọn tên khác.','error');</script>";
                        }elseif($error=='susscess'){
                        echo "<script>swal('Đăng ký thành công !','Tài khoản chưa được kích hoạt, vui lòng kích hoạt tại mục Quản lý CTV !','success');</script>";
                        }elseif($error=='email'){
                            echo "<script>swal('Địa chỉ Email đã có người sử dụng','Vui lòng chọn Email khác','error');</script>";
                            
                        }elseif($error=='fbid'){
                            echo "<script>swal('ID Facebook đã có người sử dụng','Vui lòng chọn ID FB khác','error');</script>";
                            
                        }elseif($error=='money'){
                            echo "<script>swal('Xảy ra lỗi !','Số tiền không hợp lệ !','error');</script>";
                            
                        } elseif($error=='OK'){
                            echo "<script>swal('Thành công !','Thêm thành công !','success');</script>";
                            
                        } elseif($error=='nomoney'){
                            echo "<script>swal('Tài khoản bạn chưa đủ $!','Vui lòng nạp thêm $ vào tài khoản để tạo đại lý !','error');</script>";
                            
                        } 

                        ?>