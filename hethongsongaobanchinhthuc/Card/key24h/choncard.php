        <!--div id="vtasystemnoti" class="modal fade" role="dialog"> 
    <div class="modal-dialog"> 
        <div class="modal-content"> 
            <div class="modal-header"> 
                <button type="button" class="close" data-dismiss="modal">&times;</button> 
                <h4 class="modal-title"><center><strong>Thông Báo Mới</strong></center></h4> 
            </div> 
            <div class="modal-body"> 
                        <span class="h4"> 
                            <center><b>CHỈ NẠP ĐƯỢC THẺ VIETTEL</b></center> 
                        </span> 
            </div> 
                    <div class="modal-footer"> 
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Đóng</button> 
                    </div> 
                </div> 

            </div> 
        </div--> 
        <script type="text/javascript"> 
            window.onload = function(){ 
    document.getElementById('warnings').click(); 
}; 
    $(document).ready(function(){ 
    $(".form-control").tooltip({ placement: 'right'}); 
}); 
</script> 
<?php 
if(!$_SESSION['user']){ 
?> 

<meta http-equiv=refresh content="0; URL=/index.php"> 
<script>alert("ĐĂNG NHẬP ĐI BẠN ƠI !!!!"); </script> 

<?php 
}else{ 
?> 

        <div class="col-md-6"> 
          <div class="box box-success"> 
            <div class="box-header"> 
              <h3 class="box-title">NẠP TIỀN HỆ THỐNG 
</h3> 
            </div> 
            <div class="box-body pad table-responsive"> 
<div class="form-group"> 
<label class="control-label">Tài khoản <star>*</star></label> 
<input class="form-control error" id="txtuser" name="txtuser" value="<?php echo $getuser['username'];?>" disabled=""> 
</div> 
<div class="form-group"> 
<label class="control-label">Loại thẻ <star>*</star></label> 
                                <select class="form-control" name="key" id="key" oninput="update()"> 
                                    <option value="vtt">Viettel</option> 
                                   <option value="vms">Mobiphone</option> 
                                   <option value="vnp">Vinaphone</option> 
                                   <!--option value="vnmobile">Vietnammobile</option> 
                                   <option value="vcoin">Vcoin</option> 
                                   <option value="oncash">OnCash</option> 
                                   <option value="bit">BIT</option--> 
                                   <option value="gate">Gate</option>
                                   <!--option value="MTOP">MTOP</option> 
                                   <option value="megacard">Megacard</option--> 
                                </select> 
</div> 
<div class="form-group"> 
<label class="control-label">Mã thẻ <star>*</star></label> 
<input class="form-control" oninput="update()" id="code" name="code" placeholder="Mã thẻ" data-toggle="tooltip" data-title="Mã số sau lớp bạc mỏng"/> 
</div> 
<div class="form-group"> 
<label class="control-label">Số seri <star>*</star></label> 
<input class="form-control" oninput="update()" id="serial" name="serial" placeholder="Số seri" data-toggle="tooltip" data-title="Mã seri nằm sau thẻ"/> 
</div> 

<div class="footer text-center"> 
<button id="postdata" class="btn btn-info btn-fill btn-wd" name="napthe" onclick="napthe()">Nhập Quà</button> 
</div> 


<div class="form-group"> 
<center>Nếu có lỗi trong quá trình nạp thẻ, vui lòng SMS : <code>check (< seri >) <?php echo $getuser['username']; ?></code> Gửi <strong>0919257664</strong>. 
</center> 
</div> 

<div id="ketqua"></div> 
</div>   

</div></div> 

        <div class="col-md-6"> 
          <div class="box box-success"> 
            <div class="box-header"> 
              <h3 class="box-title">NẠP TIỀN BẰNG VÍ ĐIỆN TỬ HOẶC CHUYỂN KHOẢN 
</h3> 
            </div> 
            <div class="box-body pad table-responsive"> 

      <div class="list-group-item"> 
<center>Tiền của bạn sẽ được cộng ngay lập tức từ 1 đến 2p sau khi nạp qua ngân hàng 
</center> 
</div> 
     
    <div class="table-responsive"> 
<table class="table table-bordered"> 
<thead> 
<tr class="active"> 
<th><center>Ngân hàng</center></th> 
<th><center><font color="red">Thông tin chuyển khoản</font></center></th></tr></thead><tbody> 

<tr><td><center><b>VIETCOMBANK</b><br><img src="https://hethongsongao.com/giaodien/img/vietcombank.jpg"></center></td><td><b>- Số tài khoản: <font color="red">0021000407369</font></b><br> 
- Tên : <font color="red">NGUYEN DINH QUANG</font><br> 
- Chi nhánh: <font color="red">Chi Nhánh Hà Nội</font></br> 
- Nội Dung Chuyển Khoản: <font color="red"><b><?php echo $getuser['username']; ?> Nap Tien Mua Vip</b></font ></br> 
</td></tr> 

<tr><td><center><b>THẺ CÀO SIÊU RẺ</b><br><img src="https://thecaosieure.com/images/logo.png" height="35px" weight="32px"></center></td><td><b>- Tài khoản: <font color="red">nhianhlove</font></b><br> 
- Tên : <font color="red">VŨ TIẾN ANH</font><br> 
- Nội Dung Chuyển Khoản: <font color="red"><b><?php echo $getuser['username']; ?> Nap Tien Mua Vip</b></font ></br> 
</td></tr> 

<tr><td><center><b>BÁN THẺ 247 - BANTHE247.COM</b><br><img src="https://banthe247.com/images/logo.png"></center></td><td><b>- Tài khoản: <font color="red">vutienanh2901@gmail.com</font></b><br> 
- Tên : <font color="red">VŨ TIẾN ANH</font><br> 
- Nội Dung Chuyển Khoản: <font color="red"><b><?php echo $getuser['username']; ?> Nap Tien Mua Vip</b></font ></br> 
</td></tr> 

</tbody></table> 
      </div>   
    <div class="list-group-item"> 
<center>Nếu từ 5-10 Phút mà chưa được cộng tiền vui lòng SMS : <code>check bank <?php echo $getuser['username']; ?></code> Gửi <strong>0919257664</strong>. 
</center> 
</div> 
        </div> 
    </div> 
    </div> 

        <div class="col-md-12"> 
          <div class="box box-success"> 
            <div class="box-header"> 
              <h3 class="box-title">10 GIAO DỊCH GẦN NHẤT 
</h3> 
            </div> 
            <div class="box-body pad table-responsive"> 
     
    <div class="table-responsive"> 
        <table id="dataTable" class="table table-bordered table-striped"> 
          <thead> 
            <tr> 
              <th>Tên</th> 
              <th>Mã Thẻ</th> 
              <th>Seri</th> 
              <th>Nạp Lúc</th> 
              <th>Mệnh Giá</th> 
              <th>Loại Thẻ</th> 
            </tr> 
          </thead> 
          <tbody> 
            <?php 
$req = mysqli_query($vtasystem, "SELECT * FROM `log_card` WHERE `nguoinhan`= '".$getuser['username']."' LIMIT 10"); 
while($res = mysqli_fetch_assoc($req)){ 
?> 
            <tr> 
              <td> 
                <?php echo $res['nguoinhan']; ?> 
              </td> 
              <td> 
                <?php echo $res['mathe']; ?> 
              </td> 
              <td> 
                <?php echo $res['seri']; ?> 
              </td> 
              <td> 
                <?php echo $res['time']; ?> 
              </td> 
              <td> 
                <?php echo $res['menhgia']; ?> 
              </td> 
              <td> 
                <?php echo $res['loaithe']; ?> 
              </td> 
            </tr> 
            <?php 
} 
?> 
          </tbody> 
        </table> 
       </div> 
<div class="category"><star>*</star> Là mã dự thưởng khi có event.</div> 

</div> 
</div>   
  

<script> 
function napthe() { 
if(!$('#txtuser').val()) { 
toastr.error('Chưa nhập tên người nhận sao nhận đây', 'Thông báo lỗi'); 
}else if(!$('#code').val()) { 
toastr.error('Bạn chưa nhập mã thẻ!', 'Thông báo lỗi'); 
}else if(!$('#serial').val()) { 
toastr.error('Bạn chưa nhập mã seri!', 'Thông báo lỗi'); 
}else if(!$('#key').val()) { 
toastr.error('Chưa chọn loại thẻ!', 'Thông báo lỗi'); 
}else { 
xuly(); 
} 
} 

   function xuly(){ 
      $('#postdata').html('<i class="fa fa-spinner fa-spin"></i> Đang Xử Lý'); 
                $.ajax({ 
                    url : "../core/xt_modun/doithenhanh.php", 
                    type : "post", 
                    dateType:"text",//xong 
                    data : { 
                         txtuser : $('#txtuser').val(),  
                         code : $('#code').val(), 
                         serial : $('#serial').val(), 
                         key : $('#key').val() 
                    }, 
                    success : function (result){ 
                        $('#ketqua').html(result); 
   $('#postdata').html('Nạp Thẻ'); 
                    } 
                }); 
            } 
    function update(){ 
            var key = $("#key").val(); 
            var code = $("#code").val(); 
            var serial = $("#serial").val(); 

            $("#id-key").text(key); 
            $("#id-mathe").text(code); 
            $("#id-seri").text(serial); 

        } 
</script> 

<?php } ?>