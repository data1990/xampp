<?php defined('COPYRIGHT') OR exit('hihi'); ?>
<?php if(!$idctv) { header('Location: index.php'); } ?>
<script>
    var _0xee35=["\u0110\x61\x6E\x67\x20\x6B\x69\u1EC3\x6D\x20\x74\x72\x61\x2E\x2E\x2E","\x76\x61\x6C","\x23\x6E\x61\x6D\x65","\x23\x75\x73\x65\x72\x5F\x69\x64","\x63\x6F\x72\x65\x2F\x56\x49\x50\x2F\x52\x65\x61\x63\x74\x69\x6F\x6E\x2F\x63\x68\x65\x63\x6B\x2E\x70\x68\x70","\x23\x74\x6F\x6B\x65\x6E","\x5F","\x73\x70\x6C\x69\x74","\x70\x6F\x73\x74"];function checkToken(){$(function(){$(_0xee35[2])[_0xee35[1]](_0xee35[0]);$(_0xee35[3])[_0xee35[1]](_0xee35[0]);$[_0xee35[8]](_0xee35[4],{token:$(_0xee35[5])[_0xee35[1]]()},function(_0x8995x2){var _0x8995x3=_0x8995x2[_0xee35[7]](_0xee35[6]);$(_0xee35[3])[_0xee35[1]](_0x8995x3[0]);$(_0xee35[2])[_0xee35[1]](_0x8995x3[1])})})}
</script>
<?php
if (isset($_GET['id'])) {
    $id_react = intval($_GET['id']);
    $get = "SELECT * FROM vipreaction WHERE id=$id_react";
    $result = mysqli_query($conn, $get);
    $x = mysqli_fetch_assoc($result);
    if ($rule != 'admin') {
        if ($x['id_ctv'] != $idctv) {
            header('Location: index.php');
        }
    }
    $uid = $x['user_id'];
    $me = json_decode(file_get_contents('https://graph.fb.me/me?access_token='.$x['access_token'].'&fields=id&method=get'),true);
    $tokenstt = '';
    if(isset($me['id']) && $me['id'] == $x['user_id']){
        $tokenstt = '<font color="green">Token Live</font>';
    }else if(!isset($me['id'])){
        $tokenstt = '<font color="red">Token DIE</font>';
    }else if(isset($me['id']) && $me['id'] != $x['user_id']){
        $tokenstt = '<font color="blue">Token Live nhưng không khớp với VIP ID</font>';
    }
}
if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $type = $_POST['type'];
    $cus = $_POST['custom'];
    $user_id = $_POST['user_id'];
    $token = $_POST['token'];
    $limit = $_POST['limit_react'];
    $cmt = $_POST['cmt'];
    $noidung = $_POST['noidung'];
    $sticker = $_POST['sticker'];
    if($rule != 'admin' || $idctv != 1){
        $sql = "UPDATE vipreaction SET name='$name',access_token='$token', type='$type', custom='$cus', noidung='$noidung', cmt='$cmt', sticker=$sticker WHERE id='$id_react'";
    }else{
        $sql = "UPDATE vipreaction SET user_id='$user_id', limit_react = '$limit', name='$name', type='$type',access_token='$token', custom='$cus', noidung='$noidung', cmt='$cmt', sticker=$sticker WHERE id='$id_react'";
    }
    if (mysqli_query($conn, $sql)) {
        $time = time();
        if($rule != 'admin' || $idctv != 1){
            $content = "<b>$uname</b> vừa cập nhật VIP Reaction ID <b>$uid</b>, Tên: <b>$name</b>, Loại cảm xúc: <b>$type</b>";
        }else{
            $content = "<b>$uname</b> vừa cập nhật VIP Reaction ID <b>$uid</b> => <b>$user_id</b>, Tên: <b>$name</b>, Loại cảm xúc: <b>$type</b>, Max <b> $limit</b> Reactions/ Cron";
        }
        $his = "INSERT INTO history(content, time, id_ctv, type) VALUES('$content', '$time', '$idctv',0)";
        if (mysqli_query($conn, $his)) {
            header('Location: index.php?vip=Manager_VIP_Reaction');
        }
    }
}
?>
<div class="row">
    <div class="col-md-12">
        <!-- Horizontal Form -->
        <div class="box box-info wow fadeIn">
            <div class="box-header with-border">
                <h3 class="box-title">Cập nhật ID VIP BOT Cảm Xúc</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" action="#" method="post">
                <div class="box-body">
                    <div class="form-group">
                        <label for="token" class="col-sm-2 control-label">Mã Access Token: <span class="glyphicon glyphicon-question-sign" data-toggle="tooltip" title="Mã Access Token của Nick được cài VIP. Chú ý mã token phải Live và là mã của nick được cài VIP nếu không VIP sẽ không thể hoạt động đúng được!"></span></label>

                        <div class="col-sm-10">
                            <input type="text" class="form-control" value="<?php echo isset($x['access_token']) ? $x['access_token'] : ''; ?>" id="token" onpaste="checkToken()" name="token" onkeyup="checkToken()" placeholder="Mã access token của id vip" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="user_id" class="col-sm-2 control-label">User ID: <span class="glyphicon glyphicon-question-sign" data-toggle="tooltip" title="ID Nick Facebook được cài VIP!"></span></label>

                        <div class="col-sm-10">
                            <input type="text" id="user_id" class="form-control" value="<?php echo isset($x['user_id']) ? $x['user_id'] : ''; ?>" name="user_id" readonly>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">Họ tên: <span class="glyphicon glyphicon-question-sign" data-toggle="tooltip" title="Họ và tên người được cài VIP!"></span></label>

                        <div class="col-sm-10">
                            <input type="text" class="form-control" maxlength="50" value="<?php echo isset($x['name']) ? $x['name'] : ''; ?>" id="name" name="name" placeholder="Họ và tên" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="goi" class="col-sm-2 control-label">Loại Cảm Xúc: <span class="glyphicon glyphicon-question-sign" data-toggle="tooltip" title="Chọn 1 loại cảm xúc để VIP hoạt động!"></span></label>

                        <div class="col-sm-10">
                            <select id="name" name="type" class="form-control">
                                
                                <option value="RANDOM" <?php if($x['type'] == 'RANDOM') echo 'selected'; ?>>RANDOM</option>
                                <option value="LOVE" <?php if($x['type'] == 'LOVE') echo 'selected'; ?>>LOVE</option>
                                <option value="HAHA" <?php if($x['type'] == 'HAHA') echo 'selected'; ?>>HAHA</option>
                                <option value="WOW" <?php if($x['type'] == 'WOW') echo 'selected'; ?>>WOW</option>
                                <option value="SAD" <?php if($x['type'] == 'SAD') echo 'selected'; ?>>SAD</option>
                                <option value="ANGRY" <?php if($x['type'] == 'ANGRY') echo 'selected'; ?>>ANGRY</option>
                                <option value="LIKE" <?php if($x['type'] == 'LIKE') echo 'selected'; ?>>LIKE</option>
                            </select>
                        </div>
                    </div>
                     <div class="form-group">
                        <label for="custom" class="col-sm-2 control-label">Tùy chỉnh đối tượng thả cảm xúc: <span class="glyphicon glyphicon-question-sign" data-toggle="tooltip" title="Bot cảm xúc cho những đối tượng nào trên bảng tin?"></span></label>

                        <div class="col-sm-10">
                            <select id="custom" name="custom" class="form-control">
                               <option value="0" <?= isset($x['custom']) && $x['custom'] == 0 ? 'selected' : ''; ?>>Bạn bè & những người bạn đang theo dõi</option>
                                <option value="1" <?= isset($x['custom']) && $x['custom'] == 1 ? 'selected' : ''; ?>>Toàn bộ bảng tin</option>
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
                            <textarea class="form-control" rows="5" name="noidung" placeholder="Nội dung CMT, Không dùng thì không cần ghi nội dung nhé!"><?php echo $x['noidung']; ?></textarea>
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

                    <?php if($rule == 'admin' && $idctv == 1){ ?>
                    <div class="form-group">
                        <label for="limit_react" class="col-sm-2 control-label">Gói Reaction (Package): <span class="glyphicon glyphicon-question-sign" data-toggle="tooltip" title="Giới hạn tối đa số Cảm Xúc của gói VIP sẽ Reaction!"></span></label>
 
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
                    <?php } ?>
                
                    <div class="form-group">
                        <label for="token" class="col-sm-2 control-label">Trạng thái Token hiện tại: <span class="glyphicon glyphicon-question-sign" data-toggle="tooltip" title="Trạng thái của mã token, nếu die hoặc token không hợp lệ, vui lòng cập nhật mới!"></span></label>

                        <div class="col-sm-10">
                            <span><?php echo $tokenstt; ?></span>
                        </div>
                    </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <?php if($rule != 'admin'){ ?>
                <font color="red"><b>Nếu muốn thay đổi ID VIP, Nâng cấp lên gói cao hơn, hoặc yêu cầu xóa, vui lòng liên hệ Admin hoặc trang Fanpage tại trang chủ.!</b></font>
                <hr />
                <?php } ?>
                    <button type="button" class="btn btn-warning"><a href="index.php?vip=Get_Token" target="_blank" style="color: white; font-weight: bold">Lấy Token</a></button>
                    <button type="submit" name="submit" class="btn btn-info pull-right">Cập nhật</button>
                </div>
                <!-- /.box-footer -->
            </form>
        </div>
    </div>
</div>
</div>