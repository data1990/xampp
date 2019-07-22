<!DOCTYPE html>
<html>
<head>
	<?php $this->load->view('trangchu/head'); ?>
</head>
<body>
	<div id="header-box">
		<?php $this->load->view('trangchu/menu'); ?>
	</div>
	<div class="main-content clearfix">
		<div class="container">
			<div class="left">
				<?php $this->load->view('trangchu/left'); ?>
			</div>
			<div class="right">
				
				<?php $this->load->view($temp); ?>
			</div>
		</div>
		<footer class="footer">
			<?php $this->load->view('trangchu/footer'); ?>
		</footer>
		<script type="text/javascript" src="//js.f.360game.vn/publishing/mainsites/nth360/3/js/jquery.js"></script>
 		<script type="text/javascript" src="//js.f.360game.vn/publishing/mainsites/nth360/3/js/tab.js"></script>
 		<script type="text/javascript" src="//js.f.360game.vn/publishing/mainsites/nth360/3/js/jquery.bxslider.min.js"></script>
        <script src="//js.f.360game.vn/publishing/mainsites/nth360/3/js/index.js"></script>
        <script type="text/javascript" src="//js.f.360game.vn/publishing/mainsites/nth360/3/js/dropdown.js"></script>
   		<script type="text/javascript" src="//js.f.360game.vn/publishing/mainsites/nth360/3/js/modal.js"></script>
 		<script type="text/javascript">
 			function _scrolltotop() {
              $("#back-top").hide();
              //--------------------------
              $(window).scroll(function() {
                  if ($(this).scrollTop() > 100) {
                      $('#back-top').fadeIn();
                  } else {
                      $('#back-top').fadeOut();
                  }
              });
              // scroll body to 0px on click
              $('#back-top a').click(function() {
                  $('body,html').animate({
                      scrollTop: 0
                  }, 800);
                  return false;
              });
          }

          function _togglelist() {
              if ($(this).parent().hasClass("active")) {
                  $(this).parent().next().slideUp(300);
                  $(this).parent().removeClass("active");
              } else {
                  $(this).parent().next().slideDown(300);
                  $(this).parent().addClass("active");
              }
          }

          jQuery(document).ready(function() {
              _scrolltotop();
              $('.fb-chat-box .title .ico').click(_togglelist);

              $('.bn-slide').bxSlider({
                  auto: true,
                  pause: 5000,
                  controls: false
              });
              $('.bg-slide').bxSlider({
                  auto: true,
                  pause: 2000,
                  mode: 'fade',
                  controls: false,
                  slideWidth: 1289
              });
          });

 			function search(){
 				window.location = '//nth.360game.vn/tim-kiem?q=' + $('#search-input').val();
 			}
 			</script>
	</div>
</body>
</html>