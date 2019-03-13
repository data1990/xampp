<?php
if($vipcmt == 'on'){
?>
<div class="row">
    <div class="col-md-12">
        <!-- Horizontal Form -->
        <div class="box box-info wow fadeIn">
            <div class="box-header with-border">
                <h3 class="box-title">Thêm ID VIP CMT</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" action="addcmtsv" method="post">
                <div class="box-body">
                    <div class="form-group">
                    <input type="hidden" id="rule" value="<?php echo $this->session->userdata['logged_in']['rule']; ?>" />
                        <label for="user_id" class="col-sm-2 control-label">User ID: <span class="glyphicon glyphicon-question-sign" data-toggle="tooltip" title="ID Nick Facebook được cài VIP!"></span></label>

                          <div class="col-sm-10">
                            <div class="input-group">
                                <input type="number" class="form-control" onchange="checkid()" onkeyup="checkid()" id="user_id" value="<?php echo isset($_POST['user_id']) ? $_POST['user_id'] : ''; ?>" name="user_id" placeholder="User ID" required>
                            <p id="duysex"></p>
                            <?php echo isset($loi['err']) ? $loi['err'] : ''; ?>
                            <?php echo isset($loi['exists']) ? $loi['exists'] : ''; ?>
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
                        <label for="han" class="col-sm-2 control-label">Thời Hạn: <span class="glyphicon glyphicon-question-sign" data-toggle="tooltip" title="Thời hạn mua VIP"></span></label>

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
                        <label for="noidung" class="col-sm-2 control-label">Nội dung CMT: <span class="glyphicon glyphicon-question-sign" data-toggle="tooltip" title="Danh sách các nội dung bình luận, mỗi dòng 1 nội dung khác nhau!"></span></label>

                        <div class="col-sm-10">
                            <textarea class="form-control" rows="10" name="noi_dung" placeholder="Nội dung CMT, nội dung khác nhau cách nhau bởi dấu xuống dòng (Enter)" required><?php echo isset($_POST['noi_dung']) ? $_POST['noi_dung'] : ''; ?></textarea>
                        </div>
                    </div>
                     <div class="form-group">
                        <label for="cmt" class="col-sm-2 control-label">Số CMT / Cron: <span class="glyphicon glyphicon-question-sign" data-toggle="tooltip" title="Số lượng CMT tăng sau mỗi lần VIP được chạy!"></span></label>

                        <div class="col-sm-10">
                            <select id="cmt" name="cmt" class="form-control" required="">
                                <?php
                                for ($i = 2; $i <= 10; $i++) {
                                    echo "<option value='$i'>$i CMT/Cron</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="goi" class="col-sm-2 control-label">Gói CMT (Package): <span class="glyphicon glyphicon-question-sign" data-toggle="tooltip" title="Giới hạn tối đa số CMT của gói VIP!"></span></label>

                        <div class="col-sm-10">
                           <select id="goi" name="goi" class="form-control" onchange="tinh()">
                                <?php
                                
                                foreach ($cmtpakagecheck->result() as $row){
                                    echo "<option value='" . $row->price . "'>{$row->max} CMTs - ".number_format($row->price)." VNĐ / tháng</option>";
                                
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="gender" class="col-sm-2 control-label">Giới tính CMT: <span class="glyphicon glyphicon-question-sign" data-toggle="tooltip" title="Chọn giới tính để VIP lọc khi CMT!"></span></label>

                        <div class="col-sm-10">
                           <select name="gender" class="form-control">
                                <option value="both">Cả Nam và Nữ</option>
                                <option value="male">Chỉ Nam</option>
                                <option value="female">Chỉ Nữ</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="hashtag" class="col-sm-2 control-label">HashTag vô hiệu CMT: <span class="glyphicon glyphicon-question-sign" data-toggle="tooltip" title="Nhập hashtag để vô hiệu hóa VIP ở 1 status nào đó, chú ý không chứa dấu # khi nhập! Chi tiết xem ở dưới!"></span></label>

                        <div class="col-sm-10">
                           <input type="text" name="hashtag" value="" placeholder="Nhập hashtag ( không chứa dấu # )" class="form-control" required="" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="sticker" class="col-sm-2 control-label">Comments Kèm Sticker: <span class="glyphicon glyphicon-question-sign" data-toggle="tooltip" title="Lựa chọn kèm sticker hoặc không!"></span></label>

                        <div class="col-sm-10">
                           <select name="sticker" class="form-control">
                                <option value="on">Bật Kèm Sticker</option>
                                <option value="off">Không Dùng Sticker</option>
                            </select>
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
                    </div>                    <div class="form-group">
                        <label for="goi" class="col-sm-2 control-label">Thành tiền: <span class="glyphicon glyphicon-question-sign" data-toggle="tooltip" title="Tổng số tiền cần thanh toán!"></span></label>

                        <div class="col-sm-10">
                            <span style="background:red; color:yellow" class="h4" id="result"><script>tinh();</script>.</span>
                        </div>
                    </div>
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                <?php if($this->session->userdata['logged_in']['rule']== 'agency'){ ?> <font color="red">Bạn là <b>Đại lí</b> nên được giảm 10% giá gói VIP này</font><?php }else if($this->session->userdata['logged_in']['rule']== 'freelancer'){ ?> <font color="red">Bạn là <b>Cộng tác viên</b> được giảm 5% giá gói VIP này</font>  <?php  } ?><br />
                <hr />
                <span class="h4" style="background:red; color:yellow" id="help">Hashtag vô hiệu hóa CMT là gì?</span>
                    <br /><span class="h4" id="hash" style="display:none">
                        - Được sử dụng khi bạn không muốn VIP CMT hoạt động ở 1 status/ảnh nào đó<br />
                        - Để hashtag hoạt động bạn chỉ cần thêm vào nội dung của status, caption của ảnh hashtag mà bạn đã cài đặt ( chú ý có dấu <code>#</code> ở đằng trước )<br />
                        - Ví dụ: bạn cài đặt VIP và để nội dung hashtag là <code>no</code> ( khi cài thì không cần thêm dấu <code>#</code> nhé). Sau đó bạn đăng status có nội dung <code>VTA đẹp chai quá</code> , và nếu bạn không muốn VIP CMT hoạt động ở status này, thì bạn phải để nội dung là <code>VTA đẹp chai quá #no</code> ( có dấu <code>#</code> trước hashtag khi đăng nội dung nhé ).<br/>
                       - Nhắc lại: Khi cài VIP thì hashtag không có dấu <code>#</code> , còn khi đăng status thì có thêm dấu <code>#</code> đằng trước ! (Ex: <code>no</code> khi cài và <code>#no</code> khi đăng status<br />
                        <span  style="background:red; color:yellow" id="ok">Đã hiểu?</span>
                        </span>
                    <button type="submit" name="submit" class="btn btn-info pull-right">Thêm</button>
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
<script>
    $('#help').click(function(){
        $('#hash').slideToggle();
    });
    $('#ok').click(function(){
        $('#hash').slideUp();
    });
</script>
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
        $.post('giamgia', {han: $('#han').val(), goi: $('#goi').val(), rule: $('#rule').val()}, function (result) {
            $('#result').html(result);
        });
    }
}
</script>
<!--<center>-->
                    <?php 
                        $error = $this->session->flashdata('error');
                        if($error=='money'){
                            echo "<script>swal('Số tiền trong tài khoản bạn còn thiếu!','Vui lòng nạp thêm để mua.','error');</script>";
                        }elseif($error=='susscess'){
                        echo "<script>swal('Thêm thành công !','Bạn đã mua gói CMT thành công','success');</script>";
                        }elseif($error=='bug'){
                            echo "<script>swal('Bug','Không hợp lệ, chú định bug à, quên mẹ cái mùa xuân ấy đê :)))','error');</script>";
                            
                        }elseif($error=='tontai1'){
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
                        <p>Hiện tại sever vip cmt tạm dừng thêm id vui lòng quay lại sau nhé!</p>
                        <p>Trở về trang chủ <a href="/index.php">Bái baiii</a></p>
                    </b>
                </center>
            </div>
            </div>
    </div>
</div>
<?php } ?>