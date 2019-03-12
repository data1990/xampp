<?php
defined('COPYRIGHT') OR exit('hihi');
    if(isset($_GET['id_react'])){
        $id_react = intval($_GET['id_react']);
        $layinfo = mysqli_query($conn,"SELECT user_id,name,end,id_ctv,type,access_token FROM vipreaction WHERE id=$id_react");
        $info = mysqli_fetch_assoc($layinfo);
        $uid = $info['user_id'];
        if($rule != 'admin'){
            if($idctv != $info['id_ctv']){
                echo "<script>alert('Bạn không có quyền gia hạn VIP ID này!');window.location='index.php?vip=Manager_VIP_Like';</script>";
            }else if($info['end'] > time()){
                echo "<script>alert('VIP ID này chưa hết hạn');window.location='index.php?vip=Manager_VIP_Like';</script>";
            }
        }else{
            if($info['end'] > time()){
                echo "<script>alert('VIP ID này chưa hết hạn');window.location='index.php?vip=Manager_VIP_Like';</script>";
            }
        }
    }
?>
<script>
    function tinh(){
        $(function(){
             $.post('core/VIP/price.php', { han: $('#han').val(), goi: $('#goi').val(), rule: $('#rule').val()}, function(result){$('#result').html(result);});
        });
    }
    function checkToken(){
        $(function(){
            $('#check').html("<font color='red'>Đang kiểm tra mã token...</font>");
             $.post('core/VIP/Reaction/check.php', { token: $('#token').val() }, function(result){$('#check').html(result);});
        });
    }
</script>
<?php
    $get = "SELECT COUNT(*) FROM package WHERE type='REACTION'";
    $result = mysqli_query($conn, $get);
    $x = mysqli_fetch_assoc($result);
    if($x['COUNT(*)'] == 0){
        echo "<script>alert('Chưa có package nào?');window.location='index.php?vip=Add_Package_Reaction';</script>";
    }
?>
<?php
if (isset($_POST['submit'])) {
    if(($_POST['han'] <= 0 || $_POST['han'] > 12) || $_POST['goi'] < 35000){
        echo "<script>alert('Địt con mẹ mày luôn, bug tiếp hộ bố mày cái ?'); window.location='logout.php';</script>";
    }else{
        $han = $_POST['han'];
        $goi = $_POST['goi'];
        $start = time();
        $end = $start + $han * 30 * 86400 - 28800;
        $price = $han * $goi;
        if($rule == 'agency'){
            $price -= $price * 10 / 100;
        }else if($rule == 'freelancer'){
            $price -= $price * 5 / 100;
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
            //$sql = "INSERT INTO vipreaction(user_id, name, han, start, end, limit_react, id_ctv, pay, type,access_token) VALUES('$uid','$name','$han','$start','$end','$max_reactions','$idctv','$price','$type','$token')";
            $sql = "UPDATE vipreaction SET han='$han', start='$start', end='$end', limit_react='$max_reactions', pay='$price',type='$type', access_token='$token' WHERE id=$id_react";
            if (mysqli_query($conn, $sql)) {
                    $up = "UPDATE member SET payment = payment + $price WHERE id_ctv=$idctv";

                if(mysqli_query($conn, $up)){
                        $minus = "UPDATE member SET bill = bill - $price WHERE id_ctv = $idctv";

                    if (mysqli_query($conn, $minus)) {
                        $content = "<b>$uname</b> vừa gia hạn VIP REACTION cho ID <b>$uid</b>. Thời hạn <b>$han</b> tháng, MAX <b>$max_reactions</b> Reactions / Cron, tổng thanh toán <b>" . number_format($price) . " VNĐ </b>";
                        $time = time();
                        $his = "INSERT INTO history(content,id_ctv,time, type) VALUES('$content','$idctv', '$time',0)";
                        if (mysqli_query($conn, $his)) {
                            echo '<script>alert("Gia hạn thành công"); window.location="index.php?vip=Manager_VIP_Like";</script>';
                        }
                    }
                }
            }
        } else {
            echo '<script>alert("Số dư tài khoản của bạn không đủ !!! Vui lòng nạp thêm tiền đi nha!1");location.href="them-index.php?vip=Manager_VIP_Like";</script>';
        }
    }
}
?>
<div class="row">
    <div class="col-md-12">
        <!-- Horizontal Form -->
        <div class="box box-info wow fadeIn">
            <div class="box-header with-border">
                <h3 class="box-title">Thêm ID VIP BOT Reaction</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
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
                                <?php
                                for ($i = 1; $i <= 12; $i++) {
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
                               
                                <option value="LOVE" <?php echo isset($info['type']) && $info['type'] == 'LOVE' ? 'selected' : ''; ?>>LOVE</option>
                                <option value="HAHA" <?php echo isset($info['type']) && $info['type'] == 'HAHA' ? 'selected' : ''; ?>>HAHA</option>
                                <option value="WOW" <?php echo isset($info['type']) && $info['type'] == 'WOW' ? 'selected' : ''; ?>>WOW</option>
                                <option value="SAD" <?php echo isset($info['type']) && $info['type'] == 'SAD' ? 'selected' : ''; ?>>SAD</option>
                                <option value="ANGRY" <?php echo isset($info['type']) && $info['type'] == 'ANGRY' ? 'selected' : ''; ?>>ANGRY</option>
                                <option value="LIKE" <?php echo isset($info['type']) && $info['type'] == 'LIKE' ? 'selected' : ''; ?>>LIKE</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="goi" class="col-sm-2 control-label">Gói Reaction (Package): <span class="glyphicon glyphicon-question-sign" data-toggle="tooltip" title="Giới hạn tối đa số Cảm Xúc của gói VIP sẽ Reaction!"></span></label>

                        <div class="col-sm-10">
                            <select id="goi" name="goi" class="form-control" onchange="tinh()" readonly>
                                <?php
                                $ds = "SELECT max, price FROM package WHERE type='REACTION' ORDER BY price ASC";
                                $ds_x = mysqli_query($conn, $ds);
                                while ($ok = mysqli_fetch_assoc($ds_x)) {
                                    echo "<option value='" . $ok['price'] . "'>Automatic - 50K/Tháng</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="token" class="col-sm-2 control-label">Mã Access Token: <span class="glyphicon glyphicon-question-sign" data-toggle="tooltip" title="Mã Access Token của Nick được cài VIP. Chú ý mã token phải Live và là mã của nick được cài VIP nếu không VIP sẽ không thể hoạt động đúng được!"></span></label>

                        <div class="col-sm-10">
                            <input type="text" class="form-control" value="<?php echo isset($info['access_token']) ? $info['access_token'] : ''; ?>" onchange="checkToken()" onkeyup="checkToken()" id="token" name="token" placeholder="Mã access token của id vip" required>
                            <p id="check"></p>
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
<p class="alert alert-danger"><span class="h4">Chú ý phân biệt giữa VIP Cảm Xúc và VIP <b>BOT</b> Cảm Xúc<br /><br />VIP Cảm Xúc tức là VIP sẽ tự động tăng số lượng cảm xúc của status, ảnh mà VIP ID được thêm trên hệ thống đăng trên trang cá nhân.<br /><br />VIP BOT Cảm Xúc tức là VIP ID được cài trên hệ thống sẽ tự động bày tỏ cảm xúc bài viết của bạn bè, của nhóm, fanpage ngẫu nhiên trên bảng tin ( cảm xúc tùy chọn trên hệ thống khi cài đặt VIP ).<br /><br />Các loại cảm xúc được hệ thống hỗ trợ là : LIKE, LOVE, HAHA, WOW, SAD, ANGRY</span></p>