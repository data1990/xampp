<div class="row">
    <div class="col-md-12">
        <!-- Horizontal Form -->
        <div class="box box-info wow fadeIn">
            <div class="box-header with-border">
                <h3 class="box-title">Cập nhật ID VIP Cảm Xúc</h3><br><kbd>Bạn đang thực hiện việc chỉnh sửa ID ở Sever 1</kbd>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" action="" method="post">
                <div class="box-body">
                    <?php 
                    if(isset($dulieu))
                    {
                        foreach ($dulieu as $row)                
                        {
                    ?>
                    <div class="form-group">
                        <label for="user_id" class="col-sm-2 control-label">User ID: <span class="glyphicon glyphicon-question-sign" data-toggle="tooltip" title="ID Nick Facebook được cài VIP!"></span></label>

                        <div class="col-sm-10">
                            
                            
                            <input type="number" class="form-control" value="<?php echo isset($row['user_id']) ? $row['user_id'] : ''; ?>" name="user_id">
                       
                       
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">Họ tên: <span class="glyphicon glyphicon-question-sign" data-toggle="tooltip" title="Họ và tên người được cài VIP!"></span></label>

                        <div class="col-sm-10">
                            <input type="text" class="form-control" maxlength="50" value="<?php echo isset($row['name']) ? $row['name'] : ''; ?>" id="name" name="name" placeholder="Họ và tên" required>
                        </div>
                    </div>
                    <?php if($idctv == 1){ ?>
                    <div class="form-group">
                        <label for="goi" class="col-sm-2 control-label">Gói CX (Package): <span class="glyphicon glyphicon-question-sign" data-toggle="tooltip" title="Giới hạn tối đa số cảm xúc của gói VIP!"></span></label>

                        <div class="col-sm-10">
                            <select id="goi" name="max_like" class="form-control">
                                <?php
                                foreach ($pakagecheck->result() as $row1)
                                {
                                    $check = '';
                                    if($row['max_like'] == $row1->max) $check = 'selected';
                                    echo "<option value='" . $row1->max . "' $check>{$row1->max} Likes - ".number_format($row1->price)." VNĐ / tháng</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <?php } ?>

                    <div class="form-group">
                        <label for="likes" class="col-sm-2 control-label">Số CX / Cron: <span class="glyphicon glyphicon-question-sign" data-toggle="tooltip" title="Số lượng cảm xúc tăng sau mỗi lần VIP được chạy!"></span></label>

                        <div class="col-sm-10">
                            <select name="likes" class="form-control">
                                 <option value="1" <?php if($row['likes'] == 10){echo 'selected';}; ?>>10 CX/Cron</option>
                                <option value="2" <?php if($row['likes'] == 30 ) {echo 'selected';}; ?>>30 CX/Cron</option>
                                <option value="3" <?php if($row['likes'] == 50 ) {echo 'selected';}; ?>>50 CX/Cron</option>
                                <option value="4" <?php if($row['likes'] == 100 ) {echo 'selected';}; ?>>100 CX/Cron</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                            <label for="type" class="col-sm-2 control-label">Loại: <span class="glyphicon glyphicon-question-sign" data-toggle="tooltip" title="Các loại cảm xúc được chạy khi VIP hoạt động. Chú ý nếu  chọn nhiều loại cảm xúc, mỗi lần chạy VIP sẽ chọn ngẫu nhiên cảm xúc trong danh sách bạn đã chọn, hãy chọn số lượng CX/Cron cho phù hợp với gói VIP!"></span></label>
                        <div class="col-sm-10">
                        <label style="padding-right: 10px">
                          <input type="checkbox" name="type[]" value="LIKE" class="flat-red"> <img src="<?php echo base_url('assets/img/icon/LIKE.gif'); ?>" style="width:24px" data-toggle="tooltip" title="Thích"/>
                        </label>
                        <label style="padding-right: 10px">
                          <input type="checkbox" name="type[]" value="LOVE" class="flat-red"> <img src="<?php echo base_url('assets/img/icon/LOVE.gif'); ?>" style="width:24px" data-toggle="tooltip" title="Yêu Thích" />
                        </label>
                        <label style="padding-right: 10px">
                          <input type="checkbox" name="type[]" value="HAHA" class="flat-red"> <img src="<?php echo base_url('assets/img/icon/HAHA.gif'); ?>" style="width:24px" data-toggle="tooltip" title="Cười lớn" />
                        </label>
                        <label style="padding-right: 10px">
                          <input type="checkbox" name="type[]" value="WOW" class="flat-red"> <img src="<?php echo base_url('assets/img/icon/WOW.gif'); ?>" style="width:24px" data-toggle="tooltip" title="Ngạc nhiên" />
                        </label>
                        <label style="padding-right: 10px">
                          <input type="checkbox" name="type[]" value="SAD" class="flat-red"> <img src="<?php echo base_url('assets/img/icon/SAD.gif'); ?>" style="width:24px" data-toggle="tooltip" title="Buồn" />
                        </label>
                        <label style="padding-right: 10px">
                          <input type="checkbox" name="type[]" value="ANGRY" class="flat-red"> <img src="<?php echo base_url('assets/img/icon/ANGRY.gif'); ?>" style="width:24px" data-toggle="tooltip" title="Phẫn nộ" />
                        </label><br />
                        <?php echo validation_errors(); ?>
                        <?php }} ?>
            </div>
              </div>

                    </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <?php if($this->session->userdata['logged_in']['rule'] != 'admin'){ ?>
                         <font color="red"><b>Khi bạn thay đổi Gói CX từ thấp lên cao hơn hệ thống sẽ trừ số tiền còn thiếu đối với gói cảm xúc cao hơn ! Riêng đổi từ gói CX cao xuống thấp hệ thống sẽ không hoàn tiền lại !</b></font>
                    <?php } ?>
                    <button type="submit" name="submit" class="btn btn-info pull-right">Cập nhật</button>
                </div>
                <!-- /.box-footer -->
            </form>
        </div>
    </div>
</div>
<?php 
    $error = $this->session->flashdata('error');
    if($error=='errorupdate'){
        echo "<script>swal('Lỗi rồi','Bạn không được thay đổi gói Cảm xúc.','error');</script>";
    }

    ?>