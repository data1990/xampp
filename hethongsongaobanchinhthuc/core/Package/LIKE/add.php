<?php
if ($rule != 'admin' || $idctv != 1) {
    echo "<script>alert('Ra chỗ khác chơi');window.location='index.php';</script>";
}
?>
<?php
if (isset($_POST['submit'])) {
    $loi = array();
    $get_max = "SELECT max FROM package WHERE type='LIKE'";
    $r_max = mysqli_query($conn, $get_max);
    while ($max = mysqli_fetch_assoc($r_max)) {
        foreach ($_POST['max_like'] as $max_like) {
            if ($max['max'] == $max_like) {
                $loi['exists'] = '<font color="red">Đã tồn tại package này</font>';
            }
        }
    }
    if (empty($loi)) {
        $max_like = $_POST['max_like'];
        $gia_tien = $_POST['gia_tien'];
        $package = array_combine($gia_tien, $max_like);
        $sql = "INSERT INTO package(price, max, id_ctv, type) VALUES";
        foreach ($package as $k => $v) {
            $sql .= "($k,$v,$idctv,'LIKE'),";
        }
        $sql = substr($sql, 0, strlen($sql) - 1);
        if (mysqli_query($conn, $sql)) {
            $content = "<b>$uname</b> vừa thêm <b>" . count($max_like) . "</b> Package <b>VIP Like</b>";
            $time = time();
            $his = "INSERT INTO history(content, time, id_ctv) VALUES('$content', '$time', '$idctv')";
            if (mysqli_query($conn, $his)) {
                echo "<script>alert('Thêm package thành công');window.location='index.php?vip=List_Package_Like';</script>";
            }
        }
    }
}
?><div class="row">
    <div class="col-md-12">
        <!-- Horizontal Form -->
        <div class="box box-info wow fadeIn">
            <div class="box-header with-border">
                <h3 class="box-title">Thêm Package Like</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" action="#" method="post">
                <div class="box-body" id="list">
                    <div class="form-group">
                        <div class="col-sm-6">
                            <label for="user_id" class="col-sm-2 control-label">Max Like:</label>

                            <div class="col-sm-10">
                                <input type="number" max="10000" name="max_like[]" class="form-control" placeholder="Nhập max like cho gói like này" required/>
                                <b><?php echo isset($loi['exists']) ? $loi['exists'] : ''; ?></b>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="profile" class="col-sm-2 control-label">Giá tiền (VNĐ):</label>

                            <div class="col-sm-10">
                                <input type="number" max="1000000" name="gia_tien[]" class="form-control" placeholder="Nhập giá tiền cho gói like này" required/>
                            </div>
                        </div>
                    </div> 
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <button type="button" id="add" onclick="add_package()" class="btn btn-success">Thêm package</button>
                    <button type="submit" name="submit" class="btn btn-info pull-right">Gửi yêu cầu</button>
                </div>
                <!-- /.box-footer -->
            </form>
        </div>
    </div>
</div>
<script>
    function add_package() {
        var content = '<div class="form-group"><div class="col-sm-6"><label for="user_id" class="col-sm-2 control-label">Max Like:</label><div class="col-sm-10"><input type="number" max="10000" required name="max_like[]" class="form-control" placeholder="Nhập max like cho gói like này" /></div></div><div class="col-md-6"><label for="profile" class="col-sm-2 control-label">Giá tiền (VNĐ):</label><div class="col-sm-10"><input type="number" max="1000000" required name="gia_tien[]" class="form-control" placeholder="Nhập giá tiền cho gói like này"/></div></div></div>';
        $('#list').append(content);
    }
</script>
