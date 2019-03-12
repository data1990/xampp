<?php if(isset($this->session->userdata['logged_in'])){?>
<aside class="control-sidebar control-sidebar-dark" style="height: 100%;background-image: linear-gradient(rgb(53, 92, 125), rgb(108, 91, 123), rgb(192, 108, 132));">
    <div class="row" style="margin: 10px 10px">
    <img src="https://graph.facebook.com/<?php echo $this->session->userdata['logged_in']['fbid']; ?>/picture/picture?type=large" class="profile-user-img-vta img-responsive img-circle" alt="User Image">
    </div>
    <div class="row" style="margin: 10px 10px">
     <a class="btn btn-primary form-control" href="#"><?php echo $this->session->userdata['logged_in']['name']; ?>
      </a>
    </div>
    <div class="row" style="margin: 10px 10px">
     <a class="btn btn-primary form-control" href="#"><?php echo number_format($this->session->userdata['logged_in']['money']); ?> VNĐ
      </a>
    </div>
    <div class="row" style="margin: 10px 10px">
        <a class="btn btn-primary form-control" href="/index.php?vip=Change_Info">Đổi thông tin</a>
    </div>
    <div class="row" style="margin: 10px 10px">
        <a class="btn btn-primary form-control" href="/index.php?vip=Change_Pass">Đổi mật khẩu</a>
    </div>
    <div class="row" style="margin: 10px 10px">
        <a class="btn btn-danger form-control" onclick="thoat()">Thoát</a>
    </div>
</aside>

<div class="control-sidebar-bg"></div>

<script>
function thoat(){
            swal({
              title: 'Bạn có chắc chắn muốn đăng xuất?',
              text: "HAYLIKE",
              type: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Vâng, Tôi muốn!',
              cancelButtonText: 'Trở về'
            }).then(function() {
              location.href = "thoat";
            })
        }
    </script>
    <?php } ?>
    
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
              <p><b>KHIENAVATAR.TOP > Hệ Thống VIP LIKE Hiện Đại Nhất Hiện Nay</b></p> 
              <div> 
                <a><i class="fa fa-twitter-square" style="font-size:36px;color:#000000"></i></a> &nbsp;&nbsp; 
                <a><i class="fa fa-facebook-square" style="font-size:36px;color:#000000"></i></a> &nbsp;&nbsp; 
                <a><i class="fa fa-google-plus-square" style="font-size:36px;color:#000000"></i></a> &nbsp;&nbsp; 
                <a><i class="fa fa-youtube-square" style="font-size:36px;color:#000000"></i></a><br> 
                <small>Development By <i class="fa fa-paper-plane-o"></i> Mr Hoàng</small><br> 
                <small>© 2017 - 2019KHIENAVATAR.TOP</small><br> 
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


       
        <!--<script src="assets/js/vtasieudeptrai.js"></script>-->
<noscript>Your browser does not support JavaScript!!!</noscript>
</body>
</html>
