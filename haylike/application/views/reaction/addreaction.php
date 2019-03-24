<div class="row">
    <div class="col-md-12">
        <!-- Horizontal Form -->
        <div class="box box-info wow fadeIn">
            <div class="box-header with-border">
                <h3 class="box-title">Thêm ID VIP BOT Cảm xúc bài viết của bạn bè</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" action="adreactiondb" method="post">
            
                <div class="box-body">
                    <div class="form-group">
                        <label for="token" class="col-sm-2 control-label">Mã Access Token: <span class="glyphicon glyphicon-question-sign" data-toggle="tooltip" title="Mã Access Token của Nick được cài VIP. Chú ý mã token phải Live và là mã của nick được cài VIP nếu không VIP sẽ không thể hoạt động đúng được!"></span></label>

                        <div class="col-sm-10">
                            <input type="text" class="form-control" onpaste="checkToken()" value="<?php echo isset($_POST['token']) ? $_POST['token'] : ''; ?>"  onkeyup="checkToken()" id="token" name="token" placeholder="Mã access token của id vip" required>
                            
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="user_id" class="col-sm-2 control-label">User ID: <span class="glyphicon glyphicon-question-sign" data-toggle="tooltip" title="ID Nick Facebook được cài VIP!"></span></label>

                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="user_id" value="<?php echo isset($_POST['user_id']) ? $_POST['user_id'] : ''; ?>" name="user_id" placeholder="User ID" required readonly>
                            <?php echo isset($loi['err']) ? $loi['err'] : ''; ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">Họ tên: <span class="glyphicon glyphicon-question-sign" data-toggle="tooltip" title="Họ và tên người được cài VIP!"></span></label>

                        <div class="col-sm-10">
                            <input type="text" class="form-control" maxlength="50" value="<?php echo isset($_POST['name']) ? $_POST['name'] : ''; ?>" id="name" name="name" placeholder="Họ và tên" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="phone" class="col-sm-2 control-label">Thời Hạn: <span class="glyphicon glyphicon-question-sign" data-toggle="tooltip" title="Thời hạn mua VIP"></span></label>

                        <div class="col-sm-10">
                            <select id="han" name="han" class="form-control" required="" onchange="tinh()">
                                <?php
                                for ($i = 1; $i <= 5; $i++) {
                                    echo "<option value='$i'>$i Tháng</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="goi" class="col-sm-2 control-label">Loại Cảm Xúc: <span class="glyphicon glyphicon-question-sign" data-toggle="tooltip" title="Chọn 1 loại cảm xúc để VIP hoạt động!"></span></label>

                        <div class="col-sm-10">
                            <select id="name" name="type" class="form-control">
                               <option value="RANDOM">RANDOM - Ngẫu nhiên</option>
                                <option value="LOVE">LOVE - Thả tim</option>
                                <option value="HAHA">HAHA - Cười hihi</option>
                                <option value="WOW">WOW - Ngạc nhiên</option>
                                <option value="SAD">SAD - Buồn</option>
                                <option value="ANGRY">ANGRY - Phẫn nộ</option>
                                <option value="LIKE">LIKE - Thích</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="custom" class="col-sm-2 control-label">Tùy chỉnh đối tượng thả cảm xúc: <span class="glyphicon glyphicon-question-sign" data-toggle="tooltip" title="Bot cảm xúc cho những đối tượng nào trên bảng tin?"></span></label>

                        <div class="col-sm-10">
                            <select id="custom" name="custom" class="form-control">
                               <option value="0">Bạn bè & những người bạn đang theo dõi</option>
                                <option value="1">Toàn bộ bảng tin</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="goi" class="col-sm-2 control-label">Gói Bot  Cảm xúc (Package): <span class="glyphicon glyphicon-question-sign" data-toggle="tooltip" title="Giới hạn tối đa số Cảm Xúc của gói VIP sẽ Reaction!"></span></label>

                        <div class="col-sm-10">
                            <select id="goi" name="goi" class="form-control" onchange="tinh()">
                                <?php

                                foreach ($dulieu->result() as $row)
                                {
                                    echo "<option value='" . $row->price . "'>{$row->max} Cảm xúc/Cron - ".number_format($row->price)." VNĐ/Tháng</option>";
                                }
                                ?>
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
                            <textarea class="form-control" rows="5" name="noidung" placeholder="Nội dung CMT, Không dùng thì không cần ghi nội dung nhé!"><?php echo isset($_POST['noidung']) ? $_POST['noidung'] : ''; ?></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="sticker" class="col-sm-2 control-label">Tùy chọn sticker: <span class="glyphicon glyphicon-question-sign" data-toggle="tooltip" title="Chọn sticker khi chạy comments"></span></label>
                        <div class="col-sm-10">
                            <select id="sticker" name="sticker" class="form-control">
                                <?php
                                foreach ($sticker->result() as $row)
                                {
                                    echo "<option value='" . $row->idsticker . "'>{$row->name}</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    </div>
                    <div class="form-group">
                        <label for="goi" class="col-sm-2 control-label">Mã giảm giá: <span class="glyphicon glyphicon-question-sign" data-toggle="tooltip" title="Nhập mã giảm giá (nếu có)"></span></label>

                        <div class="col-sm-10">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Nhập mã giảm giá (coupon) nếu có" name="coupon" id="coupon">
                                <span class="input-group-addon" id="check_coupon" onclick="tinh()" style="cursor:pointer">Kiểm tra</span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="goi" class="col-sm-2 control-label">Thành tiền: <span class="glyphicon glyphicon-question-sign" data-toggle="tooltip" title="Tổng số tiền cần thanh toán!"></span></label>

                        <div class="col-sm-10">
                            <span style="background:red; color:yellow" class="h4" id="result"><script>tinh();</script></span>
                        </div>
                    </div>
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <?php if($this->session->userdata['logged_in']['rule'] == 'agency'){ ?> <font color="red">Bạn là <b>Đại lí</b> nên được giảm 10% giá gói VIP này</font><?php }else if($this->session->userdata['logged_in']['rule'] == 'freelancer'){ ?> <font color="red">Bạn là <b>Cộng tác viên</b> được giảm 5% giá gói VIP này</font>  <?php  } ?>
                    <button type="button" class="btn btn-warning"><a href="index.php?vip=Get_Token" target="_blank" style="color: white; font-weight: bold">Lấy Token</a></button>
                    <button type="submit" name="submit" class="btn btn-info pull-right">Thêm</button>
                </div>
                <!-- /.box-footer -->
            </form>
        </div>
    </div>
</div>
<!--<center>-->
<?php 
    $error = $this->session->flashdata('error');
    if($error=='money'){
        echo "<script>swal('Số tiền trong tài khoản bạn còn thiếu!','Vui lòng nạp thêm để mua.','error');</script>";
    }elseif($error=='susscess'){
    echo "<script>swal('Thêm thành công !','Bạn đã mua gói Reaction thành công','success');</script>";
    }elseif($error=='bug'){
        echo "<script>swal('Bug','Không hợp lệ, chú định bug à, quên mẹ cái mùa xuân ấy đê :)))','error');</script>";
        
    }elseif($error=='tontai'){
        echo "<script>swal('Xảy ra lỗi !','User ID này đã tồn tại trên hệ thống','error');</script>";
        
    }elseif($error=='tontai2'){
        echo "<script>swal('Xảy ra lỗi !','User ID này đã tồn tại trên hệ thống tại sever 2','error');</script>";
        
    } elseif($error=='OK'){
        echo "<script>swal('Thành công !','Thêm thành công !','success');</script>";
        
    } elseif($error=='like'){
        echo "<script>swal('Chưa chọn cảm xúc !','Bạn hãy chọn ít nhất 1 cảm xúc nhé !','error');</script>";
        
    } 

    ?>
<!--</center>-->
<script>
    function checkToken() {
    $(function () {
            $("#name").val("Đang Kiểm tra...");
            $("#user_id").val("Đang kKiểm tra...");
            $.post("checktoken", {
                token: $("#token").val()
            }, function (lanName) {
                var pseudoNames = lanName.split("_");
                $("#user_id").val(pseudoNames[0]);
                $("#name").val(pseudoNames[1]);
            });
        });
    };

    function tinh() {
    if ($('#coupon').val().trim() != '') {
        $('#check_coupon').html("<i class='fa fa-spinner fa-spin'></i> Đang kiểm tra...");
        $.post('getmoneyre', {han: $('#han').val(), goi: $('#goi').val(), rule: $('#rule').val(), coupon: $('#coupon').val()}, function (result) {
            var data = JSON.parse(result);
            if (data.status == 'OK') {
                swal(
                        'Thông báo!',
                        data.msg,
                        'success'
                    );
                //alert(data.msg);
                $('#coupon').attr('readonly', 'readonly');
                $('#check_coupon').removeAttr('onclick').text('Giảm giá ' + data.sale_off + '%');
                $('#result').html(data.price);
            } else if (data.status == 'Loz') {
                swal(
                        'Thông báo!',
                        data.error_msg,
                        'error'
                    );
                //alert(data.error_msg);
                $('#check_coupon').html('Kiểm tra');
            }else if(data.status == 'cc'){
                swal(
                        'Thông báo!',
                        data.error_msg,
                        'error'
                    );
                //alert(data.error_msg);
                $('#check_coupon').html('Kiểm tra');
            }else {
                swal(
                        'Thông báo!',
                        data.error_msg,
                        'error'
                    );
                //alert(data.error_msg);
                $('#check_coupon').html('Kiểm tra');
            }
        });
    } else {
        $.post('getmoneyre', {han: $('#han').val(), goi: $('#goi').val(), rule: $('#rule').val()}, function (result) {
            $('#result').html(result);
        });
    }
}
</script>