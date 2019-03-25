<div class="row">
    <div class="col-md-12">
        <!-- Horizontal Form -->
        <div class="box box-info wow fadeIn">
            <div class="box-header with-border">
                <h3 class="box-title">Cập nhật ID VIP BOT Cảm Xúc</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" action="" method="post">
                 <?php 
                    if(isset($dulieu))
                    {
                        foreach ($dulieu as $row)                
                        {
                    ?>
                <div class="box-body">
                    <div class="form-group">
                        <label for="token" class="col-sm-2 control-label">Mã Access Token: <span class="glyphicon glyphicon-question-sign" data-toggle="tooltip" title="Mã Access Token của Nick được cài VIP. Chú ý mã token phải Live và là mã của nick được cài VIP nếu không VIP sẽ không thể hoạt động đúng được!"></span></label>

                        <div class="col-sm-10">
                            <input type="text" class="form-control" value="<?php echo isset($row['access_token']) ? $row['access_token'] : ''; ?>" id="token" onpaste="checkToken()" name="token" onkeyup="checkToken()" placeholder="Mã access token của id vip" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="user_id" class="col-sm-2 control-label">User ID: <span class="glyphicon glyphicon-question-sign" data-toggle="tooltip" title="ID Nick Facebook được cài VIP!"></span></label>

                        <div class="col-sm-10">
                            <input type="text" id="user_id" class="form-control" value="<?php echo isset($row['user_id']) ? $row['user_id'] : ''; ?>" name="user_id" readonly>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">Họ tên: <span class="glyphicon glyphicon-question-sign" data-toggle="tooltip" title="Họ và tên người được cài VIP!"></span></label>

                        <div class="col-sm-10">
                            <input type="text" class="form-control" maxlength="50" value="<?php echo isset($row['name']) ? $row['name'] : ''; ?>" id="name" name="name" placeholder="Họ và tên" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="goi" class="col-sm-2 control-label">Loại Cảm Xúc: <span class="glyphicon glyphicon-question-sign" data-toggle="tooltip" title="Chọn 1 loại cảm xúc để VIP hoạt động!"></span></label>

                        <div class="col-sm-10">
                            <select id="name" name="type" class="form-control">
                                
                                <option value="RANDOM" <?php if($row['type'] == 'RANDOM') echo 'selected'; ?>>RANDOM</option>
                                <option value="LOVE" <?php if($row['type'] == 'LOVE') echo 'selected'; ?>>LOVE</option>
                                <option value="HAHA" <?php if($row['type'] == 'HAHA') echo 'selected'; ?>>HAHA</option>
                                <option value="WOW" <?php if($row['type'] == 'WOW') echo 'selected'; ?>>WOW</option>
                                <option value="SAD" <?php if($row['type'] == 'SAD') echo 'selected'; ?>>SAD</option>
                                <option value="ANGRY" <?php if($row['type'] == 'ANGRY') echo 'selected'; ?>>ANGRY</option>
                                <option value="LIKE" <?php if($row['type'] == 'LIKE') echo 'selected'; ?>>LIKE</option>
                            </select>
                        </div>
                    </div>
                     <div class="form-group">
                        <label for="custom" class="col-sm-2 control-label">Tùy chỉnh đối tượng thả cảm xúc: <span class="glyphicon glyphicon-question-sign" data-toggle="tooltip" title="Bot cảm xúc cho những đối tượng nào trên bảng tin?"></span></label>

                        <div class="col-sm-10">
                            <select id="custom" name="custom" class="form-control">
                               <option value="0" <?= isset($row['custom']) && $row['custom'] == 0 ? 'selected' : ''; ?>>Bạn bè & những người bạn đang theo dõi</option>
                                <option value="1" <?= isset($row['custom']) && $row['custom'] == 1 ? 'selected' : ''; ?>>Toàn bộ bảng tin</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="cmt" class="col-sm-2 control-label">Tùy chọn sử dụng vip cmt: <span class="glyphicon glyphicon-question-sign" data-toggle="tooltip" title="tùy chọn bật tắt dịch vụ bot cmt kèm bot cảm xúc?"></span></label>

                        <div class="col-sm-10">
                            <select id="cmt" name="cmt" class="form-control" onclick="changeoncomment()">
                               <option value="0">Không dùng.</option>
                                <option value="1">Dùng Bot CMT.</option>
                            </select>
                        </div>
                    </div>

                    <div class="vipcmt">
                    <div class="form-group">
                        <label for="noidung" class="col-sm-2 control-label">Nội dung CMT: <span class="glyphicon glyphicon-question-sign" data-toggle="tooltip" title="Danh sách các nội dung bình luận, mỗi dòng 1 nội dung khác nhau!"></span></label>

                        <div class="col-sm-10">
                            <textarea class="form-control" rows="5" name="noidung" placeholder="Nội dung CMT, Không dùng thì không cần ghi nội dung nhé!"><?php echo $row['noidung']; ?></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="sticker" class="col-sm-2 control-label">Tùy chọn sticker: <span class="glyphicon glyphicon-question-sign" data-toggle="tooltip" title="Chọn sticker khi chạy comments"></span></label>
                        <div class="col-sm-10">
                            <select id="sticker" name="sticker" class="form-control">
                                <?php
                                $ds = "SELECT * FROM idsticker";
                                $ds_x = mysqli_query($conn, $ds);
                                while ($ok = mysqli_fetch_assoc($ds_x)) {
                                    echo "<option value='" . $ok['idsticker'] . "'>{$ok['name']}</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    </div>

                    <?php if($this->session->userdata['logged_in']['rule'] == 'admin' && $this->session->userdata['logged_in']['userid'] == 1){ ?>
                    <div class="form-group">
                        <label for="limit_react" class="col-sm-2 control-label">Gói Reaction (Package): <span class="glyphicon glyphicon-question-sign" data-toggle="tooltip" title="Giới hạn tối đa số Cảm Xúc của gói VIP sẽ Reaction!"></span></label>
 
                         <div class="col-sm-10">
                            <select id="goi" name="goi" class="form-control" onchange="tinh()">
                                <?php
                                foreach ($pakagecheck->result() as $row1)
                                {
                                        
                                    echo "<option value='" . $row1->price . "'>{$row1->max} Cảm xúc/Cron - ".number_format($row1->price)." VNĐ/Tháng</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <?php } ?>
                
                    <div class="form-group">
                        <label for="token" class="col-sm-2 control-label">Trạng thái Token hiện tại: <span class="glyphicon glyphicon-question-sign" data-toggle="tooltip" title="Trạng thái của mã token, nếu die hoặc token không hợp lệ, vui lòng cập nhật mới!"></span></label>

                        <div class="col-sm-10">
                            <span><?php echo $tokenstt; ?></span>
                        </div>
                    </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <?php if($this->session->userdata['logged_in']['rule'] != 'admin'){ ?>
                <font color="red"><b>Nếu muốn thay đổi ID VIP, Nâng cấp lên gói cao hơn, hoặc yêu cầu xóa, vui lòng liên hệ Admin hoặc trang Fanpage tại trang chủ.!</b></font>
                <hr />
                <?php }}} ?>
                    <button type="button" class="btn btn-warning"><a href="index.php?vip=Get_Token" target="_blank" style="color: white; font-weight: bold">Lấy Token</a></button>
                    <button type="submit" name="submit" class="btn btn-info pull-right">Cập nhật</button>
                </div>
                <!-- /.box-footer -->
            </form>
        </div>
    </div>
</div>
</div>