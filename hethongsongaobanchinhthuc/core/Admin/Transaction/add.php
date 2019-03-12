<?php defined('COPYRIGHT') OR exit('hihi'); ?>
<?php
if (!isset($rule) || $rule != 'admin' || $idctv !=1) {
    header('Location: /index.php');
}else{
    if (isset($_POST['submit'])) {
        if($_POST['money'] < 0){
            echo "<script>alert('Không hợp lệ');window.location='index.php';</script>";
        }else{
            $user_name = $_POST['user_name'];
            $get = "SELECT id_ctv FROM member WHERE user_name='$user_name'";
            $result = mysqli_query($conn, $get);
            $x = mysqli_fetch_assoc($result);
            $id = $x['id_ctv'];
            $money = $_POST['money'];
            $time = time();
            $sql = "UPDATE member SET bill = bill + $money WHERE user_name = '$user_name'";
            if (mysqli_query($conn, $sql)) {
                $content = "<b>$uname</b> vừa cộng <b>".number_format($money)." VNĐ</b> cho tài khoản <b>$user_name</b>";
                $time = time();
                $his = "INSERT INTO history(content, time, id_ctv, type) VALUES('$content', '$time', '$idctv',2)";
                if (mysqli_query($conn, $his)) {
                    $c = "<b>$user_name</b> vừa được <b>$uname</b> cộng <b>".number_format($money)." VNĐ vào tài khoản";
                    $t = time();
                    $noti = "INSERT INTO noti(content, time, id_ctv) VALUES('$content','$time', '$id')";
                    /*Get thông tin và gửi về tn facebook*/
                            $getinfo = mysqli_query($conn, "SELECT idbot FROM member WHERE id_ctv = $id");
                            $infouser = mysqli_fetch_assoc($getinfo);
                            $getinfo2 = mysqli_query($conn, "SELECT idbot FROM member WHERE id_ctv = $idctv");
                            $infouser2 = mysqli_fetch_assoc($getinfo2);
                            $id = $infouser['idbot'];
                            $id2 = $infouser2['idbot'];
                            sendnoti($id,'Bạn vừa được cộng '.number_format($money).' VNĐ từ '.$uname.' vào tài khoản');
                            sendnoti($id2,'Bạn vừa cộng '.number_format($money).' VNĐ cho '.$user_name.'.');
                            /*End Get Thông Tin và gửi về tn facebook*/
                    if(mysqli_query($conn, $noti)){
                        echo "<script>alert('Cộng tiền thành công'); window.location='index.php?vip=Add_Money';</script>";
                    }
                }
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
                <h3 class="box-title">Cộng tiền cho Member & Đại lí & CTV</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" action="#" method="post">
                <div class="box-body">
                    <div class="form-group">
                        <label for="user_id" class="col-sm-2 control-label">UserName:</label>

                        <div class="col-sm-10">
                        <input list="user_name" name="user_name">
                            <datalist id="user_name">
                            <?php
                                $get = "SELECT user_name, name, bill,rule FROM member ORDER BY user_name ASC";
                                $result = mysqli_query($conn, $get);
                                while ($x = mysqli_fetch_assoc($result)) {
                                    $user_name = $x['user_name'];
                                    $name1 = $x['name'];
                                    $bill1 = number_format($x['bill']);
                                    $rl = '';
                                    if($x['rule'] == 'agency'){
                                        $rl = 'Đại lí - ';
                                    }elseif($x['rule'] == 'freelancer'){
                                        $rl = 'CTV - ';
                                    }else{    
                                        $rl = 'Member - ';
                                    }
                                    echo "<option value='$user_name'>$rl $name1 ( $user_name ) - $bill1 VNĐ";
                                }
                                ?>
                                </datalist>
            
                        </div>
                    </div>


                    <div class="form-group">
                        <label for="profile" class="col-sm-2 control-label">Số tiền (VNĐ):</label>

                        <div class="col-sm-10">
                            <input  type="number" class="form-control" min="1" max="100000000" name="money" placeholder="Nhập số tiền" required=""/>
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
