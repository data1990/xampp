<h2 class="play-btn"><a class="btnquicklogin" href="#"></a></h2>



<ul class="regis-block clearfix">
    <li class="register">
        <a class="btnreg" href="#"></a>
    </li>
    <li class="card">
        <a class="btnquicklogin" href="#"></a>
    </li>
</ul>

<div class="search">
    <input id="search-input" type="text" name="" placeholder="Nhập từ khóa cần tìm">
    <a href="javascript:search();" class="search-btn"></a>
</div>
<div id="login-box" class="login-box">
	<?php if($this->session->userdata('user')) {?>
			<div class="frm-bock clearfix">
				<div class="acc clearfix">
					<p class="avatar"><img src="http://jp.avatar.zdn.vn/?user=mrhoang9086&amp;size=120"></p>
					<p class="name">
						<span class="txt1">Xin chào</span>
						<span class="txt2"><?php echo $this->session->userdata('user') ?></span>
					</p>
				</div>
			 	<div class="server-btn"><a href="#" onclick="location='//nth.360game.vn/server-game'+location.search"></a></div>
			</div>
			<div class="links clearfix">
				<p class="info-acc"><a href="https://id.zing.vn" target="_blank">Thông tin tài khoản</a></p>
				<p class="logout"><a href="<?php echo base_url('home/logoutuser') ?>">(Thoát)</a></p>
			</div>

	<?php }else{	?>
    <form id="logForm">
       	<span id="message"></span>
        <!--<span class="error" id="message" style="display: normal;">Báo lỗi tại đây !!!</span>-->
        <div class="frm-bock clearfix">
            <div class="left-frm">
                <p class="frm">
                    <input id="i_name" name="username" type="text" placeholder="Tài khoản Zing ID">
                </p>
                <p class="frm">
                    <input id="i_pass" name="password" type="password" placeholder="Mật khẩu">
                </p>
            </div>
           <!-- <p id="btnlogin" class="login-btn" type="submit"><a href="javascript: void(0);">Đăng nhập</a>-->
            	<button type="submit" class="login-btn1"><span id="logText"></span></button>
            </p>
        </div>
        <p class="pass-forgot"><a href="" target="_blank">Quên mật khẩu?</a>
        </p>
    </form>
<?php } ?>

</div>
<div id="server-list-box">
    <div class="server-list">
        <h2 class="title">DANH SÁCH MÁY CHỦ</h2>


        <div class="new-server"><a href="javascript:void(0)" onclick="doServerLogin('147')">s147. Lôi Kiếm</a>
        </div>
        <!--<div class="new-server"><a href="javascript:void(0)" onclick="doServerLogin('1')">S1. Hoa Sơn</a></div>-->
        <ul class="list clearfix" style="display: block;">

            <li style="display: list-item;"><a href="javascript:void(0)" onclick="doServerLogin('146')">s146. Băng Kiếm</a>
            </li>

            <li style="display: list-item;"><a href="javascript:void(0)" onclick="doServerLogin('145')">s145. Hỏa Kiếm</a>
            </li>

            <li style="display: list-item;"><a href="javascript:void(0)" onclick="doServerLogin('144')">s144. Phong Kiếm</a>
            </li>

            <li style="display: list-item;"><a href="javascript:void(0)" onclick="doServerLogin('143')">s143. Kỳ Kiếm</a>
            </li>

            <li style="display: list-item;"><a href="javascript:void(0)" onclick="doServerLogin('142')">s142. Hằng Kiếm</a>
            </li>

            <li style="display: list-item;"><a href="javascript:void(0)" onclick="doServerLogin('141')">s141. Hành Kiếm</a>
            </li>

            <li style="display: list-item;"><a href="javascript:void(0)" onclick="doServerLogin('140')">s140. Thiên Kiếm</a>
            </li>



        </ul>

        <div class="server-slide">
            <a href="javascript:void(0)" class="slide-btn prev"></a>
            <a href="javascript:void(0)" class="slide-btn next"></a>
            <ul style="width: 894px; display: block;">
                <li class="active"><a bucket="0" href="javascript:void(0)">146-137</a>
                </li>
                <li><a bucket="1" href="javascript:void(0)">136-127</a>
                </li>
                <li><a bucket="2" href="javascript:void(0)">126-117</a>
                </li>
                <li><a bucket="3" href="javascript:void(0)">116-107</a>
                </li>
                <li><a bucket="4" href="javascript:void(0)">106-97</a>
                </li>
                <li><a bucket="5" href="javascript:void(0)">96-87</a>
                </li>
                <li><a bucket="6" href="javascript:void(0)">86-77</a>
                </li>
                <li><a bucket="7" href="javascript:void(0)">76-67</a>
                </li>
                <li><a bucket="8" href="javascript:void(0)">66-57</a>
                </li>
                <li><a bucket="9" href="javascript:void(0)">56-47</a>
                </li>
                <li><a bucket="10" href="javascript:void(0)">46-37</a>
                </li>
                <li><a bucket="11" href="javascript:void(0)">36-27</a>
                </li>
                <li><a bucket="12" href="javascript:void(0)">26-17</a>
                </li>
                <li><a bucket="13" href="javascript:void(0)">16-7</a>
                </li>
                <li><a bucket="14" href="javascript:void(0)">6-1</a>
                </li>
            </ul>
        </div>
    </div>
</div>
<div id="feature-box" class="feature-social clearfix">
    <ul>
        <li>
            <a href="https://www.facebook.com/nth.360game.vn/" target="_blank"></a>
        </li>
        <li>
            <a href="//nth.360game.vn/thong-tin-chi-tiet?id=RTZk2Q" target="_blank"></a>
        </li>
        <li>
            <a href="https://goo.gl/ro5Evy" target="_blank"></a>
        </li>
        <li>
            <a href="//nth.360game.vn/cam-nang/tinh-nang-dac-sac/" target="_blank"></a>
        </li>
    </ul>
</div>
<div id="fb-box-fanpage">
    <div class="fb-like-box fb_iframe_widget" style="position: relative;top: -120px;" data-href="https://www.facebook.com/nth.360game.vn" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="false" data-width="280" fb-xfbml-state="rendered" fb-iframe-plugin-query="app_id=1349275128543385&amp;container_width=270&amp;href=https%3A%2F%2Fwww.facebook.com%2Fnth.360game.vn&amp;locale=vi_VN&amp;sdk=joey&amp;width=280"><span style="vertical-align: bottom; width: 280px; height: 214px;"><iframe name="f360027417e439c" width="280px" height="1000px" title="fb:like_box Facebook Social Plugin" frameborder="0" allowtransparency="true" allowfullscreen="true" scrolling="no" allow="encrypted-media" src="https://www.facebook.com/v2.10/plugins/like_box.php?app_id=1349275128543385&amp;channel=https%3A%2F%2Fstaticxx.facebook.com%2Fconnect%2Fxd_arbiter.php%3Fversion%3D44%23cb%3Df3f83f7feac8f8%26domain%3Dnth.360game.vn%26origin%3Dhttps%253A%252F%252Fnth.360game.vn%252Ff2050bc24633b2c%26relation%3Dparent.parent&amp;container_width=270&amp;href=https%3A%2F%2Fwww.facebook.com%2Fnth.360game.vn&amp;locale=vi_VN&amp;sdk=joey&amp;width=280" style="border: none; visibility: visible; width: 280px; height: 214px; --darkreader-inline-border-top: initial; --darkreader-inline-border-right: initial; --darkreader-inline-border-bottom: initial; --darkreader-inline-border-left: initial;" __idm_frm__="460" class="" data-darkreader-inline-border-top="" data-darkreader-inline-border-right="" data-darkreader-inline-border-bottom="" data-darkreader-inline-border-left=""></iframe></span>
    </div>
</div>
<script type="text/javascript">
	$(document).ready(function(){
		$('#logText').html('Đăng nhập');
		$('#logForm').submit(function(e){
			e.preventDefault();
			$('#logText').html('Checking...');
			var url = '<?php echo base_url(); ?>';
			var user = $('#logForm').serialize();
			var login = function(){
				$.ajax({
					type: 'POST',
					url: 'home/checklogin',
					dataType: 'json',
					data: user,
					success:function(response){
						$('#message').html(response.message);
						$('#logText').html('Login');
						if(response.error){
							$('#message').removeClass('success').addClass('error').show();
						}
						else{
							$('#message').removeClass('error').addClass('success').show();
							$('#logForm')[0].reset();
							setTimeout(function(){
								location.reload();
							}, 3000);
						}
					}
				});
			};
			setTimeout(login, 3000);
		});
	});
</script>
  <style type="text/css">
  	.login-box .frm-bock .login-btn1, .login-box .frm-bock .server-btn {
    float: left;
}

.login-btn1{
    background: url(https://css.f.360game.vn/publishing/mainsites/nth360/3/images/sprt_img.png) no-repeat;
    float: left;
    width: 80px;
    height: 70px;
    margin-left: 10px;
    text-indent: -9999px;
}

.login-btn1 {
    background-position: 0 -152px;
}

.login-btn1:hover {
    background-position: -90px -152px;
}
.login-box .frm-bock .acc {
    background: #ffffff;
    float: left;
    width: 155px;
    height: 70px;
    padding: 19px 7px 0;
    color: #7b7777;
    border: 1px solid #595959;
}
.login-box .frm-bock .acc .avatar {
    float: left;
    margin-right: 7px;
}
  </style>