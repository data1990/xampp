<?php
ob_start();
session_start();
define('COPYRIGHT', 'VTADEPTRAI');
date_default_timezone_set('Asia/Ho_Chi_Minh');
include '_config.php';
include 'Mailer/PHPMailerAutoload.php';
include 'login/function/active.php';
if(strpos($_SERVER['QUERY_STRING'], '=')){
$pattern = '#=(.*)#';
$str = $_SERVER['QUERY_STRING'];
preg_match($pattern, $str, $matches);
if(strpos($matches[1], '%27') === false){
// todo something
}else{
echo "<script>alert('Tuổi lồn nhé');window.location='http://xvideos.com';</script>";
}
}
$hour = date("G");
$duysexy = false;
if (isset($_SESSION['login']) && $_SESSION['login'] == 'ok') {
    $duysexy = true;
    $idctv = $_SESSION['id_ctv'];
    $rule = $_SESSION['rule'];
    $uname = $_SESSION['user_name'];
    $upass = $_SESSION['pass'];
    $ustatus = $_SESSION['status'];
    $get_info = '';
    $get_info = mysqli_query($conn, "SELECT name, email, bill, user_name,profile,baomat FROM member WHERE id_ctv = $idctv");
    // save session information user
    $info_user = mysqli_fetch_assoc($get_info);
    $xname = $info_user['name'];
    $xemail = $info_user['email'];
    $xbill = $info_user['bill'];
    $xprofile = $info_user['profile'];
    $baomat = $info_user['baomat'];
    // counting notify, history
    $get_his = '';
    $get_noti = '';
    $count_noti = '';
    if ($rule != 'admin') {
        $get_his = mysqli_query($conn, "SELECT COUNT(history.id) FROM history WHERE id_ctv=$idctv");
        $get_noti = mysqli_query($conn, "SELECT COUNT(noti.id) FROM noti WHERE id_ctv = $idctv AND status = 0");
    } else if ($rule == 'admin' && $idctv != 1) {
        $get_his = mysqli_query($conn, "SELECT COUNT(history.id) FROM history WHERE id_ctv != 1 AND id_ctv > 0");
        $get_noti = mysqli_query($conn, 'SELECT COUNT(noti.id) FROM noti WHERE id_ctv != 1 AND id_ctv > 0');
    } else if ($rule == 'admin' && $idctv == 1) {
        $get_his = mysqli_query($conn, "SELECT COUNT(history.id) FROM history");
        $get_noti = mysqli_query($conn, 'SELECT COUNT(noti.id) FROM noti');
    }
    include 'inc/counting.php';
}
$site = stripos($_SERVER['SERVER_PROTOCOL'],'https') === true ? 'https://' : 'http://';

?>
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
        
<script>
  window.fbAsyncInit = function() {
    FB.init({
      appId      : '594675477573359',
      cookie     : true,
      xfbml      : true,
      version    : 'v2.9'
    });
      
    FB.AppEvents.logPageView();   
      
  };

  (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "https://connect.facebook.net/en_US/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));
</script>
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
                            <li>
                               <a href="//mualike.pro" target="_blank"><i class="fa fa-heartbeat"></i> <span>VIP BOT Cảm Xúc</span>
                                </a>
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
                            <li>
                               <a href="//mualike.pro" target="_blank"><i class="fa fa-heartbeat"></i> <span>VIP BOT Cảm Xúc</span>
                                </a>
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
                            <li class="treeview">
                                <a href="#"><i class="glyphicon glyphicon-bell"></i> <span>Quản lí thông báo </span>
                                    <span class="pull-right-container">
                                        <span class="label label-danger"><?php echo $count_noti; ?></span>
                                    </span>
                                </a>
                                <ul class="treeview-menu">
                                    <li><a href="index.php?vip=Send_Notify"><i class="glyphicon glyphicon-asterisk"></i> Gửi thông báo</a></li>
                                    <li><a href="index.php?vip=Notify"><i class="glyphicon glyphicon-asterisk"></i> Danh sách Thông báo</a></li>
                                </ul>
                            </li>                            <li class="header">#MEMBER PANEL</li>
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
                            <li>
                               <a href="//mualike.pro" target="_blank"><i class="fa fa-heartbeat"></i> <span>VIP BOT Cảm Xúc</span>
                                </a>
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

                            <li class="treeview">
                                <a href="#"><i class="glyphicon glyphicon-bell"></i> <span>Quản lí thông báo </span>
                                    <span class="pull-right-container">
                                        <span class="label label-danger"><?php echo $count_noti; ?></span>
                                    </span>
                                </a>
                                <ul class="treeview-menu">
                                    <li><a href="index.php?vip=Send_Notify"><i class="glyphicon glyphicon-asterisk"></i> Gửi thông báo</a></li>
                                    <li><a href="index.php?vip=Notify"><i class="glyphicon glyphicon-asterisk"></i> Danh sách Thông báo</a></li>
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
           
            
            <?php
            if (isset($_REQUEST['vip'])) {
                $DuySexy = $_REQUEST['vip'];
                if ($duysexy == false) {
                    switch ($DuySexy) {
                        // Account Handle
                        case 'Login':
                            include 'login/index.php';
                            break;
                        case 'Register':
                            include 'login/register.php';
                            break;
                        case 'Confirm':
                            include 'login/confirm.php';
                            break;
                        case 'Recover':
                            include 'login/recover.php';
                            break;
                        case 'Charge_Money':
                        include 'core/xt_modun/chonthe3.php';
                            // include 'person/billing.php';
                            break;
                        case 'Check_Token':
                            include 'core/TokenVTA/check.php';
                            break;
                        case 'Get_Token':
                            include 'person/get_token.php';
                            break;
                        case 'ResendEmail':
                            include 'login/resend.php';
                            break;
                        // case 'NapThe':
                        //     include 'Card/transaction.php';
                        //     break;
                        case 'List':
                            include 'core/Admin/list.php';
                            break;
                        // login ctv
                        case 'Login_CTV':
                            include 'login/ctv.php';
                            break;
                        default:
                            echo "<script>alert('Hình như có cái gì sai sai ấy!!'); window.location='index.php';</script>";
                            break;
                        case 'Nap_The':
                            include 'core/xt_modun/loi.php';
                        break;


                    }
                }else{
                    switch ($DuySexy) {


                    case 'Xac_Nhan':
                        include 'core/Admin/xacnhan.php';
                    break;   
                        case 'Nap_The':
                            include 'core/xt_modun/loi.php';
                        break;
                        case 'Bat-Khien':
                            include 'core/tools/batkhien.php';
                            break;
                        case 'Top':
                            include 'core/tools/topdoanhthu.php';
                            break;
                        // Account Handle
                        case 'Get_Token_Clone':
                            include 'core/TokenVTA/Clone/index.php';
                            break;
                        case 'Loc_Token':
                            include 'core/TokenVTA/loc.html';
                            break;
                        case 'Confirm':
                            echo "<script>alert('Vui lòng đăng xuất trước khi kích hoạt'); window.location='index.php';</script>";
                            break;
                        case 'ResendEmail':
                            echo "<script>alert('Vui lòng đăng xuất!!); window.location='index.php';</script>";
                            break;
                        case 'Charge_Money':
                            // include 'person/billing.php';
                            include 'core/xt_modun/chonthe3.php';
                            break;
                        case 'Change_Pass':
                            include 'person/change_pass.php';
                            break;
                        case 'Get_Token':
                            include 'person/get_token.php';
                            break;
                        case 'Change_Info':
                            include 'person/change_info.php';
                            break;
                     //       //VIP Share
                     //        case 'Add_VIP_Share':
                     //            include 'core/VIP/Share/add.php';
                     //            break;
                     //        case 'Manager_VIP_Share':
                     //            include 'core/VIP/Share/list.php';
                     //            break;
                     //        case 'Extending_Share':
                     //            include 'core/VIP/Share/extend.php';
                     //            break;
                     //        case 'Update_Share':
                     //            include 'core/VIP/Share/update.php';
                     //            break;
                     //        case 'Delete_Share';
                     //            include 'core/VIP/Share/del.php';
                     //            break;
                        //VIP Buff
	                    case 'Add_Buzz_Like':
		                    include 'core/VIP/Buzz/Like/add.php';
		                    break;
	                    case 'Update_Buzz_Like';
		                    include 'core/VIP/Buzz/Like/update.php';
		                    break;
	                    case 'Delete_Buzz_Like':
		                    include 'core/VIP/Buzz/Like/del.php';
		                    break;
	                    case 'List_Buzz_Like';
		                    include 'core/VIP/Buzz/Like/list.php';
		                    break;

	                    // // VIP Post CMT
	                    // case 'Add_Buzz_CMT':
		                   //  include 'core/VIP/Buzz/CMT/add.php';
		                   //  break;
	                    // case 'Update_Buzz_CMT';
		                   //  include 'core/VIP/Buzz/CMT/update.php';
		                   //  break;
	                    // case 'Delete_Buzz_CMT':
		                   //  include 'core/VIP/Buzz/CMT/del.php';
		                   //  break;
	                    // case 'List_Buzz_CMT';
		                   //  include 'core/VIP/Buzz/CMT/list.php';
		                   //  break;
                        //VIP LIKE
                        case 'Add_VIP_Like':
                            include 'core/VIP/VIPCAMXUC/menu.php';
                            break;
                        case 'Manager_VIP_Like':
                            include 'core/VIP/VIPCAMXUC/menu.php';
                            break;
                        case 'Buy_Post':
                            include 'core/VIP/VIPCAMXUC/buypost.php';
                            break;

                        case 'Add_VIP_Like_SV1':
                            include 'core/VIP/VIPCAMXUC/LIKESV1/add.php';
                            break;
                        case 'Manager_VIP_Like_SV1':
                            include 'core/VIP/VIPCAMXUC/LIKESV1/list.php';
                            break;
                        case 'Extending_Like_SV1':
                            include 'core/VIP/VIPCAMXUC/LIKESV1/extend.php';
                            break;
                        case 'Update_Like_SV1':
                            include 'core/VIP/VIPCAMXUC/LIKESV1/update.php';
                            break;
                        case 'Delete_Like_SV1';
                            include 'core/VIP/VIPCAMXUC/LIKESV1/del.php';
                            break;

                        //VIP LIKE 2
                        case 'Add_VIP_Like_SV2':
                            include 'core/VIP/VIPCAMXUC/LIKESV2/add.php';
                            break;
                        case 'Manager_VIP_Like_SV2':
                            include 'core/VIP/VIPCAMXUC/LIKESV2/list.php';
                            break;
                        case 'Extending_Like_SV2':
                            include 'core/VIP/VIPCAMXUC/LIKESV2/extend.php';
                            break;
                        case 'Update_Like_SV2':
                            include 'core/VIP/VIPCAMXUC/LIKESV2/update.php';
                            break;
                        case 'Delete_Like_SV2';
                            include 'core/VIP/VIPCAMXUC/LIKESV2/del.php';
                            break;


                        // VIP CMT
                        case 'Add_VIP_CMT':
                            include 'core/VIP/CMT/add.php';
                            break;
                        case 'Delete_CMT':
                            include 'core/VIP/CMT/del.php';
                            break;
                        case 'Update_CMT':
                            include 'core/VIP/CMT/update.php';
                            break;
                        case 'Manager_VIP_CMT':
                            include 'core/VIP/CMT/list.php';
                            break;
                        // case 'Extending_CMT':
                        //     include 'core/VIP/CMT/extend.php';
                        //     break;

                        //VIP BOT Reaction

                        // case 'Add_VIP_Reaction':
                        //     include 'core/VIP/Reaction/add.php';
                        //     break;
                        // case 'Delete_Reaction':
                        //     include 'core/VIP/Reaction/del.php';
                        //     break;
                        // case 'Update_Reaction':
                        //     include 'core/VIP/Reaction/update.php';
                        //     break;
                        // case 'Manager_VIP_Reaction':
                        //     include 'core/VIP/Reaction/list.php';
                        //     break;
                        // case 'Extending_Reaction':
                        //     include 'core/VIP/Reaction/extend.php';
                        //     break;
                        
                        //Event
                        // case 'Event':
                        //     include 'Event/index.php';
                        //     break;

                        // VIP Sub
                        // case 'Buy_Sub':
                        //     include 'core/VIP/Sub/buy.php';
                        //     break;
                        // case 'Add_Sub':
                        //     include 'core/VIP/Sub/add.php';
                        //     break;
                        // case 'Del_Sub':
                        //     include 'core/VIP/Sub/del.php';
                        //     break;
                        // case 'List_Sub':
                        //     include 'core/VIP/Sub/list.php';
                        //     break;




                        // Expires
                        case 'Expires':
                            include 'core/VIP/Expires/list.php';
                            break;
                        case 'Del_Expires':
                            include 'core/VIP/Expires/del.php';
                            break;


                        // NOTIFICATION
                        case 'Notify':
                            include 'core/Noti/list.php';
                            break;
                        case 'Seen_Noti':
                            include 'core/Noti/seen.php';
                            break;
                        case 'Delete_Noti':
                            include 'core/Noti/del.php';
                            break;
                        case 'Send_Notify':
                            include 'core/Noti/send.php';
                            break;

                        //Statics
                        case 'Statics';
                            include 'core/Admin/Statics/list.php';
                            break;
                        case 'Update_Statics';
                            include 'core/Admin/Statics/update.php';
                            break;
                        case 'Reset_Statics';
                            include 'core/Admin/Statics/reset.php';
                            break;  

                        //HISTORY
                        case 'History';
                            include 'core/History/list.php';
                            break;
                        case 'Delete_History';
                            include 'core/History/del.php';
                            break;

                        // Gift Code
                        case 'GiftCode':
                            include 'core/GiftCode/exec.php';
                            break;
                        case 'Add_GiftCode':
                            include 'core/GiftCode/add.php';
                            break;
                        case 'Manager_GiftCode':
                            include 'core/GiftCode/list.php';
                            break;
                        case 'Delete_GiftCode':
                            include 'core/GiftCode/del.php';
                            break;
                        case 'Edit_GiftCode':
                            include 'core/GiftCode/edit.php';
                            break;

                        // Tools
                        // Manger Member
                        case 'List_Member':
                            include 'core/Admin/Member/list.php';
                            break;
                        case 'Delete_Member':
                            include 'core/Admin/Member/del.php';
                            break;
                        case 'Update_Member':
                            include 'core/Admin/Member/edit.php';
                            break;

                        //Money Transaction
                        case 'Add_Money':
                            include 'core/Admin/Transaction/add.php';
                            break;
                        case 'Transfer_Money':
                            include 'core/Admin/Transaction/transfer.php';
                            break;
                        case 'Change_Money':
                            include 'core/Admin/Transaction/change.php';
                            break;

                        //manager id sticker
                        case 'Add_Sticker':
                            include 'core/Package/Sticker/add.php';
                            break;
                        case 'List_Sticker':
                            include 'core/Package/Sticker/list.php';
                            break;
                        case 'Update_Sticker':
                            include 'core/Package/Sticker/edit.php';
                            break;
                        case 'Delete_Sticker':
                            include 'core/Package/Sticker/del.php';
                            break;

                        //manager couppon
                        case 'Add_Coupon':
                            include 'core/Admin/Coupon/add.php';
                            break;
                        case 'List_Coupon':
                            include 'core/Admin/Coupon/list.php';
                            break;
                        case 'Del_Coupon':
                            include 'core/Admin/Coupon/del.php';
                            break;
                        case 'Update_Coupon':
                            include 'core/Admin/Coupon/update.php';
                            break;

                        //manager package like
                        case 'Add_Package_Like':
                            include 'core/Package/LIKE/add.php';
                            break;
                        case 'List_Package_Like':
                            include 'core/Package/LIKE/list.php';
                            break;
                        case 'Update_Package_Like':
                            include 'core/Package/LIKE/edit.php';
                            break;
                        case 'Delete_Package_Like':
                            include 'core/Package/LIKE/del.php';
                            break;

                        //manager package CMT
                        case 'Add_Package_CMT':
                            include 'core/Package/CMT/add.php';
                            break;
                        case 'List_Package_CMT':
                            include 'core/Package/CMT/list.php';
                            break;
                        case 'Update_Package_CMT':
                            include 'core/Package/CMT/edit.php';
                            break;
                        case 'Delete_Package_CMT':
                            include 'core/Package/CMT/del.php';
                            break;

                        //manager package share
                        case 'Add_Package_Share':
                            include 'core/Package/Share/add.php';
                            break;
                        case 'List_Package_Share':
                            include 'core/Package/Share/list.php';
                            break;
                        case 'Update_Package_Share':
                            include 'core/Package/Share/edit.php';
                            break;
                        case 'Delete_Package_Share':
                            include 'core/Package/Share/del.php';
                            break;

                        //manager package reaction
                        case 'Add_Package_Reaction':
                            include 'core/Package/Reaction/add.php';
                            break;
                        case 'List_Package_Reaction':
                            include 'core/Package/Reaction/list.php';
                            break;
                        case 'Update_Package_Reaction':
                            include 'core/Package/Reaction/edit.php';
                            break;
                        case 'Delete_Package_Reaction':
                            include 'core/Package/Reaction/del.php';
                            break;

                        // token 
                        case 'Add_Token_VTA':
                            include 'core/TokenVTA/Add/index.php';
                            break;
                        case 'Del_Token_VTA':
                            include 'core/TokenVTA/Del/index.php';
                            break;
                        case 'Check_Token':
                            include 'core/TokenVTA/check.php';
                            break;
                        case 'Gets_Token':
                            include 'core/TokenVTA/Get/index.php';
                            break;


                        // list admin
                        case 'List':
                            include 'core/Admin/list.php';
                            break;

                        // CTV Management
                        case 'List_CTV':
                            include 'core/Admin/CTV/list.php';
                            break;
                        case 'Delete_CTV':
                            include 'core/Admin/CTV/del.php';
                            break;
                        case 'Update_CTV':
                            include 'core/Admin/CTV/update.php';
                            break;
                        case 'Add_CTV':
                            include 'core/Admin/CTV/add.php';
                            break;
                        case 'Edit_CTV':
                            include 'core/Admin/CTV/edit.php';
                            break;

                        // List VIP Like CTV
                        // case 'CTV_Like':
                        //     include 'core/Admin/CTV/Like/list.php';
                        //     break;
                        // case 'CTV_Delete_Like':
                        //     include 'core/Admin/CTV/Like/del.php';
                        //     break;
                        // case 'CTV_Extending_Like':
                        //     include 'core/Admin/CTV/Like/extend.php';
                        //     break;
                        // case 'CTV_Update_Like':
                        //     include 'core/Admin/CTV/Like/update.php';
                        //     break;

                        //List VIP CMT CTV
                        case 'CTV_Delete_CMT':
                            include 'core/Admin/CTV/CMT/del.php';
                            break;
                        case 'CTV_Extending_CMT':
                            include 'core/Admin/CTV/CMT/extend.php';
                            break;
                        case 'CTV_Update_CMT':
                            include 'core/Admin/CTV/CMT/update.php';
                            break;
                        case 'CTV_CMT':
                            include 'core/Admin/CTV/CMT/list.php';
                            break;

                        //List VIP Reaction CTV
                        case 'CTV_Delete_Reaction':
                            include 'core/Admin/CTV/Reaction/del.php';
                            break;
                        case 'CTV_Extending_Reaction':
                            include 'core/Admin/CTV/Reaction/extend.php';
                            break;
                        case 'CTV_Update_Reaction':
                            include 'core/Admin/CTV/Reaction/update.php';
                            break;
                        case 'CTV_Reaction':
                            include 'core/Admin/CTV/Reaction/list.php';
                            break;
                            
                        case 'Setting':
                            include 'core/Admin/setting.php';
                            break;

                        case 'List_Agency':
                            include 'core/Admin/Dai_Li/list.php';
                            break;
                        case 'Delete_Agency':
                            include 'core/Admin/Dai_Li/del.php';
                            break;
                        case 'Update_Agency':
                            include 'core/Admin/Dai_Li/update.php';
                            break;
                        case 'Edit_Agency':
                            include 'core/Admin/Dai_Li/edit.php';
                            break;
                        case 'Add_Agency':
                            include 'core/Admin/Dai_Li/add.php';
                            break;

                        //Notification
                        case 'Update_Noti':
                            include 'core/Admin/Noti/update.php';
                            break;

                        default:
                            echo "<script>alert('LỖI NHA!'); window.location='index.php';</script>";
                            break;
                    }
                }
            } else {
                if ($duysexy == false) {
                    // include 'dashboard.php';
                    echo "<script>window.location='xinchao.php';</script>";
                } else {
                if($baomat == '0'){
                    echo "<script>alert('VUI LÒNG XÁC NHẬN TÀI KHOẢN'); window.location='index.php?vip=Xac_Nhan';</script>";
                }
                    include 'person/dashboard.php';
                }
            }
            ?>
        </div>

<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark" style="height: 100%;background-image: linear-gradient(rgb(53, 92, 125), rgb(108, 91, 123), rgb(192, 108, 132));">
    <div class="row" style="margin: 10px 10px">
    <img src="https://graph.facebook.com/<?php echo isset($xprofile) ? $xprofile : '4'; ?>/picture/picture?type=large" class="profile-user-img-vta img-responsive img-circle" alt="User Image">
    </div>
    <div class="row" style="margin: 10px 10px">
     <a class="btn btn-primary form-control" href="#"><?php echo isset($xname) ? $xname : ''; ?>
      </a>
    </div>
    <div class="row" style="margin: 10px 10px">
     <a class="btn btn-primary form-control" href="#"><?php echo number_format(isset($xbill) ? $xbill : ''); ?> VNĐ
      </a>
    </div>
    <div class="row" style="margin: 10px 10px">
        <a class="btn btn-primary form-control" href="/index.php?vip=Change_Info">Đổi thông tin</a>
    </div>
    <div class="row" style="margin: 10px 10px">
        <a class="btn btn-primary form-control" href="/index.php?vip=Change_Pass">Đổi mật khẩu</a>
    </div>
    <div class="row" style="margin: 10px 10px">
        <a class="btn btn-danger form-control" onclick="logouts()">Thoát</a>
    </div>
</aside>
<div class="control-sidebar-bg"></div>
<!--Start of Tawk.to Script-->
<script type="text/javascript">
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/5adc81c75f7cdf4f05336b0f/default';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
</script>
<!--End of Tawk.to Script-->
<footer class="main-footer">  
        <div class="col-md-3 hidden-xs"> 
          <i class="fa fa-home"></i> Liên Kết Trang 
          <ul> 
            <li><a href="/">Trang chủ</a></li> 
            <li><a href="#" target="_blank">Hướng dẫn</a></li> 
            <li><a href="#" target="_blank">Giới thiệu</a></li> 
            <li><a href="https:/M.ME/100009580369715" target="_blank">Liên Hệ</a></li> 
          </ul> 
        </div> 
        <div class="col-md-6"> 
          <center> 
            <div style="text-align:center"> 
              <p><b>HETHONGSONGAO.COM<br>Hệ Thống VIP LIKE Hiện Đại Nhất Hiện Nay</b></p> 
              <div> 
                <a><i class="fa fa-twitter-square" style="font-size:36px;color:#000000"></i></a> &nbsp;&nbsp; 
                <a><i class="fa fa-facebook-square" style="font-size:36px;color:#000000"></i></a> &nbsp;&nbsp; 
                <a><i class="fa fa-google-plus-square" style="font-size:36px;color:#000000"></i></a> &nbsp;&nbsp; 
                <a><i class="fa fa-youtube-square" style="font-size:36px;color:#000000"></i></a><br> 
                <small>Development By <i class="fa fa-paper-plane-o"></i> Vũ Tiến Anh</small><br> 
                <small>© 2017 - <?= date('Y'); ?>VTASYSTEM.COM</small><br> 
              </div> 
            </div>  
          </center> 
        </div> 
        <div class="col-md-3 hidden-xs"> 
          <i class="fa fa-link"></i> Liên Kết Site 
          <ul> 
            <li><a href="https://www.facebook.com/100009580369715" target="_blank">Facebook</a></li> 
            <li><center><a href="https://hethongsongao.com/"><img src="https://www.easycounter.com/counter.php?hethongsongao" border="0" alt="stats counter"></a></center></li> 
          </ul> 
        </div> 
      </footer>
<!-- 
        <footer class="main-footer" data-wow-duration="3s">
            <div class="pull-right hidden-xs">
                <strong><code>HTSA v5.5</code> Code By <a href="#" target="_blank"><code>HTSA</code></a></strong>
            </div>
            <strong>&copy; 2017-<?= date('Y'); ?> <code>HETHONGSONGAO.COM</code> Powered By <a href="/" target="_blank"><code>VTASYSTEM</code></a>
        </footer> -->

        <div id="price" class="modal animated flash" role="dialog">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title" style="text-align:center">Bảng Giá</h4>
                    </div>
                    <div class="modal-body">
                        <?php include 'inc/bang_gia.php'; ?>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Đóng</button>
                    </div>
                </div>

            </div>
        </div>
        <script src="inc/vtasieudeptrai.js"></script>
<noscript>Your browser does not support JavaScript!!!</noscript>
</body>
</html>
