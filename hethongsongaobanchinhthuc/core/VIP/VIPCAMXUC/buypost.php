<?php 
/*
*** Code by VTA 16:04:00 22/05/2018
*** Fb.Com/VuTienAnh.VN
*** SĐT 0919.257.664
*** Ok!
*/
$rate = 2000; 
?>
<script type="text/javascript">
function _limit() {
        var limitpost = $('#limitpost').val();
        if (limitpost >= 2) {
            var price = limitpost * <?= $rate; ?>;
            var x = price.toFixed(0).replace(/./g, function (c, i, a) {
                return i && c !== "." && ((a.length - i) % 3 === 0) ? ',' + c : c;
            });
            $('#result').html(x + ' VNĐ');
        } else {
            alert('Mua tối thiểu 2 Post');
            $('#limitpost').val('2');
        }
    }
function check(){
  if($('#idvip').val() != ''){
    $.get('core/VIP/VIPCAMXUC/checkid.php', { idvip: $('#idvip').val(), sever: $('input[name=sever]:checked').val() }, function(result){ $('#check').html(result); });
    }
  }
</script>
<?php
if (isset($_POST['submit'])) {
    $idvip = htmlspecialchars(addslashes($_POST['idvip']));;
    $sever = $_POST['sever'];
    $limitpost = intval($_POST['limitpost']);
    $price = $rate * $limitpost;
    $check_bill = mysqli_query($conn, "SELECT bill FROM member WHERE id_ctv=$idctv");
    $bill = mysqli_fetch_assoc($check_bill)['bill'];
        if ($bill - $price >= 0) {
            if($sever == 'sv1'){
            echo $ins = mysqli_query($conn, "UPDATE vip SET limitpost = limitpost + $limitpost WHERE user_id='$idvip'");
            }else if($sever == 'sv2'){
            echo $ins = mysqli_query($conn, "UPDATE vipsv2 SET limitpost = limitpost + $limitpost WHERE user_id='$idvip'");
            }
                    if ($ins) {
                        $up = mysqli_query($conn, "UPDATE member SET bill = bill - $price, payment = payment + $price WHERE id_ctv=$idctv");
                        if ($up) {
                            $content = "<b>$uname</b> vừa mua thêm <b>$limitpost</b> Lượt Post cho  <b>$idvip</b>. Tổng thanh toán: <b>" . number_format($price) . "</b> VNĐ";
                            $time = time();
                            $his = mysqli_query($conn, "INSERT INTO history(content,id_ctv,time, type) VALUES('$content','$idctv', '$time',0)");
                            if ($his) {
                                /*Get thông tin và gửi về tn facebook*/
                            $getinfo = mysqli_query($conn, "SELECT idbot FROM member WHERE id_ctv = $idctv");
                            $infouser = mysqli_fetch_assoc($getinfo);
                            $id = $infouser['idbot'];
                            sendnoti($id,'Bạn vừa mua thêm '.$limitpost.'lượt post cho ID VIP '.$idvip.'. Tổng thanh toán'.number_format($price).'.');
                            /*End Get Thông Tin và gửi về tn facebook*/
                                echo "<script>alert('Thành công');window.location='index.php?vip=Buy_Post';</script>";
                            }
                        }
                    }
        } else {
            echo "<script>alert('Không đủ tiền rùi, nạp thêm đi nha');window.location='index.php?vip=Nap_The';</script>";
        }
}
?>
<div class="row">
    <div class="col-md-12">
        <!-- Horizontal Form -->
        <div class="box box-info wow fadeIn">
            <div class="box-header with-border">
                <h3 class="box-title">Mua Thêm Lượt Post Cho VIP ID</kbd>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" action="#" method="post">
                <div class="box-body">
                    
                <div class="form-group">
                    <label class="col-sm-2 control-label"><font color="red">ID VIP: </font> <star>*</star></label> 
                    <div class="col-sm-10">
                        <input type="text" onchange="check();" onkeyup="check();" id="idvip" class="form-control" name="idvip" placeholder="Nhập chính xác id vip" data-toggle="tooltip" required/>
                        <span id="check"></span>
                    </div>                  
                </div>


                <div class="form-group"> 
                    <label class="col-sm-2 control-label">Cài tại sever : (Chọn đúng)<star>*</star></label> <br>
                    <div class="col-sm-10">
                      <input type="radio" class="sever" name="sever" value="sv1" onchange="check()" onmouseleave="check()" checked required> Sever 1<br />
                      <input type="radio" class="sever" name="sever" value="sv2" onchange="check()" onmouseleave="check()" required> Sever 2<br />
                    </div>                 
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label"><font color="red">Mua Thêm (Lượt): </font> <star>*</star></label> 
                    <div class="col-sm-10">
                        <input type="number" name="limitpost" id="limitpost" class="form-control" onblur="_limit()" value="2" min="2" max="20" required/>
                    </div>                  
                </div>

                <div class="form-group">
                        <label for="goi" class="col-sm-2 control-label">Thành tiền: <span class="glyphicon glyphicon-question-sign" data-toggle="tooltip" title="Tổng số tiền cần thanh toán!"></span></label>

                        <div class="col-sm-10">
                            <span style="background:red; color:yellow" class="h4" id="result"><script>_limit();</script></span>
                        </div>
                </div>

                    </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <button type="submit" name="submit" class="btn btn-info pull-right">Mua</button>
                </div>
                <!-- /.box-footer -->
            </form>
        </div>
    </div>
</div>
