<?php if($viplike == 'on'){
?>
<div class="row">
    <div class="col-md-12">
        <!-- Horizontal Form -->
        <div class="box box-info wow fadeIn">
            <div class="box-header with-border">
                <h3 class="box-title">Thêm ID VIP Cảm Xúc </h3><br> <kbd>Bạn đang thực hiện việc thêm ID ở Sever 1</kbd>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" action="addviplikes1" method="post">
                <!--<input type="hidden" id="rule" value="<?php echo $rule; ?>" />-->
                <div class="box-body">
                    <div class="form-group">
                        <label for="user_id" class="col-sm-2 control-label">User ID: <span class="glyphicon glyphicon-question-sign" data-toggle="tooltip" title="ID Nick Facebook được cài VIP!"></span></label>

                        <div class="col-sm-10">
                            <div class="input-group">
                                <input type="number" class="form-control" onchange="checkid()" onkeyup="checkid()" id="user_id" value="<?php echo isset($_POST['user_id']) ? $_POST['user_id'] : ''; ?>" name="user_id" placeholder="User ID" required>
                                <p id="duysex"></p>
                                <?php echo isset($loi['err']) ? $loi['err'] : ''; ?>

                                <span class="input-group-addon"><a href="#get_uid" data-toggle="modal" style="text-decoration:none; color:red;font-weight:bold; cursor:pointer">Lấy ID</a></span>
                            </div>
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
                        <label for="likes" class="col-sm-2 control-label">Số CX / Cron: <span class="glyphicon glyphicon-question-sign" data-toggle="tooltip" title="Số lượng cảm xúc tăng sau mỗi lần VIP được chạy!"></span></label>

                        <div class="col-sm-10">
                            <select name="likes" class="form-control">
                                <option value="1">10 CX/Cron</option>
                                <option value="2">30 CX/Cron</option>
                                <option value="3">50 CX/Cron</option>
                                <option value="4">100 CX/Cron</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="goi" class="col-sm-2 control-label">Gói CX (Package): <span class="glyphicon glyphicon-question-sign" data-toggle="tooltip" title="Giới hạn tối đa số cảm xúc của gói VIP!"></span></label>

                        <div class="col-sm-10">
                            <select id="goi" name="goi" class="form-control" onchange="tinh()">
                                <?php
                                foreach ($pakagecheck->result() as $row)
                                {
                                    $range = $row->max . ' ~  ' . ($row->max += $row->max * 20 / 100);
                                    echo "<option value='" . $row->price . "'>$range CX - " . number_format($row->price) . " VNĐ / Tháng</option>";
                                }
                                
                                ?>
                            </select>


                        </div>
                    </div>
                    <div class="form-group">
                        <label for="type" class="col-sm-2 control-label">Loại: <span class="glyphicon glyphicon-question-sign" data-toggle="tooltip" title="Các loại cảm xúc được chạy khi VIP hoạt động. Chú ý nếu  chọn nhiều loại cảm xúc, mỗi lần chạy VIP sẽ chọn ngẫu nhiên cảm xúc trong danh sách bạn đã chọn, hãy chọn số lượng CX/Cron cho phù hợp với gói VIP!"></span></label>
                        <div class="col-sm-10">
                            <label style="padding-right: 10px">
                                <input type="checkbox" name="type[]" value="LIKE" class="flat-red"> <img src="assets/img/icon/LIKE.gif" style="width:24px" data-toggle="tooltip" title="Thích"/>
                            </label>
                            <label style="padding-right: 10px">
                                <input type="checkbox" name="type[]" value="LOVE" class="flat-red"> <img src="assets/img/icon/LOVE.gif" style="width:24px" data-toggle="tooltip" title="Yêu Thích" />
                            </label>
                            <label style="padding-right: 10px">
                                <input type="checkbox" name="type[]" value="HAHA" class="flat-red"> <img src="assets/img/icon/HAHA.gif" style="width:24px" data-toggle="tooltip" title="Cười lớn" />
                            </label>
                            <label style="padding-right: 10px">
                                <input type="checkbox" name="type[]" value="WOW" class="flat-red"> <img src="assets/img/icon/WOW.gif" style="width:24px" data-toggle="tooltip" title="Ngạc nhiên" />
                            </label>
                            <label style="padding-right: 10px">
                                <input type="checkbox" name="type[]" value="SAD" class="flat-red"> <img src="assets/img/icon/SAD.gif" style="width:24px" data-toggle="tooltip" title="Buồn" />
                            </label>
                            <label style="padding-right: 10px">
                                <input type="checkbox" name="type[]" value="ANGRY" class="flat-red"> <img src="assets/img/icon/ANGRY.gif" style="width:24px" data-toggle="tooltip" title="Phẫn nộ" />
                            </label><br />
                            <?php echo isset($loi['type']) ? $loi['type'] : ''; ?>
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
                    <?php if ($this->session->userdata['logged_in']['rule'] == 'agency') { ?> <font color="red">Bạn là <b>Đại lí</b> nên được giảm 10% giá gói VIP này</font><?php } else if ($this->session->userdata['logged_in']['rule'] == 'freelancer') { ?> <font color="red">Bạn là <b>Cộng tác viên</b> được giảm 5% giá gói VIP này</font>  <?php } ?>
                    <button type="submit" name="submit" class="btn btn-info pull-right">Thêm</button>
                </div>
                <!-- /.box-footer -->
            </form>
        </div>
<!-- Thông báo và hướng dẫn -->
        <p class="alert alert-danger" style="font-size:17px">
            - Cài đặt <kbd>Bài viết công khai</kbd> với chế độ hiển thị với <kbd>Mọi người</kbd> để VIP có thể hoạt động<br>
            - Khi đăng bài, giới hạn bài đăng của mỗi gói vip là <kbd>15 Bài/1 Ngày</kbd> - Nếu đăng quá <kbd>15 Bài/1 Ngày</kbd> thì bài thứ <kbd>16</kbd> sẽ không tăng like!.<br>
        </p>
<!-- Thông báo và hướng dẫn -->
    </div>
</div>

<!-- Modal get uid -->
<div id="get_uid" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" style="text-align:center">Nhập địa chỉ Facebook cần lấy vào ô bên dưới. Ví dụ: <kbd>https://www.facebook.com/zuck</kbd></h4>
            </div>
            <div class="modal-body">
                <div class="input-group input-lg">
                    <input type="text" class="form-control" id="link_profile" placeholder="Ví dụ: https://www.facebook.com/zuck"  />
                    <span class="input-group-addon" id="check_uid" onclick="getID()" style="color:red; font-weight:bold; cursor:pointer">Lấy  ID</span>
                    <select class="form-control" id="type">
                        <option value="person">Trang cá nhân</option>
                        <option value="page">Trang fanpage</option>
                    </select>
                </div>
                <div style="text-align:center">
                    <span id="result_uid" style="font-size:17px"></span>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
            </div>
        </div>

    </div>
</div>
<?php 
}else{
?>    
<div class="row">
    <div class="col-md-12">
        <!-- Horizontal Form -->
        <div class="box box-info wow fadeIn">
            <div class="box-header with-border">
                <h3 class="box-title">ĐÓNG THÊM ID VIP</h3>
            </div>
            <div class="panel body">
                <center>
                    <b>
                        <p>Hiện tại sever 1 đã đủ ID vui lòng thêm id tại sever 2</p>
                        <p>Truy cập sever 2 <a href="" target="_blank">SEVER VIP LIKE 2</a></p>
                    </b>
                </center>
            </div>
            </div>
    </div>
</div>
<?php 
}
?>

<!--<center>-->
                    <?php 
                        $error = $this->session->flashdata('error');
                        if($error=='money'){
                            echo "<script>swal('Số tiền trong tài khoản bạn còn thiếu!','Vui lòng nạp thêm để mua.','error');</script>";
                        }elseif($error=='susscess'){
                        echo "<script>swal('Thêm thành công !','Bạn đã mua gói Like thành công','success');</script>";
                        }elseif($error=='bug'){
                            echo "<script>swal('Bug','Không hợp lệ, chú định bug à, quên mẹ cái mùa xuân ấy đê :)))','error');</script>";
                            
                        }elseif($error=='tontai1'){
                            echo "<script>swal('Xảy ra lỗi !','User ID này đã tồn tại trên hệ thống tại sever 1','error');</script>";
                            
                        }elseif($error=='tontai2'){
                            echo "<script>swal('Xảy ra lỗi !','User ID này đã tồn tại trên hệ thống tại sever 2','error');</script>";
                            
                        } elseif($error=='OK'){
                            echo "<script>swal('Thành công !','Thêm thành công !','success');</script>";
                            
                        } elseif($error=='like'){
                            echo "<script>swal('Chưa chọn cảm xúc !','Bạn hãy chọn ít nhất 1 cảm xúc nhé !','error');</script>";
                            
                        } 

                        ?>
                <!--</center>-->

<script >
    function getID() {
        var profile = $('#link_profile').val().trim();
        var type = $('#type').val().trim();
        if (profile != '' && type != '') {
            $('#check_uid').html('<i class="fa fa-spinner fa-spin"></i> Đang lấy ID...');
            
            $.post('getuidfb', {link: profile, loaitype: type}, function (ds) {
                $('#result_uid').html(ds);
                $('#check_uid').html('Lấy ID');
            });
        } else {
            alert('Vui lòng nhập địa chỉ Facebook cần Get ID');
        }  
    }
    function tinh() {
    if ($('#coupon').val().trim() != '') {
        $('#check_coupon').html("<i class='fa fa-spinner fa-spin'></i> Đang kiểm tra...");
        $.post('getmoney', {han: $('#han').val(), goi: $('#goi').val(), rule: $('#rule').val(), coupon: $('#coupon').val()}, function (result) {
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
        $.post('getmoney', {han: $('#han').val(), goi: $('#goi').val(), rule: $('#rule').val()}, function (result) {
            $('#result').html(result);
        });
    }
}
</script>