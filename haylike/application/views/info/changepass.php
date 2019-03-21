<div class="row">
    <div class="col-md-12">
        <!-- Horizontal Form -->
        <div class="box box-info wow fadeIn">
            <div class="box-header with-border">
                <h3 class="box-title">Đổi mật khẩu</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" action="<?php echo base_url('changepassok'); ?>" method="post">
                <div class="box-body">
                    <div class="form-group">
                        <label for="oldpass" class="col-sm-2 control-label">Mật khẩu cũ:</label>

                        <div class="col-sm-10">
                            <input type="text" minlength="6" class="form-control" value="<?php echo isset($_POST['old_pass']) ? $_POST['old_pass'] : ''; ?>"id="old_pass" name="old_pass" placeholder="Mật khẩu cũ" required>
                            <?php echo isset($loi['old_pass']) ? $loi['old_pass'] : ''; ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="new_pass1" class="col-sm-2 control-label">Mật khẩu mới:</label>

                        <div class="col-sm-10">
                            <input type="password" minlength="6" class="form-control" id="new_pass1" name="new_pass1" placeholder="Mật khẩu mới" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="new_pass2" class="col-sm-2 control-label">Nhập lại Mật khẩu mới:</label>
                        <div class="col-sm-10">
                            <input type="password" minlength="6" class="form-control" id="new_pass2" name="new_pass2" placeholder="Nhập lại mật khẩu mới" required>
                            
                        </div>
                    </div>
                    
                <div class="box-footer">
                    <button type="submit" name="submit" class="btn btn-info pull-right">Đổi mật khẩu</button>
                </div>
                <!-- /.box-footer -->
            </form>
        </div>
    </div>
</div>
</div>
<?php 
    $error = $this->session->flashdata('error');
    if($error=='loipassmoi'){
        echo "<script>swal('Lỗi rồi','Mật khẩu mới và nhập lại mật khẩu mới không giống nhau.','error');</script>";
    }elseif($error=='susscess'){
        echo "<script>swal('Cập nhật thành công !','Bạn đã cập nhật mật khẩu thành công !','success');</script>";
    }elseif($error=='passcu'){
        echo "<script>swal('Lỗi rồi','Mật khẩu cũ không đúng !','error');</script>";
    }
?>  