<div class="row">
    <style type="text/css">
        .profile-user-img-vta {
            margin: 0 auto;
            /*width: 100px;*/
            
            padding: 3px;
            border: 3px solid #dd4b39;
        }
    </style>

    <div class="col-md-12">
        <div class="notice notice-danger">
            
            
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="col-md-4">
                <div class="box box-danger">
                    <div class="box-body box-profile">
                        <img class="profile-user-img-vta img-responsive img-circle vta" alt="<?php echo $this->session->userdata['logged_in']['name']; ?>" src="https://graph.facebook.com/<?php echo $this->session->userdata['logged_in']['fbid'];?>/picture?type=large">

                        <h3 class="profile-username text-center">
                <?php if($this->session->userdata['logged_in']['rule'] == 'member'){ 
                  echo '<a href="#" class="ctv"><font color="red">'.$this->session->userdata['logged_in']['name'].' </font></a>';
                }else{ 
                  echo '<a href="#" class="admin"><font color="red">'.$this->session->userdata['logged_in']['name'].'</font></a>';
                }?> - <?php if($this->session->userdata['logged_in']['rule'] == 'admin'){ 
                  echo '<img src="assets/img/admin.gif" data-toggle="tooltip" title="Bạn là Admin" alt="admin" style="width:48px" />';
                }elseif($this->session->userdata['logged_in']['rule'] == 'agency'){ 
                  echo '<span class="label label-success">Đại lí <img src="assets/img/agency.png" alt="agency" data-toggle="tooltip" title="Bạn là Đại lí" style="width:20px" /></span>';
                }elseif($this->session->userdata['logged_in']['rule'] == 'member'){
                  echo '<img src="assets/img/member.gif" data-toggle="tooltip" title="Bạn là Member thường" alt="member" style="width:48px" />';
                }else{
                echo '<font color="#3c8dbc">CTV</font> <img src="assets/img/ctv.png" alt="ctv" data-toggle="tooltip" title="Bạn là Cộng tác viên" style="width:20px" />';              
                } ?>
              <img src="assets/img/verify.png" data-toggle="tooltip" title="Tài khoản đã được Xác minh" alt="verify" style="width:16px;height:16px" />
              </h3>

                        <p class="text-muted text-center">@
                            <?php echo $this->session->userdata['logged_in']['username']; ?>
                        </p>

                        <ul class="list-group list-group-unbordered">
                            <li class="list-group-item">
                                <b>Số tiền</b> <b class="pull-right"><?php echo number_format($this->session->userdata['logged_in']['money']); ?> <sup>vnđ</sup></b>
                            </li>
                            <li class="list-group-item">
                                <b>Số ID Vip</b> <b class="pull-right"><?php echo number_format($count_like); ?> <sup>ID</sup></b>
                            </li>
                            <?php if ($this->session->userdata['logged_in']['rule']=='admin' ) { ?>
                            <li class="list-group-item">
                                <a href="listthongbao"><b>Bạn có</b> <b class="pull-right"><?php echo $count_noti; ?> <sup>noti</sup></b></a>
                            </li>
                            <?php } else if ($this->session->userdata['logged_in']['rule']=='member' ) { ?>

                            <?php } else if ($this->session->userdata['logged_in']['rule']=='agency' ) { ?>
                            <!-- <li class="list-group-item">
                  <b>Số CTV</b> <b class="pull-right"><?php echo number_format($x['numctv']); ?> <sup>user</sup></b>
                </li> -->
                        </ul>
                        <?php } else { ?>
                        <li class="list-group-item">
                           <!-- <?php echo!empty($x[ 'udaili']) ? $x[ 'udaili'] . '( ' . $x[ 'ndaili'] . ' )' : 'VTASYSTEM'; ?>-->
                        </li>
                        <?php } ?>
                        <li class="list-group-item">
                            <b>Doanh thu</b> <b class="pull-right"><?php echo number_format($this->session->userdata['logged_in']['payment']); ?> <sup>vnđ</sup></b>
                        </li>
                        <a href="#" class="btn btn-primary btn-block"><b>HAYLIKE.ONLINE</b></a>
                    </div>
                    <!-- /.box-body -->
                </div>
            </div>

            <div class="col-lg-8">
                <div class="notice notice-danger">
                    <center>
                        <b><a href="listthongbao">Bạn có <?php echo $count_noti; ?> thông báo chưa xem!</a></b>
                    </center>
                </div>
                <div class="box box-success">
                    <!-- code start -->
                    <div class="panel">
                        <header class="panel-heading">
                            <center style="font-size: 20px;">VIP LIKE </center>
                            <center style="font-size: 14px;">Tự Động Tăng Lượt Thích Các Bài Viết Mới Của Bạn.</center>
                        </header>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-xs-12">
                                    <a href="addviplike" class="btn btn-block btn-success">MUA</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="panel">
                        <header class="panel-heading">
                            <center style="font-size: 20px;">VIP CMT</center>
                            <center style="font-size: 14px;">Tự Động Tăng Bình Luận Các Bài Viết Mới Của Bạn.</center>
                        </header>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-xs-6">
                                    <a href="addcmt" class="btn btn-block btn-success">MUA</a>
                                </div>
                                <div class="col-xs-6">
                                    <a href="listcmt" class="btn btn-block btn-success">QUẢN LÍ</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="panel">
                        <header class="panel-heading">
                            <center style="font-size: 20px;">VIP BOT</center>
                            <center style="font-size: 14px;">Giúp Bạn Thả Cảm Xúc Tự Động Cho Bạn Bè.</center>
                        </header>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-xs-12">
                                    <a href="" class="btn btn-block btn-success">MUA</a>
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
                        <a href="listthongbao" class="btn btn-app">
                            <span class="badge bg-yellow"><?php echo $count_noti; ?></span>
                            <i class="fa fa-envelope"></i> Tin nhắn riêng
                        </a>
                        <a href="history" class="btn btn-app">
                            <span class="badge bg-yellow"><?php echo $count_his; ?></span>
                            <i class="fa fa-inbox"></i> Lịch sử hoạt động
                        </a>
                        <a href="hethan" class="btn btn-app">
                            <span class="badge bg-yellow"><?php echo $count_expires; ?></span>
                            <i class="fa fa-barcode"></i> Các Id sắp hết hạn
                        </a>
                        <a href="index.php?vip=GiftCode" class="btn btn-app">
                            <span class="badge bg-yellow"></span>
                            <i class="fa fa-heart-o"></i> Gift Code
                        </a>
                        <a href="updateinfoo" class="btn btn-app">
                            <span class="badge bg-yellow"></span>
                            <i class="fa fa-user"></i> Cá nhân
                        </a>
                        <a href="changepass" class="btn btn-app">
                            <span class="badge bg-yellow"></span>
                            <i class="fa fa-expeditedssl"></i> Đổi mật khẩu
                        </a>
                        <a href="napthe" class="btn btn-app">
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


<!--<div id="vtasystemnoti" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><center><strong>Thông Báo Mới</strong></center></h4>
            </div>
            <div class="modal-body">
                <span class="h4">
                            <?php 
                             if(isset($xinchao)){echo $xinchao;}
                             ?>
                        </span>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Đóng</button>
            </div>
        </div>

    </div>
</div>-->
<!-- Control Sidebar -->
                      
