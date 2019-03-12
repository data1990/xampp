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

                        <div class="col-sm-10">
                            <input type="number" class="form-control" id="profile" value="<?php echo isset($_POST['profile']) ? $_POST['profile'] : ''; ?>" name="profile" placeholder="Nhập ID Facebook ví dụ: 10000xxxxxxxx" required>
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
                            	
                            </select><br /><code>Ví dụ: haylike@gmail.com thì chỉ nhập haylike. Nhập chính xác Email để lấy lại Mật khẩu khi quên!</code>
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