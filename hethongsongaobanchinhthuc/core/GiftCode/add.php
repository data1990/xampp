<?php
    if($rule != 'admin' && $rule !='agency'){
        header('Location: index.php');
    }
    function radom_code($length = 12) {
    $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
?>
<?php
if (isset($_POST['submit'])) {
    $loi = array();
    $code = $_POST['code'];
    $get = "SELECT code FROM gift";
    $result = mysqli_query($conn, $get);
    while ($x = mysqli_fetch_assoc($result)) {
        if ($x['code'] == $code) {
            $loi['err'] = "<font color='red'> Code này đã tồn tại trên hệ thống</font>";
        }
    }
    if (empty($loi)) {
        if($_POST['billing'] < 0){
            echo "<script>alert('Không hợp lệ');window.location='index.php';</script>";
        }else{
            $bill = $_POST['billing'];
            $get_bill = "SELECT bill FROM member WHERE id_ctv=$idctv";
            $r = mysqli_query($conn, $get_bill);
            $bills = mysqli_fetch_assoc($r)['bill'];
            if($bills >= $bill){
                $minus = "UPDATE member SET bill = bill - $bill WHERE id_ctv=$idctv";
                if(mysqli_query($conn, $minus)){
                    $sql = "INSERT INTO gift(code, billing,status,id_ctv) VALUES('$code','$bill',0,'$idctv')";
                    if (mysqli_query($conn, $sql)) {
                        $content = "<b>$uname</b> vừa thêm Gift Code <b>$code</b> trị giá <b>".number_format($bill)."</b> VNĐ";
                        $time = time();
                        $his = "INSERT INTO history(content, time, id_ctv, type) VALUES('$content','$time','$idctv',3)";
                        if(mysqli_query($conn, $his)){
                            /*Get thông tin và gửi về tn facebook*/
                            $getinfo = mysqli_query($conn, "SELECT idbot FROM member WHERE id_ctv = $idctv");
                            $infouser = mysqli_fetch_assoc($getinfo);
                            $id = $infouser['idbot'];
                            sendnoti($id,'Bạn vừa thêm Gift Code '.$code.' mệnh giá '.number_format($bill).' VNĐ');
                            /*End Get Thông Tin và gửi về tn facebook*/
                            echo "<script>alert('Thêm gift code thành công'); window.location='index.php?vip=GiftCode';</script>";
                        }
                    }
                }
            }else{
                echo "<script>alert('Không đủ tiền để thêm GIFT CODE'); window.location='them-index.php?vip=GiftCode';</script>";
            }
        }
    }
}
?><div class="row">
    <div class="col-md-12">
        <!-- Horizontal Form -->
        <div class="box box-info wow fadeIn">
            <div class="box-header with-border">
                <h3 class="box-title">Thêm GIFT CODE</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" action="#" method="post">
                <div class="box-body">
                    <div class="form-group">
                        <label for="code" class="col-sm-2 control-label">Code:</label>

                        <div class="col-sm-10">
                            <input type="text" minlength="6" class="form-control" id="code" name="code" value="VTA<?=radom_code()?>HTSA"placeholder="Nhập gift code" required>
                            <?php echo isset($loi['err']) ? $loi['err'] : ''; ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="billing" class="col-sm-2 control-label">Billing (VNĐ):</label>

                        <div class="col-sm-10">
                            <input type="number" max="<?php if($idctv == 1) echo 100000000; else echo 100000; ?>" class="form-control" value="<?php echo isset($_POST['billing']) ? $_POST['billing'] : ''; ?>" id="billing" name="billing" placeholder="Nhập số tiền cho gift code" required>
                        </div>
                    </div>

                    <!-- /.box-body -->
                    <div class="box-footer">
                        <font color="red" style="font-weight: bold;text-transform: uppercase;">Sau khi thêm GIFT CODE, số dư của bạn sẽ tự động bị trừ = giá trị của GIFT CODE</font>
                        <button type="submit" name="submit" class="btn btn-info pull-right">Thêm Gift Code</button>
                    </div>
                    <!-- /.box-footer -->
            </form>
        </div>
    </div>
</div>
</div>
