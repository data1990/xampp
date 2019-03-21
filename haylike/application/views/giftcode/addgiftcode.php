<div class="row">
    <div class="col-md-12">
        <!-- Horizontal Form -->
        <div class="box box-info wow fadeIn">
            <div class="box-header with-border">
                <h3 class="box-title">Thêm GIFT CODE</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" action="" method="post">
                <div class="box-body">
                    <div class="form-group">
                        <label for="code" class="col-sm-2 control-label">Code:</label>

                        <div class="col-sm-10">
                            <input type="text" minlength="6" class="form-control" id="code" name="code" value="<?php echo $code; ?>"placeholder="Nhập gift code" required>
                            
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="billing" class="col-sm-2 control-label">Billing (VNĐ):</label>

                        <div class="col-sm-10">
                            <input type="number" max="<?php if($idctv == 1) echo 100000000; else echo 100000; ?>" class="form-control" value="<?php echo set_value('billing') ?>" id="billing" name="billing" placeholder="Nhập số tiền cho gift code" required>
                        </div>
                    </div>

                    <!-- /.box-body -->
                    <div class="box-footer">
                        <font color="red" style="font-weight: bold;text-transform: uppercase;">Sau khi thêm GIFT CODE, số dư của bạn sẽ tự động bị trừ = giá trị của GIFT CODE</font>
                        <button type="submit" name="submit" class="btn btn-info pull-right">Thêm Gift Code</button>
                    </div>
                    <!-- /.box-footer -->
            </form>
        </div>
    </div>
</div>
</div>
<?php 
    $error = $this->session->flashdata('error');
    if($error=='code'){
        echo "<script>swal('Lỗi rồi !','Mã code này đã có trong hệ thống !','error');</script>";
    }elseif($error=='susscess'){
        echo "<script>swal('Thêm thành công !','Thêm thành công Code !','success');</script>";
    }elseif($error=='money'){
        echo "<script>swal('Lỗi rồi !','Tài khoản bạn không đủ tiền để tạo code !','error');</script>";
    }

?>  