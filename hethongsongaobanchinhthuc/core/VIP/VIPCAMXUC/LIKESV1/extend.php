<?php
    if(isset($_GET['id_like'])){
        $id_like = $_GET['id_like'];
        $layinfo = mysqli_query($conn,"SELECT user_id,name,end,id_ctv FROM vip WHERE id=$id_like");
        $info = mysqli_fetch_assoc($layinfo);
        $uid = $info['user_id'];
        if($rule != 'admin'){
            if($idctv != $info['id_ctv']){
                echo "<script>alert('Bạn không có quyền gia hạn VIP ID này!');window.location='index.php?vip=Manager_VIP_Like_SV1';</script>";
            }else if($info['end'] > time()){
                echo "<script>alert('VIP ID này chưa hết hạn');window.location='index.php?vip=Manager_VIP_Like_SV1';</script>";
            }
        }else{
            if($info['end'] > time()){
                echo "<script>alert('VIP ID này chưa hết hạn');window.location='index.php?vip=Manager_VIP_Like_SV1';</script>";
            }
        }
    }
?>
<script src="plugins/colorpicker/bootstrap-colorpicker.min.js"></script>
<script src="plugins/iCheck/icheck.min.js"></script>
<link rel="stylesheet" href="plugins/iCheck/all.css">
<link rel="stylesheet" href="plugins/colorpicker/bootstrap-colorpicker.min.css">
    <script>
    function tinh() {
        $(function () {
        
	        $.post('core/VIP/price.php', {han: $('#han').val(), goi: $('#goi').val(), rule: $('#rule').val()}, function (result) {
	                $('#result').html(result);
	            });
        });
    }
    function checkid() {
        $(function () {
            $.post('core/VIP/checkid.php', {user_id: $('#user_id').val()}, function (r) {
                $('#duysex').html(r);
            });
        });
    }
</script>
<?php
$get = "SELECT COUNT(*) FROM package WHERE type='LIKE'";
$result = mysqli_query($conn, $get);
$x = mysqli_fetch_assoc($result);
if ($x['COUNT(*)'] == 0) {
    echo "<script>alert('Chưa có package nào?');window.location='index.php?vip=Add_Package_Like';</script>";
}
?>
<?php
if (isset($_POST['submit'])) {
    if ((($_POST['han'] != 'one' && $_POST['han'] != 'three') && $_POST['han'] !='seven') && (($_POST['han'] <= 0 || $_POST['han'] > 12) || $_POST['goi'] < 15000)) {
            echo "<script>alert('Địt con mẹ mày luôn, bug tiếp hộ bố mày cái ?'); window.location='index.php?vip=Manager_VIP_Like_SV1';</script>";
    } else {
        $loi = array();
        if(!isset($_POST['type'])){
        	$loi['type'] = '<font color=red>Vui lòng chọn ít nhất 1 loại cảm xúc!</font>';
        }
        if (empty($loi)) {
            $list_type = $_POST['type'];
            $type = implode("\n", $list_type);
            $name = $_POST['name'];
            $han = $_POST['han'];
            $likes = $_POST['likes'];
            $goi = $_POST['goi'];
            $start = time();
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
            if ($han == 'seven') {
                $price = ($goi/30)*15;
                $end = $start + 86400 * 7 - 28800;
                $han = 'seven';
                $get_max = "SELECT max FROM package WHERE type='LIKE' AND price='$goi'";
                $r_max = mysqli_query($conn, $get_max);
                $max_like = mysqli_fetch_assoc($r_max)['max'];
            } else {
                $end = $start + $han * 30 * 86400 - 28800;
                $price = $han * $goi;
                if ($rule == 'agency') {
                    $price -= $price * 10 / 100;
                } else if ($rule == 'freelancer') {
                    $price -= $price * 5 / 100;
                }
                $get_max = "SELECT max FROM package WHERE type='LIKE' AND price='$goi'";
                $r_max = mysqli_query($conn, $get_max);
                $max_like = mysqli_fetch_assoc($r_max)['max'];
            }
            if($likes <= $max_like){
                    $get = "SELECT bill FROM member WHERE id_ctv = $idctv";
                $result = mysqli_query($conn, $get);
                $x = mysqli_fetch_assoc($result);
                if ($x['bill'] - $price >= 0) {
                    //$sql = "INSERT INTO vip(user_id, name, han, start, end, likes, max_like, id_ctv, pay,type) VALUES('$uid','$name','$han','$start','$end','$likes','$max_like','$idctv','$price','$type')";
                    $sql = "UPDATE vip SET han='$han', start='$start', end='$end', likes='$likes', max_like='$max_like', pay='$price',type='$type' WHERE id=$id_like";
                    if (mysqli_query($conn, $sql)) {
                            $up = "UPDATE member SET payment = payment + $price WHERE id_ctv=$idctv";
 
                        if (mysqli_query($conn, $up)) {
                                $minus = "UPDATE member SET bill = bill - $price WHERE id_ctv = $idctv";

                            if (mysqli_query($conn, $minus)) {
                                if($han == 'one'){
                                    $content = "<b>$uname</b> vừa gia hạn VIP Cảm Xúc cho ID <b>$uid</b>. Thời hạn <b>1 ngày </b> tháng, gói <b>$max_like</b> CX, Loại CX: $type, tổng thanh toán <b>" . number_format($price) . " VNĐ </b>";
                                }else if($han == 'three'){
                                    $content = "<b>$uname</b> vừa gia hạn VIP Cảm Xúc cho ID <b>$uid</b>. Thời hạn <b>3 ngày </b> tháng, gói <b>$max_like</b> CX, Loại CX: $type, tổng thanh toán <b>" . number_format($price) . " VNĐ </b>";
                                }else if($han == 'seven'){
                                    $content = "<b>$uname</b> vừa gia hạn VIP Cảm Xúc cho ID <b>$uid</b>. Thời hạn <b>7 ngày </b> tháng, gói <b>$max_like</b> CX, Loại CX: $type, tổng thanh toán <b>" . number_format($price) . " VNĐ </b>";
                                }else{
                                    $content = "<b>$uname</b> vừa gia hạn VIP Cảm Xúc cho ID <b>$uid</b>. Thời hạn <b>$han</b> tháng, gói <b>$max_like</b> CX, Loại CX: $type, tổng thanh toán <b>" . number_format($price) . " VNĐ </b>";
                                }
                                $time = time();
                                $his = "INSERT INTO history(content,id_ctv,time, type) VALUES('$content','$idctv', '$time',0)";
                                if (mysqli_query($conn, $his)) {
                                    echo '<script>alert("Gia hạn thành công"); window.location="index.php?vip=Manager_VIP_Like_SV1";</script>';
                                }
                            }
                        }
                    }
                } else {
                    echo '<script>alert("Số dư tài khoản của bạn không đủ !!! Vui lòng nạp thêm tiền đi nha!1");location.href="them-index.php?vip=Manager_VIP_Like_SV1";</script>';
                }
            }else{
                echo "<script>alert('Vui lòng chọn số CX/Cron nhỏ hơn hoặc bằng gói CX');window.location='them-index.php?vip=Manager_VIP_Like_SV1';</script>";
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
                <h3 class="box-title">Gia hạn ID VIP Cảm Xúc</h3>
            </div>
            <form class="form-horizontal" action="#" method="post">
                <input type="hidden" id="rule" value="<?php echo $rule; ?>" />
                <div class="box-body">
                    <div class="form-group">
                        <label for="user_id" class="col-sm-2 control-label">User ID: <span class="glyphicon glyphicon-question-sign" data-toggle="tooltip" title="ID Nick Facebook được cài VIP!"></span></label>

                        <div class="col-sm-10">
                            <input type="number" class="form-control" id="user_id" value="<?php echo isset($info['user_id']) ? $info['user_id'] : ''; ?>" name="user_id" placeholder="User ID" required disabled>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">Họ tên: <span class="glyphicon glyphicon-question-sign" data-toggle="tooltip" title="Họ và tên người được cài VIP!"></span></label>

                        <div class="col-sm-10">
                            <input type="text" class="form-control" maxlength="50" value="<?php echo isset($info['name']) ? $info['name'] : ''; ?>" id="name" name="name" placeholder="Họ và tên" required disabled>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="phone" class="col-sm-2 control-label">Thời Hạn: <span class="glyphicon glyphicon-question-sign" data-toggle="tooltip" title="Thời hạn mua VIP"></span></label>

                        <div class="col-sm-10">
                            <select id="han" name="han" class="form-control" required="" onchange="tinh()">
                                <!--<option value="seven">7 ngày</option>-->
                                <?php
                                for ($i = 1; $i <= 12; $i++) {
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
                               <option value="30">30 CX/Cron</option>
                                <option value="50">50 CX/Cron</option>
                                <option value="100">100 CX/Cron</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="goi" class="col-sm-2 control-label">Gói CX (Package): <span class="glyphicon glyphicon-question-sign" data-toggle="tooltip" title="Giới hạn tối đa số cảm xúc của gói VIP!"></span></label>

                        <div class="col-sm-10">
                            <select id="goi" name="goi" class="form-control" onchange="tinh()" <?php if($rule == 'admin' || $rule == 'agency') echo 'disabled'; ?>>
                                <?php
                                $ds = "SELECT max, price FROM package WHERE type='LIKE' AND max <=1700 ORDER BY price ASC";
                                $ds_x = mysqli_query($conn, $ds);
                                
                                while ($ok = mysqli_fetch_assoc($ds_x)) {
                                	
                                    echo "<option value='" . $ok['price'] . "' >{$ok['max']} CX - ".number_format($ok['price'])." VNĐ / Tháng</option>";
                                }
                                ?>
                            </select>


                        </div>
                    </div>
                        <div class="form-group">
                            <label for="type" class="col-sm-2 control-label">Loại: <span class="glyphicon glyphicon-question-sign" data-toggle="tooltip" title="Các loại cảm xúc được chạy khi VIP hoạt động. Chú ý nếu  chọn nhiều loại cảm xúc, mỗi lần chạy VIP sẽ chọn ngẫu nhiên cảm xúc trong danh sách bạn đã chọn, hãy chọn số lượng CX/Cron cho phù hợp với gói VIP!"></span></label>
                        <div class="col-sm-10">
                        <label style="padding-right: 10px">
                          <input type="checkbox" name="type[]" value="LIKE" class="flat-red"> <img src="core/VIP/LIKE/icon/like.png" style="width:24px" data-toggle="tooltip" title="Thích"/>
                        </label>
                        <label style="padding-right: 10px">
                          <input type="checkbox" name="type[]" value="LOVE" class="flat-red"> <img src="core/VIP/LIKE/icon/love.png" style="width:24px" data-toggle="tooltip" title="Yêu Thích" />
                        </label>
                        <label style="padding-right: 10px">
                          <input type="checkbox" name="type[]" value="HAHA" class="flat-red"> <img src="core/VIP/LIKE/icon/haha.png" style="width:24px" data-toggle="tooltip" title="Cười lớn" />
                        </label>
                        <label style="padding-right: 10px">
                          <input type="checkbox" name="type[]" value="WOW" class="flat-red"> <img src="core/VIP/LIKE/icon/wow.png" style="width:24px" data-toggle="tooltip" title="Ngạc nhiên" />
                        </label>
                        <label style="padding-right: 10px">
                          <input type="checkbox" name="type[]" value="SAD" class="flat-red"> <img src="core/VIP/LIKE/icon/sad.png" style="width:24px" data-toggle="tooltip" title="Buồn" />
                        </label>
                        <label style="padding-right: 10px">
                          <input type="checkbox" name="type[]" value="ANGRY" class="flat-red"> <img src="core/VIP/LIKE/icon/angry.png" style="width:24px" data-toggle="tooltip" title="Phẫn nộ" />
                        </label><br />
                        <?php echo isset($loi['type']) ? $loi['type'] : ''; ?>
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
                    <button type="submit" name="submit" class="btn btn-info pull-right">Gia hạn</button>
                </div>
                <!-- /.box-footer -->
            </form>
        </div>
    </div>
</div>
<p class="alert alert-danger"><span class="h4">Chú ý phân biệt giữa VIP Cảm Xúc và VIP <b>BOT</b> Cảm Xúc<br /><br />VIP Cảm Xúc tức là VIP sẽ tự động tăng số lượng cảm xúc của status, ảnh mà VIP ID được thêm trên hệ thống đăng trên trang cá nhân.<br /><br />VIP BOT Cảm Xúc tức là VIP ID được cài trên hệ thống sẽ tự động bày tỏ cảm xúc bài viết của bạn bè, của nhóm, fanpage ngẫu nhiên trên bảng tin ( cảm xúc tùy chọn trên hệ thống khi cài đặt VIP ).<br /><br />Các loại cảm xúc được hệ thống hỗ trợ là : LIKE, LOVE, HAHA, WOW, SAD, ANGRY</span></p>
<script>
    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
      checkboxClass: 'icheckbox_minimal-blue',
      radioClass: 'iradio_minimal-blue'
    });
    //Red color scheme for iCheck
    $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
      checkboxClass: 'icheckbox_minimal-red',
      radioClass: 'iradio_minimal-red'
    });
    //Flat red color scheme for iCheck
    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
      checkboxClass: 'icheckbox_flat-green',
      radioClass: 'iradio_flat-green'
    });

    //Colorpicker
    $(".my-colorpicker1").colorpicker();
    //color picker with addon
    $(".my-colorpicker2").colorpicker();

    //Timepicker
    $(".timepicker").timepicker({
      showInputs: false
    });
</script>

