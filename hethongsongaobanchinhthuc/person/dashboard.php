<div class="row">
  <style type="text/css">
    .profile-user-img-vta {
    margin: 0 auto;
    /*width: 100px;*/
    padding: 3px;
    border: 3px solid #dd4b39;
}

</style>
<?php
$xinchao = $getsetting['thongbao']; 
if ($rule == 'admin' || $rule == 'member') {
    $sql = "SELECT member.name , bill, user_name, profile, num_id, payment FROM member WHERE id_ctv = $idctv";
} else if ($rule == 'agency') {
    $sql = "SELECT * FROM member WHERE id_ctv = $idctv";
} else {
      $sql = "SELECT * FROM member  WHERE id_ctv = $idctv";
}
$result = mysqli_query($conn, $sql);
$x = mysqli_fetch_assoc($result);
?>
    <?php
if($x['bill'] <= 50000) {  
echo'<div class="col-md-12"> 
               <div class="alert alert-danger alert-dismissible"> 
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button> 
                <h4><i class="icon fa fa-ban"></i> Alert!</h4> 
                Tài Khoản Của Bạn Sắp Hết Tiền! Nạp Tiền Để Sử Dụng. <a href="/index.php?vip=Nap_The" type="button" class="btn btn-primary btn-xs">NẠP TIỀN LUÔN</a> 
              </div></div>';} 
               
              if($x['profile'] == 4) {  
                echo'<div class="col-md-12"> 
               <div class="alert alert-danger alert-dismissible"> 
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button> 
                <h4><i class="icon fa fa-ban"></i> Alert!</h4> 
                Tài Khoản Chưa Cập Nhập Thông Tin Chính Sác Vui Lòng Click <a href="index.php?vip=Change_Info" type="button" class="btn btn-success btn-xs">ĐỔI THÔNG TIN</a>! Trong Vòng 24h Không cập nhập HỆ THỐNG TỰ ĐỘNG XÓA TÀI KHOẢN CỦA BẠN! VÀ SẼ KHÔNG NHẬN ĐƯỢC TIỀN BỒI THƯỜNG! 
              </div></div>';} 
?> 
<div class="col-md-12"> 
               <div class="notice notice-danger"> 
                <?php echo $xinchao; ?></a>
              </div></div>

<div class="row"> 
<div class="col-lg-12"> 
<div class="col-md-4"> 
<div class="box box-danger">
            <div class="box-body box-profile">
              <img class="profile-user-img-vta img-responsive img-circle vta" alt="<?php echo $x['fullname']; ?>" src="https://graph.facebook.com/<?php echo $x['profile'];?>/picture?type=large">

              <h3 class="profile-username text-center">
                <?php if($rule == 'member'){ 
                  echo '<a href="#" class="ctv"><font color="red">'.$x['name'].' </font></a>';
                }else{ 
                  echo '<a href="#" class="admin"><font color="red">'.$x['name'].'</font></a>';
                }?> - <?php if($rule == 'admin'){ 
                  echo '<img src="src/admin.gif" data-toggle="tooltip" title="Bạn là Admin" alt="admin" style="width:48px" />';
                }elseif($rule == 'agency'){ 
                  echo '<span class="label label-success">Đại lí <img src="src/agency.png" alt="agency" data-toggle="tooltip" title="Bạn là Đại lí" style="width:20px" /></span>';
                }elseif($rule == 'member'){
                  echo '<img src="src/member.gif" data-toggle="tooltip" title="Bạn là Member thường" alt="member" style="width:48px" />';
                }else{
                echo '<font color="#3c8dbc">CTV</font> <img src="src/ctv.png" alt="ctv" data-toggle="tooltip" title="Bạn là Cộng tác viên" style="width:20px" />';              
                } ?>
              <img src="src/verify.png" data-toggle="tooltip" title="Tài khoản đã được Xác minh" alt="verify" style="width:16px;height:16px" />
              </h3>

              <p class="text-muted text-center">@<?php echo $uname; ?></p>

              <ul class="list-group list-group-unbordered">
                <li class="list-group-item">
                  <b>Số tiền</b> <b class="pull-right"><?php echo number_format($x['bill']); ?> <sup>vnđ</sup></b>
                </li>
                <li class="list-group-item">
                  <b>Số ID Vip</b> <b class="pull-right"><?php echo number_format($count_like); ?> <sup>ID</sup></b>
                </li>
                <?php if ($rule == 'admin') { ?>
                <li class="list-group-item">
                  <a href="/index.php?vip=Notify"><b>Bạn có</b> <b class="pull-right"><?php echo $count_noti; ?> <sup>noti</sup></b></a>
                </li>
                 <?php } else if ($rule == 'member') { ?>

                 <?php } else if ($rule == 'agency') { ?>
                <!-- <li class="list-group-item">
                  <b>Số CTV</b> <b class="pull-right"><?php echo number_format($x['numctv']); ?> <sup>user</sup></b>
                </li> -->
              </ul>
              <?php } else { ?>
              <li class="list-group-item">
                <?php echo!empty($x['udaili']) ? $x['udaili'] . '( ' . $x['ndaili'] . ' )' : 'VTASYSTEM'; ?>  
              </li> 
              <?php } ?> 
                <li class="list-group-item">
                  <b>Doanh thu</b> <b class="pull-right"><?php echo number_format($x['payment']); ?> <sup>vnđ</sup></b>
                </li>
              <a href="#" class="btn btn-primary btn-block"><b>HETHONGSONGAO.COM</b></a>
            </div>
            <!-- /.box-body -->
          </div>
</div>  

<div class="col-lg-8">
  <div class="notice notice-danger"> 
  <center>
    <b><a href="/index.php?vip=Notify">Bạn có <?php echo $count_noti; ?> noti chưa xem!</a></b>
  </center>
  </div>
<div class="box box-success"> 
<!-- code start --> 
                                            <div class="panel"> 
                                                <header class="panel-heading"><center style="font-size: 20px;">VIP LIKE </center><center style="font-size: 14px;">Tự Động Tăng Lượt Thích Các Bài Viết Mới Của Bạn.</center></header> 
                                                <div class="panel-body"> 
                                                    <div class="row"> 
                                                        <div class="col-xs-12"> 
                                                            <a href="index.php?vip=Add_VIP_Like" class="btn btn-block btn-success">MUA</a> 
                                                        </div>  
                                                    </div> 
                                                </div> 
                                            </div> 
                                            <div class="panel"> 
                                                <header class="panel-heading"><center style="font-size: 20px;">VIP CMT</center><center style="font-size: 14px;">Tự Động Tăng Bình Luận Các Bài Viết Mới Của Bạn.</center></header> 
                                                <div class="panel-body"> 
                                                    <div class="row"> 
                                                        <div class="col-xs-6"> 
                                                            <a href="index.php?vip=Add_VIP_CMT" class="btn btn-block btn-success">MUA</a> 
                                                        </div> 
                                                        <div class="col-xs-6"> 
                                                            <a href="index.php?vip=Manager_VIP_CMT" class="btn btn-block btn-success">QUẢN LÍ</a> 
                                                        </div> 
                                                    </div> 
                                                </div> 
                                            </div>
                                            <div class="panel"> 
                                                <header class="panel-heading"><center style="font-size: 20px;">VIP BOT</center><center style="font-size: 14px;">Giúp Bạn Thả Cảm Xúc Tự Động Cho Bạn Bè.</center></header> 
                                                <div class="panel-body"> 
                                                    <div class="row"> 
                                                        <div class="col-xs-12"> 
                                                            <a href="//mualike.pro" class="btn btn-block btn-success">MUA</a> 
                                                        </div> 
                                                    </div> 
                                                </div> 
                                            </div>             
</div> 
</div>

<div class="col-md-12">
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">MENU NHANH</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
            <a href="index.php?vip=Notify" class="btn btn-app">
                <span class="badge bg-yellow"><?php echo $count_noti; ?></span>
                <i class="fa fa-envelope"></i> Tin nhắn riêng
              </a>
        <a href="index.php?vip=History" class="btn btn-app">
                <span class="badge bg-yellow"><?php echo $count_his; ?></span>
                <i class="fa fa-inbox"></i> Lịch sử hoạt động
              </a>
        <a href="index.php?vip=Expires" class="btn btn-app">
                <span class="badge bg-yellow"><?php echo $count_expires; ?></span>
                <i class="fa fa-barcode"></i> Các Id sắp hết hạn
              </a>
        <a href="index.php?vip=GiftCode" class="btn btn-app">
                <span class="badge bg-yellow"></span>
                <i class="fa fa-heart-o"></i> Gift Code
              </a>
        <a href="index.php?vip=Change_Info" class="btn btn-app">
                <span class="badge bg-yellow"></span>
                <i class="fa fa-user"></i> Cá nhân
              </a>
        <a href="index.php?vip=Change_Pass" class="btn btn-app">
                <span class="badge bg-yellow"></span>
                <i class="fa fa-expeditedssl"></i> Đổi mật khẩu
              </a>
        <a href="index.php?vip=Nap_The" class="btn btn-app">
                <span class="badge bg-yellow"></span>
                <i class="fa fa-money"></i> Nạp tiền
              </a>
        <a href="#" class="btn btn-app">
                <span class="badge bg-yellow"></span>
                <i class="fa fa-users"></i> Liên hệ Admin
              </a>
        <a data-toggle="modal" href="#price" class="btn btn-app">
                <span class="badge bg-yellow"></span>
                <i class="glyphicon glyphicon-usd"></i> Bảng Giá
              </a>
            </div>
            <!-- /.box-body -->
          </div>

</div>
</div>
</div>
</div>
        <div id="vtasystemnoti" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><center><strong>Thông Báo Mới</strong></center></h4>
            </div>
            <div class="modal-body">
                        <span class="h4">
                            <?php 
                             echo $xinchao; ?>
                        </span>
            </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Đóng</button>
                    </div>
                </div>

            </div>
        </div>