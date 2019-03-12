<script src="plugins/colorpicker/bootstrap-colorpicker.min.js"></script>
<script src="plugins/iCheck/icheck.min.js"></script>
<link rel="stylesheet" href="plugins/iCheck/all.css">
<link rel="stylesheet" href="plugins/colorpicker/bootstrap-colorpicker.min.css">
<?php
$get_pack = mysqli_query($conn, "SELECT COUNT(*), MIN(price) FROM package WHERE type='LIKE'");
$package = mysqli_fetch_assoc($get_pack);
if ($package['COUNT(*)'] == 0) {
    echo "<script>alert('Chưa có package nào, Thêm ngay?');window.location='index.php?vip=Add_Package_Like';</script>";
}
?>
<?php
if (isset($_POST['submit'])) {
    $han = $_POST['han'];
    $list_type = $_POST['type'];
    $type = implode("\n", $list_type);
    $name = $_POST['name'];
    $likes = $_POST['likes'];
    $goi = $_POST['goi'];
    $start = time();
    $limitpost = '15';
    if ($han <= 0 || $han > 12) { 
        echo "<script>alert('Địt con mẹ mày luôn, bug tiếp hộ bố mày cái ?  Địt thẳng vào mồm thằng Nguyễn Ngọc Hoàng!'); window.location='index.php';</script>";
    }else if ($_POST['goi'] < $package['MIN(price)']) {
        echo "<script>alert('Địt con mẹ mày luôn, bug tiếp hộ bố mày cái ?'); window.location='index.php';</script>";
    } else {
        $loi = array();
        $uid = trim($_POST['user_id']);
        $get = "SELECT COUNT(user_id) FROM vipsv2 WHERE user_id = $uid";
        $result = mysqli_query($conn, $get);
        $x = mysqli_fetch_assoc($result);

        $get2 = "SELECT COUNT(user_id) FROM vip WHERE user_id = $uid";
        $result2 = mysqli_query($conn, $get2);
        $x2 = mysqli_fetch_assoc($result2);

        if ($x['COUNT(user_id)'] > 0) {
            $loi['err'] = '<font color="red">User ID này đã tồn tại trên hệ thống tại sever 2</font>';
        }else if ($x2['COUNT(user_id)'] > 0) {
            $loi['err'] = '<font color="red">User ID này đã tồn tại trên hệ thống tại sever 1</font>';
        }
        // $checkne = mysqli_query($conn,"SELECT COUNT(*) FROM free WHERE uid = '$uid' AND type='LIKE'");
        // $numm = mysqli_fetch_assoc($checkne)['COUNT(*)'];
        // if($_POST['han'] == 'one' && $numm == 1){
        // 	$loi['exists'] = '<font color="red">ID này đã được Test!</font>';
        // }
        if (!isset($_POST['type'])) {
            $loi['type'] = '<font color=red>Vui lòng chọn ít nhất 1 loại cảm xúc!</font>';
        }
        if (empty($loi)) {
            // if ($han == 'one') {
            //     $price = 0;
            //     $end = $start + 86400 - 28800;
            //     $max_like = 100;
            //     $han = 'one';
            //     mysqli_query($conn, "INSERT INTO free(uid, type, id_ctv) VALUES('$uid','LIKE',$idctv)");
            // } else if ($han == 'three') {
            //     $price = 0;
            //     $end = $start + 86400 * 3 - 28800;
            //     $max_like = 100;
            //     $han = 'three';
            // }else 
            // if ($han == 'seven') {
            //     $price = ($goi / 30) * 10;
            //     $end = $start + 86400 * 7 - 28800;
            //     $han = 'seven';
            //     $get_max = "SELECT max FROM package WHERE type='LIKE' AND price='$goi'";
            //     $r_max = mysqli_query($conn, $get_max);
            //     $max_like = mysqli_fetch_assoc($r_max)['max'];
            // } else {
                $end = $start + $han * 30 * 86400 - 28800;
                $price = $han * $goi;

                if ($rule == 'agency') {
                    $price -= $price * 10 / 100;
                } else if ($rule == 'freelancer') {
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
                
                $get_max = "SELECT max FROM package WHERE type='LIKE' AND price='$goi'";
                $r_max = mysqli_query($conn, $get_max);
                $max_like = mysqli_fetch_assoc($r_max)['max'];
            // }
            if ($likes <= $max_like) {
                    $get = "SELECT bill FROM member WHERE id_ctv = $idctv";
                $result = mysqli_query($conn, $get);
                $x = mysqli_fetch_assoc($result);
                if ($x['bill'] - $price >= 0) {
                    $sql = "INSERT INTO vip(user_id, name, han, start, end, likes, max_like, id_ctv, pay,type, limitpost) VALUES('$uid','$name','$han','$start','$end','$likes','$max_like','$idctv','$price','$type', '$limitpost')";
                    if (mysqli_query($conn, $sql)) {
                            $up = "UPDATE member SET num_id = num_id + 1, payment = payment + $price WHERE id_ctv=$idctv";
                        if (mysqli_query($conn, $up)) {
                                $minus = "UPDATE member SET bill = bill - $price WHERE id_ctv = $idctv";
                            if (mysqli_query($conn, $minus)) {
                                if ($han == 'oneeee') {
                                    $content = "<b>$uname</b> vừa thêm VIP Cảm Xúc cho ID <b>$uid</b> tại sever 1. Thời hạn <b>1 ngày </b> tháng, gói <b>$max_like</b> CX, Loại CX: $type, tổng thanh toán <b>" . number_format($price) . " VNĐ </b>";
                                } else if ($han == 'threeeeee') {
                                    $content = "<b>$uname</b> vừa thêm VIP Cảm Xúc cho ID <b>$uid</b> tại sever 1. Thời hạn <b>3 ngày </b> tháng, gói <b>$max_like</b> CX, Loại CX: $type, tổng thanh toán <b>" . number_format($price) . " VNĐ </b>";
                                } else if ($han == 'sevennnnn') {
                                    $content = "<b>$uname</b> vừa thêm VIP Cảm Xúc cho ID <b>$uid</b> tại sever 1. Thời hạn <b>7 ngày </b> tháng, gói <b>$max_like</b> CX, Loại CX: $type, tổng thanh toán <b>" . number_format($price) . " VNĐ </b>";
                                } else if (!empty(trim($_POST['coupon']))){
                                    $coupon = $_POST['coupon'];
                                    $get = mysqli_query($conn, "SELECT sale_off,COUNT(*) FROM coupon WHERE code = '$coupon' GROUP BY sale_off");
                                    $cop = mysqli_fetch_assoc($get);
                                    $content = "<b>$uname</b> vừa thêm VIP Cảm Xúc cho ID <b>$uid</b> tại sever 1. Thời hạn <b>$han</b> tháng, gói <b>$max_like</b> CX, Loại CX: $type, Sử dụng mã giảm giá <b>".$coupon."(".$cop['sale_off']." %) tổng thanh toán <b>" . number_format($price) . " VNĐ </b>";
                                }else{
                                    $content = "<b>$uname</b> vừa thêm VIP Cảm Xúc cho ID <b>$uid</b> tại sever 1. Thời hạn <b>$han</b> tháng, gói <b>$max_like</b> CX, Loại CX: $type, tổng thanh toán <b>" . number_format($price) . " VNĐ </b>";
                                }
                                $time = time();
                                $his = "INSERT INTO history(content,id_ctv,time, type) VALUES('$content','$idctv', '$time',0)";
                                if (mysqli_query($conn, $his)) {
                                    /*Get thông tin và gửi về tn facebook*/
                            $getinfo = mysqli_query($conn, "SELECT idbot FROM member WHERE id_ctv = $idctv");
                            $infouser = mysqli_fetch_assoc($getinfo);
                            $id = $infouser['idbot'];
                            sendnoti($id,'Bạn vừa thêm VIP Cảm Xúc cho ID '.$uid.' tại sever 1. Thời hạn '.$han.' tháng, gói '.$max_like.' CX, tổng thanh toán '.number_format($price).' VNĐ');
                            /*End Get Thông Tin và gửi về tn facebook*/
                                    echo '<script>alert("Thêm thành công"); window.location="index.php?vip=Add_VIP_Like_SV1";</script>';
                                }
                            }
                        }
                    }
                } else {
                    echo '<script>alert("Số dư tài khoản của bạn không đủ !!! Vui lòng nạp thêm tiền đi nha!1");location.href="index.php?vip=Add_VIP_Like_SV1";</script>';
                }
            } else {
                echo "<script>alert('Vui lòng chọn số CX/Cron nhỏ hơn hoặc bằng gói CX');window.location='index.php?vip=Add_VIP_Like_SV1';</script>";
            }
        }
    }
}
if($getsetting['viplike'] == 'on'){
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
            <form class="form-horizontal" action="#" method="post">
                <input type="hidden" id="rule" value="<?php echo $rule; ?>" />
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
                                <option value="10">10 CX/Cron</option>
                                <option value="30">30 CX/Cron</option>
                                <option value="50">50 CX/Cron</option>
                                <option value="100">100 CX/Cron</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="goi" class="col-sm-2 control-label">Gói CX (Package): <span class="glyphicon glyphicon-question-sign" data-toggle="tooltip" title="Giới hạn tối đa số cảm xúc của gói VIP!"></span></label>

                        <div class="col-sm-10">
                            <select id="goi" name="goi" class="form-control" onchange="tinh()">
                                <?php
                                $ds = "SELECT max, price FROM package WHERE type='LIKE' ORDER BY price ASC";
                                $ds_x = mysqli_query($conn, $ds);

                                while ($ok = mysqli_fetch_assoc($ds_x)) {
                                    $range = $ok['max'] . ' ~  ' . ($ok['max'] += $ok['max'] * 20 / 100);
                                    echo "<option value='" . $ok['price'] . "'>$range CX - " . number_format($ok['price']) . " VNĐ / Tháng</option>";
                                }
                                ?>
                            </select>


                        </div>
                    </div>
                    <div class="form-group">
                        <label for="type" class="col-sm-2 control-label">Loại: <span class="glyphicon glyphicon-question-sign" data-toggle="tooltip" title="Các loại cảm xúc được chạy khi VIP hoạt động. Chú ý nếu  chọn nhiều loại cảm xúc, mỗi lần chạy VIP sẽ chọn ngẫu nhiên cảm xúc trong danh sách bạn đã chọn, hãy chọn số lượng CX/Cron cho phù hợp với gói VIP!"></span></label>
                        <div class="col-sm-10">
                            <label style="padding-right: 10px">
                                <input type="checkbox" name="type[]" value="LIKE" class="flat-red"> <img src="core/VIP/VIPCAMXUC/LIKESV1/icon/LIKE.gif" style="width:24px" data-toggle="tooltip" title="Thích"/>
                            </label>
                            <label style="padding-right: 10px">
                                <input type="checkbox" name="type[]" value="LOVE" class="flat-red"> <img src="core/VIP/VIPCAMXUC/LIKESV1/icon/LOVE.gif" style="width:24px" data-toggle="tooltip" title="Yêu Thích" />
                            </label>
                            <label style="padding-right: 10px">
                                <input type="checkbox" name="type[]" value="HAHA" class="flat-red"> <img src="core/VIP/VIPCAMXUC/LIKESV1/icon/HAHA.gif" style="width:24px" data-toggle="tooltip" title="Cười lớn" />
                            </label>
                            <label style="padding-right: 10px">
                                <input type="checkbox" name="type[]" value="WOW" class="flat-red"> <img src="core/VIP/VIPCAMXUC/LIKESV1/icon/WOW.gif" style="width:24px" data-toggle="tooltip" title="Ngạc nhiên" />
                            </label>
                            <label style="padding-right: 10px">
                                <input type="checkbox" name="type[]" value="SAD" class="flat-red"> <img src="core/VIP/VIPCAMXUC/LIKESV1/icon/SAD.gif" style="width:24px" data-toggle="tooltip" title="Buồn" />
                            </label>
                            <label style="padding-right: 10px">
                                <input type="checkbox" name="type[]" value="ANGRY" class="flat-red"> <img src="core/VIP/VIPCAMXUC/LIKESV1/icon/ANGRY.gif" style="width:24px" data-toggle="tooltip" title="Phẫn nộ" />
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
                    <?php if ($rule == 'agency') { ?> <font color="red">Bạn là <b>Đại lí</b> nên được giảm 10% giá gói VIP này</font><?php } else if ($rule == 'freelancer') { ?> <font color="red">Bạn là <b>Cộng tác viên</b> được giảm 5% giá gói VIP này</font>  <?php } ?>
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
<script>
        $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
        checkboxClass: 'icheckbox_minimal-blue',
        radioClass: 'iradio_minimal-blue'
    });

    $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
        checkboxClass: 'icheckbox_minimal-red',
        radioClass: 'iradio_minimal-red'
    });
    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
        checkboxClass: 'icheckbox_flat-green',
        radioClass: 'iradio_flat-green'
    });
    $(".my-colorpicker1").colorpicker();
    $(".my-colorpicker2").colorpicker();
    $(".timepicker").timepicker({
        showInputs: false
    });
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

    // function tinh() {
    //     $(function () {
    //         $.post('core/VIP/price.php', {han: $('#han').val(), goi: $('#goi').val(), rule: $('#rule').val()}, function (result) {
    //             $('#result').html(result);
    //         });
    //     });
    // }
    function checkid() {
        $(function () {
            $('#name').val('Đang kiểm tra....');
            $.post('core/VIP/checkid.php', {user_id: $('#user_id').val()}, function (r) {
                $('#name').val(r);
            });
        });
    }
    // function lay id tu link fb
    function getID() {
        var profile = $('#link_profile').val().trim();
        var type = $('#type').val().trim();
        if (profile != '' && type != '') {
            $('#check_uid').html('<i class="fa fa-spinner fa-spin"></i> Đang lấy ID...');
            $.post('core/VIP/checkid.php', {link: profile, type: type}, function (ds) {
                $('#result_uid').html(ds);
                $('#check_uid').html('Lấy ID');
            });
        } else {
            alert('Vui lòng nhập địa chỉ Facebook cần Get ID');
        }
    }
</script>
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
                        <p>Truy cập sever 2 <a href="/index.php?vip=Add_VIP_Like_SV2" target="_blank">SEVER VIP LIKE 2</a></p>
                    </b>
                </center>
            </div>
            </div>
    </div>
</div>
<?php 
}
?>