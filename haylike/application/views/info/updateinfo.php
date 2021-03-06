<div class="row">
    <div class="col-md-12">
        <!-- Horizontal Form -->
        <div class="box box-info wow fadeIn">
            <div class="box-header with-border">
                <h3 class="box-title">Cập nhật thông tin</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
           <?php 
                    if(isset($info))
                    {
                        foreach ($info as $row)                
                        {
                ?>
            <form class="form-horizontal" action="<?php echo base_url('update-info'); ?>" method="post">
                 
                <div class="box-body">
                    
                    <div class="form-group">
                        <label for="username" class="col-sm-2 control-label">Tài khoản:</label>

                        <div class="col-sm-10">
                            <input type="text" minlength="4" class="form-control" value="<?php echo isset($row['user_name']) ? $row['user_name'] : ''; ?>" disabled>
                            
                        </div>
                    </div>
                     <div class="form-group">
                        <label for="email" class="col-sm-2 control-label">Email:</label>

                        <div class="col-sm-10">
                            <input type="email" class="form-control" value="<?php echo isset($row['email']) ? $row['email'] : ''; ?>" disabled>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">Họ tên:</label>

                        <div class="col-sm-10">
                            <input type="text" minlength="2" class="form-control" value="<?php echo isset($row['name']) ? $row['name'] : ''; ?>" id="name" name="name" placeholder="Họ và tên" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="profile" class="col-sm-2 control-label">ID Facebook:</label>

                        <div class="col-sm-10">
                            <input type="number" class="form-control" id="" value="<?php echo isset($row['profile']) ? $row['profile'] : ''; ?>" name="profile" placeholder="ID Facebook" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="phone" class="col-sm-2 control-label">Số điện thoại:</label>

                        <div class="col-sm-10">
                            <input type="number" class="form-control" id="sdt" value="<?php echo isset($row['phone']) ? $row['phone'] : ''; ?>" name="sdt" placeholder="Số điện thoại" required>
                        </div>
                    </div>
                </div>
                
                <div class="box-footer">
                    <?php if($this->session->userdata['logged_in']['rule'] != 'admin'){ ?><font color="red"><b>Để đổi Username và Email, Liên hệ <a href="//fb.com/" target="_blank"><b>Admin</b></a></b></font> <?php } ?>
                    <button type="submit" name="submit" class="btn btn-info pull-right">Cập nhật thông tin</button>

                </div>
                
            </form>
        <?php } } ?>
        </div>
    </div>
    </div>
<?php 
    $error = $this->session->flashdata('error');
    if($error=='usename'){
        echo "<script>swal('Tên đăng nhập đã tồn tại trong hệ thống','Vui lòng chọn tên khác.','error');</script>";
    }elseif($error=='susscess'){
    echo "<script>swal('Cập nhật thành công !','Bạn đã cập nhật thông tin thành công !','success');</script>";
    }
?>  