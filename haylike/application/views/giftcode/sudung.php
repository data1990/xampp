<div class="row">
    <div class="col-md-12">
        <!-- Horizontal Form -->
        <div class="box box-info wow fadeIn">
            <div class="box-header with-border">
                <h3 class="box-title">GIFT CODE</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" action="" method="post">
                <div class="box-body">
                    <div class="form-group">
                        <label for="giftcode" class="col-sm-2 control-label">Nhập mã Gift Code:</label>

                        <div class="col-sm-10">
                            <input type="text" name="gift_code" class="form-control" />
                        </div>
                    </div>
                    <?php echo validation_errors(); ?>


                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <button type="submit" name="submit" class="btn btn-info pull-right">Thực hiện</button>
                </div>
                <!-- /.box-footer -->
            </form>
        </div>
    </div>
</div>
<?php 
$error = $this->session->flashdata('error');
if($error=='dasudung'){
    echo "<script>swal('Lỗi rồi','Bạn chỉ được sử dụng 1 lần Giftcode !.','error');</script>";
}elseif($error=='useok'){
    echo "<script>swal('Thành công !','Bạn đã sử dụng GiftCode thành công','success');</script>";
    }elseif($error=='khongtontai'){
    echo "<script>swal('Lỗi rồi !','Giftcode đã sử dụng hoặc không tồn tại trong hệ thống !','error');</script>";
    }

?>