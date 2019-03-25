<div class="row">
    <div class="col-md-12">
        <!-- Horizontal Form -->
        <div class="box box-info wow fadeIn">
            <div class="box-header with-border">
                <h3 class="box-title">Cập nhật ID VIP CMT</h3>
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

                    <div class="form-group">
                        <label for="cmt" class="col-sm-2 control-label">Số CMT / Cron: <span class="glyphicon glyphicon-question-sign" data-toggle="tooltip" title="Số lượng CMT tăng sau mỗi lần VIP được chạy!"></span></label>

                        <div class="col-sm-10">
                            <select name="cmt" class="form-control">
                                <?php
                                for ($i = 2; $i <= 10; $i++) {
                                    $check = '';
                                    if ($i == $row['cmts']) {
                                        $check = 'selected';
                                    }
                                    echo "<option value='$i' $check>$i CMT/Cron</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <?php if($this->session->userdata['logged_in']['rule'] == 'admin' && $this->session->userdata['logged_in']['userid'] == 1){ ?>
                    <div class="form-group">
                        <label for="max_cmt" class="col-sm-2 control-label">Gói CMT (Package): <span class="glyphicon glyphicon-question-sign" data-toggle="tooltip" title="Giới hạn tối đa số CMT của gói VIP!"></span></label>

                        <div class="col-sm-10">
                           <select id="max_cmt" name="max_cmt" class="form-control">
                                <?php
                                    
                                foreach ($pakagecheck->result() as $row1)
                                {
                                        $check = '';
                                        if($row['max_cmt'] == $row1->max){
                                            $check = 'selected';
                                        }
                                        echo "<option value='" . $row1->max . "' $check>{$row1->max} CMTs - ".number_format($row1->price)." VNĐ / tháng</option>";
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                    <?php } ?>
                     <div class="form-group">
                        <label for="noi_dung" class="col-sm-2 control-label">Nội dung: <span class="glyphicon glyphicon-question-sign" data-toggle="tooltip" title="Danh sách các nội dung bình luận, mỗi dòng 1 nội dung khác nhau!"></span></label>
                        

                        <div class="col-sm-10">
                            <textarea class="form-control" name="noi_dung" rows="10" required><?php echo isset($row['noi_dung']) ? $row['noi_dung'] : ''; ?></textarea>
                            
                        </div>
                    </div>
                </div>
                <div class="form-group">
                        <label for="gender" class="col-sm-2 control-label">Giới tính CMT: <span class="glyphicon glyphicon-question-sign" data-toggle="tooltip" title="Chọn giới tính để VIP lọc khi CMT!"></span></label>

                        <div class="col-sm-10">
                           <select name="gender" class="form-control">
                                <option value="both" <?php if($row['gender'] == 'both') { echo 'selected'; }?>>Cả Nam và Nữ</option>
                                <option value="male" <?php if($row['gender'] == 'male') { echo 'selected'; }?>>Chỉ Nam</option>
                                <option value="female" <?php if($row['gender'] == 'female') { echo 'selected'; } ?>>Chỉ Nữ</option>
                            </select>
                        </div>
                    </div>
                <div class="form-group">
                        <label for="sticker" class="col-sm-2 control-label">THÊM STICKER: <span class="glyphicon glyphicon-question-sign" data-toggle="tooltip" title="thêm sticker vào vip cmt"></span></label>

                        <div class="col-sm-10">
                           <select name="sticker" class="form-control">
                                <option value="both" <?php if($row['sticker'] == 'on') { echo 'selected'; }?>>Bật</option>
                                <option value="male" <?php if($row['sticker'] == 'off') { echo 'selected'; }?>>Tắt</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="hashtag" class="col-sm-2 control-label">HashTag vô hiệu CMT: <span class="glyphicon glyphicon-question-sign" data-toggle="tooltip" title="Nhập hashtag để vô hiệu hóa VIP ở 1 status nào đó, chú ý không chứa dấu # khi nhập! Chi tiết xem ở dưới!"></span></label>

                        <div class="col-sm-10">
                           <input type="text" name="hashtag" value="<?php echo substr($row['hash_tag'],1,strlen($row['hash_tag'])); ?>" placeholder="Nhập hashtag ( không chứa dấu # )" class="form-control" required="" />
                        </div>
                    </div>
                <?php }} ?>
                <!-- /.box-body -->
                <div class="box-footer">
                    <?php if($this->session->userdata['logged_in']['rule'] != 'admin'){ ?>
                         <font color="red"><b>Nếu muốn thay đổi ID VIP, Nâng cấp lên gói cao hơn, yêu cầu xóa, tăng lượng CMT / Cron,  vui lòng liên hệ Admin hoặc trang Fanpage tại trang chủ.!</b></font>
                    <?php } ?>
                    
                   <span class="h4" style="background:red; color:yellow" id="help">Hashtag vô hiệu hóa CMT là gì?</span>
                    <br /><span class="h4" id="hash" style="display:none">
                        - Được sử dụng khi bạn không muốn VIP CMT hoạt động ở 1 status/ảnh nào đó<br />
                        - Để hashtag hoạt động bạn chỉ cần thêm vào nội dung của status, caption của ảnh hashtag mà bạn đã cài đặt ( chú ý có dấu <code>#</code> ở đằng trước )<br />
                        - Ví dụ: bạn cài đặt VIP và để nội dung hashtag là <code>no</code> ( khi cài thì không cần thêm dấu <code>#</code> nhé). Sau đó bạn đăng status có nội dung <code>Anh DuySexy đẹp chai quá</code> , và nếu bạn không muốn VIP CMT hoạt động ở status này, thì bạn phải để nội dung là <code>Anh DuySexy đẹp chai quá #no</code> ( có dấu <code>#</code> trước hashtag khi đăng nội dung nhé ).<br/>
                        - Nhắc lại: Khi cài VIP thì hashtag không có dấu <code>#</code> , còn khi đăng status thì có thêm dấu <code>#</code> đằng trước ! (Ex: <code>no</code> khi cài và <code>#no</code> khi đăng status<br />
                        <span  style="background:red; color:yellow" id="ok">Đã hiểu?</span>
                        </span>
                    <button type="submit" name="submit" class="btn btn-info pull-right">Cập nhật</button>
                </div>
                <!-- /.box-footer -->
            </form>
            <p class="alert alert-danger" style="font-size:17px">
                - Không sử dụng các kí tự đặc biệt , biểu tượng icon, dấu <code>'</code> và dấu <code>"</code> vào nội dung comment nếu không VIP sẽ lỗi hoặc không hoạt động, chúng tôi không chịu trách nhiệm về vấn đề này!!<br />
                - Hệ thống lọc trùng nội dung nên các bạn chú ý luôn luôn nhập số lượng nội dung nhiều hơn <code>Max CMT</code>
            </p>
        </div>
    </div>
</div>