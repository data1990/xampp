<?php
if($baomat == '0'){
?>
<div class="col-lg-12">
          <div class="box box-danger">
            <div class="box-header with-border">
              <h3 class="box-title">Xác Nhận Tài Khoản</h3>
            </div>
<div class="panel-body">
<?php
if(isset($_POST['xacnhan'])){
$sql = "SELECT profile FROM member WHERE id_ctv = $idctv";
$result = mysqli_query($conn, $sql);
$x = mysqli_fetch_assoc($result);
$idfb = $x['profile'];
$macode = $_POST['macode'];
$checkcode = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*), code, idbot FROM codesignup WHERE uid = $idfb"));
$idbot = $checkcode['idbot'];
if($macode != $checkcode['code']){
echo '<div class="alert alert-warning">Bạn nhập sai mã!</div>';
}else{
mysqli_query($conn ,"UPDATE codesignup SET taikhoan='$uname' WHERE code='$macode'");
mysqli_query($conn ,"UPDATE member SET baomat='1', idbot='$idbot' WHERE id_ctv ='$idctv'");

                            /*Get thông tin và gửi về tn facebook*/
                            $getinfo = mysqli_query($conn, "SELECT idbot FROM codesignup WHERE uid = $idfb");
                            $infouser = mysqli_fetch_assoc($getinfo);
                            $id = $infouser['idbot'];
                            sendnoti($id,'Bạn vừa xác nhận tài khoản '.$uname.' thành công');
                            /*End Get Thông Tin và gửi về tn facebook*/


$timexacnhan = date("d/m/Y - H:i:s", time());
$content = "<b>$uname</b> vừa xác nhận tài khoản lúc <b>$timexacnhan</b>";
$time = time();
mysqli_query($conn ,"INSERT INTO history(content,id_ctv,time, type) VALUES('$content','$idctv', '$time',69)");
echo '<div class="alert alert-success">Xác Nhận Thành Công. Hệ thống sử lý 2 giây...</div>';
echo '<meta http-equiv=refresh content="2; URL=/index.php">';
}
}
?>
<form action="" method="POST">
<div class="form-group">
  <label for="pwd">Nhập mã:</label>
  <input type="text" class="form-control" name="macode" id="macode" placeholder="Nhập mã kích hoạt">
</div>
	<button type="submit" name="xacnhan" class="btn btn-danger">OK</button>

        </form>	
      </div>
    </div>
  </div>

  <div class="col-lg-12">
          <div class="box box-success">
            <div class="box-header with-border">
              <h3 class="box-title"> Hướng Dẫn Lấy Mã</h3>
            </div>
<div class="panel-body">
<strong>Các bước thực hiện :</strong>
<ol>
<li>Các bạn vào trang fanpage <a href="https://www.facebook.com/vtasystem.vn/" target="_black">Hethongsongao Fanpage</a> Click Chat với Page. <img src="https://i.imgur.com/UXcpbCv.png" class="img-responsive pad"/></li>
<li>Chat : Kichhoat , KICHHOAT, Kích Hoạt, kích hoạt, đều được để nhận mã kích hoạt. Sau đó nhập IDFB của bạn vào để kích hoạt.
<img src="https://i.imgur.com/QrfvzNt.png" class="img-responsive pad"/></li>
<li>Quay lại trang chủ Hethongsongao.Com . Dán mã vừa coppy được .Click OK. Vậy là đã kích hoạt thành công
<img src="https://i.imgur.com/5IvZsjk.png" class="img-responsive pad"/>
</li>
</ol>
<strong>Tài khoản lập sau 1 tiếng mà không kích hoạt hệ thống tự động xóa tài khoản!</strong>
</div>
</div>
</div>
<?php
}else{
    echo "<script>alert('Tài khoản của bạn đã xác nhận rồi nhé!');window.location='index.php';</script>";
}
?>