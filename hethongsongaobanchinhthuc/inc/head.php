<!DOCTYPE html>
<html>
    <head>
        <!-- Meta Tag -->
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="theme-color" content="red" />
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport" />
        <title><?php echo $getsetting['title']; ?></title>
        <link rel="shortcut icon" href="<?php echo $getsetting['icon']; ?>" type="image/x-icon">
        <meta name="author" content="<?php echo $getsetting['nameadmin']; ?>">
        <meta name="copyright" content="<?php echo $getsetting['nameadmin']; ?>">
        <meta name="keywords" content="<?php echo $getsetting['keyword']; ?>">
        <meta property="og:url" content="<?php echo $site; ?><?= $_SERVER['SERVER_NAME']; ?>" />
        <meta property="og:type" content="website" />
        <meta property="og:locale" content="vi_VN" />
        <meta property="og:image" content="<?php echo $getsetting['banner']; ?>" />
        <meta name="description" content="<?php echo $getsetting['description']; ?>" />
        <script src="inc/deptrai.js"></script>
</head> 
<!-- layout-boxed -->
<body class="layout-boxed skin-red-light sidebar-mini  pace-done">
    <div class="wrapper">
        <header class="main-header">
            <a href="/" class="logo" style="border-radius: 0px;background: linear-gradient(to right, rgb(53, 92, 125), rgb(108, 91, 123));">
                <span class="logo-mini"><b>VTA</b></span>
                <span class="logo-lg"><img src="<?php echo $getsetting['logo']; ?>" alt="<?php echo $getsetting['title']; ?>"></span>
            </a>
            <nav class="navbar navbar-static-top" style="border-radius: 0px;background: linear-gradient(to right, rgb(53, 92, 125), rgb(108, 91, 123), rgb(192, 108, 132));" role="navigation">
                <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button" style="border-radius: 0px;background: linear-gradient(to right, rgb(53, 92, 125));">
                    <span class="sr-only">Toggle navigation</span>
                </a>

                      <div class="navbar-custom-menu">
                                            <?php if ($duysexy == true) {
                        ?>
        <ul class="nav navbar-nav">
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="control-sidebar">
              <img src="https://graph.facebook.com/<?php echo isset($xprofile) ? $xprofile : '4'; ?>/picture/picture?type=large" class="user-image" alt="User Image">
              <span class="hidden-xs"><b><?php echo isset($xname) ? $xname : ''; ?></b>  <i class="fa fa-sort-desc" aria-hidden="true"></i></span>
            </a>
          </li>
</ul>
                    <?php } else { ?>
        <ul class="nav navbar-nav">
                <li><a class="dropdown-toggle" id="timer"></a></li>
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="https://graph.facebook.com/<?php echo isset($xprofile) ? $xprofile : '4'; ?>/picture/picture?type=large" class="user-image" alt="User Image">
              <span class="hidden-xs"><b>CHÀO KHÁCH</b>  <i class="fa fa-sort-desc" aria-hidden="true"></i></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="https://graph.facebook.com/4/picture?type=large" class="img-circle" alt="User Image">

                <p>
                 VUI LÒNG ĐĂNG NHẬP</small>
                </p>
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="https://facebook.com/100009580369715" class="btn btn-default btn-flat">Profile</a>
                </div>
              </li>
            </ul>
          </li>
                    <!-- Control Sidebar Toggle Button -->
</ul>
                     <?php } ?>
            </div>
            </nav>
        </header>

        <!-- Sidebar Menu -->
        <aside class="main-sidebar">
            <section class="sidebar">
                <div class="user-panel wow flash" data-wow-duration="3s">
                    <div class="pull-left image">
                        <img src="https://graph.facebook.com/<?php echo isset($xprofile) ? $xprofile : '4'; ?>/picture?type=large" class="img-circle" alt="User Image">
                    </div>
                    <div class="pull-left info">
                        <p><span class="badge bg-teal"><?php echo isset($xname) ? $xname : 'Mark Zuckerberg'; ?></span> <img src="src/verify.png" alt="verify" style="width:16px;height:16px" /></p>
                        <!-- Status -->
                        <a href="<?php echo (isset($rule) && $rule == 'admin' && $idctv == 1) ? '#' : ''; ?>">
                        <span class="badge bg-red"><?php echo number_format(isset($xbill) ? $xbill : '10000000'); ?> VNĐ</span>
                       </a>
                    </div>
                </div>

                <?php if ($duysexy == false) { ?>
                    <ul class="sidebar-menu" data-widget="tree">
                        <li class="header wow fadeInLeft">DANH SÁCH MENU</li>
                        <li class="active wow flash" data-wow-duration="0.5s"><a href="/" target="_blank"><i class="fa fa-star"></i> <span style="color:red">HETHONGSONGAO.COM</span></a></li>

                        <li class="bg-green"><a style="color: #fff;background-image: url('https://zmp3-static.zadn.vn/skins/zmp3-v5.1/images/tet/backgroud_tet.png'); background-repeat: no-repeat,repeat; background-position: center;" href="https://bit.ly/SupportVTASYSTEM" target="_blank"><i class="fa fa-life-ring" aria-hidden="true"></i> <span>Hỗ Trợ Thành Viên</span></a></li>
                        <li class="wow fadeInUp" data-wow-duration="1s"><a href="index.php?vip=Login"><i class="fa fa-sign-in"></i> <span>Đăng nhập</span></a></li>
                        <li class="wow fadeInUp" data-wow-duration="1.5s"><a href="index.php?vip=Register"><i class="glyphicon glyphicon-new-window"></i> <span>Đăng kí</span></a></li>
                        <li class="wow fadeInUp" data-wow-duration="2s"><a href="index.php?vip=Recover"><i class="glyphicon glyphicon-lock"></i> <span>Quên mật khẩu?</span></a></li>
                        <li class="wow fadeInUp" data-wow-duration="2.5s"><a href="index.php?vip=Nap_The"><i class="glyphicon glyphicon-shopping-cart"></i> <span>Thanh toán</span></a></li>
                        <li class="wow fadeInUp" data-wow-duration="3s"><a data-toggle="modal" href="#price"><i class="glyphicon glyphicon-usd" id="showModal"></i> <span>Bảng giá</span></a></li>
                        <li class="wow fadeInUp" data-wow-duration="3.5s"><a href="index.php?vip=List"><i class="glyphicon glyphicon-list-alt"></i> <span>Quản trị viên / Đại lí</span></a></li>
                        <li class="wow fadeInUp" data-wow-duration="2.25s"><a href="#vtasystemnoti" id="warning" data-toggle="modal"><i class="glyphicon glyphicon-star-empty"></i> <span>Thông Báo Mới</span></a></li>
                        <li class="wow fadeInUp" data-wow-duration="2.25s"><a href="index.php?vip=Top"><i class="fa fa-line-chart text-red"></i> <span>TOP DOANH THU</span></a></li>

                        <!--<li class="wow fadeInUp" data-wow-duration="4s"><a href="index.php?vip=Get_Token"><i class="glyphicon glyphicon-retweet"></i> <span>Get Access Token</span></a></li>-->
                        <!--<li class="wow fadeInUp" data-wow-duration="4s"><a href="index.php?vip=Check_Token"><i class="glyphicon glyphicon-transfer"></i> <span>Check Access Token</span></a></li>-->
                    </ul>
                    <?php
                } else {
                    if ($rule == 'freelancer' || $rule == 'member') {
                        ?>
                        <ul class="sidebar-menu" data-widget="tree">
                            <li class="active Home wow wobble" style="visibility: visible; animation-name: wobble;"><a href="/"><i class="fa fa-home" style="color: #00a65a;"></i> <span>TRANG CHỦ</span></a></li>
                            <li class="wow fadeInUp" data-wow-duration="2.25s"><a href="#vtasystemnoti" id="warning" data-toggle="modal"><i class="glyphicon glyphicon-star-empty"></i> <span>Thông Báo Mới</span></a></li>
                        <li class="wow fadeInUp" data-wow-duration="2.25s"><a href="index.php?vip=Top"><i class="fa fa-line-chart text-red"></i> <span>TOP DOANH THU</span></a></li>


                            <li class="header">DANH SÁCH MENU</li>

                            <li><a href="index.php?vip=Nap_The"><i class="glyphicon glyphicon-usd"></i> <span>Nạp tiền</span></a></li>
                            <li class="bg-green"><a style="color: #fff;background-image: url('https://zmp3-static.zadn.vn/skins/zmp3-v5.1/images/tet/backgroud_tet.png'); background-repeat: no-repeat,repeat; background-position: center;" href="https://bit.ly/SupportVTASYSTEM" target="_blank"><i class="fa fa-life-ring" aria-hidden="true"></i> <span>Hỗ Trợ Thành Viên</span></a></li>
                            <!--li><a href="index.php?vip=Event"><i class="glyphicon glyphicon-usd"></i> <span>Vòng quay may mắn</span></a></li-->
                            <li><a href="index.php?vip=Add_VIP_Like"><i class="fa fa-thumbs-o-up"></i> <span>VIP Cảm Xúc</span>                      <span class="pull-right-container"><span class="label label-info"><?php echo $count_like + $count_like2; ?></span></span></a></li>
                            <li class="treeview">
                                <a href="#"><i class="fa fa-comments"></i> <span>VIP COMMENT</span>
                                    <span class="pull-right-container">
                                        <span class="label label-success"><?php echo $count_cmt; ?></span>
                                    </span>
                                </a>
                                <ul class="treeview-menu">
                                    <li><a href="index.php?vip=Add_VIP_CMT"><i class="glyphicon glyphicon-asterisk"></i> Thêm VIP CMT</a></li>
                                    <li><a href="index.php?vip=Manager_VIP_CMT"><i class="glyphicon glyphicon-asterisk"></i> Quản Lí VIP CMT</a></li>
                                </ul>
                            </li>
                            <li class="treeview">
                                <a href="#"><i class="fa fa-heartbeat"></i> <span>VIP BOT Cảm Xúc</span>
                                    <span class="pull-right-container">
                                        <span class="label label-warning"><?php echo $count_reaction; ?></span>
                                    </span>
                                </a>
                                <ul class="treeview-menu">
                                    <li><a href="//mualike.pro"><i class="glyphicon glyphicon-asterisk"></i> Thêm VIP REACTION</a></li>
                                    <li><a href="index.php?vip=Manager_VIP_Reaction"><i class="glyphicon glyphicon-asterisk"></i> Quản Lí VIP REACTION</a></li>
                                </ul>
                            </li>
                            <li><a href="index.php?vip=Expires"><i class="glyphicon glyphicon-off"></i> <span>VIP ID Sắp Hết Hạn</span><span class="pull-right-container"> <span class="label label-danger"><?php echo $count_expires; ?></span></span></a></li>
                            <li class="header">#MEMBER PANEL</li>
                            <li><a href="index.php?vip=Nap_The"><i class="glyphicon glyphicon-gift"></i> <span>Nạp Tiền</span></a></li>

                            <li><a href="index.php?vip=GiftCode"><i class="glyphicon glyphicon-gift"></i> <span>GIFT CODE</span></a></li>
                   <li><a href="index.php?vip=History"><i class="glyphicon glyphicon-retweet"></i> <span>Lịch sử hoạt động</span> <span class="pull-right-container"><span class="label label-warning"><?php echo $count_his; ?></span></span></a></li>
                            <li class="treeview">
                                <a href="#"><i class="glyphicon glyphicon-wrench"></i> <span>Cá nhân </span>
                                    <span class="pull-right-container">
                                        <i class="fa fa-angle-left pull-right"></i>
                                    </span>
                                </a>
                                <ul class="treeview-menu">
                                    <li><a href="index.php?vip=Change_Info"><i class="glyphicon glyphicon-asterisk"></i> Cập nhật thông tin</a></li>
                                    <li><a href="index.php?vip=Change_Pass"><i class="glyphicon glyphicon-asterisk"></i> Đổi mật khẩu</a></li>
                                    <li><a href="index.php?vip=Nap_The"><i class="glyphicon glyphicon-asterisk"></i> Nạp tiền</a></li>
                                </ul>
                            </li>

                        </ul>

                    <?php } else if ($rule == 'agency') { ?>

                        <ul class="sidebar-menu" data-widget="tree">
                            <li class="active Home wow wobble" style="visibility: visible; animation-name: wobble;"><a href="/"><i class="fa fa-home" style="color: #00a65a;"></i> <span>TRANG CHỦ</span></a></li>
                            <li class="wow fadeInUp" data-wow-duration="2.25s"><a href="#vtasystemnoti" id="warning" data-toggle="modal"><i class="glyphicon glyphicon-star-empty"></i> <span>Thông Báo Mới</span></a></li>
                        <li class="wow fadeInUp" data-wow-duration="2.25s"><a href="index.php?vip=Top"><i class="fa fa-line-chart text-red"></i> <span>TOP DOANH THU</span></a></li>


                            <li class="header">DANH SÁCH MENU</li>

                            <li><a href="index.php?vip=Nap_The"><i class="glyphicon glyphicon-usd"></i> <span>Nạp tiền</span></a></li>
                            <li class="bg-green"><a style="color: #fff;background-image: url('https://zmp3-static.zadn.vn/skins/zmp3-v5.1/images/tet/backgroud_tet.png'); background-repeat: no-repeat,repeat; background-position: center;" href="https://bit.ly/SupportVTASYSTEM" target="_blank"><i class="fa fa-life-ring" aria-hidden="true"></i> <span>Hỗ Trợ Thành Viên</span></a></li>
                            <li><a href="index.php?vip=Add_VIP_Like"><i class="fa fa-thumbs-o-up"></i> <span>VIP Cảm Xúc</span>                      <span class="pull-right-container"><span class="label label-info"><?php echo $count_like + $count_like2; ?></span></span></a></li>
                            <li class="treeview">
                                <a href="#"><i class="fa fa-comments"></i> <span>VIP COMMENT</span> 
                                    <span class="pull-right-container">
                                        <span class="label label-success"><?php echo $count_cmt; ?></span>
                                    </span>
                                </a>
                                <ul class="treeview-menu">
                                    <li><a href="index.php?vip=Add_VIP_CMT"><i class="glyphicon glyphicon-asterisk"></i> Thêm VIP CMT</a></li>
                                    <li><a href="index.php?vip=Manager_VIP_CMT"><i class="glyphicon glyphicon-asterisk"></i> Quản Lí VIP CMT</a></li>
                                </ul>
                            </li>
                            <li class="treeview">
                                <a href="#"><i class="fa fa-heartbeat"></i> <span>VIP BOT Cảm Xúc</span>
                                    <span class="pull-right-container">
                                        <span class="label label-warning"><?php echo $count_reaction; ?></span>
                                    </span>
                                </a>
                                <ul class="treeview-menu">
                                    <li><a href="//mualike.pro"><i class="glyphicon glyphicon-asterisk"></i> Thêm VIP REACTION</a></li>
                                    <li><a href="index.php?vip=Manager_VIP_Reaction"><i class="glyphicon glyphicon-asterisk"></i> Quản Lí VIP REACTION</a></li>
                                </ul>
                            </li>
                            <li><a href="index.php?vip=Expires"><i class="glyphicon glyphicon-off"></i> <span>VIP ID Sắp Hết Hạn</span><span class="pull-right-container"> <span class="label label-danger"><?php echo $count_expires; ?></span></span></a></li>
                            <li class="header">#AGENCY PANEL</li>
                            <li class="treeview">
                                <a href="#"><i class="glyphicon glyphicon-user"></i> <span>Quản lí CTV </span>
                                    <span class="pull-right-container">
                                        <span class="label label-success"><?php echo $count_ctv; ?></span>
                                    </span>
                                </a>
                                <ul class="treeview-menu">
                                    <li><a href="index.php?vip=Add_CTV"><i class="glyphicon glyphicon-asterisk"></i> Tạo tài khoản CTV</a></li>
                                    <li><a href="index.php?vip=List_CTV"><i class="glyphicon glyphicon-asterisk"></i> Danh sách CTV</a></li>
                                    <li><a href="index.php?vip=Transfer_Money"><i class="glyphicon glyphicon-asterisk"></i> Chuyển tiền</a></li>
                                </ul>
                            </li>
                            <li class="treeview">
                                <a href="#"><i class="glyphicon glyphicon-gift"></i> <span>Quản Lí GIFT CODE</span>
                                    <span class="pull-right-container">
                                        <span class="label label-info"><?php echo $count_gift; ?></span>
                                    </span>
                                </a>
                                <ul class="treeview-menu">
                                    <li><a href="index.php?vip=Add_GiftCode"><i class="glyphicon glyphicon-asterisk"></i> Thêm Gift Code</a></li>
                                    <li><a href="index.php?vip=Manager_GiftCode"><i class="glyphicon glyphicon-asterisk"></i> Quản Lí Gift Code</a></li>
                                </ul>
                            </li>
                            <li class="header">#MEMBER PANEL</li>
                            <li><a href="index.php?vip=Nap_The"><i class="glyphicon glyphicon-gift"></i> <span>Nạp Tiền</span></a></li>

                            <li><a href="index.php?vip=History"><i class="glyphicon glyphicon-retweet"></i> <span>Lịch sử hoạt động</span>
                                    <span class="pull-right-container"><span class="label label-warning"><?php echo $count_his; ?>
                                        </span></span></a></li>
                            <li class="treeview">
                                <a href="#"><i class="glyphicon glyphicon-wrench"></i> <span>Cá nhân </span>
                                    <span class="pull-right-container">
                                        <i class="fa fa-angle-left pull-right"></i>
                                    </span>
                                </a>
                                <ul class="treeview-menu">
                                    <li><a href="index.php?vip=Change_Info"><i class="glyphicon glyphicon-asterisk"></i> Cập nhật thông tin</a></li>
                                    <li><a href="index.php?vip=Change_Pass"><i class="glyphicon glyphicon-asterisk"></i> Đổi mật khẩu</a></li>
                                    <li><a href="index.php?vip=Nap_The"><i class="glyphicon glyphicon-asterisk"></i> Nạp tiền</a></li>
                                </ul>
                            </li>

                        </ul>

                    <?php } else if ($rule == 'admin') { ?>
                        <ul class="sidebar-menu" data-widget="tree">
                            <li class="active Home wow wobble" style="visibility: visible; animation-name: wobble;"><a href="/"><i class="fa fa-home" style="color: #00a65a;"></i> <span>TRANG CHỦ</span></a></li>
                            <li class="wow fadeInUp" data-wow-duration="2.25s"><a href="#vtasystemnoti" id="warning" data-toggle="modal"><i class="glyphicon glyphicon-star-empty"></i> <span>Thông Báo Mới</span></a></li>
                        <li class="wow fadeInUp" data-wow-duration="2.25s"><a href="index.php?vip=Top"><i class="fa fa-line-chart text-red"></i> <span>TOP DOANH THU</span></a></li>


                            <li class="header">DANH SÁCH MENU</li>
                            <li><a href="index.php?vip=Add_VIP_Like"><i class="fa fa-thumbs-o-up"></i> <span>VIP Cảm Xúc</span>                      <span class="pull-right-container"><span class="label label-info"><?php echo $count_like + $count_like2; ?></span></span></a></li>
                            <li class="treeview">
                                <a href="#"><i class="fa fa-comments"></i> <span>VIP COMMENT</span>
                                    <span class="pull-right-container">
                                        <span class="label label-success"><?php echo $count_cmt; ?></span>
                                    </span>
                                </a>
                                <ul class="treeview-menu">
                                    <li><a href="index.php?vip=Add_VIP_CMT"><i class="glyphicon glyphicon-asterisk"></i> Thêm VIP CMT</a></li>
                                    <li><a href="index.php?vip=Manager_VIP_CMT"><i class="glyphicon glyphicon-asterisk"></i> Quản Lí VIP CMT</a></li>
                                </ul>
                            </li>
                            <li class="treeview">
                                <a href="#"><i class="fa fa-heartbeat"></i> <span>VIP BOT Cảm Xúc</span>
                                    <span class="pull-right-container">
                                        <span class="label label-warning"><?php echo $count_reaction; ?></span>
                                    </span>
                                </a>
                                <ul class="treeview-menu">
                                    <li><a href="//mualike.pro"><i class="glyphicon glyphicon-asterisk"></i> Thêm VIP REACTION</a></li>
                                    <li><a href="index.php?vip=Manager_VIP_Reaction"><i class="glyphicon glyphicon-asterisk"></i> Quản Lí VIP REACTION</a></li>
                                </ul>
                            </li>
                            <li class="treeview">
                                <a href="#"><i class="glyphicon glyphicon-off"></i> <span>VIP ID Sắp Hết Hạn</span>
                                    <span class="pull-right-container">
                                        <span class="label label-danger"><?php echo $count_expires; ?></span>
                                    </span>
                                </a>
                                <ul class="treeview-menu">
                                    <li><a href="index.php?vip=Expires"><i class="glyphicon glyphicon-asterisk"></i> Danh sách</a></li>
                                    <?php if ($idctv == 1) { ?>
                                        <li><a href="index.php?vip=Del_Expires"><i class="glyphicon glyphicon-asterisk"></i> Xóa VIP ID Hết Hạn</a></li>
                                    <?php } ?>
                                </ul>
                            </li>
                            <li><a href="index.php?vip=Nap_The"><i class="glyphicon glyphicon-usd"></i> <span>Nạp tiền</span></a></li>
                            <li class="header">#ADMIN PANEL</li>
                            <li class="treeview">
                                <a href="#"><i class="glyphicon glyphicon-gift"></i> <span>Quản Lí GIFT CODE</span>
                                    <span class="pull-right-container">
                                        <span class="label label-success"><?php echo $count_gift; ?></span>
                                    </span>
                                </a>
                                <ul class="treeview-menu">
                                    <li><a href="index.php?vip=Add_GiftCode"><i class="glyphicon glyphicon-asterisk"></i> Thêm Gift Code</a></li>
                                    <li><a href="index.php?vip=Manager_GiftCode"><i class="glyphicon glyphicon-asterisk"></i> Quản Lí Gift Code</a></li>
                                </ul>
                            </li>
                            <li class="treeview">
                                <a href="#"><i class="glyphicon glyphicon-gift"></i> <span>Quản Lí Coupon</span>
                                    <span class="pull-right-container">
                                        <span class="label label-success"><?php echo $count_cou; ?></span>
                                    </span>
                                </a>
                                <ul class="treeview-menu">
                                    <li><a href="index.php?vip=Add_Coupon"><i class="glyphicon glyphicon-asterisk"></i> Thêm Coupon</a></li>
                                    <li><a href="index.php?vip=List_Coupon"><i class="glyphicon glyphicon-asterisk"></i> Quản Lí Coupon</a></li>
                                </ul>
                            </li>
                            <li><a href="index.php?vip=History"><i class="glyphicon glyphicon-retweet"></i> <span>Quản lí Lịch sử </span> <span class="pull-right-container"><span class="label label-warning"><?php echo $count_his; ?></span></span></a></li>

                            <li class="treeview">
                                <a href="#"><i class="glyphicon glyphicon-list-alt"></i> <span>Quản lí Đại Lí</span>
                                    <span class="pull-right-container">
                                        <span class="label label-info"><?php echo $count_agency; ?></span>
                                    </span>
                                </a>
                                <ul class="treeview-menu">
                                    <li><a href="index.php?vip=Add_Agency"><i class="glyphicon glyphicon-asterisk"></i> Tạo tài khoản Đại Lí</a></li>
                                    <li><a href="index.php?vip=List_Agency"><i class="glyphicon glyphicon-asterisk"></i> <span>Danh sách Đại Lí</span></a></li>
                                </ul>
                            </li>
                            <li class="treeview">
                                <a href="#"><i class="glyphicon glyphicon-globe"></i> <span>Quản lí CTV </span>
                                    <span class="pull-right-container">
                                        <span class="label label-success"><?php echo $count_ctv; ?></span>
                                    </span>
                                </a>
                                <ul class="treeview-menu">
                                    <li><a href="index.php?vip=Add_CTV"><i class="glyphicon glyphicon-asterisk"></i> Tạo tài khoản CTV</a></li>
                                    <li><a href="index.php?vip=List_CTV"><i class="glyphicon glyphicon-asterisk"></i> <span>Danh sách CTV</span></a></li>

                                </ul>
                            </li>

                            <li><a href="index.php?vip=List_Member"><i class="glyphicon glyphicon-user"></i> <span>Quản lí Member</span> <span class="pull-right-container"><span class="label label-danger"><?php echo $count_member; ?></span></span></a></li>
                            <li class="treeview">
                                <a href="#"><i class="glyphicon glyphicon-random"></i> <span>Giao dịch </span>
                                    <span class="pull-right-container">
                                        <i class="fa fa-angle-left pull-right"></i>
                                    </span>
                                </a>
                                <ul class="treeview-menu">
                                    <?php if ($idctv == 1) { ?><li><a href="index.php?vip=Add_Money"><i class="glyphicon glyphicon-asterisk"></i> Cộng tiền</a></li> <li><a href="index.php?vip=Change_Money"><i class="glyphicon glyphicon-asterisk"></i> Cập nhật tiền</a></li><?php } ?>
                                    <?php if ($idctv == 1 || $idctv == 359) { ?><li><a href="index.php?vip=Transfer_Money"><i class="glyphicon glyphicon-asterisk"></i> Chuyển tiền</a></li> <?php } ?>

                                </ul>
                            </li>


                            <?php if ($idctv == 1) { ?>
                                <li class="treeview">
                                    <a href="#">
                                        <i class="glyphicon glyphicon-hdd"></i> <span>Quản lí package</span>
                                        <span class="pull-right-container">
                                            <i class="fa fa-angle-left pull-right"></i>
                                        </span>
                                    </a>

                                    <ul class="treeview-menu">

                                        <li class="treeview">
                                            <a href="#"><i class="fa fa-circle-o"></i>Package VIP Cảm Xúc
                                                <span class="pull-right-container">
                                                    <i class="fa fa-angle-left pull-right"></i>
                                                </span>
                                            </a>
                                            <ul class="treeview-menu">
                                                <li><a href="index.php?vip=Add_Package_Like"><i class="glyphicon glyphicon-asterisk"></i> Thêm Package</a></li>
                                                <li><a href="index.php?vip=List_Package_Like"><i class="glyphicon glyphicon-asterisk"></i> Danh sách Package</a></li>
                                            </ul>
                                        </li>

                                        <li class="treeview">
                                            <a href="#"><i class="fa fa-circle-o"></i> Package VIP CMT
                                                <span class="pull-right-container">
                                                    <i class="fa fa-angle-left pull-right"></i>
                                                </span>
                                            </a>
                                            <ul class="treeview-menu">
                                                <li><a href="index.php?vip=Add_Package_CMT"><i class="glyphicon glyphicon-asterisk"></i> Thêm Package</a></li>
                                                <li><a href="index.php?vip=List_Package_CMT"><i class="glyphicon glyphicon-asterisk"></i> Danh sách Package</a></li>
                                            </ul>
                                        </li>

                                        <li class="treeview">
                                            <a href="#"><i class="fa fa-circle-o"></i> Package VIP Share
                                                <span class="pull-right-container">
                                                    <i class="fa fa-angle-left pull-right"></i>
                                                </span>
                                            </a>
                                            <ul class="treeview-menu">
                                                <li><a href="index.php?vip=Add_Package_Share"><i class="glyphicon glyphicon-asterisk"></i> Thêm Package</a></li>
                                                <li><a href="index.php?vip=List_Package_Share"><i class="glyphicon glyphicon-asterisk"></i> Danh sách Package</a></li>
                                            </ul>
                                        </li>

                                        <li class="treeview">
                                            <a href="#"><i class="fa fa-circle-o"></i> Package VIP Bot Reaction
                                                <span class="pull-right-container">
                                                    <i class="fa fa-angle-left pull-right"></i>
                                                </span>
                                            </a>
                                            <ul class="treeview-menu">
                                                <li><a href="index.php?vip=Add_Package_Reaction"><i class="glyphicon glyphicon-asterisk"></i> Thêm Package</a></li>
                                                <li><a href="index.php?vip=List_Package_Reaction"><i class="glyphicon glyphicon-asterisk"></i> Danh sách Package</a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </li>

                            <?php } ?>
                            <li class="treeview">
                                <a href="#"><i class="glyphicon glyphicon-wrench"></i> <span>Cá nhân </span>
                                    <span class="pull-right-container">
                                        <i class="fa fa-angle-left pull-right"></i>
                                    </span>
                                </a>
                                <ul class="treeview-menu">
                                    <li><a href="index.php?vip=Change_Info"><i class="glyphicon glyphicon-asterisk"></i> Cập nhật thông tin</a></li>
                                    <li><a href="index.php?vip=Change_Pass"><i class="glyphicon glyphicon-asterisk"></i> Đổi mật khẩu</a></li>

                                </ul>
                            </li>
                            <?php if ($idctv == 1) { ?>
                            <li class="treeview">
                                <a href="#"><i class="glyphicon glyphicon-wrench"></i> <span>Token Management</span>
                                    <span class="pull-right-container">
                                        <i class="fa fa-angle-left pull-right"></i>
                                    </span>
                                </a>
                                <ul class="treeview-menu">
                                    <li><a href="index.php?vip=Add_Token_VTA"><i class="glyphicon glyphicon-asterisk"></i> Thêm token</a></li>
                                    <li><a href="index.php?vip=Del_Token_VTA"><i class="glyphicon glyphicon-asterisk"></i> Xóa token die</a></li>

                                </ul>
                            </li>
                            <li><a href="index.php?vip=Setting"><i class="glyphicon glyphicon-bell"></i> <span>SETTING</span></a></li>
                            <?php } ?>    
                        </ul>
                        <?php
                    }
                }
                ?>
            </section>
        </aside>
                <div class="content-wrapper" style="padding:5px">
