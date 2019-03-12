<?php defined('COPYRIGHT') OR exit('hihi'); ?>
<script>
    function checkToken() {
    $(function () {
            $("#name").val("Đang Kiểm tra...");
            $("#user_id").val("Đang kKiểm tra...");
            $.post("core/VIP/Reaction/check.php", {
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
        $.post('core/VIP/price.php', {han: $('#han').val(), goi: $('#goi').val(), rule: $('#rule').val(), coupon: $('#coupon').val()}, function (result) {
            var duy = JSON.parse(result);
            if (duy.status == 'OK') {
                swal(
                        'Thông báo!',
                        duy.msg,
                        'success'
                    );
                //alert(duy.msg);
                $('#coupon').attr('readonly', 'readonly');
                $('#check_coupon').removeAttr('onclick').text('Giảm giá ' + duy.sale_off + '%');
                $('#result').html(duy.price);
            } else if (duy.status == 'Loz') {
                swal(
                        'Thông báo!',
                        duy.error_msg,
                        'error'
                    );
                //alert(duy.error_msg);
                $('#check_coupon').html('Kiểm tra');
            }else if(duy.status == 'cc'){
                swal(
                        'Thông báo!',
                        duy.error_msg,
                        'error'
                    );
                //alert(duy.error_msg);
                $('#check_coupon').html('Kiểm tra');
            }else {
                swal(
                        'Thông báo!',
                        duy.error_msg,
                        'error'
                    );
                //alert(duy.error_msg);
                $('#check_coupon').html('Kiểm tra');
            }
        });
    } else {
        $.post('core/VIP/price.php', {han: $('#han').val(), goi: $('#goi').val(), rule: $('#rule').val()}, function (result) {
            $('#result').html(result);
        });
    }
}
</script>
<?php
   $get_pack = mysqli_query($conn, "SELECT COUNT(*), MIN(price) FROM package WHERE type='REACTION'");
$package = mysqli_fetch_assoc($get_pack);
if ($package['COUNT(*)'] == 0) {
    echo "<script>alert('Chưa có package nào, Thêm ngay?');window.location='index.php?vip=Add_Package_Reaction';</script>";
}
?>
<?php
if (isset($_POST['submit'])) {
    $han = $_POST['han'];
    if ($han <= 0 || $han > 12) { 
        echo "<script>alert('Địt con mẹ mày luôn, bug tiếp hộ bố mày cái ?  Địt thẳng vào mồm thằng Nguyễn Ngọc Hoàng!'); window.location='index.php';</script>";
    }else if ($_POST['goi'] < $package['MIN(price)']) {
        echo "<script>alert('Địt con mẹ mày luôn, bug tiếp hộ bố mày cái ?'); window.location='index.php';</script>";
    } else {
        $loi = array();
        $uid = $_POST['user_id'];
        $get = "SELECT COUNT(user_id) FROM vipreaction WHERE user_id = $uid";
        $result = mysqli_query($conn, $get);
        $x = mysqli_fetch_assoc($result);
        if ($x['COUNT(user_id)'] > 0) {
            $loi['err'] = '<font color="red">User ID này đã tồn tại trên hệ thống</font>';
        }
        if (empty($loi)) {
            $name = $_POST['name'];
            $han = $_POST['han'];
            $goi = $_POST['goi'];
            $cus = $_POST['custom'];
            $cmt = $_POST['cmt'];
            $noidungs = $_POST['noidung'];
            $noidung = isset($noidungs) ? $noidungs : 'NULL';
            $sticker = $_POST['sticker'];
            $start = time();
            $end = $start + $han * 30 * 86400;
            $price = $han * $goi;
            if($rule == 'agency'){
                $price -= $price * 10 / 100;
            }else if($rule == 'freelancer'){
                $price -= $price * 5 / 100;
            }
                if (!empty(trim($_POST['coupon']))) {
                $coupon = $_POST['coupon'];
                $get = mysqli_query($conn, "SELECT sale_off,COUNT(*) FROM coupon WHERE code = '$coupon' GROUP BY sale_off");
                $cop = mysqli_fetch_assoc($get);
                if ($cop['COUNT(*)'] == 1) {
                    $price -= $price * $cop['sale_off'] / 100;
                }
                }
            $type = $_POST['type'];
            $token = $_POST['token'];
            $get_max = "SELECT max FROM package WHERE type='REACTION' AND price='$goi'";
            $r_max = mysqli_query($conn, $get_max);
            $max_reactions = mysqli_fetch_assoc($r_max)['max'];
                $get = "SELECT bill FROM member WHERE id_ctv = $idctv";
            $result = mysqli_query($conn, $get);
            $x = mysqli_fetch_assoc($result);
            if ($x['bill'] - $price >= 0) {
                $sql = "INSERT INTO vipreaction(user_id, name, han, start, end, limit_react, id_ctv, pay, type,access_token,custom,noidung,cmt,sticker) VALUES('$uid','$name','$han','$start','$end','$max_reactions','$idctv','$price','$type','$token','$cus','$noidung','$cmt',$sticker)";
                if (mysqli_query($conn, $sql)) {
                        $up = "UPDATE member SET num_id = num_id + 1, payment = payment + $price WHERE id_ctv=$idctv";
                    if(mysqli_query($conn, $up)){
                            $minus = "UPDATE member SET bill = bill - $price WHERE id_ctv = $idctv";
                        if (mysqli_query($conn, $minus)) {
                            if (!empty(trim($_POST['coupon']))){
                                    $coupon = $_POST['coupon'];
                                    $get = mysqli_query($conn, "SELECT sale_off,COUNT(*) FROM coupon WHERE code = '$coupon' GROUP BY sale_off");
                                    $cop = mysqli_fetch_assoc($get);
                                    $content = "<b>$uname</b> vừa thêm VIP REACTION cho ID <b>$uid</b>. Thời hạn <b>$han</b> tháng, gói <b>$max_reactions</b> Reactions / Cron, Sử dụng mã giảm giá <b>".$coupon."(".$cop['sale_off']." %) tổng thanh toán <b>" . number_format($price) . " VNĐ </b>";
                                }else{
                            $content = "<b>$uname</b> vừa thêm VIP REACTION cho ID <b>$uid</b>. Thời hạn <b>$han</b> tháng, MAX <b>$max_reactions</b> Reactions / Cron, tổng thanh toán <b>" . number_format($price) . " VNĐ </b>";
                            }
                            $time = time();
                            $his = "INSERT INTO history(content,id_ctv,time, type) VALUES('$content','$idctv', '$time',0)";
                            if (mysqli_query($conn, $his)) {
                                if($price >= 20000){
                                    mysqli_query($conn, "UPDATE event SET turn = turn + 1 WHERE user_name='$uname' AND rule = '$rule'");
                                }
                                echo '<script>alert("Thêm thành công"); window.location="index.php?vip=Add_VIP_Reaction";</script>';
                            }
                        }
                    }
                }
            } else {
                echo '<script>alert("Số dư tài khoản của bạn không đủ !!! Vui lòng nạp thêm tiền đi nha!1");location.href="index.php?vip=Add_VIP_Reaction";</script>';
            }
        }
    }
}
?>
<div class="row">
    <div class="col-md-12">
        <!-- Horizontal Form -->
        <div class="box box-info wow fadeIn">
            <div class="box-header with-border">
                <h3 class="box-title">Thêm ID VIP BOT Cảm xúc bài viết của bạn bè</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" action="#" method="post">
            <input type="hidden" id="rule" value="<?php echo $rule; ?>" />
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
                                $ds = "SELECT max, price FROM package WHERE type='REACTION' ORDER BY price ASC";
                                $ds_x = mysqli_query($conn, $ds);
                                while ($ok = mysqli_fetch_assoc($ds_x)) {
                                    echo "<option value='" . $ok['price'] . "'>{$ok['max']} Cảm xúc/Cron - ".number_format($ok['price'])." VNĐ/Tháng</option>";
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
                    <?php if($rule == 'agency'){ ?> <font color="red">Bạn là <b>Đại lí</b> nên được giảm 10% giá gói VIP này</font><?php }else if($rule == 'freelancer'){ ?> <font color="red">Bạn là <b>Cộng tác viên</b> được giảm 5% giá gói VIP này</font>  <?php  } ?>
                    <button type="button" class="btn btn-warning"><a href="index.php?vip=Get_Token" target="_blank" style="color: white; font-weight: bold">Lấy Token</a></button>
                    <button type="submit" name="submit" class="btn btn-info pull-right">Thêm</button>
                </div>
                <!-- /.box-footer -->
            </form>
        </div>
    </div>
</div>