<?php
    if (isset($_POST['submit'])) {
        $giftcode = $_POST['gift_code'];
        $get = "SELECT billing, status,id_ctv,id_use, COUNT(*) FROM gift WHERE code = '$giftcode' GROUP BY billing, status, id_ctv, id_use";
        $result = mysqli_query($conn, $get);
        $x = mysqli_fetch_assoc($result);
        $check = mysqli_query($conn,"SELECT COUNT(*) FROM gift WHERE id_use=$idctv AND status=1");
        $num = mysqli_fetch_assoc($check)['COUNT(*)'];
        if($x['COUNT(*)'] == 1) {
            if($x['status'] == 0 && $num == 0){
                $billing = $x['billing'];
                    $exec = "UPDATE member SET bill = bill + $billing WHERE id_ctv = $idctv";
                if (mysqli_query($conn, $exec)) {
                    $update = "UPDATE gift SET status = 1, id_use = $idctv, uname='$uname', rule='$rule' WHERE code = '$giftcode'";
                    if (mysqli_query($conn, $update)) {
                            $content = "<b>$uname</b> đã sử dụng Gift Code <b> $giftcode</b> và được cộng <b>" . number_format($billing) . "</b> VNĐ vào tài khoản";
                            $time = time();
                            $his = "INSERT INTO history(content, time, id_ctv, type) VALUES('$content','$time','$idctv',3)";
                            if (mysqli_query($conn, $his)) {
                            /*Get thông tin và gửi về tn facebook*/
                            $getinfo = mysqli_query($conn, "SELECT idbot FROM member WHERE id_ctv = $idctv");
                            $infouser = mysqli_fetch_assoc($getinfo);
                            $id = $infouser['idbot'];
                            sendnoti($id,'Bạn đã sử dụng Gift Code '.$giftcode.' và được cộng '.number_format($billing).' VNĐ vào tài khoản');
                            /*End Get Thông Tin và gửi về tn facebook*/

                                echo "<script>alert('Thành công!!'); window.location='index.php?vip=GiftCode';</script>";
                            }
                    }
                }
            }else{
                echo "<script>alert('Bạn chỉ được sử dụng 1 giftcode cho event lần này!'); window.location='index.php?vip=GiftCode';</script>";
            }
        }else {
             echo "<script>alert('Gift code không tồn tại hoặc đã được sử dụng');window.location='index.php?vip=GiftCode';</script>";
        }
    }
?><div class="row">
    <div class="col-md-12">
        <!-- Horizontal Form -->
        <div class="box box-info wow fadeIn">
            <div class="box-header with-border">
                <h3 class="box-title">GIFT CODE</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" action="#" method="post">
                <div class="box-body">
                    <div class="form-group">
                        <label for="giftcode" class="col-sm-2 control-label">Nhập mã Gift Code:</label>

                        <div class="col-sm-10">
                            <input type="text" name="gift_code" class="form-control" />
                        </div>
                    </div>



                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <button type="submit" name="submit" class="btn btn-info pull-right">Thực hiện</button>
                </div>
                <!-- /.box-footer -->
            </form>
        </div>
    </div>
</div>
