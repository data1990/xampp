<div class="row">
    <div class="col-md-12">
        <!-- Horizontal Form -->
        <div class="box box-info wow fadeIn">
            <div class="box-header with-border">
                <h3 class="box-title">Cập nhật tiền cho Member & Đại lí & CTV</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" action="#" method="post">
                <div class="box-body">
                    <div class="form-group">
                        <label for="user_id" class="col-sm-2 control-label">UserName:</label>

                        <div class="col-sm-10">
                        <input list="user_name" name="user_name">
                            <datalist id="user_name">
                            <?php
                                if(isset($dulieu)){
                                   foreach ($dulieu as $row)                
                                    {
                                    $user_name = $row['user_name'];
                                    $name1 = $row['name'];
                                    $bill1 = number_format($row['bill']);
                                    $rl = '';
                                    if($row['rule'] == 'agency'){
                                        $rl = 'Đại lí - ';
                                    }elseif($row['rule'] == 'freelancer'){
                                        $rl = 'CTV - ';
                                    }else{    
                                        $rl = 'Member - ';
                                    }
                                    echo "<option value='$user_name'>$rl $name1 ( $user_name ) - $bill1 VNĐ";
                                }}
                                ?>
                                </datalist>
            
                        </div>
                    </div>


                    <div class="form-group">
                        <label for="profile" class="col-sm-2 control-label">Số tiền (VNĐ):</label>

                        <div class="col-sm-10">
                            <input  type="number" class="form-control" min="1" max="100000000" name="money" placeholder="Nhập số tiền" required=""/>
                        </div>
                    </div>
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
    if($error=='susscess'){
        echo "<script>swal('Thành công !','Bạn đã cập nhật tiền thành công!','success');</script>";
    }

?>