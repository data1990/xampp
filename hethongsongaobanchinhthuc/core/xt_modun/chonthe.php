<?php defined('COPYRIGHT') OR exit('hihi'); 
?>
<?php
// Api config 
    $config = array(); 
    $config['PartnerID']    = 'vtasystem'; //do bên API cap
    $config['PartnerKey']   = 'vtasystem@abc'; //do bên API cap
  // Call lib
    include 'card_charging_api.php';
  
  // Call lib
  try {
    $api = new Card_charging_api($config);
  }
  catch (Card_charging_Exception $e) {
    exit($e->getMessage());
  } 
  
  //lay danh sach cac loai the dang hoat dong
  $keys = $api->get_card_keys();
  $keys = is_array($keys) ? $keys : array();
?>
<link rel="stylesheet" href="../../bootstrap/toastr.css"> 
<script type="text/javascript" src="../../bootstrap/toastr.min.js"></script> 

        <div class="col-md-6"> 
          <div class="box box-success"> 
            <div class="box-header"> 
              <h3 class="box-title">NẠP TIỀN HỆ THỐNG 
</h3> 
            </div> 
            <div class="box-body pad table-responsive"> 
  <div class="form-group">
    <label class="control-label"><font color="red">Tài khoản: </font> <star>*</star></label> 
      <input type="text" onchange="check();"  onkeyup="check();" id="user" style="width: 400px" class="form-control"  name="user" value="<?php echo isset($uname) ? $uname : ''; ?>" placeholder="Nhập chính xác tên tài khoản" data-toggle="tooltip" data-title="Nhập chính xác tên tài khoản" required <?php echo isset($uname) ? 'readonly' : ''; ?>/>
      <span id="check"></span>
  </div>

<div class="form-group"> 
<label for="rule" class="control-label">Bạn là ? (Chọn đúng)<star>*</star></label> <br>

    <?php
    if($rule == 'admin'){
    ?>
      <input type="radio" class="rule" name="rulex" value="admin" data-toggle="tooltip" data-title="Click chọn nếu bạn là admin" onchange="check()" onmouseleave="check()" <?php if(isset($rule) && $rule == 'admin') echo 'checked'; ?> required> Admin<?php if($k>0){?><code>+ <?php echo $k; ?>%</code><?php }else{ ?><code> OK </code><?php } ?><br />
    <?php }else if($rule == 'agency'){
    ?>
      <input type="radio" class="rule" name="rulex" value="agency" data-toggle="tooltip" data-title="Click chọn nếu bạn là đại lí" onchange="check()" onmouseleave="check()" <?php if(isset($rule) && $rule == 'agency') echo 'checked'; ?> required> Đại lí <?php if($k>0){?><code>+ <?php echo $k; ?>%</code><?php }else{ ?><code> OK</code><?php } ?><br />
    <?php }else if($rule == 'freelancer'){
    ?>
      <input type="radio" class="rule" name="rulex" value="freelancer" data-toggle="tooltip" data-title="Click chọn nếu bạn là cộng tác viên" onchange="check()" onmouseleave="check()" <?php if(isset($rule) && $rule == 'freelancer') echo 'checked'; ?> required> Cộng tác viên <?php if($k>0){?><code>+ <?php echo $k; ?>%</code><?php }else{ ?><code>OK</code> <?php } ?><br />
    <?php }else if($rule == 'member'){
    ?>
      <input type="radio" class="rule" name="rulex" value="member" data-toggle="tooltip" data-title="Click chọn nếu bạn là thành viên" onchange="check()" onmouseleave="check()" <?php if(isset($rule) && $rule == 'member') echo 'checked'; ?> required>Thành viên <?php if($k>0){?><code>+ <?php echo $k; ?>%</code><?php } ?>
    <?php } ?>
</div>

<div class="form-group"> 
<label class="control-label">Loại thẻ <star>*</star></label> 
                                <select class="form-control" name="key" id="key"> 
             <?php foreach ($keys as $key):?>
              <option value="<?php echo $key?>"><?php echo $key?></option>
             <?php endforeach;?>
                                </select> 
</div> 
<div class="form-group"> 
<label class="control-label">Mã thẻ <star>*</star></label> 
<input class="form-control" id="code" name="code" placeholder="Mã thẻ"/> 
</div> 
<div class="form-group"> 
<label class="control-label">Số seri <star>*</star></label> 
<input class="form-control" id="serial" name="serial" placeholder="Số seri"/> 
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

<tr><td><center><b>VIETCOMBANK</b><br><img src="data:image/png;base64,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"></center></td><td><b>- Số tài khoản: <font color="red">0021000407369</font></b><br> 
- Tên : <font color="red">NGUYEN DINH QUANG</font><br> 
- Chi nhánh: <font color="red">Chi Nhánh Hà Nội</font></br> 
- Nội Dung Chuyển Khoản: <font color="red"><b><?php echo $uname; ?> Nap Tien Mua Vip</b></font ></br> 
</td></tr> 

<tr><td><center><b>THẺ CÀO SIÊU RẺ</b><br><img src="https://thecaosieure.com/images/logo.png" height="35px" weight="32px"></center></td><td><b>- Tài khoản: <font color="red">nhianhlove</font></b><br> 
- Tên : <font color="red">VŨ TIẾN ANH</font><br> 
- Nội Dung Chuyển Khoản: <font color="red"><b><?php echo $uname; ?> Nap Tien Mua Vip</b></font ></br> 
</td></tr> 

<tr><td><center><b>BÁN THẺ 247 - BANTHE247.COM</b><br><img src="https://banthe247.com/images/logo.png"></center></td><td><b>- Tài khoản: <font color="red">vutienanh2901@gmail.com</font></b><br> 
- Tên : <font color="red">VŨ TIẾN ANH</font><br> 
- Nội Dung Chuyển Khoản: <font color="red"><b><?php echo $uname; ?> Nap Tien Mua Vip</b></font ></br> 
</td></tr> 

<tr><td><center><b>VÍ MOMO - MOMO.VN</b><br><img src="https://momo.vn/Contents/images/logo.png"></center></td><td><b>- Tài khoản: <font color="red">0919257664</font></b><br> 
- Tên : <font color="red">VŨ TIẾN ANH</font><br> 
- Nội Dung Chuyển Khoản: <font color="red"><b><?php echo $uname; ?> Nap Tien Mua Vip</b></font ></br> 
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

<script> 
function napthe() { 
if(!$('#user').val()) { 
toastr.error('Chưa nhập tên người nhận sao nhận đây', 'Thông báo lỗi'); 
}else if(!$('#code').val()) { 
toastr.error('Bạn chưa nhập mã thẻ!', 'Thông báo lỗi'); 
}else if(!$('#serial').val()) { 
toastr.error('Bạn chưa nhập mã seri!', 'Thông báo lỗi'); 
}else if(!$('#key').val()) { 
toastr.error('Chưa chọn loại thẻ!', 'Thông báo lỗi'); 
}else if(!$('#key').val()) { 
toastr.error('Chưa chọn loại thẻ!', 'Thông báo lỗi'); 
} 
xuly(); 
}  

   function xuly(){ 
      $('#postdata').html('<i class="fa fa-spinner fa-spin"></i> Đang Xử Lý'); 
                $.ajax({ 
                    url : "../core/xt_modun/doicard.php", 
                    type : "post", 
                    dateType:"text",//xong 
                    data : { 
                         user : $('#user').val(),  
                         code : $('#code').val(), 
                         serial : $('#serial').val(), 
                         key : $('#key').val(),
                         rulex : $('#rulex').val()
                    }, 
                    success : function (result){ 
                        $('#ketqua').html(result); 
                    $('#postdata').html('Nạp Thẻ'); 
                    } 
                }); 
            } 
function check(){
  if($('#user').val() != ''){
    $.get('Card/check.php', { user: $('#user').val(), rule: $('input[name=rulex]:checked').val() }, function(result){ $('#check').html(result); });
    }
  }
</script>
