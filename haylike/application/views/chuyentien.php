<div class="row">
    <div class="col-md-12">
        <!-- Horizontal Form -->
        <div class="box box-info wow fadeIn">
            <div class="box-header with-border">
                <h3 class="box-title">Chuyển tiền cho Member - CTV - Đại Lí</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" action="#" method="post">
                <div class="box-body">
                    <div class="form-group">
                        <label for="user_id" class="col-sm-2 control-label">UserName:</label>

                        <div class="col-sm-10">                                
                             <select name="user_name" class="form-control">
                                    <?php
                                    if(isset($dulieu)){
                                   foreach ($dulieu as $row)                
                                    {
                                        $user_name = $row['user_name'];
                                        $name2 = $row['name'];
                                        $bill2 = number_format($row['bill']);
                                        echo "<option value='$user_name'>Cộng tác viên - $name2 ( $user_name ) - $bill2 VNĐ";
                                    }
                                ?>

                            </select>
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
                    <button type="submit" name="ctv" class="btn btn-info pull-right">Thực hiện</button>
                </div>
                <!-- /.box-footer -->
            </form>
        </div>
    </div>
</div>
